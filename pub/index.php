<?php
/**
 * Timino - PHP MVC framework
 *
 * @package     Timino
 * @author      Lotfio Lakehal <lotfiolakehal@gmail.com>
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
 */

/*
 * ------------------------------------
 *  psr-4 Autoloader
 * ------------------------------------
 */
require_once "../vendor/autoload.php";

use Omnicient\Core\{ Request, App};
use App\Services\Custom\Git;

/*
 * ------------------------------------
 *  Start Application
 * ------------------------------------
 */
$request = new Request;

try{

    $app = new App($request);

    $app->run();

}catch (Exception $e)
{
    $load = new Omnicient\Core\Loader();

    $load->view("Error", "500", "500", array(
        "Exception" =>$e, "branch" =>  (new Git())->getBranch()
    ));
}
