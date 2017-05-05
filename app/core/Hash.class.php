<?php
class Hash
{
    /**
     * Return a hash version of the password with the bluefish algorythm
     */
    static function generate($sPassword)
    {
        $aOptions = [
            'cost' => 11
        ];
        return password_hash($sPassword, PASSWORD_BCRYPT, $aOptions);
    }
    // ---
    /*
        Return true if the password is confirm, false if not
     */
    static function check($sPassword, $sHash)
    {
        return (password_verify($sPassword, $sHash) === true) ? true : false ;
    }
    // ---
}
