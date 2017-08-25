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
namespace Timino\App\Services\Database;

class Update
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
    * database update method
    *
    * @param string $tbl
    * @param array $data data to be updated     
    * @param string $cond 
    * @return bool
    *
    * usage example
    *  set("users",array(
   
    *     "Email" => "lotfio@admin.com"
    *  ),array( // where condition

    *     "Email | = " => "lotfio",
    *     "name  | = "  => "smail"
    *  ));
    *));
    */
   public function set($tbl, $data, $cond = NULL)
   {

      $keys   = array_keys($data);
      $values = array_values($data);
      $nph    = array_map(function($elem){ return ":".$elem.rand(); }, $keys);


      $sql = "UPDATE `$tbl` SET ";

      if(is_array($data))
      {
         if(count($data) > 1)
         {
            for($i = 0; $i< count($data) -1; $i++)
            {
               $sql .= "`$keys[$i]`" . " = " . $nph[$i] . " and ";
            }

            $sql .= $keys[count($keys) -1] . " = " . $nph[count($nph) -1 ];

         
         }else{

            foreach($data as $key => $val)
            {
               $sql .= "`$keys[0]` = $nph[0] ";
            }

         }

      }

      // if is set condition

      if($cond)
      {
         $sql .= " WHERE ";

         $keysCond = array_keys($cond);
         $valsCond = array_values($cond);
         $nphCond  = array_map(function($elem)
         {                 
            $elem = preg_replace("/[^a-zA-Z0-9\:\@\_\-]+/", NULL, $elem);
            return ":".$elem . rand();
         }, $keysCond);

         if(is_array($cond))
         {
            if(count($cond) > 1) // array of conditions
            {

            foreach($keysCond as $key)
            {
               $newKeys[] = explode("|", $key);
            }
            
            for($i = 0; $i < count($newKeys) - 1 ; $i++)
            {
               $sql .= trim($newKeys[$i][0]) . " " . trim($newKeys[$i][1])  . " " . trim($nphCond[$i]). " and ";
            }

            $sql .= trim($newKeys[count($newKeys)-1][0]) . " " . trim($newKeys[count($newKeys)-1][1])  . " " . trim($nphCond[count($nphCond)-1]);


            $condBind = array_combine($nphCond, $valsCond);


            }else{ // one elem on array
         

            if(preg_match("#\|#", $keysCond[0]))
            {
               $do = explode("|", $keysCond[0]);

               $sql .= trim($do[0]) . " " . trim($do[1]) . " " . $nphCond[0];

               $condBind = array_combine($nphCond, $valsCond);

            }else{

               $condBind = array_combine($nphCond, $valsCond);
               $sql .= $keysCond[0] . " = " . $nphCond[0];

            }

            } // one elem on array

         }
      }

      $binds = array_combine($nph, $values);
      $binds = $binds + $condBind;

      $stmt = $this->db->prepare($sql);

      $stmt->execute($binds);

      return $stmt->rowCount() > 0 ? true : false;

   }


}