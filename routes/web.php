<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/login', [AuthController::class, 'authenticate']);
