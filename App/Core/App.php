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

use App\Core\Abstraction\RequestInterface;
use App\Services\Template\ErrorTemplator;

class App
{
    /**
     * @var default controller
     */
    private $controller;

    /**
     * @var default action
     */
    private $action;

    /**
     * @var array params
     */
    private $params;

    /**
     * set default controller and method function
     */
    public function setDefault()
    {
        $this->controller = Linker::route("DEFAULT_CONTROLLER");
        $this->action = Linker::route("DEFAULT_ACTION");
    }

    /**
     * App constructor.
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->setDefault();
        $this->params = $request->params();

        /**
         * check for Requested controller
         */
        if ($request->controller()) {
            $controller = Linker::namespace("CONTROLLERS") . ucfirst($request->controller());
            $this->controller = (class_exists($controller)) ? $request->controller() : Linker::route("ERROR_CONTROLLER");
        }

        /**
         * call controller
         */
        try {

            $controller = Linker::namespace("CONTROLLERS") . ucfirst($this->controller);
            if (!class_exists($controller)) throw new \Exception("Error controller <b>$controller</b> Doesn't exists");

            $this->controller = new $controller(new ServicesAutoLoader, new Loader);

        } catch (\Exception $e) {
            die(ErrorTemplator::exceptionError($e->getMessage()));
        }

        /**
         * check for requested method
         */
        if ($request->action()) {
            $this->action = (method_exists($this->controller, $request->action())) ? $request->action() : Linker::route("ERROR_ACTION");
        }

        /**
         * call controller method with parameters
         */
        call_user_func_array([$this->controller, $this->action,], $this->params);
    }
}