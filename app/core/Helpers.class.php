<?php

class Helpers
{
    public static function debug($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    public static function getAsset($path) {
        return BASE_PATH . 'app/assets/' . $path;
    }

    public static function getAdminRoute($path)
    {
        $path = rtrim($path, '/');
        return BASE_PATH . ADMIN_PATH . '/' . $path . '/';
    }

    public static function redirectBack()
    {
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $path = $_SERVER['HTTP_REFERER'];
            self::redirect($path);
        }
    }

    public static function redirect($path)
    {
        header('Location: ' . $path);
        exit();
    }
}
