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
 * Dispatcher class
 * 
 */

namespace Timino\App\Core;

class Dispatcher 
{

  /**
   * @var string controller
   */
  private $defaultController;

  /**
   * @var string action
   */
  private $defaultAction;

  /**
   * @var string error controller
   */
  private $errController;

  /**
   * @var string error action
   */
  private $errAction;

  /**
   * constructor method
   * set default controllers and actions
   * @param Linker $linker 
   */
  public function __construct()
  {
    $this->defaultController = Linker::route("DEFAULT_CONTROLLER");
    $this->errController     = Linker::route("ERROR_CONTROLLER");
    $this->defaultAction     = Linker::route("DEFAULT_ACTION");
    $this->errAction         = Linker::route("ERROR_ACTION");
  }

  /**
   * uri method
   * @return array
   */
  private function uri()
  {
    $uri = (isset($_GET["uri"])) ?  $_GET["uri"] : NULL;
    $uri = preg_replace(Linker::regex("URI"), NULL, $uri);
    $uri = array_values(array_filter(explode("/", $uri)));
    return $uri;
  }

  /**
   * controller method
   *
   * @return string
   */
  public function controller()
  {
    return (isset($this->uri()[0])) ? ucfirst($this->uri()[0]) : NULL;
  }

  /**
   * action method
   * @return string
   */
  public function action()
  {
    return (isset($this->uri()[1])) ? lcfirst($this->uri()[1]) : NULL;
  }

  /**
   *default controller
   * @return string
   */
  public function defaultController()
  {
    return $this->defaultController;
  }

 /**
  * default action
  * @return string
  */
  public function defaultAction()
  {
    return $this->defaultAction;
  }

  /**
  * error controller
  * @return string
  */
  public function errController()
  {
    return $this->errController;
  }

  /**
  * error action
  * @return string
  */
  public function errAction()
  {
    return $this->errAction;
  }

  /**
   * parameters action
   * @return array
   */
  public function params()
  {
    if(count($this->uri()) > 2 )
    { 
      $params = $this->uri();
      unset($params[0], $params[1]);
      return array_values($params); 
    }

    return array();
  }

}