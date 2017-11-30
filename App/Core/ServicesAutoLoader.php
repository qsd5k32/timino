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
 * Services Autoloader class
 *
 */

namespace App\Core;

use App\Core\Abstraction\ServicesLoadersInterface;
use Exception;
use ReflectionClass;

class ServicesAutoLoader implements ServicesLoadersInterface
{
    /**
     * @var array services to be registered
     */
    private $services = array();

    /**
     * ServiceLoader constructor.
     * start the Service autoloader
     */
    public function __construct()
    {
        $this->register();
    }

    /**
     * register services method
     * @throws \Exception
     */
    public function register()
    {
        $file = APP . 'Config' . DS . 'services.php';

        if (!file_exists($file)) throw new Exception("Error file $file not found !");

        $file = array_map(function($e){ return ucfirst($e);}, require $file);

        /**
         * check for single tone classes and normal classes with reflection class
         * set instantiate single tone with ::instantiate() and normal with new
         * and save services to $this->services array;
         */
        foreach ($file as $srvName => $service) {

            if (!class_exists($service)) throw new  Exception("error <b>$service</b> Service <b>class</b> doesn't exists !");

            $class = new ReflectionClass($service);

            if ($class->hasMethod("instantiate")) {
                $this->services[$srvName] = (!isset($this->services[$srvName])) ? $this->services[$srvName] = $service::instantiate
                () : NULL;

            } else {

                $this->services[$srvName] = (!isset($this->services[$srvName])) ? $this->services[$srvName] = new $service() : NULL;
            }
        }

    }

    /**
     * get services method
     * @param $serviceName
     * @return mixed
     * @throws \Exception
     */
    public function get($serviceName)
    {
        $serviceName = ucfirst($serviceName);
        if (!isset($this->services[$serviceName])) throw new Exception("error service $serviceName Doesn't exists !");
        return $this->services[$serviceName];
    }
}