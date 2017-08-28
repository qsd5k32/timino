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
 *  Validation service class
 * 
 */

namespace Timino\App\Services\Security;

use Timino\App\Core\Linker;

class Validation
{
   /**
    * email validation method
    *
    * @param string $email
    * @param integer $minLength minimum email length by default 6 a@a.com
    * @return string|bool
    */
   public function email($email, $minLength = 6)
   {
      return (preg_match(Linker::regex("EMAIL"), $email)) && (strlen($email)  >= $minLength) ? $email : 0;
   }

   /**
    * string validation method
    *
    * @param string $string
    * @param int $minLength
    * @return string|bool
    */
   public function string($string, $minLength = 3)
   {
      return (!preg_match(Linker::regex("STRING"), $string)) && (strlen($string)  >= $minLength) ? $string : 0;
   }

   /**
    * arabic string validation method
    *
    * @param string $string
    * @param integer $minLength
    * @return string|bool
    */
   public function arabicString($string, $minLength = 3)
   {
      return (!preg_match(Linker::regex("ARABIC_STRING"), $string)) && (strlen($string)  >= $minLength) ? $string : 0;
   }

   /**
    * french string validation method
    *
    * @param string $string
    * @param integer $minLength
    * @return string|bool
    */
   public function frenchString($string, $minLength = 3)
   {
      return (!preg_match(Linker::regex("FRENCH_STRING"), $string)) && (strlen($string)  >= $minLength) ? $string : 0;
   }
}