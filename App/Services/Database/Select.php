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
namespace Timino\App\Services\Database;

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
   * Select from Database
   * @param  string $tbl     table name
   * @param  mixed  $sel     selection can be string comma separated or an array 
   * @param  string $cond    selection condition
   * @param  array  $binds   parameters to be bound
   * @param  string $result  default return count you can use "fetch" to get an array of data
   * @return mixed  rowcounts or array of data        
   */
  public function from($tbl, $sel, $cond = NULL, $binds = NULL,$result = NULL)
  {

      $sql  = "SELECT ";

      if(is_array($sel)) // an array of selection
      {
          if(count($sel) > 1)
          {
              for($i = 0; $i< count($sel) - 1; $i++)
              {
                  $sql .= $sel[$i] .", ";
              }

               $sql .= $sel[count($sel) - 1] . " FROM `$tbl` $cond";

          }else{

              $sql .= $sel[0] . " FROM `$tbl` $cond";
          }
      

      }else{ // not an array

          // if coma separated string
          if(preg_match("#\,#", $sel)){

              $selection = explode(",", $sel);

              for($i = 0; $i< count($selection) - 1; $i++)
              {
                  $sql .= $selection[$i] .", ";
              }

              $sql .= $selection[count($selection) - 1] . " FROM `$tbl` $cond";

          }else{

              // only one selection 
              $sql .= $sel . " FROM `$tbl` $cond";

          }


      }

      $stmt = $this->db->prepare($sql);

      if(isset($result) && $result == "fetch")
      {
          return $stmt->execute($binds) ? $stmt->rowCount() > 0 ? $stmt->fetchAll() : 0 : false;
      }

      return $stmt->execute($binds) ? $stmt->rowCount() : false;
  }

}