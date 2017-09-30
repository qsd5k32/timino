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
 * Routes Configuration file
 *
 */

return [

    "DEFAULT_CONTROLLER"    => "Index",
    "ERROR_CONTROLLER"      => "ErrorController",
    "DEFAULT_ACTION"        => "manage",
    "ERROR_ACTION"          => "errorAction",

    // app folders routes
    "CORE"          => APP . "Core" . DS,
    "CONTROLLERS"   => APP . "Controllers" . DS,
    "MODELS"        => APP . "Models" . DS,
    "SERVICES"      => APP . "Services" . DS,
    "VIEWS"         => APP . "Views" . DS,

    // public folders routes for php check and validation
    "PHP_PUBLIC" => [

        "ASSETS" => [
            "IMG" => PUB . "assets" . DS . "img" . DS,
        ],

        "UPLOADS" => [
            "IMG"   => PUB . "uploads" . DS . "img"   . DS,
            "FILES" => PUB . "uploads" . DS . "files" . DS,
        ]
    ],

    // public folders
    "ASSETS" => [
        "CSS"   => URL . "assets" . DS . "css"   . DS,
        "IMG"   => URL . "assets" . DS . "img"   . DS,
        "JS"    => URL . "assets" . DS . "js"    . DS,
        "FONTS" => URL . "assets" . DS . "fonts" . DS,
    ],

    "UPLOADS" => [
        "IMG"   => URL . "uploads" . DS . "img" . DS,
        "FILES" => URL . "uploads" . DS . "files" . DS,
    ],

    // libs mail routes
    "EMAIL" => APP . "Storage" . DS . "Mail" . DS,
];