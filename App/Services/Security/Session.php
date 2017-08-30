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
 *  Session class
 * 
 */

namespace Timino\App\Services\Security;

class Session
{
   /**
    * start session method
    *
    * @return void
    */
   public function init()
   {
      if(!isset($_SESSION))
      {
         session_start();
      }
   }

   /**
    * set session method
    *
    * @param string $name session name
    * @param string $val  session value
    * @return void
    */
   public function set($name, $val)
   {
      $_SESSION[$name] = $val;
   }

   /**
    * get session method
    *
    * @param string $name session name
    * @return void
    */
   public function get($name)
   {
      return (isset($_SESSION[$name]) )? $_SESSION[$name] : false;
   }

   /**
    * unset session method
    *
    * @param string $name session name
    * @return void
    */
   public function remove($name)
   {
      if(isset($_SESSION[$name]))  unset($_SESSION[$name]);
      return false;
   }

   /**
    * destroy the whole session method
    *
    * @return void
    */
   public function destroy()
   {
      session_destroy();
   }
}