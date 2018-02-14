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
 * Services config file
 * all services to be loaded must be set here !
 *
 */
return[
    "Loader"         => Omnicient\Core\Loader::class,
    "Mailer"         => Omnicient\Services\Custom\Mailer::class,
    "Git"            => Omnicient\Services\Custom\Git::class,
    "Form"           => Omnicient\Services\Security\Form::class,
    "Authentication" => Omnicient\Services\Security\Authentication::class,
    "Cookie"         => Omnicient\Services\Security\Cookie::class,
    "Session"        => Omnicient\Services\Security\Session::class,
    "Redirect"       => Omnicient\Services\Security\Redirection::class,
    "Token"          => Omnicient\Services\Security\Token::class,
    "Validate"       => Omnicient\Services\Security\Validation::class,
    "Upload"         => Omnicient\Services\Uploads\Upload::class,
];