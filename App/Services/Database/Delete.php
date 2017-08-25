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
 * Database delete class
 * 
 */
namespace Timino\App\Services\Database;


class Delete
{
   
   /**
   * @var resource
   */
   private $db;

   public function __construct()
   {
      $this->db = (Connection::instantiate())->con();
   }


   /**
    * delete from db method
    *
    * @param string $tbl table name
    * @param array $cond

    * exemple of use cond = WHERE ....
    * note : dont forget to use pipe.
    * array("Name | = or != or < or > or <= exetra " => "lotfio") // one condition

    * array(
    *   "Name  | =  " => "ahmed",
    *   "Email | != " => "admin@gmail.com" and so on
    *) // multiple conditions

    * @return void
    */
   public function from($tbl, $cond = NULL)
   {
   
      $sql = "DELETE FROM `$tbl` WHERE ";
   
      if(is_array($cond) && count($cond) > 1 )
      {
         $keys   = array_keys($cond);
         $values = array_values($cond);
   
   
         foreach($keys as $key)
         {
            $newKeys[] = explode("|", $key);
         }
   
         foreach($values as $val)
         {
            $newVals[] = explode("|", $val);
         }
   
         // named placeholders
         for($i = 0; $i < count($newKeys); $i++)
         {
            $nph[] =  trim($newKeys[$i][0]);
         }
   
         // values 
         for($i = 0; $i < count($newVals); $i++)
         {
            $insVals[] =  trim($newVals[$i][0]);
         }
   
         $nph = array_map(function($elem){ return ":".$elem.rand();}, $nph);
   
   
         for($i = 0; $i < count($keys) - 1; $i++)
         {
            $sql .= trim($newKeys[$i][0]). " " . trim($newKeys[$i][1]) ." " .  trim($nph[$i]) . " " . trim($newVals[$i][1]) . " ";
         }
   
         $sql .= trim($newKeys[count($newKeys) - 1][0]). " " . trim($newKeys[count($newKeys) - 1][1]) ." " .  trim($nph[count($nph) - 1]);
   
   
      }else{
   
         $keys   = array_keys($cond);
         $values = array_values($cond);
   
         foreach($keys as $key)
         {
            $newKeys[] = explode("|", $key);
         }
   
         foreach($values as $val)
         {
            $newVals[] = explode("|", $val);
         }
   
         // named placeholders
         for($i = 0; $i < count($newKeys); $i++)
         {
            $nph[] =  trim($newKeys[$i][0]);
         }
   
         // values 
         for($i = 0; $i < count($newVals); $i++)
         {
            $insVals[] =  trim($newVals[$i][0]);
         }
   
   
         $nph = array_map(function($elem){ return ":".$elem.rand();}, $nph);
   
   
         $sql .= trim($newKeys[0][0]) ." " . trim($newKeys[0][1]) . " " .$nph[0];
   
   
   
      }
   
      //data to be bound;
      $binds = array_combine($nph, $insVals);
   
   
      $stmt = $this->db->prepare($sql);
      $stmt->execute($binds);
      return $stmt->rowCount() > 0 ? true : false;
   }
}