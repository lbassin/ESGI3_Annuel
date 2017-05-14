<?php

class Db
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            try {
                self::$instance = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER,
                    DB_PWD,
                    array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    )
                );
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function tryCredentials($host, $user, $password, $database, $port = 3306)
    {
        try {
            /** @var PDO $pdo */
            $pdo = new PDO(
                'mysql:host=' . $host . ';dbname=' . $database . ';port=' . $port,
                $user,
                $password
            );
        } catch (Exception $e) {
            return false;
        }

        $pdo = null;
        return true;
    }
}