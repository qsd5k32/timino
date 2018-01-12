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
 * Git service class
 *
 */

namespace App\Services\Custom;

class Git
{

    public function getBranch()
    {
        $headFile = ROOT . '.git' . DS . 'HEAD';
        if(file_exists($headFile))
        {
           $line = isset(file($headFile)[0]) ? file($headFile)[0] : false;
           if($line)
           {
               $branch = explode("/", $line);
               $branch = $branch[count($branch) -1];
               return $branch;
           }

           return 'Branch was not found';
        }

        return ".git dir or HEAD file doesn't exist !";
    }

}