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
        return '/' . ADMIN_PATH . '/' . $path . '/';
    }
}