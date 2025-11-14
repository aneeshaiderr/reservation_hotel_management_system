<?php

// function
 require __DIR__.'/../function.php';
session_start();
// echo "heloo";
// exit();
define('BASE_PATH', __DIR__.'/../');

define('BASE_URL', '/practice/public');
require BASE_PATH.'/vendor/autoload.php';
$config = require BASE_PATH.'config.php';
use App\Core\Database;
use App\Core\Router;
use App\Middleware\AuthMiddleware;

// Call middleware at start of request
AuthMiddleware::handle();
$router = new Router();

require BASE_PATH.'app/Core/routes.php';

$db = new Database($config['database']);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$basePath = '/practice/public';

if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

$uri = rtrim($uri, '/');
$uri = $uri === '' ? '/' : $uri;

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
// $router->routes($uri, $method);
