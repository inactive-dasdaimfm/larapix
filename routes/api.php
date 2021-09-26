<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}/orders', [UserController::class, 'listOrders']);
Route::post('/users', [UserController::class, 'create'])
    ->middleware('user_exists');

Route::post('/orders/create', [OrderController::class, 'create']);