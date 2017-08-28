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
 * Base Model class
 * 
 */

namespace Timino\App\Core;


abstract class Model
{
   protected $record;
   protected $form;
   protected $timeAgo;
   protected $mail;
   
   public function __construct(ServiceProvider $service)
   {
      $this->record  = $service->get("Record");
      $this->form    = $service->get("Form");
      $this->timeAgo = $service->get("TimeAgo");
      $this->mail    = $service->get("Mail");
   }
}