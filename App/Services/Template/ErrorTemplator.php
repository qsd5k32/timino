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
 *  Error templator class
 *
 */

namespace App\Services\Template;

class ErrorTemplator
{
    public static function exceptionError($err)
    {
        $tmp = "<div style=';
      color: #F44336;
      padding: 30px;
      background: #f7f7f7;
      width: 70%;
      margin: auto;
      border: 1px dashed #cac6c6;'>";
        $tmp .= $err;
        $tmp .= "</div>";
        return $tmp;
    }
}