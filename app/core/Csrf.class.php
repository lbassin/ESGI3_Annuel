<?php

class Csrf
{
    /*
     * Generate information of authentication to stock in the session
     */
    static function generate()
    {
        //session_regenerate_id(true);
        Session::setToken([
            'token' => sha1(uniqid(rand(), true)) . date('YmdHis'),
            'token_expiration' => time() + 21600,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'ip_address' => $_SERVER['REMOTE_ADDR'],
        ]);
    }

    /**
     * Check if the token match with the one in the session
     * @param string $sToken :
     * @var string $aToken [0] : Match to the id of the token send
     * @var string $aToken [1] : Match to the token send
     * @return true if the token is recognize & match
     * @var $_SESSION [id] is clean at the end
     */
    static function check($sToken)
    {
        $aToken = explode('&amp;', $sToken);

        $sessionToken = isset($_SESSION['token'][$aToken[0]]['token']) ?
            $_SESSION['token'][$aToken[0]]['token'] : null;

        $sessionUserAgent = isset($_SESSION['token'][$aToken[0]]['user_agent']) ?
            $_SESSION['token'][$aToken[0]]['user_agent'] : null;

        $sessionIp = isset($_SESSION['token'][$aToken[0]]['ip_address']) ?
            $_SESSION['token'][$aToken[0]]['ip_address'] : null;

        $sessionExpiration = isset($_SESSION['token'][$aToken[0]]['token_expiration']) ?
            $_SESSION['token'][$aToken[0]]['token_expiration'] : null;

        if (!$sessionToken || !$sessionUserAgent || !$sessionIp || !$sessionExpiration) {
            return false;
        }

        if ($sessionToken != $aToken[1]) {
            Session::removeToken($aToken[0]);
            return false;
        } elseif ($sessionUserAgent != $_SERVER['HTTP_USER_AGENT'] ||
            $sessionIp != $_SERVER['REMOTE_ADDR'] ||
            $sessionExpiration < time()
        ) {
            Session::removeToken($aToken[0]);
            return false;
        } else {
            Session::removeToken($aToken[0]);
            return true;
        }
    }
}
