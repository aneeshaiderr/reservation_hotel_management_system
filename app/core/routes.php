<?php

use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\RoomController;
use App\Controllers\NewsController;
use App\Controllers\ContactController;
use App\Controllers\Auth\SignupController;
use App\Controllers\Auth\LoginController;

use App\Controllers\DashboardController\UserController;
use App\Controllers\DashboardController\RoomsController;
use App\Controllers\DashboardController\HotelController;
use App\Controllers\DashboardController\ReservationController;
use App\Controllers\DashboardController\DiscountController;
use App\Controllers\DashboardController\ServicesController;
use App\Controllers\DashboardController\AnalyticsController;

use App\Controllers\Auth\StaffLoginController;
use App\Controllers\Auth\StaffSignupController;



$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/room', [RoomController::class, 'index']);
$router->get('/news', [NewsController::class, 'index']);
$router->get('/contact', [ContactController::class, 'index']);


$router->get('/login', [LoginController::class, 'index']);
$router->post('/login', [LoginController::class, 'store']);
$router->get('/signup', [SignupController::class, 'index']);
$router->post('/signup', [SignupController::class, 'store']);

// Staff login/signup
$router->get('/staffLogin', [StaffLoginController::class, 'index']);
$router->post('/staffLogin', [StaffLoginController::class, 'store']);
$router->get('/StaffSignup', [StaffSignupController::class, 'index']);
$router->post('/StaffSignup', [StaffSignupController::class, 'store']);



$router->group(['middleware' => ['authMiddleware']], function ($router) {

    // Common for all logged-in users (user, staff, super_admin)
    $router->get('/user', [UserController::class, 'index']);
       $router->get('/user/CreateUser', [UserController::class, 'CreateUser']);
       $router->post('/user/store', [UserController::class, 'CreateUser']);
    $router->get('/userAllDetails', [UserController::class, 'userAllDetails']);
    $router->get('/userdetails', [UserController::class, 'show']);
    $router->get('/details', [UserController::class, 'show']);
    $router->post('/details', [UserController::class, 'update']);

    //  Reservations 
    $router->get('/reservation', [ReservationController::class, 'index']);
    $router->get('/reservation/reservationCreate', [ReservationController::class, 'create']);
    $router->post('/reservation', [ReservationController::class, 'store']);
    $router->get('/reservation/editReservation', [ReservationController::class, 'edit']);
    $router->post('/reservation/update', [ReservationController::class, 'update']);
    $router->post('/reservation/delete', [ReservationController::class, 'delete']);

    // Rooms
    $router->get('/rooms', [RoomsController::class, 'index']);
    $router->get('/roomCreate', [RoomsController::class, 'create']);
    $router->post('/rooms', [RoomsController::class, 'store']);
    $router->get('/roomDetail', [RoomsController::class, 'detail']);
    $router->post('/rooms/update', [RoomsController::class, 'update']);
    $router->post('/rooms/delete', [RoomsController::class, 'delete']);

    //  Hotels
    $router->get('/hotel', [HotelController::class, 'index']);
    $router->get('/hotel/create', [HotelController::class, 'create']);
    $router->post('/hotel/store', [HotelController::class, 'store']);
    $router->get('/hotel/hotelDetail', [HotelController::class, 'show']);
    $router->post('/hotel', [HotelController::class, 'update']);
    $router->post('/hotel/delete', [HotelController::class, 'delete']);

    //  Discounts (only for staff/admin)
    $router->group(['middleware' => ['role:staff,super_admin']], function ($router) {
        $router->get('/discount', [DiscountController::class, 'index']);
        $router->get('/discount/createDiscount', [DiscountController::class, 'create']);
        $router->post('/discount', [DiscountController::class, 'store']);
        $router->get('/discount/editDiscount', [DiscountController::class, 'edit']);
        $router->post('/discount/update', [DiscountController::class, 'update']);
        $router->post('/discount/delete', [DiscountController::class, 'delete']);
    });

    // Services
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



// use App\Controllers\HomeController;
// use App\Controllers\AboutController;
// use App\Controllers\RoomController;
// use App\Controllers\NewsController;
// use App\Controllers\ContactController;
// use App\Controllers\Auth\SignupController;
// use App\Controllers\Auth\LoginController;

// // Guest (Public Frontend) Routes
// use App\Controllers\DashboardController\UserAllDetailsController;
// use App\Controllers\DashboardController\UserController;

// use App\Controllers\DashboardController\RoomsController;
// use App\Controllers\DashboardController\HotelController;
// use App\Controllers\DashboardController\ReservationController;
// use App\Controllers\DashboardController\DiscountController;
// use App\Controllers\DashboardController\ServicesController;
// use App\Controllers\DashboardController\AnalyticsController;
// use App\Middleware\Permission;
// use App\Controllers\Auth\StaffLoginController;
// use App\Controllers\Auth\StaffSignupController;




// $router->group(['middleware' => ['auth']], function ($router) {

//     $router->get('/discount', [DiscountController::class, 'index']);

    
//     $router->get('/discount/createDiscount', [DiscountController::class, 'create']);
//     $router->post('/discount', [DiscountController::class, 'store']);

   
//     $router->get('/discount/editDiscount', [DiscountController::class, 'edit']);  
//     $router->post('/discount/update', [DiscountController::class, 'update']);


//     $router->post('/discount/delete', [DiscountController::class, 'delete']);
// });

// $router->group(['middleware' => ['Staff']], function ($router) {

//     // Staff Signup
//     $router->get('/StaffSignup', [StaffSignupController::class, 'index']);  
//     $router->post('/StaffSignup', [StaffSignupController::class, 'store']); 

//     // Staff Login
//     $router->get('/staffLogin', [StaffLoginController::class, 'index']);   
//     $router->post('/staffLogin', [StaffLoginController::class, 'store']); 
      
// });
// $router->group(['middleware' => ['users']], function ($router) {
//     $router->get('/', [HomeController::class, 'index']);      
//     $router->get('/about', [AboutController::class, 'index']);
//     $router->get('/room', [RoomController::class, 'index']);   
//     $router->get('/news', [NewsController::class, 'index']);   
//     $router->get('/contact', [ContactController::class, 'index']); 
// });

// $router->group(['middleware' => ['user']], function ($router) {

 
//     // Signup Routes
    
//     $router->get('/signup', [SignupController::class, 'index']); 
//     $router->post('/signup', [SignupController::class, 'index']);  

  
//     // Login Routes
   
//     $router->get('/login', [LoginController::class, 'index']);   
//     $router->post('/login', [LoginController::class, 'store']);  
//     $router->group(['middleware' => ['authMiddleware']], function ($router) {

//     // Everyone redirects
//     $router->get('/user', [UserController::class, 'index']);

//     // Super Admin and Staff also can see reservations
//     $router->get('/reservation', [ReservationController::class, 'index']);
//     // Create Form
//     $router->get('/reservation/reservationCreate', [ReservationController::class, 'create']);
//     $router->post('/reservation', [ReservationController::class, 'store']);

//     $router->get('/rooms', [RoomsController::class, 'index']);
//     $router->get('/hotel', [HotelController::class, 'index']);
    
// });
// });

    
// $router->group(['middleware' => ['authMiddleware', 'role:user']], function ($router) {

    
//      $router->get('/user', [UserController::class, 'index']);
//      $router->get('/user/CreateUser', [UserController::class, 'CreateUser']);
//      $router->post('/user/store', [UserController::class, 'CreateUser']);
//     $router->get('/userAllDetails', [UserAllDetailsController::class, 'index']);
//  $router->get('/userdetails', [UserAllDetailsController::class, 'show']);
//     $router->get('/details', [UserController::class, 'show']);
//     $router->post('/details', [UserController::class, 'update']);

// $router->group(['middleware' => ['authMiddleware']], function ($router) {

//     // All Reservations (List)
//     $router->get('/reservation', [ReservationController::class, 'index']);

//     // Create rreservation
//     $router->get('/reservation/reservationCreate', [ReservationController::class, 'create']);
//     $router->post('/reservation', [ReservationController::class, 'store']);

//     // Edit Reservation
//     $router->get('/reservation/editReservation', [ReservationController::class, 'edit']);  
//     $router->post('/reservation/update', [ReservationController::class, 'update']);

//     // Delete Reservation
//     $router->post('/reservation/delete', [ReservationController::class, 'delete']);
// });
// $router->group(['middleware' => ['authMiddleware']], function ($router) {

//     //  All Rooms (List)
//     $router->get('/rooms', [RoomsController::class, 'index']);

//     // Create Room (Form + Store)
//     $router->get('/roomCreate', [RoomsController::class, 'create']);
//     $router->post('/rooms', [RoomsController::class, 'store']);

//     //Edit / Update Room Details
//     $router->get('/roomDetail', [RoomsController::class, 'detail']);  
//     $router->post('/rooms/update', [RoomsController::class, 'update']);

//     // Delete Room (Soft Delete)
//     $router->post('/rooms/delete', [RoomsController::class, 'delete']);
// });

    

//     //  Analytics 
//     $router->get('/analytics', [AnalyticsController::class, 'index']);
//     $router->get('/reservation/analytics', [AnalyticsController::class, 'index']);
    
// });
// $router->group(['middleware' => ['authMiddleware', 'role:super_admin']], function($router) {
//   $router->post('/user', [UserController::class, 'softDelete']);
    
 
// });

// $router->group(['middleware' => ['authMiddleware']], function ($router) {

//     // All Hotels (List)
//     $router->get('/hotel', [HotelController::class, 'index']);

//     // Create Hotel
//     $router->get('/hotel/create', [HotelController::class, 'create']);
//     $router->post('/hotel/store', [HotelController::class, 'store']);

//     // Edit / Update Hotel
//     $router->get('/hotel/hotelDetail', [HotelController::class, 'show']);  
//     $router->post('/hotel', [HotelController::class, 'update']);

//     // Delete Hotel (Soft Delete)
//     $router->post('/hotel/delete', [HotelController::class, 'delete']);
// });
// $router->group(['middleware' => ['auth']], function ($router) {

//     // All Services (List)
//     $router->get('/services', [ServicesController::class, 'index']);

//     // Create Service
//     $router->get('/createService', [ServicesController::class, 'create']);
//     $router->post('/services', [ServicesController::class, 'store']);

//     // Edit / Update Service
//     $router->get('/services/editService', [ServicesController::class, 'edit']);
//     $router->post('/services/update', [ServicesController::class, 'update']);

//     // Delete Service (Soft Delete)
//     $router->post('/services/delete', [ServicesController::class, 'delete']);
// });
