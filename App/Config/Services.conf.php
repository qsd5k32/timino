<?php

/** 
 * Tinimo - PHP MVC framework
 *
 * @package     Tinimo
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
 * services Configuration file
 * 
 * Here You can aload all services under services folder
 * each class (service) must be loaded here to be accecible from the service provider object later
 * single tone classes must end with .s notation exm "Database.s" => SRV . "Database\Database"
 * to load services use $service->get("service name");
 * 
 * single tone classes must use instantiate() as the default instancition method 
 */

return[

   // db services
   "Record"       => SRV . "Database\\Record",
   "Connection.s" => SRV . "Database\\Connection",

   // security services
   "Form"         => SRV . "Security\\Form",

   // time services
   "TimeAgo"     => SRV . "DateTime\\TimeAgo",

   // custom services
   "Mail"        => SRV . "Custom\\Mailer",
  
];