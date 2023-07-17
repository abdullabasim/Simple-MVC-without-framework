<?php

spl_autoload_register(function ($className) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    

    require_once $classPath;
});



session_start();

require_once '../Route/Web-route.php';

