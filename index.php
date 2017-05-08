<?php
session_start();

spl_autoload_register(function ($class) {
    if (file_exists("app/core/" . $class . ".class.php")) {
        include "app/core/" . $class . ".class.php";
    } else {
        if (file_exists("app/models/" . $class . ".class.php")) {
            include "app/models/" . $class . ".class.php";
        }
    }
});

if (!file_exists('conf.inc.php') && !strpos($_SERVER['REQUEST_URI'], 'assets')) {
    require 'app/controllers/SetupControllerBack.class.php';
    $controller = new SetupControllerBack();
    die;
} else {
    include "conf.inc.php";
}

$route = new Routing();