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
 * DB connection class
 *
 */

namespace App\Services\Database;


use App\Core\Linker;

class Connection
{
    // single instance
    private static $instance;

    //connection var
    private $_con;

    private function __construct()
    {
            $this->_con = new \PDO(
                Linker::database('DRIVER') . ":host=" . Linker::database('HOST') . ";dbname=" . Linker::database('NAME'),
                Linker::database('USER'),
                Linker::database('PASS'),
                Linker::database('OPTIONS')
            );
    }

    public static function instantiate()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Get Connection
     * @return db connection Object
     */
    public function con()
    {
        return $this->_con;
    }
}