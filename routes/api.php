<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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