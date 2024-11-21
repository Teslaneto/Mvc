<?php

namespace Core;

class Router {
    protected $routes = [];

    public function __construct() {
        $this->routes = [
            '/' => ['controller' => 'Home', 'action' => 'index'],
            '/user/profile' => ['controller' => 'User', 'action' => 'profile'],
        ];
    }

    public function dispatch($url) {
        $url = rtrim($url, '/');
        $route = $this->routes[$url] ?? null;

        if ($route) {
            $controllerName = '\\App\\Controllers\\' . $route['controller'] . 'Controller';
            $action = $route['action'];

            if (class_exists($controllerName) && method_exists($controllerName, $action)) {
                $controller = new $controllerName();
                $controller->$action();
            } else {
                $this->notFound();
            }
        } else {
            $this->notFound();
        }
    }

    private function notFound() {
        http_response_code(404);
        echo "404 - Page Not Found";
    }
}
