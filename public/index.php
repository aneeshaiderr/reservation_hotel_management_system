
<?php

 require __DIR__ . '/../function.php'; 
 session_start(); 

define('BASE_PATH', __DIR__ . '/../');
// echo base_path('app/view/Frontend/about.php');
// die();
define('BASE_URL', '/practice/public');
require BASE_PATH . '/vendor/autoload.php';
$config = require BASE_PATH . 'config.php';
use App\Middleware\Session;
use App\Middleware\Authenticator;
use App\Models\User;
use App\Core\Router;
use App\Core\Database;

use App\Controllers\DashboardController\UserController;


$router = new Router();



require BASE_PATH . 'app/Core/routes.php';

 $db = new Database($config['database']);

// model instance
// $userModel = new User($db);

// // // controller instance (model inject ho raha hai)
// $userController = new UserController($userModel);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$basePath = '/practice/public';


if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}


$uri = rtrim($uri, '/');
$uri = $uri === '' ? '/' : $uri;

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];



$router->route($uri, $method);
