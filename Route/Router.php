<?php

namespace Route;

class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $this->getCurrentPath();

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $callback) {
                $params = [];

                if ($this->isMatchingRoute($route, $path, $params)) {
                    call_user_func($callback, $params);
                    return;
                }
            }
        }

        echo '404 Not Found';
    }

    private function getCurrentPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = dirname($scriptName);

        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }

        return '/' . trim($path, '/');
    }

    private function isMatchingRoute($route, $path, &$params)
    {
        $routePattern = preg_replace('/{([^\/]+)}/', '(?<$1>[^/]+)', $route);
        $routePattern = str_replace('/', '\/', $routePattern);
        $routePattern = '/^' . $routePattern . '$/';

        if (preg_match($routePattern, $path, $matches)) {
            $paramNames = array_filter(array_keys($matches), 'is_string');
            $params = array_intersect_key($matches, array_flip($paramNames));
            return true;
        }

        return false;
    }
}
