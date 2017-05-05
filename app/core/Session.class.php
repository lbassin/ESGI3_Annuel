<?php

class Session
{
    public static function setToken($aToken)
    {
        foreach ($aToken as $key => $value) {
            $_SESSION['token'][$key] = $value;
        }
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
