<?php
class Xss
{
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
