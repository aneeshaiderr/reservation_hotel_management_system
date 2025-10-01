<?php

$router->get('/', 'app/view/Frontend/index.php');
$router->get('/about', 'app/view/Frontend/about.php');
$router->get('/room', 'app/view/Frontend/room.php');
$router->get('/news', 'app/view/Frontend/news.php');
$router->get('/contact', 'app/view/Frontend/contact.php');



// $router->get('/user', '/DashboardController/UserController.php');
$router->get('/user', [
    'class' => 'App\Controllers\DashboardController\UserController',
    'method' => 'index'
]);
$router->get('/user/create', [
    'class' => 'App\Controllers\DashboardController\UserController',
    'method' => 'create'
]);
$router->post('/user', [
    'class' => 'App\Controllers\DashboardController\UserController',
    'method' => 'store'
]);
$router->delete('/user', [
    'class' => 'App\Controllers\DashboardController\UserController',
    'method' => 'destroy'
]);
$router->get('/details', [
    'class' => 'App\Controllers\DashboardController\DetailsController',
    'method' => 'index'
]);

$router->patch('/details', [
    'class' => 'App\Controllers\DashboardController\DetailsController',
    'method' => 'update'
]);
$router->get('/rooms', [
    'class' => 'App\Controllers\DashboardController\RoomsController',
    'method' => 'index'
]);
$router->get('/rooms', [
    'class' => 'App\Controllers\DashboardController\RoomsController',
    'method' => 'index'
]);
$router->get('/signup', [
    'class' => 'App\Controllers\Auth\SignupController',
    'method' => 'index'
]);
$router->post('/signup', [
    'class' => 'App\Controllers\Auth\SignupController',
    'method' => 'index'
]);
// Login page show (GET request)
$router->get('/login', [
    'class' => 'App\Controllers\Auth\LoginForm',
    'method' => 'index'
]);

// Login form submit (POST request)
$router->post('/login', [
    'class' => 'App\Controllers\Auth\LoginForm',
    'method' => 'store'
    
], ['permission:users']);
$router->get('/staffSignup', [
    'class' => 'App\Controllers\Auth\StaffSignup',
    'method' => 'index'
]);
$router->post('/staffSignup', [
    'class' => 'App\Controllers\Auth\StaffSignup',
    'method' => 'index'
]);
$router->get('/staffLogin', [
    'class' => 'App\Controllers\Auth\StaffLogin',
    'method' => 'index'
]);
$router->post('/staffLogin', [
    'class' => 'App\Controllers\Auth\staffLogin',
    'method' => 'store'
]);
// $router->get('/register', '/registration/create.php')->only('guest');
// $router->get('/user', 'app/views/dashboard/user.php');
// $router->get('/rooms', 'app/views/dashboard/models/rooms.php');
$router->get('/hotel', 'app/views/dashboard/models/hotel.php');
$router->get('/services', 'app/views/dashboard/models/services.php');
$router->get('/discount', 'app/views/dashboard/models/discount.php');
$router->get('/reservation', 'app/views/dashboard/models/reservation.php');
$router->get('/payment', 'app/views/dashboard/models/payment.php');
$router->get('/analytics', 'app/views/dashboard/models/analytics.php');
$router->get('/setting', 'app/views/dashboard/models/setting.php');
$router->get('/setting', 'app/views/dashboard/models/setting.php');
// $router->get('/details', 'app/views/Dashboard/details.view.php');
// $router->patch('/details', 'app/views/dashboard/details.view.php');


