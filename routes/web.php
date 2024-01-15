<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Api Routes (Phase 01)
Route::post('/user-registration', [UserController::class, 'userRegistration']);
Route::post('/user-login', [UserController::class, 'userLogin']);
Route::get('/user-profile', [UserController::class,'userProfile'])->middleware('auth:sanctum');
Route::get('/user-logout', [UserController::class,'userLogout'])->middleware('auth:sanctum');
Route::post('/profile-update', [UserController::class,'profileUpdate'])->middleware('auth:sanctum');
Route::post('/send-otp', [UserController::class,'sendOTP']);
Route::post('/verify-otp', [UserController::class,'verifyOTP']);
Route::post('/reset-password', [UserController::class,'resetPassword'])->middleware('auth:sanctum');



// Page Routes (Phase 02)
Route::view('/userRegistration', 'pages.auth.registration-page');
Route::view('/userLogin', 'pages.auth.login-page')->name('login');
Route::view('/sendOtp', 'pages.auth.send-otp-page');
Route::view('/verifyOtp', 'pages.auth.verify-otp-page');
Route::view('/resetPass', 'pages.auth.reset-pass-page');
Route::view('/userProfile', 'pages.dashboard.profile-page');



// Api Routes (Phase 02)
Route::post('/create-category', [CategoryController::class, 'createCategory'])->middleware('auth:sanctum');
Route::post('/update-category', [CategoryController::class, 'updateCategory'])->middleware('auth:sanctum');
Route::post('/delete-category', [CategoryController::class, 'deleteCategory'])->middleware('auth:sanctum');
Route::post('/category-by-id', [CategoryController::class, 'categoryById'])->middleware('auth:sanctum');
Route::get('/category-list', [CategoryController::class, 'categoryList'])->middleware('auth:sanctum');

// Update-category is not complete in the front-end (JS part)!!!!

// Page Routes (Phase 02)
Route::view('/categoryPage', 'pages.dashboard.category-page');


