<?php
session_start();
require "conf.inc.php";

spl_autoload_register(function ($class) {
    if (file_exists("app/core/" . $class . ".class.php")) {
        include "app/core/" . $class . ".class.php";
    } else {
        if (file_exists("app/models/" . $class . ".class.php")) {
            include "app/models/" . $class . ".class.php";
        }
    }
});

$route = new Routing();