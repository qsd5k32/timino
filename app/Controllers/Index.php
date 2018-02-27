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

namespace App\Controllers;

use Omnicient\App\Controller;

class Index extends Controller
{
    /**
     * manage method
     * default method to be called when controller requested
     * this method can be changed from config files
     * if you change this method make sure to update it in the base controller
     * @return void
     */
    public function manage()
    {

        //$all_records = _model($this->class)->all();
        //$all_records = _srv("loader")->model($this->class)->all();

        return _view("index.manage");
    }
}