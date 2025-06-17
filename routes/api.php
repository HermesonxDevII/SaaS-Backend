<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->prefix('/create')->group(function () {
    Route::post('/user', [UserController::class, 'create']);
});

Route::middleware('auth:sanctum')->prefix('/list')->group(function () {
    Route::get('/user', [UserController::class, 'list']);
});

Route::middleware('auth:sanctum')->prefix('/edit')->group(function () {
    Route::put('/user/{id}', [UserController::class, 'edit']);
});

Route::middleware('auth:sanctum')->prefix('/delete')->group(function () {
    Route::delete('/user/{id}', [UserController::class, 'delete']);
});