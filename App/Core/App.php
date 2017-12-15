<?php

/**
 * Timino - PHP MVC framework
 *
 * @package     Timino
 * @author      Lotfio Lakehal <contact@lotfio-lakehal.com>
 * @copyright   2017 Lotfio Lakehal
 * @license     MIT
 * @link        https://github.com/lotfio-lakehal/timino
 *
 * Copyright (C) 2018
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * INFO :
 * App class
 *
 */

namespace App\Core;

use App\Core\Tcsg\RequestInterface;

class App
{
    /**
     * @var request object
     */
    private $request;

    /**
     * @var
     */
    private $defaultController;

    /**
     * @var
     */
    private $defaultAction;

    /**
     * App constructor.
     * @param RequestInterface $request
     * @throws \Exception
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;

        $this->defaultController = Linker::path("DEFAULT_CONTROLLER");
        $this->defaultAction     = Linker::path("DEFAULT_ACTION");

    }

    public function run()
    {
        /**
         * check for Requested controller
         */
        if ($this->request->controller()) {
            $controller = Linker::namespace("CONTROLLERS") . ucfirst($this->request->controller());
            $this->defaultController = (class_exists($controller))
                ? $this->request->controller() : Linker::path("ERROR_CONTROLLER");
        }

        /**
         * call controller
         */
        $controller = Linker::namespace("CONTROLLERS") . ucfirst($this->defaultController);
        if (!class_exists($controller)) throw new \Exception("error controller $controller Doesn't exists");

        $this->defaultController = new $controller(new ServicesAutoLoader, new Loader);


        /**
         * check for requested method
         */
        if ($this->request->action()) {
            $this->defaultAction = (method_exists($this->defaultController, $this->request->action()))
                ? $this->request->action() : Linker::path("ERROR_ACTION");
        }

        /**
         * call controller method with parameters
         */
        call_user_func_array([$this->defaultController, $this->defaultAction,], $this->request->params());
    }
}