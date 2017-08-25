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
 * Base controller class
 *  
 */

namespace Timino\App\Core;

use Timino\App\Services\Template\ErrorTemplator;

abstract class Controller
{     
      /**
       * model and views loader
       * @var object
       */
      public $load;

      // services goes down here

      public function __construct(ServiceProvider $service,Loader $loader)
      {
         $this->load = $loader;
      }

      /**
       * Default Manage Method
       *
       * @return void
       */
      public function manage()
      {     
            $method = Linker::route('DEFAULT_ACTION'); // default action
            $controller = get_called_class(); // get called controller class not this one
            die(ErrorTemplator::exceptionError("Error <b>$controller Controller</b> needs a <b>$method</b> Method"));
      }

      /**
       * Default Error Action
       *
       * @return void
       */
      public function errorAction()
      {
             $this->load->view("error", ["manage"], "404");
      }
}