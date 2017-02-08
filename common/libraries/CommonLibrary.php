<?php
namespace common\libraries;

class CommonLibrary {
    public static function underscoreToCamelCase($string, $capitalizeFirstCharacter = false) {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }
    
    public static function capitalizeOnlyFirstLetter($text) {

        return str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($text))));
    }
}
