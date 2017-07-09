<?php

class Session
{
    /**
     * Integrates token informations in session
     * @param array $aToken contains token informations
     * @var string $index contains the last index of the token array
     * @var array $_SESSION['token'] get all informations from @param $aToken at the index from @var $index
     */
    public static function setToken($aToken)
    {
        $index = (isset($_SESSION['token'])) ? count($_SESSION['token']) : 0 ;
        foreach ($aToken as $key => $value) {
            $_SESSION['token'][$index][$key] = $value;
        }
    }

    /**
     * Unset session token from index
     * @param integer $iToken contains the index of the token
     */
    public static function doneToken($iIndex)
    {
        unset($_SESSION['token'][$iIndex]);
    }

    /**
     * Return index and content of the last index token generated
     * @return string index and content of the last index token generated
     */
    public static function getToken()
    {
        if (isset($_SESSION['token'])) {
            end($_SESSION['token']);
            return key($_SESSION['token'])."&".$_SESSION['token'][key($_SESSION['token'])]['token'];
        }
        return '';
    }

    public static function addSuccess($message)
    {
        $notifications = self::getNotifications();

        $notifications['success'][] = $message;

        self::setNotifications($notifications);
    }

    private static function getNotifications()
    {
        $notifications = [];
        if (isset($_SESSION['notifications'])) {
            $notifications = $_SESSION['notifications'];
        }

        return $notifications;
    }

    private static function setNotifications($notifications)
    {
        $_SESSION['notifications'] = $notifications;
    }

    public static function getSuccess()
    {
        $notifications = self::getNotifications();
        if (!isset($notifications['success'])) {
            return [];
        }

        return $notifications['success'];
    }

    public static function resetSuccess()
    {
        $notifications = self::getNotifications();
        $notifications['success'] = [];
        self::setNotifications($notifications);
    }

    public static function addError($message)
    {
        $notifications = self::getNotifications();

        $notifications['error'][] = $message;

        self::setNotifications($notifications);
    }

    public static function getErrors()
    {
        $notifications = self::getNotifications();
        if (!isset($notifications['error'])) {
            return [];
        }

        return $notifications['error'];
    }

    public static function resetErrors()
    {
        $notifications = self::getNotifications();
        $notifications['error'] = [];
        self::setNotifications($notifications);
    }

    public static function isLogged()
    {
        return isset($_SESSION['id']);
    }
}
