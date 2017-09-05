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

namespace Timino\App\Core;

use Timino\App\Core\Abstraction\RequestInterface;

class Request implements RequestInterface
{
    /**
     * @return array
     */
    public function uri()
    {
        $uri = preg_replace("/[^\w\d\@\.\-\/]/", NULL, trim($_SERVER['REQUEST_URI'], "/"));
        return array_values(array_filter(explode("/", $uri)));
    }

    /**
     * @return mixed|null
     */
    public function controller()
    {
        return $this->uri()[0] ?? NULL;
    }

    /**
     * @return mixed|null
     */
    public function action()
    {
        return $this->uri()[1] ?? NULL;
    }

    /**
     * @return array
     */
    public function params()
    {
        if(count($this->uri()) > 2)
        {
            $uri = $this->uri(); unset($uri[0], $uri[1]); return array_values($uri);
        }
        return array();
    }
}