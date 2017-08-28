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
 * Linker class
 * 
 */
namespace Timino\App\Core;

use Timino\App\Services\Template\ErrorTemplator;

class Linker
{   
    /**
     * config file suffix
     * @var string
     */
    const SUFFIX = ".conf.php";

   /**
    * routes method for all application links and paths
    * @param string $key
    * @return string path to
    */
   public static function route($key)
   {
      $routes = CONFIG . "Routes" . self::SUFFIX;

      try{

        if(!file_exists($routes)) throw new \Exception("Error $routes file was not found");

        $routes = require $routes;
        
        // if dot access notation 
        if(preg_match("#\.+#", $key))
        {
           $keys = explode(".", $key);
     
           $temp = &$routes;
           
           foreach($keys as $key) {

            if(!isset($temp[$key]))  throw new \Exception("Error $key key was not found");
             
            $temp =& $temp[$key];
           }
           return $temp;
        }

        if(!isset($routes[$key]))  throw new \Exception("Error $key key was not found");

     }catch(\Exception $e)
     {
         die(ErrorTemplator::exceptionError($e->getMessage()));
     }

      return $routes[$key];
   }

   /**
    * routes method for all application links and paths
    * @param string $key
    * @return string path to
    */
   public static function namespace($key)
   {
      $namespaces = CONFIG . "Namespaces". self::SUFFIX;

      try{
        if(!file_exists($namespaces)) throw new \Exception("Error $namespaces file was not found");

        $namespaces = require $namespaces;

        if(!isset($namespaces[$key])) throw new \Exception("Error $key key was not found");

     }catch(\Exception $e)
     {
        die(ErrorTemplator::exceptionError($e->getMessage()));
     }

      return $namespaces[$key];
   }

   /**
    * load database configuration
    *
    * @param [type] $key
    * @return void
    */
   public static function database($key)
   {
       $file = CONFIG . "Database". self::SUFFIX;

      try{
         if(!file_exists($file)) throw new \Exception("Error $file file was not found");

         $file = require $file;

         if(!isset($file[$key])) throw new \Exception("Error $key key was not found");

      }catch(\Exception $e)
      {
         die(ErrorTemplator::exceptionError($e->getMessage()));
      }

      return $file[$key];
   }

   /**
    * regular expression linker metod
    *
    * @param string $key regex name
    * @return string regex pattern
    */
   public static function regex($key)
   {
        $file = CONFIG . "Regex". self::SUFFIX;

        try{
            if(!file_exists($file)) throw new \Exception("Error $file file was not found");

            $file = require $file;

            if(!isset($file[$key])) throw new \Exception("Error $key key was not found");

        }catch(\Exception $e)
        {
            die(ErrorTemplator::exceptionError($e->getMessage()));
        }

        return $file[$key];
   }

   /**
    * email config linker metod
    *
    * @param string $key  name
    * @return string value
    */
   public static function mail($key)
   {
        $file = CONFIG . "Mail". self::SUFFIX;

        try{
            if(!file_exists($file)) throw new \Exception("Error $file file was not found");

            $file = require $file;

            if(!isset($file[$key])) throw new \Exception("Error $key key was not found");

        }catch(\Exception $e)
        {
            die(ErrorTemplator::exceptionError($e->getMessage()));
        }

        return $file[$key];
   }

}