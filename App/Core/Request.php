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
 * Request class
 *
 */

namespace App\Core;

use App\Core\Tcsg\RequestInterface;

class Request implements RequestInterface
{
    /**
     * @var array default uri
     */
    public $uri = array();

    /**
     * Request constructor.
     * initialize $uri
     */
    public function __construct()
    {
        if (isset($_GET['uri'])) {
            $uri = preg_replace(Linker::regex("URI"), NULL, trim($_GET['uri'], "/"));
            $this->uri = array_values(array_filter(explode("/", $uri)));
        }
    }

    /**
     * requested controller
     * @return mixed|null
     */
    public function controller()
    {
        return $this->uri[0] ?? NULL;
    }

    /**
     * requested class
     * @return mixed|null
     */
    public function action()
    {
        return $this->uri[1] ?? NULL;
    }

    /**
     * requested parameters
     * @return array
     */
    public function params()
    {
        if (count($this->uri) > 2) {
            $uri = $this->uri;
            unset($uri[0], $uri[1]);
            return array_values($uri);
        }
        return array();
    }
}