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
 * Service provider class
 * 
 */
namespace Timino\App\Core;

use Timino\App\Services\Template\ErrorTemplator;
        
class ServiceProvider
{
   /**
    * Store services
    * @var array
    */
   private $services = array();

   /**
    * set services names and namespaces always to ucfirst 
    * and load them to the services array
    */
   public function __construct()
   {
      $services = CONFIG . "Services" . ".conf.php";
      try{

        if(!file_exists($services)) throw new \Exception("Error $services file was not found ! ");

        $services = require $services;
        
        if(!is_array($services) OR count($services) < 1) throw new \Exception("Error Servicess confing file should be an array of keys services names and values services classes");

        // make service name and namespace always ucfirst
        foreach($services as $name => $class)
        {
          $name  = ucfirst($name);
          $class = explode("\\", $class);
          $class = array_map("ucfirst", $class);
          $class = implode("\\", $class);

          $srv[$name] = $class;
        }

        // load services to the services array;
        // instanciate boath single tone and normale classes
        foreach($srv as $name => $class)
        {
          if(preg_match("+\.s$+", $name))
          {
              $name = explode(".", $name)[0];

            (!isset($this->services[$name])) ? $this->services[$name] = $class::instantiate() : false;
          
          }else{

            try{

              if(!class_exists($class)) throw new \Exception("Error class $class was not found ! ");
              (!isset($this->services[$name])) ? $this->services[$name] = new $class()  : false;

            }catch(\Exception $e)
            {
              die(ErrorTemplator::exceptionError($e->getMessage()));
            }

              
          }

        }


      }catch(\Exception $e)
      {
        die(ErrorTemplator::exceptionError($e->getMessage()));
      }
   }

   

   /**
    * get services method
    *
    * @param string $name service name
    * @return void
    */
   public function get($name)
   {
      $name  = ucfirst($name);
      return (isset($this->services[$name])) ? $this->services[$name] : die(ErrorTemplator::exceptionError("Error $name Service Was Not Found !"));
   }
}