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
 * Index Model class
 * 
 */

namespace Timino\App\Models;

use Timino\App\Core\Model;

class Index extends Model
{
   public function test()
   {
      // insert
      // echo $this->record->insert->into("users",array(
      //    "Name"   => "bilal",
      //    "Email"  => "bilal@gmail.com",
      //    "Passwd" => sha1("123456")
      // ));


      // $this->record->update->set("users", array(
      //    "Email" => "bistish@000000000000"
      // ), array(
      //    "Email | = " => "lotfio@ouedkniss.com | and",
      //    "Name  | = " => "Lakehal"
      // ));
      
      // delete
      // echo $this->record->delete->from("users",array(
      //    "Email | = " => "lotfio@gmail.com | and",
      //    "Name  | = " => "saida" 
      // ));

      // select
      //  $do = $this->record->select->from("users","*", "WHERE Email = ? ", ["lotfio@gmail.com"], "fetch");
      //  if($do)
      //  {
      //     echo "<pre>";
      //     print_r($do);
      //  }
   }
}