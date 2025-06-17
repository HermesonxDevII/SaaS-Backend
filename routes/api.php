<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanySegmentController;

Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->prefix('/create')->group(function () {
    Route::post('/user', [UserController::class, 'create']);
    Route::post('/company-segment', [CompanySegmentController::class, 'create']);
});

Route::middleware('auth:sanctum')->prefix('/list')->group(function () {
    Route::get('/user', [UserController::class, 'list']);
    Route::get('/company-segment', [CompanySegmentController::class, 'list']);
});

Route::middleware('auth:sanctum')->prefix('/edit')->group(function () {
    Route::put('/user/{id}', [UserController::class, 'edit']);
    Route::put('/company-segment/{id}', [CompanySegmentController::class, 'edit']);
});

Route::middleware('auth:sanctum')->prefix('/delete')->group(function () {
    Route::delete('/user/{id}', [UserController::class, 'delete']);
    Route::delete('/company-segment/{id}', [CompanySegmentController::class, 'delete']);
});