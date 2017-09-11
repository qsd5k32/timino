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
 * Directory support class
 *
 */

namespace App\Support;

class Dir
{
    /**
     * scan directory method in a recursive way and return all files with absolute path
     * @param $path
     * @return array
     */
    public static function scan($path)
    {
        $dirs  = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        $files = array();
        foreach ($dirs as $dir)
        {
            if(!$dir->isDir())  $files[] = $dir->getPathName();
        }
        return $files;
    }


    /**
     * get classes and there namespaces as an array
     * @param $path directory to scan
     * @param $fromPath namespace start path
     * @return array class name => class namespace
     */
    public static function getClassesWithNamespaces($path, $fromPath)
    {
        // remove php extension and subdirectories
        $files = array_map(function ($elem) use($fromPath) {
            $elem = substr($elem, strpos($elem, $fromPath));
            return rtrim($elem, ".php");
        }, self::scan($path));

        // explode class to an array
        for ($i = 0; $i < sizeof($files); $i++) {
            $explodeFiles[] = explode("/", $files[$i]);
        }

        // create classes namespaces
        // set each class with class name and
        // replace directory separator with namespace separator
        foreach ($explodeFiles as $namespace) {
            // make first service letter upper case
            $ucfirstNamespace = array_map(function ($elem) {
                return ucfirst($elem);
            }, array_values($namespace));

            $classNames[] = $ucfirstNamespace[count($ucfirstNamespace) - 1];
            $classNamespaces[] = "\\" . implode("\\", $ucfirstNamespace);

        }

        //self::getConfigurationFiles();

      //  die;

        return array_combine($classNames, $classNamespaces);
    }


   /* public static function getConfigurationFiles()
    {
        $files = self::scan("../App/Config/");
        foreach ($files as $file)
        {
            $onlyFiles[] =  explode("/", $file)[3];
        }

        echo "<pre>";
        print_r($onlyFiles);
    }*/
}
