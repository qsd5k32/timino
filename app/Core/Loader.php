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
 * Loader class
 *
 */

namespace App\Core;

use App\Support\Language;
use Exception;

class Loader
{   
    /**
     * @var view folder
     */
    private $folde;

    /**
     * @var  view files 
     */
    private $files;

    /**
     * @var view page title
     */
    private $pageTitle;

    /**
     * @var data to be passed to the view
     */
    private $modelData;

    /**
     * @var assets paths
     */
    private $assets;

    /**
     * @var uploads paths
     */
    private $uploads;
    
    /**
     * view set up method to initialize view information before generating the view
     *
     * @param       $folder
     * @param       $files
     * @param null  $pageTitle
     * @param array $modelData
     * @throws Exception
     */
    private function setUp($folder, $files, $pageTitle = null, $modelData = array())
    {
        $this->folder = ucfirst($folder);

        $this->pageTitle = $pageTitle;

        if (is_string($files)) $files = explode(",", $files);

        $this->files = array_map("ucfirst", $files);

        $this->modelData = (object) $modelData;

        $this->assets   = (object)  Linker::path("ASSETS");
        $this->uploads  = (object)  Linker::path("UPLOADS");
        $this->lang     = new Language();

    }

    /**
     * view method
     * load views with header and footer
     * load views from _tmp directory dynamically
     * load views from given folder
     *
     * @param       $folder
     * @param       $files
     * @param null  $pageTitle
     * @param array $modelData
     * @throws Exception
     */
    public function view($folder, $files, $pageTitle = null, $modelData = [])
    {
        $this->setUp($folder, $files, $pageTitle, $modelData);

        if (!is_dir(Linker::path("VIEWS") . $this->folder))
            throw new Exception("Requested Folder $folder does not exists");
        /**
         * Merge the two directories as one array
         * @var array
         */
        $availableFiles = array_merge(
            scandir(Linker::path("VIEWS") . '_tmp'),
            scandir(Linker::path("VIEWS") . $this->folder)
        );
        /**
         * Remove Default header and footer
         * remove hidden file . and default dirs
         * @var array
         */
        $availableFiles = array_filter($availableFiles, function ($elem) {
            return !preg_match("/(^\.{1,})|(Header)|(Footer)/", $elem);
        });
        /**
         * Remove .php extention
         * @var array
         */
        $availableFiles = array_map(function ($elem) {
            return trim($elem, '.php');
        }, $availableFiles);

        /**
         * Sort and orgnise files in the array
         */
        sort($availableFiles);


        /**
         *
         */
        require_once Linker::path("VIEWS") . "_tmp" . DS . "Header.php";
        /**
         * if requested files exists on the given folder require them
         *  else require them from _tmp directory (default dir)
         *  else throw an error
         */
        foreach ($this->files as $file) {

            if (in_array($file, $availableFiles)) {
                if (file_exists(Linker::path("VIEWS") . $this->folder . DS . $file . ".php")) {
                    require Linker::path("VIEWS") . $this->folder . DS . $file . ".php";
                } else {
                    require Linker::path("VIEWS") . "_tmp" . DS . $file . ".php";
                }

            }
        }

        $notFound = array_diff($this->files, $availableFiles);

        foreach ($notFound as $file) {

            throw new Exception("file $file.php was not found on the views folder  $folder ");
        }

        require_once Linker::path("VIEWS") . "_tmp" . DS . "Footer.php";
    }


    /**
     * load naked view without header and footer
     *
     * @param       $folder
     * @param       $files
     * @param array $modelData
     * @throws Exception
     */
    public function nakedView($folder, $files, $modelData = [])
    {
        $this->setUp($folder, $files, null, $modelData);

        if (!is_dir(Linker::path("VIEWS") . $this->folder))
            throw new Exception("Requested Folder <b>$folder</b> does not exists on the Views Folder");

        foreach ($this->files as $file) {

            if (file_exists(Linker::path("VIEWS") . $this->folder . DS . $file . ".php")) {

                require Linker::path("VIEWS") . $this->folder . DS . $file . ".php";

            } else {
                throw new Exception("file $file.php was not found on $folder views  folder ");
            }

        }

    }

    /**
     * Render Templates with Twig Templating engine
     *
     * @param       $folder
     * @param       $files
     * @param null  $pageTitle
     * @param array $modelData
     */
    public function twigView($folder, $files, $pageTitle = null, $modelData = [])
    {
        $this->setUp($folder, $files, $pageTitle, $modelData);

        $tmp    = Linker::path("VIEWS") . "_tmp" . DS;
        $folder = Linker::path("VIEWS") . $this->folder . DS;

        // set twig loader and environment
        $loader = new \Twig_Loader_Filesystem(array($tmp, $folder));
        $twig = new \Twig_Environment($loader, array("debug" => true));
        $twig->addExtension(new \Twig_Extension_Debug());

        // needed data to be passed to the view
        $twig->addGlobal("assets",    $this->assets);
        $twig->addGlobal("uploads",   $this->uploads);
        $twig->addGlobal("pageTitle", $this->pageTitle);
        $twig->addGlobal("modelData", $this->modelData);
        $twig->addGlobal("lang",      $this->lang);


        echo $twig->render("Header.twig");

        foreach ($this->files as $file) {

            if ($file == "Header" || $file == "Footer")

                //FIXME catch this exception
                throw new \Twig_Error_Loader("$file already exists please use different name !");

            echo $twig->render($file . ".twig");
        }


        echo $twig->render("Footer.twig");

    }



    /**
     * @param $model
     * @return mixed
     * @throws \Exception
     */
    public function model($model)
    {
        $model = Linker::namespace("MODELS") . ucfirst($model);

        if (!class_exists($model)) throw new \Exception("error $model Model was not found !");

        return new $model(new ServicesAutoLoader());

    }
}