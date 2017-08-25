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
 * Database insertion class
 * 
 */
namespace Timino\App\Services\Database;


class Insert
{
   /**
    * Database connection instance
    * exemple :

    * into("users", [
    * "Name"   => "lotfio",
    * "Email"  => "lotfio@admin.com",
    * "Passwd" => "qsd54qsdf3df"
    * ]);
    
    * @var resource
    */
   private $db;

   public function __construct()
   {
      $this->db = (Connection::instantiate())->con();
   }

   /**
   * insert method
   *
   * @param string $table
   * @param mixed $data
   * @return void
   */
  public function into($table, $data)
  {

    if(!is_array($data)) die("Error : second parameter must be an array of keys and values");

    $keys   = array_keys($data);
    $values = array_values($data);

    // sql query
    $sql = "INSERT INTO `$table` (";

    // if more than one column
    if(count($data) > 1)
    {
        for($i = 0; $i < count($data) -1; $i++)
        {
           $sql .= "`$keys[$i]`, ";
        }

        $sql .= "`" . end($keys) . "`) VALUES (";

        for($i = 0; $i < count($data) -1; $i++)
        {
           $sql .= ":$keys[$i], ";
        }

         $sql .=":" . end($keys) . ")";

        }else{ // only one column

           $sql .= "`$keys[0]`) VALUES(:$keys[0])";
        }

        // make keys as named placeholders
        $binds = array_map(function($elem){
           return ":".$elem;
        }, $keys);


        // combine placeholders with values
        $binds = array_combine($binds, $values);


        $stmt = $this->db->prepare($sql);

        return $stmt->execute($binds) ? $stmt->rowCount() : false;
  }

}