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
 * Main Configuration file
 *
 */
session_start(["name" => "Timino"]);

defined("DS") || define("DS", DIRECTORY_SEPARATOR);

defined("ROOT") || define('ROOT', dirname(dirname(__DIR__)) . DS);

defined("APP") || define('APP', ROOT . "app" . DS);

defined("PUB") || define('PUB', ROOT . "pub" . DS);

defined("URL") || define('URL',
    htmlspecialchars($_SERVER["REQUEST_SCHEME"], ENT_QUOTES, "UTF-8") . "://" .
    htmlspecialchars($_SERVER["HTTP_HOST"], ENT_QUOTES, "UTF-8") . DS);

defined("CONFIG") || define("CONFIG", APP . "Config" . DS);

defined("BNS") || define('BNS', "App\\");

defined("SRV") || define("SRV", BNS . "Services\\");
