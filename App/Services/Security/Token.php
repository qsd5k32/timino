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
 *  Token class
 * 
 */

namespace Timino\App\Services\Security;

class Token
{
   /**
    * random string method
    *
    * @param int $length
    * @return string random strin
    */
   public function randomStr($length = 10)
   {
      $chars = "azertyuiopqsdfghjklmwxcvbn0123654789AZERTYUIOPQSDFGHJKLMWXCVBN";
      $str   = "";

      for($i = 0; $i <= $length; $i++)
      {
         $str .= $chars[rand(0, strlen($chars) - 1)];
      }
      return $str;
   }

   /**
    * set CSRF token
    *
    * @return void
    */
   public function setCsrfToken()
   {
      return $_SESSION["CSRF"] = $this->randomStr(50);
   }

   /**
    * hash password method
    *
    * @param string $passwd
    * @return string hash
    */
   public function hashPasswd($passwd)
   {
      $options = [
         'cost' => 12,
     ];
     return password_hash($passwd, PASSWORD_BCRYPT, $options);
   }

   /**
    * verify password method
    *
    * @param string $passwd user password
    * @param string $hash old password hashed generally from db
    * @return bool
    */
   public function verifyPasswd($passwd, $hash)
   {
      return password_verify($passwd, $hash);
   }
}