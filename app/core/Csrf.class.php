<?php

class Csrf
{
    /*
        Configure the session token for the Crsf security
    */
    static function generate()
    {
        session_regenerate_id(true);
        $sToken = sha1(uniqid(rand(), true)).date('YmdHis');
        $_SESSION['token'] = $sToken;
        $_SESSION['token_expiration'] = time() + 21600;
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
    }

    /*
        Check the session with a posted token from a form
        Returns false if the variable in parameter is not the same as that of the form
        Returns false if the browser of ip address change
        Returns false If the token has expired
        Return true in the other case
    */
    static function check($sToken)
    {
        if ($_SESSION['token'] != $sToken) {
            return false;
        } elseif ($_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip_address'] != $_SERVER['REMOTE_ADDR'] || $_SESSION['token_expiration'] < time()) {
            return false;
        } else {
            return true;
        }
    }
}
