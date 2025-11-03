<?php

use App\Controllers\AboutController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\SignupController;
use App\Controllers\Auth\StaffLoginController;
use App\Controllers\Auth\StaffSignupController;
use App\Controllers\ContactController;
use App\Controllers\DashboardController\AnalyticsController;
use App\Controllers\DashboardController\DiscountController;
use App\Controllers\DashboardController\HotelController;
use App\Controllers\DashboardController\ReservationController;
use App\Controllers\DashboardController\RoomsController;
use App\Controllers\DashboardController\ServicesController;
use App\Controllers\DashboardController\UserController;
use App\Controllers\HomeController;
use App\Controllers\NewsController;
use App\Controllers\RoomController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/room', [RoomController::class, 'index']);
$router->get('/news', [NewsController::class, 'index']);
$router->get('/contact', [ContactController::class, 'index']);

$router->get('/login', [LoginController::class, 'index']);
$router->post('/login', [LoginController::class, 'store']);
$router->get('/signup', [SignupController::class, 'index']);
$router->post('/signup', [SignupController::class, 'index']);

// Staff login/signup
$router->get('/staffLogin', [StaffLoginController::class, 'index']);
$router->post('/staffLogin', [StaffLoginController::class, 'store']);
$router->get('/staffSignup', [StaffSignupController::class, 'index']);
$router->post('/staffSignup', [StaffSignupController::class, 'index']);

$router->group(['middleware' => ['authMiddleware']], function ($router) {
    // Common for all logged-in users (user, staff, super_admin)

    // Feedback-- Why not group these routes in a UserController
    $router->get('/user', [UserController::class, 'index']);
    $router->get('/user/CreateUser', [UserController::class, 'CreateUser']);
    $router->post('/user', [UserController::class, 'softDelete']);
    $router->post('/user/store', [UserController::class, 'CreateUser']);
    $router->get('/userAllDetails', [UserController::class, 'userAllDetails']);
    $router->get('/userdetails', [UserController::class, 'show']);
    $router->get('/details', [UserController::class, 'show']);
    $router->post('/details', [UserController::class, 'update']);
    

    //  Reservations
    // Feedback-- Why not group these routes in a ReservationController
    $router->get('/reservation', [ReservationController::class, 'index']);
    $router->get('/reservation/reservationCreate', [ReservationController::class, 'create']);
    $router->post('/reservation', [ReservationController::class, 'store']);
    $router->get('/reservation/editReservation', [ReservationController::class, 'edit']);
    $router->post('/reservation/update', [ReservationController::class, 'update']);
    $router->post('/reservation/delete', [ReservationController::class, 'delete']);

    // Rooms
    // Feedback-- Why not group these routes in a RoomsController
    $router->get('/rooms', [RoomsController::class, 'index']);
    $router->get('/roomCreate', [RoomsController::class, 'create']);
    $router->post('/rooms', [RoomsController::class, 'store']);
    $router->get('/roomDetail', [RoomsController::class, 'detail']);
    $router->post('/rooms/update', [RoomsController::class, 'update']);
    $router->post('/rooms/delete', [RoomsController::class, 'delete']);

    //  Hotels
    // Feedback-- Why not group these routes in a HotelController
    $router->get('/hotel', [HotelController::class, 'index']);
    $router->get('/hotel/create', [HotelController::class, 'create']);
    $router->post('/hotel/store', [HotelController::class, 'store']);
    $router->get('/hotel/hotelDetail', [HotelController::class, 'show']);
    $router->post('/hotel', [HotelController::class, 'update']);
    $router->post('/hotel/delete', [HotelController::class, 'delete']);

    //  Discounts (only for staff/admin)
    $router->group(['middleware' => ['role:staff,super_admin']], function ($router) {
        // Feedback-- Why not group these routes in a DiscountController
        $router->get('/discount', [DiscountController::class, 'index']);
        $router->get('/discount/createDiscount', [DiscountController::class, 'create']);
        $router->post('/discount', [DiscountController::class, 'store']);
        $router->get('/discount/editDiscount', [DiscountController::class, 'edit']);
        $router->post('/discount/update', [DiscountController::class, 'update']);
        $router->post('/discount/delete', [DiscountController::class, 'delete']);
    });

    // Services
    // Feedback-- Why not group these routes in a ServicesController
    $router->get('/services', [ServicesController::class, 'index']);
    $router->get('/createService', [ServicesController::class, 'create']);
    $router->post('/services', [ServicesController::class, 'store']);
    $router->get('/services/editService', [ServicesController::class, 'edit']);
    $router->post('/services/update', [ServicesController::class, 'update']);
    $router->post('/services/delete', [ServicesController::class, 'delete']);

    // Analytics (for staff and admin only)
    $router->group(['middleware' => ['role:staff,super_admin']], function ($router) {
        $router->get('/analytics', [AnalyticsController::class, 'index']);
        $router->get('/reservation/analytics', [AnalyticsController::class, 'index']);
    });

    // Super Admin only
    $router->group(['middleware' => ['role:super_admin']], function ($router) {
        $router->post('/user/delete', [UserController::class, 'softDelete']);
    });
});
