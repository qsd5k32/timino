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
 *  TimeAgo service class
 * 
 */

namespace Timino\App\Services\DateTime;

class TimeAgo
{
   /**
    * elapced time methos
    *
    * @param string $datetime TIMESTAMP string
    * @param boolean $full show full elapced time years months hours minutes seconds
    * @return string
    */
   public function timeAgo($datetime, $full = false) {

      $now = new \DateTime;
      $ago = new \DateTime($datetime);
      $diff = $now->diff($ago);
  
      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;
  
      $string = array(
          'y' => 'year',
          'm' => 'month',
          'w' => 'week',
          'd' => 'day',
          'h' => 'hour',
          'i' => 'minute',
          's' => 'second',
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
      }
  
      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

}