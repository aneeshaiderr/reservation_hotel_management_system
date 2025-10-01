<?php
namespace App\Core;
use App\Core\Database;
class Router {
    protected $db =null;
    protected $routes = [];


    protected function add($method, $uri, $controller, $middleware = []) {
        $this->routes[] = [
            'method'     => strtoupper($method),
            'uri'        => $uri,
            'controller' => $controller,
            'middleware' => $middleware
        ];
    }

    public function get($uri, $controller, $middleware = []) {
        $this->add('GET', $uri, $controller, $middleware);
    }

    public function post($uri, $controller, $middleware = []) {
        $this->add('POST', $uri, $controller, $middleware);
    }

    public function patch($uri, $controller, $middleware = []) {
        $this->add('PATCH', $uri, $controller, $middleware);
    }

    public function delete($uri, $controller, $middleware = []) {
        $this->add('DELETE', $uri, $controller, $middleware);
    }

    public function route($currentUri, $currentMethod) {
        $currentMethod = strtoupper($currentMethod);
        $currentUri = rtrim($currentUri, '/');

        foreach ($this->routes as $route) {
            $routeUri = rtrim($route['uri'], '/');
            $routeUri = $routeUri === '' ? '/' : $routeUri;  
            $currentUri = $currentUri === '' ? '/' : $currentUri;

            if ($routeUri === $currentUri && $route['method'] === $currentMethod) {

                // Middleware check
                if (!empty($route['middleware'])) {
                    foreach ($route['middleware'] as $mw) {
                        if (str_starts_with($mw, 'permission:')) {
                            $requiredPermission = explode(':', $mw)[1];

                        //  $check = new \App\Middleware\Permission($db, $requiredPermission);

                        //     $check->handle($_SESSION['user_id'] ?? null, $requiredPermission);
                        }
                    }
                }

                $controller = $route['controller'];

                if (is_array($controller)) {
                    $class = $controller['class'];
                    $method = $controller['method'];

                    if (class_exists($class) && method_exists($class, $method)) {
                        $obj = new $class();
                        return $obj->$method();
                    } else {
                        http_response_code(500);
                        echo "Controller ya method nahi mila.";
                        exit;
                    }
                }
                elseif (is_string($controller)) {
                    if (str_starts_with($controller, 'app/view')) {
                        $path = base_path($controller);
                    } else {
                        $path = __DIR__ . '/../controllers/' . ltrim($controller, '/');
                    }

                    if (file_exists($path)) {
                        return require $path;
                    } else {
                        http_response_code(404);
                        echo "File not found: $path";
                        exit;
                    }
                }
            }
        }
        http_response_code(404);
        return require base_path('app/view/404.php');
    }
}

// namespace App\Core;
// class Router {
//     protected $routes = [];

//     protected function add($method, $uri, $controller) {
//         $this->routes[] = [
//             'method' => strtoupper($method),
//             'uri' => $uri,
//             'controller' => $controller
//         ];
//     }

//     public function get($uri, $controller) {
//         $this->add('GET', $uri, $controller);
//     }

//     public function post($uri, $controller) {
//         $this->add('POST', $uri, $controller);
//     }

//     public function patch($uri, $controller) {
//         $this->add('PATCH', $uri, $controller);
//     }

//     public function delete($uri, $controller) {
//         $this->add('DELETE', $uri, $controller);
//     }

//     public function route($currentUri, $currentMethod) {
//     $currentMethod = strtoupper($currentMethod);
//     $currentUri = rtrim($currentUri, '/');

//     foreach ($this->routes as $route) {
// $routeUri = rtrim($route['uri'], '/');
// $routeUri = $routeUri === '' ? '/' : $routeUri;  
// $currentUri = rtrim($currentUri, '/');
// $currentUri = $currentUri === '' ? '/' : $currentUri;

//         if ($routeUri === $currentUri && $route['method'] === $currentMethod) {
 
//             $controller = $route['controller'];

//             if (is_array($controller)) {
//                 $class = $controller['class'];
//                 $method = $controller['method'];

//                 if (class_exists($class) && method_exists($class, $method)) {
//                     $obj = new $class();
//                     return $obj->$method();
//                 } else {
//                     http_response_code(500);
//                     echo "Controller ya method nahi mila.";
//                     exit;
//                 }

//             }
//             elseif (is_string($controller)) {
    
//     if (str_starts_with($controller, 'app/view')) {
//         $path = base_path($controller);
//     } else {
        
//         $path = __DIR__ . '/../controllers/' . ltrim($controller, '/');
//     }

//     if (file_exists($path)) {
//         return require $path;
//     } else {
//         http_response_code(404);
//         echo "File not found: $path";
//         exit;
//     }
// }
           
//         }
//     }
//      http_response_code(404);
//         return require base_path('app/view/404.php');
// }
// }

