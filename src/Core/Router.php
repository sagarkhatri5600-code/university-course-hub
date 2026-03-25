<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, array $handler): void
    {
        $regex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_-]+)', $path);
        $regex = "#^" . $regex . "$#";
        
        $this->routes[] = [
            'method'  => $method,
            'pattern' => $regex,
            'controller' => $handler[0],
            'action'     => $handler[1],
            'path'       => $path
        ];
    }

    public function dispatch(string $method, string $uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        $baseDir = dirname($_SERVER['SCRIPT_NAME']);
        $baseDir = str_replace('\\', '/', $baseDir);
        if ($baseDir !== '/') {
            if (strpos($uri, $baseDir) === 0) {
                $uri = substr($uri, strlen($baseDir));
            }
        }
        
        if ($uri === '' || $uri === false) {
            $uri = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $matches)) {

                if ($method === 'POST') {
                    if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
                        throw new \Exception("Invalid CSRF token");
                    }
                }

                if (strpos($route['path'], '/admin') === 0 && $route['path'] !== '/admin/login') {
                    if (!Auth::check()) {
                        header('Location: ' . url('/admin/login'));
                        exit;
                    }
                }

                if (strpos($route['path'], '/staff') === 0 && $route['path'] !== '/staff/login') {
                    if (!StaffAuth::check()) {
                        header('Location: ' . url('/staff/login'));
                        exit;
                    }
                }

                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                $controllerName = $route['controller'];
                $action = $route['action'];

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $action)) {
                        return call_user_func_array([$controller, $action], $params);
                    }
                }
            }
        }

        throw new \Exception("Route not found: $uri");
    }
}
