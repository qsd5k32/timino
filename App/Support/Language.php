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
 * languages support class
 *
 */

namespace App\Support;

class Language
{
    /**
     * @return string
     */
    private function whatLanguage()
    {
        if (isset($_SESSION['lang'])) {
            switch ($_SESSION['lang']) {
                case 'fr' :
                    return 'fr';
                    break;
                case 'ar' :
                    return 'ar';
                    break;
                default   :
                    return 'en';
                    break;
            }
        }

        return 'en';
    }

    /**
     * @return array
     */
    private function getLanguage()
    {
        return Dir::scan(APP . 'Storage/Lang/' . $this->whatLanguage());
    }

    /**
     * @param $lang
     * @return mixed
     * @throws \Exception
     */
    public function set($lang)
    {

        $arrayWords = array();

        foreach ($this->getLanguage() as $language) {
            $arrayWords[] = require $language;
        }

        static $word = array();

        foreach ($arrayWords as $words) {
            if (is_array($words)) {
                foreach ($words as $key => $val) {
                    $word[$key] = $val;
                }
            }
        }

        if (!isset($word[$lang])) throw new \Exception("error word $lang Not found on the language array !");

        return $word[$lang];
    }
}