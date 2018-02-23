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
 * general Configuration file (general rules)
 *
 */

return [

    // application dir
    "ROOT_DIR"              => "../",
    "APP_DIR"               => "../app",
    "VIEWS_DIR"             => "../app/views",
    "CACHE_DIR"             => "../storage/cache",
    "CONFIG_DIR"            => "../config",
    "PUBLIC_DIR"            => '../public',
    "SUPPORT_DIR"           => "../support",

    // controllers
    "DEFAULT_CONTROLLER"    => "Index",
    "ERROR_CONTROLLER"      => "Error",
    "DEFAULT_ACTION"        => "manage",
    "ERROR_ACTION"          => "notFoundMethod"
];