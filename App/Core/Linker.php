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

namespace App\Core;

class Linker
{
    /**
     * @var array available routes method
     */
    private static $routes = array(
        "conf",
        "path",
        "namespace",
        "database",
        "regex",
        "mail"
    );

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic($method, $arguments)
    {
        if (!in_array($method, self::$routes)) throw new \Exception("error Method $method was not found !");

        return self::link($method, $arguments[0]);
    }

    /**
     * @param $method
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public static function link($method, $key)
    {
        $file = CONFIG;

        switch ($method) {
            case "conf"     : $file .= "conf.php";       break;            
            case "path"     : $file .= "paths.php";      break;
            case "namespace": $file .= "namespaces.php"; break;
            case "database" : $file .= "database.php";   break;
            case "regex"    : $file .= "regex.php";      break;
            case "mail"     : $file .= "mail.php";       break;
        }


        if (!file_exists($file)) throw new \Exception("error $file file was not found");

        $routes = require $file;

        // if dot access notation
        if (preg_match("#\.+#", $key)) {
            $keys = explode(".", $key);

            $temp = &$routes;

            foreach ($keys as $key) {

                if (!isset($temp[$key])) throw new \Exception("error $key key was not found on $file");

                $temp = &$temp[$key];
            }

            return $temp;
        }

        if (!isset($routes[$key])) throw new \Exception("error $key key was not found on $file");

        return $routes[$key];
    }
}