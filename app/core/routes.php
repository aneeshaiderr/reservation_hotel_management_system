<?php

$router->get('/', 'app/view/Frontend/index.php');
$router->get('/about', 'app/view/Frontend/about.php');
$router->get('/room', 'app/view/Frontend/room.php');
$router->get('/news', 'app/view/Frontend/news.php');
$router->get('/contact', 'app/view/Frontend/contact.php');

$router->get('/userAllDetails', [
    'class' => 'App\Controllers\DashboardController\UserAllDetailsController',
    'method' => 'index'
]);

$router->get('/user', [
    'class' => 'App\Controllers\DashboardController\UserController',
    'method' => 'index'
]);
$router->get('/reservation/create', [
    'class' => 'App\Controllers\DashboardController\UserController',
    'method' => 'create'
]);
$router->post('/user', [
    'class' => 'App\Controllers\DashboardController\UserController',
    'method' => 'store'
]);
$router->delete('/user/delete', [
    'class' => 'App\Controllers\DashboardController\UserController',
    'method' => 'softDelete'
]);

$router->get('/details', [
    'class' => 'App\Controllers\DashboardController\DetailsController',
    'method' => 'index'
]);

$router->patch('/details', [
    'class' => 'App\Controllers\DashboardController\DetailsController',
    'method' => 'update'
]);
$router->get('/userdetails', [
    'class' => 'App\Controllers\DashboardController\UserDetailsController',
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
    
]);
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
$router->get('/roomDetail', [
    'class' => 'App\Controllers\DashboardController\RoomDetailController',
    'method' => 'index'
]);
$router->post('/roomDetail', [
    'class' => 'App\Controllers\DashboardController\RoomDetailController',
    'method' => 'update'
]);
$router->get('/roomCreate', [
    'class' => 'App\Controllers\DashboardController\RoomCreateController',
    'method' => 'index'
]);

$router->post('/roomCreate', [
    'class' => 'App\Controllers\DashboardController\RoomCreateController',
    'method' => 'store'
]);

$router->post('/rooms/delete', [
    'class' => 'App\Controllers\DashboardController\RoomsController',
    'method' => 'delete'
]);
$router->get('/hotel', [
    'class' => 'App\Controllers\DashboardController\HotelController',
    'method' => 'index'
]);
$router->post('/hotel/delete', [
    'class' => 'App\Controllers\DashboardController\HotelController',
    'method' => 'delete'
]);
$router->get('/hotel/create', [
    'class' => 'App\Controllers\DashboardController\HotelCreateController',
    'method' => 'create'
]);

$router->post('/hotel/store', [
    'class' => 'App\Controllers\DashboardController\HotelCreateController',
    'method' => 'store'
]);
$router->get('/hotel/hotelDetail', [
    'class' => 'App\Controllers\DashboardController\HotelDetailController',
    'method' => 'show'
]);
$router->patch('/hotel', [
    'class' => 'App\Controllers\DashboardController\HoteldetailController',
    'method' => 'update'
]);
$router->get('/reservation', [
    'class' => 'App\Controllers\DashboardController\ReservationController',
    'method' => 'index'
]);
$router->get('/reservation/reservationCreate', [
    'class' => 'App\Controllers\DashboardController\ReservationController',
    'method' => 'create'
]);
$router->post('/reservation', [
    'class' => 'App\Controllers\DashboardController\ReservationController',
    'method' => 'store'
]);
$router->post('/reservation/delete', [
    'class' => 'App\Controllers\DashboardController\ReservationController',
    'method' => 'delete'
]);
$router->get('/reservation/editReservation', [
    'class' => 'App\Controllers\DashboardController\EditReservationController',
    'method' => 'show'
]);
$router->patch('/reservation', [
    'class' => 'App\Controllers\DashboardController\EditReservationController',
    'method' => 'update'
]);
$router->get('/discount', [
    'class' => 'App\Controllers\DashboardController\DiscountController',
    'method' => 'index'
]);
$router->get('/discount/createDiscount', [
    'class' => 'App\Controllers\DashboardController\DiscountCreateController',
    'method' => 'index'
]);
$router->post('/discount', [
    'class' => 'App\Controllers\DashboardController\DiscountCreateController',
    'method' => 'store'
]);
$router->get('/discount/editDiscount', [
    'class' => 'App\Controllers\DashboardController\EditDiscountController',
    'method' => 'show'
]);
$router->patch('/discount', [
    'class' => 'App\Controllers\DashboardController\EditDiscountController',
    'method' => 'update'
]);
$router->post('/discount/delete', [
    'class' => 'App\Controllers\DashboardController\DiscountController',
    'method' => 'delete'
]);
$router->get('/services', [
    'class' => 'App\Controllers\DashboardController\ServicesController',
    'method' => 'index'
]);
$router->get('/services/createService', [
    'class' => 'App\Controllers\DashboardController\CreateServiceController',
    'method' => 'index'
]);

$router->post('/services', [
    'class' => 'App\Controllers\DashboardController\CreateServiceController',
    'method' => 'store'
]);
$router->get('/services/editService', [
    'class' => 'App\Controllers\DashboardController\EditServiceController',
    'method' => 'edit'
]);

$router->patch('/services', [
    'class' => 'App\Controllers\DashboardController\EditServiceController',
    'method' => 'update'
]);
$router->post('/services/delete', [
    'class' => 'App\Controllers\DashboardController\ServicesController',
    'method' => 'delete'
]);
$router->get('/analytics', [
    'class' => 'App\Controllers\DashboardController\AnalyticsController',
    'method' => 'index'
]);
$router->get('/reservation/analytics', [
    'class' => 'App\Controllers\DashboardController\AnalyticsController',
    'method' => 'index'
]);

