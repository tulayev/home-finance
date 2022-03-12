<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\RecordController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/records', RecordController::class);
    Route::get('/user', [UserController::class, 'user']);
    Route::put('/user/info', [UserController::class, 'updateInfo']);
    Route::put('/user/password', [UserController::class, 'updatePassword']);
    Route::post('/upload', [ImageController::class, 'upload']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
