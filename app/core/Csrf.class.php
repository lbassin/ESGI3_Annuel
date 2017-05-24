<?php

class Csrf
{
    /*
     * Generate information of authentication to stock in the session
     */
    static function generate()
    {
        session_regenerate_id(true);
        Session::setToken([
            'token' => sha1(uniqid(rand(), true)).date('YmdHis'),
            'token_expiration' => time() + 21600,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'ip_address' => $_SERVER['REMOTE_ADDR'],
        ]);
    }
    /**
     * Check if the token match with the one in the session
     * @param string $sToken :
        * @var string $aToken[0] : Match to the id of the token send
        * @var string $aToken[1] : Match to the token send
     * @return true if the token is recognize & match
     * @var $_SESSION[id] is clean at the end
     */
    static function check($sToken)
    {
        $aToken = explode('&', $sToken);
        if ($_SESSION['token'][$aToken[0]]['token'] != $aToken[1]) {
            return false;
        } elseif ( $_SESSION['token'][$aToken[0]]['user_agent'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['token'][$aToken[0]]['ip_address'] != $_SERVER['REMOTE_ADDR'] || $_SESSION['token'][$aToken[0]]['token_expiration'] < time()) {
            return false;
        } else {
            return true;
        }
        Session::doneToken($aToken[0]);
    }
}
