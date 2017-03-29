<?php
class Db extends PDO{
    protected $db;
    private static $instance = null;

    function __construct(){
        try{
            parent::__construct('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT, DB_USER, DB_PWD, array(
                    PDO::MYSQL_ATTR_INIT_COMMAND	=>	'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                )
            );
        } catch( Exception $e ){
            die( 'Erreur : '.$e->getMessage() );
        }
        self::$instance = $this;
       $this->db = 'mysql';
    }
    public static function getInstance (){
        if(is_null(self::$instance))
        {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    function dbmsName(){
        return $this->db;
    }
}