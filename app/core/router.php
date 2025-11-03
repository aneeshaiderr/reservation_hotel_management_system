<?php

namespace App\Core;

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;

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
                        http_response_code(404);
                        echo '404 - View file not found: '.htmlspecialchars($route['callback']);

                        return;
                    }
                }
            }
        }

        http_response_code(404);
        echo '404 - Route not found';
    }

    // Middleware Handler
    private function applyMiddleware($middleware)
    {
        if ($middleware === 'auth') {
            (new AuthMiddleware())->handle();
        } elseif (strpos($middleware, 'role:') === 0) {
            $role = explode(':', $middleware)[1];
            (new RoleMiddleware())->handle($role);
        }
    }
}

// class Router {
//     protected $db =null;
//     protected $routes = [];

//     protected function add($method, $uri, $controller, $middleware = []) {
//         $this->routes[] = [
//             'method'     => strtoupper($method),
//             'uri'        => $uri,
//             'controller' => $controller,
//             'middleware' => $middleware
//         ];
//     }

//     public function get($uri, $controller, $middleware = []) {
//         $this->add('GET', $uri, $controller, $middleware);
//     }

//     public function post($uri, $controller, $middleware = []) {
//         $this->add('POST', $uri, $controller, $middleware);
//     }

//     public function patch($uri, $controller, $middleware = []) {
//         $this->add('PATCH', $uri, $controller, $middleware);
//     }

//     public function delete($uri, $controller, $middleware = []) {
//         $this->add('DELETE', $uri, $controller, $middleware);
//     }

//     public function route($currentUri, $currentMethod) {
//         $currentMethod = strtoupper($currentMethod);
//         $currentUri = rtrim($currentUri, '/');

//         foreach ($this->routes as $route) {
//             $routeUri = rtrim($route['uri'], '/');
//             $routeUri = $routeUri === '' ? '/' : $routeUri;
//             $currentUri = $currentUri === '' ? '/' : $currentUri;

//             if ($routeUri === $currentUri && $route['method'] === $currentMethod) {

//                 // Middleware check
//                 if (!empty($route['middleware'])) {
//                     foreach ($route['middleware'] as $mw) {
//                         if (str_starts_with($mw, 'permission:')) {
//                             $requiredPermission = explode(':', $mw)[1];

//                         //  $check = new \App\Middleware\Permission($db, $requiredPermission);

//                         //     $check->handle($_SESSION['user_id'] ?? null, $requiredPermission);
//                         }
//                     }
//                 }

//                 $controller = $route['controller'];

//                 if (is_array($controller)) {
//                     $class = $controller['class'];
//                     $method = $controller['method'];

//                     if (class_exists($class) && method_exists($class, $method)) {
//                         $obj = new $class();
//                         return $obj->$method();
//                     } else {
//                         http_response_code(500);
//                         echo "Controller ya method nahi mila.";
//                         exit;
//                     }
//                 }
//                 elseif (is_string($controller)) {
//                     if (str_starts_with($controller, 'app/view')) {
//                         $path = base_path($controller);
//                     } else {
//                         $path = __DIR__ . '/../controllers/' . ltrim($controller, '/');
//                     }

//                     if (file_exists($path)) {
//                         return require $path;
//                     } else {
//                         http_response_code(404);
//                         echo "File not found: $path";
//                         exit;
//                     }
//                 }
//             }
//         }
//         http_response_code(404);
//         return require base_path('app/view/404.php');
//     }
// }
