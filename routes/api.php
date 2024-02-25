<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Public Routes
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);
//Forgot Password Routes
//Password reset link request form
// Route::post('/forgot-password',[ForgotPassword::class, 'forgotPassword']);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {

    //Routes for users
    Route::get('/users',[UserController::class,'index']);
    Route::post('/users',[UserController::class,'store']);
    Route::get('/users/{id}',[UserController::class,'show']);
    Route::put('/users/{id}',[UserController::class,'update']);
    Route::delete('/users/{id}',[UserController::class,'destroy']);
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::put('/users/change_password/{id}',[UserController::class,'changePassword']);

    //Routes for Events
    Route::get('/events',[EventController::class,'index']);
    Route::post('/events',[EventController::class,'store']);
    Route::get('/events/{id}',[EventController::class,'show']);
    Route::put('/events/{id}',[EventController::class,'update']);
    Route::delete('/events/{id}',[EventController::class,'destroy']);

    //Routes for Tickets
    Route::get('/tickets',[TicketController::class,'index']);
    Route::post('/tickets',[TicketController::class,'store']);
    Route::get('/tickets/{id}',[TicketController::class,'show']);
    Route::put('/tickets/{id}',[TicketController::class,'update']);
    Route::delete('/tickets/{id}',[TicketController::class,'destroy']);
});
