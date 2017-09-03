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
 * App class
 * 
 */

namespace Timino\App\Core;

use Timino\App\Services\Template\ErrorTemplator;

class App
{
   /**
    * controller
    * @var string
    */
   private $controller;

   /**
    * action
    * @var string
    */
   private $action;

   /**
    * parameters
    * @var array
    */
   private $params;


  /**
   * instantiate application
   *
   * @param Dispatcher $dispatcher
   */
   public function __construct(Dispatcher $dispatcher)
   {
      // set default controller
      $this->controller = $dispatcher->defaultController();
      // set default action
      $this->action     = $dispatcher->defaultAction();
      //set default params
      $this->params     = $dispatcher->params();


      // check if isset controller else use default
      if($dispatcher->controller())
      {
         if(class_exists(Linker::namespace("CONTROLLERS") . $dispatcher->controller()))
         {
           $this->controller = $dispatcher->controller();

         }else{

            $this->controller = $dispatcher->errController();
         }

      }

      /**
       * instanciate controller
       */
      

      try{

        $controller = Linker::namespace("CONTROLLERS") . $this->controller;

        if(!class_exists($controller)) throw new \Exception("Error <b> $controller Controller</b> Does not exists");

        $this->controller = new  $controller(new ServiceProvider, new Loader);

      }catch(\Exception $e)
      {
        die(ErrorTemplator::exceptionError($e->getMessage()));
      }


      // check if isset method else use default method
      if($dispatcher->action())
      {
         if(method_exists($this->controller, $dispatcher->action()))
         {
            $this->action = $dispatcher->action();

         }else{

            $this->action = $dispatcher->errAction();
         }
      }

      // call methods with parameters from controller
      call_user_func_array([$this->controller, $this->action], $this->params);

   }   
}