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
    public $load;

    // services goes down here

    public function __construct(ServicesLoadersInterface $service, Loader $loader)
    {
        $this->load = $loader;
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