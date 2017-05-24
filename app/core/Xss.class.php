<?php

class Xss
{
    /**
     * Convert an element to an html entity
     * @param element $eDirty the element to convert
     * @return element $eDirty the elemement converted
     * how to use : Xss::parse($element = ['*' => ['*']]...);
     */
    static function parse($eDirty)
    {
        if (is_array($eDirty)) {
            foreach ($eDirty as $key => $value) {
                $eDirty[$key] = self::parse($value);
            }
        } else {
            $eDirty = htmlentities($eDirty, ENT_QUOTES, 'UTF-8');
        }
        return $eDirty;
    }
}
