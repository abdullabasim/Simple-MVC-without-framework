<?php

spl_autoload_register(function ($className) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
    }
});



session_start();

require_once __DIR__ . '/Route/Web-route.php';


