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
 * Upload Image Service class
 *
 */
namespace Timino\App\Services\Upload;

class Image
{
    private $name;
    private $tmp_name;
    private $type;
    private $size;
    private $errors;
    private $ext;

    public $image;
    private $extensions   = array("png", "jpg", "jpeg", "gif");
    private $uploadErrors = array();

    public function setUploadImage($name)
    {
        $this->name     = $_FILES[$name]["name"];
        $this->tmp_name = $_FILES[$name]["tmp_name"];
        $this->type     = $_FILES[$name]["type"];
        $this->size     = $_FILES[$name]["size"];
        $this->errors   = $_FILES[$name]["error"];
        return $this;
    }
    public function validate()
    {

        $this->name = strtolower($this->name);
        $name = explode(".", $this->name);
        // image name
        $this->name = sha1($name[0] . time() . rand());
        // image extension
        $this->ext = array_values(array_slice($name, -1))[0];
        if(!in_array($this->ext, $this->extensions))
        {
            $this->uploadErrors[] = "Error Image type not allowed";
        }
        if($this->size > 800000)
        {
            $this->uploadErrors[] = "Image size is too large ";
        }
        if($this->errors > 0)
        {
            $this->uploadErrors[] = "Error uploading Image";
        }
        $this->image = $this->name = $this->name . "." . $this->ext;
        return $this;
    }
    /**
     * check if there are errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->uploadErrors;
    }
    /**
     * upload method
     *
     * @param string $path
     * @return bool
     */
    public function uploadImage($path)
    {
        return (move_uploaded_file($this->tmp_name, $path . $this->image)) ? true : false;
    }
    /**
     * delete image mothod
     *
     * @return bool
     */
    public function delete($img)
    {
        if(file_exists($img))
        {
            unlink($img);
            return true;
        }
        return false;
    }

}