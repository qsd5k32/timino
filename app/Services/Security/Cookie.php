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
 *  Cookie service class
 *
 */

namespace App\Services\Security;

class Cookie
{
    /**
     * @param string $name cookie name
     * @param string $value cookie value
     * @param $exp
     */
    public function set($name, $value, $exp)
    {
        setcookie($name, $value, $exp, "/");
    }

    /**
     * @param string $name cookie name
     * @return mixed
     */
    public function get($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : false;
    }

    /**
     * @param $name cookie name
     * @param $value cookie value
     * @param $exp
     */
    public function serialize($name, $value, $exp)
    {
        setcookie($name, \serialize($value), $exp, "/");
    }

    /**
     * @param $name cookie name
     * @return bool|mixed
     */
    public function unserialize($name)
    {
        if (isset($_COOKIE[$name])) {
            return \unserialize($_COOKIE[$name]);
        }
        return false;
    }

    /**
     * @param $name cookie name
     */
    public function remove($name)
    {
        if (isset($_COOKIE[$name])) $this->set($name, NULL, time() - 100000);
    }

}