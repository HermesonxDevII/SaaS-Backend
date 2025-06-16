<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('/create')->group(function () {
    Route::post('/user', [UserController::class, 'create']);
});

Route::prefix('/list')->group(function () {
    Route::get('/user', [UserController::class, 'list']);
});

Route::prefix('/edit')->group(function () {
    Route::put('/user/{id}', [UserController::class, 'edit']);
});

Route::prefix('/delete')->group(function () {
    Route::delete('/user/{id}', [UserController::class, 'delete']);
});