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
 * Database Select class
 *
 */

namespace App\Services\Database;

class Select
{
    /**
     * Database connection instance
     * @var resource
     */
    private $db;

    public function __construct()
    {
        $this->db = (Connection::instantiate())->con();
    }


    /**
     * select from db method
     *
     * @param string $tbl
     * @param array or comma separated string $sel
     * @param array or null $cond
     * @param string $cond2 on no cond one use null
     * @return mixed
     *
     *   $do = from("users","array('or string with comma')" array( // array of conditions
     *   "Name   | =  "   => "lotfi | and",
     *   "Email  | =  "   => "lokam | and",
     *   "Passwd | =  "   => "123",
     *   ), "ORDER BY Email DESC LIMIT 1"); // more condition if no condition 1 use null to allow cond 2 to work
     */
    public function from($tbl, $sel, $cond = null, $cond2 = NULL)
    {

        $binds = NULL;
        $sql = "SELECT ";

        if (is_array($sel)) // an array of selection
        {
            if (count($sel) > 1) {
                for ($i = 0; $i < count($sel) - 1; $i++) {
                    $sql .= $sel[$i] . ", ";
                }

                $sql .= $sel[count($sel) - 1] . " FROM `$tbl` ";

                if (!$cond) $sql .= $cond2;

            } else {

                $sql .= $sel[0] . " FROM `$tbl` ";
                if (!$cond) $sql .= $cond2;
            }


        } else { // not an array

            // if coma separated string
            if (preg_match("#\,#", $sel)) {

                $selection = explode(",", $sel);

                for ($i = 0; $i < count($selection) - 1; $i++) {
                    $sql .= $selection[$i] . ", ";
                }

                $sql .= $selection[count($selection) - 1] . " FROM `$tbl` ";
                if (!$cond) $sql .= $cond2;

            } else {

                // only one selection
                $sql .= $sel . " FROM `$tbl` ";
                if (!$cond) $sql .= $cond2;

            }
        }

        /**
         * if is set condition
         * else select without condition
         */

        if (isset($cond) && is_array($cond)) {
            $keys = array_keys($cond);
            $values = array_values($cond);

            $sql .= "WHERE ";

            if (count($cond) > 1) // multiple conditions
            {
                foreach ($keys as $key) {
                    $k[] = explode("|", $key);
                }

                foreach ($values as $value) {
                    $v[] = explode("|", $value);
                }
                for ($i = 0; $i < count($k); $i++) {
                    $nph[] = trim($k[$i][0]);
                    $val[] = trim($v[$i][0]);
                }

                $nph = array_map(function ($elem) {
                    return ":" . $elem . rand();
                }, $nph);


                for ($i = 0; $i < count($k) - 1; $i++) {
                    $sql .= trim($k[$i][0]) . " " . trim($k[$i][1]) . " " . $nph[$i] . $v[$i][1] . " ";
                }

                $sql .= trim($k[count($k) - 1][0]) . " " . trim($k[count($k) - 1][1]) . " " . $nph[count($nph) - 1] . " " . $cond2;

                $binds = array_combine($nph, $val);

            } else { // one condition  one array element

                foreach ($keys as $key) {
                    $k[] = explode("|", $key);
                }

                foreach ($values as $value) {
                    $v[] = explode("|", $value);
                }
                for ($i = 0; $i < count($k); $i++) {
                    $nph[] = trim($k[$i][0]);
                    $val[] = trim($v[$i][0]);
                }

                $nph = array_map(function ($elem) {
                    return ":" . $elem . rand();
                }, $nph);

                $sql .= trim($k[0][0]) . " " . trim($k[0][1]) . " " . $nph[0] . " " . $cond2;

                $binds = array_combine($nph, $val);
            }
        }


        $stmt = $this->db->prepare($sql);
        $stmt->execute($binds);

        return $stmt->rowCount() > 0 ? $stmt->fetchAll() : 0;

    }

}