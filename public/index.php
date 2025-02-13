<?php
session_start();
// php -S localhost:8000


require_once ('../core/BaseController.php');
require_once '../core/Router.php';
require_once '../core/Route.php';
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/HousingController.php';
require_once '../app/controllers/ProfileController.php';
require_once '../app/config/db.php';



$router = new Router();
Route::setRouter($router);



Route::get('/home' , [HomeController::class , "showHome"]);

// Define routes
// auth routes 
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'handleRegister']);
Route::get('/otp', [AuthController::class, 'showOtp']);
Route::post('/handleOtp', [AuthController::class, 'handleOtp']);
Route::get('/login', [AuthController::class, 'showleLogin']);
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/post-housing', [HousingController::class, 'showPostHousingForm']);
Route::post('/housing/store', [HousingController::class, 'store']);


// admin routes
Route::get('/dashboard', [AdminController::class, 'showDashboard']);
Route::post('/dashboard/update-role', [AdminController::class, 'updateRole']);
Route::post('/dashboard/delete-user', [AdminController::class, 'deleteUser']);



Route::get('/profile', [ProfileController::class, 'profile']);
Route::post('/update-profile', [ProfileController::class, 'updateProfile']);


// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



