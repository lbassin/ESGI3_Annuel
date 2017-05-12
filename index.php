<?php
session_start();

$errorControllerFile = 'app/controllers/ErrorController.class.php';
if (!file_exists($errorControllerFile)) {
    die('Error');
}
include($errorControllerFile);

set_exception_handler(function(Exception $ex){
   $errorManager = new ErrorController();
   $errorManager->handleException($ex);
});

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
    require 'app/controllers/SetupController.class.php';
    $controller = new SetupController();
    die;
} else {
    include "conf.inc.php";
}

$route = new Routing();