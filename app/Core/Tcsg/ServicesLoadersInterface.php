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
 * ServicesLoaders Interface
 *
 */

namespace App\Core\Tcsg;

interface ServicesLoadersInterface
{
    /**
     * Register method
     * Register all services loaded from config
     * use reflexion class to instanciate singletone or normal classes
     * @return mixed
     */
    public function register();

    /**
     * Get services method
     * Return an object of the loaded service otherwise throw an Exception if not found
     * @param $serviceName
     * @return mixed
     */
    public function get($serviceName);
}