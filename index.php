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

if (!file_exists('conf.inc.php')) {
    define('ADMIN_PATH', 'admin');

    $controller = new SetupControllerBack();
    $controller->indexAction();

    die;
} else {
    include "conf.inc.php";
}

$route = new Routing();