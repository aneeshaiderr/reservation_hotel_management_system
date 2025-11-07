<?php

namespace App\Core;

use App\Middleware\AuthMiddleware;

class Router
{
    private $routes = [];

    private $groupMiddleware = [];

    public function get($path, $callback)
    {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback)
    {
        $this->addRoute('POST', $path, $callback);
    }

    public function patch($path, $callback)
    {
        $this->addRoute('PATCH', $path, $callback);
    }

    public function delete($path, $callback)
    {
        $this->addRoute('DELETE', $path, $callback);
    }

    // Add Route

    private function addRoute($method, $path, $callback)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => rtrim($path, '/'),
            'callback' => $callback,
            'middleware' => $this->groupMiddleware,
        ];
    }

    // Group Routes with Middleware

    public function group(array $options, callable $callback)
    {
        $previousMiddleware = $this->groupMiddleware;

        if (isset($options['middleware'])) {
            $this->groupMiddleware = array_merge($this->groupMiddleware, (array) $options['middleware']);
        }

        $callback($this);

        $this->groupMiddleware = $previousMiddleware;
    }

    // Main Router

    public function route($currentUri, $currentMethod)
    {
        $currentMethod = strtoupper($currentMethod);
        $currentUri = parse_url($currentUri, PHP_URL_PATH);

        $currentUri = preg_replace('#^/practice/public#', '', $currentUri);
        $currentUri = rtrim($currentUri, '/');
        if ($currentUri === '') {
            $currentUri = '/';
        }

        foreach ($this->routes as $route) {
            $routePath = rtrim($route['path'], '/');
            if ($routePath === '') {
                $routePath = '/';
            }

            if ($routePath === $currentUri && $route['method'] === $currentMethod) {
                foreach ($route['middleware'] as $mw) {
                    $this->applyMiddleware($mw);
                }

                if (is_callable($route['callback'])) {
                    return call_user_func($route['callback']);
                }

                if (is_array($route['callback']) && count($route['callback']) === 2) {
                    [$controller, $method] = $route['callback'];
                    if (class_exists($controller)) {
                        $instance = new $controller();
                        if (method_exists($instance, $method)) {
                            return $instance->$method();
                        } else {
                            http_response_code(500);
                            echo "500 - Method not found in controller: {$controller}::{$method}";

                            return;
                        }
                    } else {
                        http_response_code(500);
                        echo "500 - Controller class not found: {$controller}";

                        return;
                    }
                }

                if (is_string($route['callback'])) {
                    $file = BASE_PATH.'/'.ltrim($route['callback'], '/');
                    if (file_exists($file)) {
                        require $file;

                        return;
                    } else {
                        // http_response_code(404);
                        echo '404 - View file not found: '.htmlspecialchars($route['callback']);

                        return;
                    }
                }
            }
        }
        abort(404);

        exit;


    }

    // Middleware Handler
    private function applyMiddleware($middleware)
    {
        if ($middleware === 'auth') {
            AuthMiddleware::handle();
        }
    }
}
