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
 * Database update class
 *
 */

namespace App\Services\Database;

class Update
{
    /**
     * Database connection instance
     * @var resource
     */
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db->con();
    }


    /**
     * database update method
     *
     * @param string $tbl
     * @param array $data data to be updated
     * @param string $cond
     * @return bool
     *
     * usage example
     * echo update("users",[
     *  "Name"  => "Lakehal",
     *  "Email" => "lotfio@ouedkniss.com"
     *  ],[
     *     "ID      |  = " => "20 | and", // use pipes on condition
     *     "Passwd  |  = " => "1321321",
     *  ]);
     */
    public function set($tbl, $data, $conditions)
    {

        $sql = "UPDATE `$tbl` SET ";

        $keys = array_keys($data);
        $values = array_values($data);
        $placeholders = array_map(function ($elem) {
            return ":" . $elem . rand();
        }, $keys);


        if (is_array($data)) {
            if (count($data) > 1) // array of elements
            {
                for ($i = 0; $i < count($keys) - 1; $i++) {
                    $sql .= $keys[$i] . " = " . $placeholders[$i] . ", ";
                }

                $sql .= $keys[count($keys) - 1] . " = " . $placeholders[count($placeholders) - 1];


                $bind = array_combine($placeholders, $values);


            } else { // only one

                $sql .= $keys[0] . " = " . $placeholders[0];

                $bind = array_combine($placeholders, $values);

            }
        }

        /**
         * hundling conditions
         */
        if (is_array($conditions)) {
            $sql .= " WHERE ";

            if (count($conditions) > 1) // array of elements
            {
                $conKeys = array_keys($conditions);
                $convals = array_values($conditions);

                foreach ($conKeys as $key) {
                    $k[] = explode("|", $key);
                }
                foreach ($convals as $val) {
                    $v[] = explode("|", $val);
                }

                for ($i = 0; $i < count($conKeys); $i++) {
                    $ky[] = trim($k[$i][0]);
                    $vl[] = trim($v[$i][0]);
                }

                $nph = array_map(function ($elm) {
                    return ":" . $elm . rand();
                }, $ky);

                for ($i = 0; $i < count($conKeys) - 1; $i++) {
                    $sql .= trim($k[$i][0]) . " " . trim($k[$i][1]) . " " . trim($nph[$i]) . " " . trim($v[$i][1]) . " ";
                }

                $sql .= trim($k[count($k) - 1][0]) . " " . trim($k[count($k) - 1][1]) . " " . trim($nph[count($nph) - 1]);

                $binds = array_combine($nph, $vl);


            } else { // only one element

                $conKeys = array_keys($conditions);
                $convals = array_values($conditions);

                foreach ($conKeys as $key) {
                    $k[] = explode("|", $key);
                }
                foreach ($convals as $val) {
                    $v[] = explode("|", $val);
                }

                for ($i = 0; $i < count($conKeys); $i++) {
                    $ky[] = trim($k[$i][0]);
                    $vl[] = trim($v[$i][0]);
                }

                $nph = array_map(function ($elm) {
                    return ":" . $elm;
                }, $ky);


                $sql .= trim($k[0][0]) . " " . trim($k[0][1]) . " " . trim($nph[0]);

                $binds = array_combine($nph, $vl);


            }  // one element
        }

        $bounds = $bind + $binds;

        $stmt = $this->db->prepare($sql);

        $stmt->execute($bounds);

        return $stmt->rowCount() > 0 ? true : false;

    }


}