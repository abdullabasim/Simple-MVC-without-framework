<?php

namespace App\Controllers;

abstract class BaseController
{
    protected function render($view, $data = [])
    {

        extract($data);

        $viewPath = 'app/Views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: $viewPath");
        }

        include_once($viewPath);
    }

    protected function redirect($url, $statusCode = 302)
    {
        header('Location: /blog/' . $url, true, $statusCode);
        exit();
    }
}