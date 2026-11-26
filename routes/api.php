<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//register route
Route::post('/register', [AuthController::class, 'register']);

//resend OTP
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);

//verify email
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);

//login
Route::post('/login', [AuthController::class, 'login']);