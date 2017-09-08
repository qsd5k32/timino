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

namespace Timino\App\Core;

use Timino\App\Core\Abstraction\ServicesLoadersInterface;
use Timino\App\Services\Template\ErrorTemplator;

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
     * @return array scan services directory
     */
    private function scan()
    {
        $rii = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(APP . "Services" . DS));

        $files = array();
        foreach ($rii as $file)
            if (!$file->isDir())
                $files[] = $file->getPathname();
        return $files;
    }

    /**
     * generate services method
     * @return array service name => service class
     */
    private function generate()
    {
        // remove php extension
        $services = array_map(function ($elem) {
            $elem = substr($elem, strpos($elem, "App"));
            return rtrim($elem, ".php");
        }, $this->scan());

        // explode services to an array and remove base directories /var/www
        for ($i = 0; $i < sizeof($services); $i++) {
            $explodeServices[] = explode("/", $services[$i]);
        }

        // set each service with name and
        // replace directory separator with namespace separator
        foreach ($explodeServices as $service) {
            // make first service letter upper case
            $ucfirstServices = array_map(function ($elem) {
                return ucfirst($elem);
            }, array_values($service));

            $servicesNames[] = $ucfirstServices[count($ucfirstServices) - 1];

            $srv[] = implode("/", $ucfirstServices);
            $servicesNamespaces = array_map(function ($elem) {
                $elem = preg_replace("#\/#", "\\", $elem);
                return "\\" . $elem;
            }, $srv);
        }

        // each service with name as key and namespace as value
        return array_combine($servicesNames, $servicesNamespaces);
    }


    /**
     * set()
     * register services
     * single tone with instantiate()
     * simple services with the new keyword
     */
    public function register()
    {
        /**
         * check for single tone classes and normal classes with reflection class
         * set instantiate single tone with ::instantiate() and normal with new
         * and save services to $this->services array;
         */
        foreach ($this->generate() as $srvName => $service) {
            try {

                if (!class_exists($service)) throw new  \Exception("Error <b>$service</b> Service <b>class</b> doesn't exists !");

                $class = new \ReflectionClass($service);

                if ($class->hasMethod("instantiate")) {
                    $this->services[$srvName] = (!isset($this->services[$srvName])) ? $this->services[$srvName] = $service::instantiate
                    () : NULL;

                } else {

                    $this->services[$srvName] = (!isset($this->services[$srvName])) ? $this->services[$srvName] = new $service() : NULL;
                }


            } catch (\Exception $e) {
                die(ErrorTemplator::exceptionError($e->getMessage()));
            }

        }

    }

    /**
     * get services method
     * @param $serviceName
     * @return mixed
     */
    public function get($serviceName)
    {
        try {
            $serviceName = ucfirst($serviceName);
            if (!isset($this->services[$serviceName])) throw new \Exception("Error service <b>$serviceName</b> Doesn't exists !");
            return $this->services[$serviceName];
        } catch (\Exception $e) {

            die(ErrorTemplator::exceptionError($e->getMessage()));
        }
    }
}