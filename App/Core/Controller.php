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
 * Base controller class
 *
 */

namespace App\Core;

use App\Core\Abstraction\ServicesLoadersInterface;
use Exception;

abstract class Controller
{
    /**
     * model and views loader
     * @var object
     */
    protected  $load;
    /**
     * services to be loaded
     * @var ServicesLoadersInterface
     */
    protected  $services;

    /**
     * Controller constructor.
     * @param ServicesLoadersInterface $services
     * @param Loader $loader
     */
    public function __construct(ServicesLoadersInterface $services, Loader $loader)
    {
        $this->services = $services;
        $this->load     = $loader;
    }

    /**
     * load services on service call
     * @param $service
     * @return mixed
     */
    public function __get($service)
    {
        return $this->services->get($service);
    }

    /**
     * @throws Exception
     */
    public function manage()
    {
        $method = Linker::route('DEFAULT_ACTION'); // default action
        $controller = static::class;
        throw new Exception("error $controller Controller needs a $method Method");
    }

    /**
     * Default error Action
     *
     * @return void
     */
    public function errorAction()
    {
        $this->load->view("error", ["404"], "404");
    }
}