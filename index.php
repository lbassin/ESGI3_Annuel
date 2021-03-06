<?php
session_start();

$errorControllerFile = 'app/controllers/ErrorController.class.php';
if (!file_exists($errorControllerFile)) {
    die('Error');
}
include($errorControllerFile);

set_exception_handler(function ($ex) {
    $errorManager = new ErrorController();
    $errorManager->handleException($ex);
});

require 'app/assets/lib/PHPMailer/PHPMailerAutoload.php';

spl_autoload_register(function ($class) {
    if (file_exists("app/core/" . $class . ".class.php")) {
        include "app/core/" . $class . ".class.php";
    } elseif (file_exists("app/models/" . $class . ".class.php")) {
        include "app/models/" . $class . ".class.php";
    } elseif (file_exists("app/interfaces/" . $class . ".int.php")){
        include "app/interfaces/" . $class . ".int.php";
    } elseif (file_exists("app/traits/" . $class . ".trait.php")){
        include "app/traits/" . $class . ".trait.php";
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