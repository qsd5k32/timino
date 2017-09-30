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

use App\Services\Template\ErrorTemplator;
use App\Support\Language;

class Loader
{
    /**
     * load model method
     *
     * @param string $model
     * @return void
     */
    public function model($model)
    {
        $model = ucfirst($model);

        $model = Linker::namespace("MODELS") . $model;

        try {

            if (!class_exists($model)) throw new \Exception("error <b> $model Model </b> was not found !");

            return new $model(new ServicesAutoLoader());

        } catch (\Exception $e) {
            die(ErrorTemplator::exceptionError($e->getMessage()));
        }

    }

    /**
     * view method
     * load views with header and footer
     * load views from _tmp directory dynamically
     * load views from given folder
     *
     * @param string $folder
     * @param array  $files
     * @param string $pageTitle
     * @param array  $modelData
     * @return void
     */
    public function view($folder, $files, $pageTitle = NULL, $modelData = [])
    {
        $folder = ucfirst($folder);

        if (is_string($files)) $files = explode(",", $files);

        $files = array_map("ucfirst", $files);

        $modelData = (object)$modelData;

        $assets  = (object)Linker::route("ASSETS");
        $uploads = (object)Linker::route("UPLOADS");
        $lang    = new Language();

        try {

            if (!is_dir(Linker::route("VIEWS") . $folder)) throw new \Exception("Requested Folder <b>$folder</b> does not exists");
            /**
             * Merge the two directories as one array
             * @var array
             */
            $availableFiles = array_merge(
                scandir(Linker::route("VIEWS") . '_tmp'),
                scandir(Linker::route("VIEWS") . $folder)
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

        } catch (\Exception $e) {
            die(ErrorTemplator::exceptionError($e->getMessage()));
        }

        /**
         *
         */
        require_once Linker::route("VIEWS") . "_tmp" . DS . "Header.php";
        /**
         * if requested files exists on the given folder require them
         *  else require them from _tmp directory (default dir)
         *  else throw an error
         */
        foreach ($files as $file) {

            if (in_array($file, $availableFiles)) {
                if (file_exists(Linker::route("VIEWS") . $folder . DS . $file . ".php")) {
                    require Linker::route("VIEWS") . $folder . DS . $file . ".php";
                } else {
                    require Linker::route("VIEWS") . "_tmp" . DS . $file . ".php";
                }

            }
        }

        $notFound = array_diff($files, $availableFiles);

        foreach ($notFound as $file) {

            die(ErrorTemplator::exceptionError("file <b>$file.php</b> was not found on the views folder <b> $folder </b> "));
        }

        require_once Linker::route("VIEWS") . "_tmp" . DS . "Footer.php";
    }


    /**
     * load naked view without header and footer
     * @param       $folder
     * @param       $files
     * @param array $modelData
     */
    public function nakedView($folder, $files, $modelData = [])
    {
        $folder = ucfirst($folder);

        if (is_string($files)) $files = explode(",", $files);

        $files = array_map("ucfirst", $files);

        $modelData = (object)$modelData;

        // routes
        $assets = (object)Linker::route("ASSETS");
        $uploads = (object)Linker::route("UPLOADS");
        $lang    = new Language();

        try {

            if (!is_dir(Linker::route("VIEWS") . $folder)) throw new \Exception("Requested Folder <b>$folder</b> does not exists on the Views Folder");

            foreach ($files as $file) {

                if (file_exists(Linker::route("VIEWS") . $folder . DS . $file . ".php")) {

                    require Linker::route("VIEWS") . $folder . DS . $file . ".php";

                } else {
                    die(ErrorTemplator::exceptionError("file <b>$file.php</b> was not found on <b>$folder</b> views  folder "));
                }

            }
        } catch (\Exception $e) {
            die(ErrorTemplator::exceptionError($e->getMessage()));
        }

    }

    /**
     * Render Templates with Twig Templating engine
     * @param       $folder
     * @param       $files
     * @param null  $pageTitle
     * @param array $modelData
     */
    public function twigView($folder, $files, $pageTitle = NULL, $modelData = [])
    {
        try {

            $folder = ucfirst($folder);

            if (is_string($files)) $files = explode(",", $files);

            $files = array_map("ucfirst", $files);


            $tmp    = Linker::route("VIEWS") . "_tmp" . DS;
            $folder = Linker::route("VIEWS") . $folder . DS;

            // set twig loader and environment
            $loader = new \Twig_Loader_Filesystem(array($tmp, $folder));
            $twig = new \Twig_Environment($loader, array("debug" => true));
            $twig->addExtension(new \Twig_Extension_Debug());

            // needed data to be passed to the view
            $twig->addGlobal("assets", (object)Linker::route("ASSETS"));
            $twig->addGlobal("uploads", (object)Linker::route("UPLOADS"));
            $twig->addGlobal("pageTitle", $pageTitle);
            $twig->addGlobal("modelData", (object)$modelData);
            $twig->addGlobal("lang",  new Language());


            echo $twig->render("Header.twig");

            foreach ($files as $file) {

                if($file == "Header" || $file == "Footer") throw new \Twig_Error_Loader("<b>$file </b> already exists please use different name !");
                echo $twig->render($file . ".twig");
            }


            echo $twig->render("Footer.twig");


        } catch (\Twig_Error_Loader $e) {
            die(ErrorTemplator::exceptionError($e->getMessage()));
        }

    }
}