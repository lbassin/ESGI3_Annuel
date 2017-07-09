<?php

class Xss
{
    /**
     * Convert an element to an html entity
     * @param array|string $eDirty the element to convert
     * @return array|string $eDirty the elemement converted
     * how to use : Xss::parse($element = ['*' => ['*']]...);
     */
    static function parse($eDirty)
    {
        if (is_array($eDirty)) {
            foreach ($eDirty as $key => $value) {
                if (empty($value)) {
                    continue;
                }

                $eDirty[$key] = self::parse($value);
            }
        } else {
            if(self::isJson($eDirty)){
                $jsonDirty = json_decode($eDirty, true);
                $jsonDirty = self::parse($jsonDirty);
                $eDirty = json_encode($jsonDirty);
            }else{
                $eDirty = htmlentities($eDirty, ENT_QUOTES, 'UTF-8');
            }
        }
        return $eDirty;
    }

    private static function isJson($string) {
        $result = json_decode($string);
        if(is_int($result)){
            return false;
        }
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
