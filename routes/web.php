<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'authenticate']);

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('employees', EmployeeController::class)->middleware('auth');
Route::resource('positions', PositionController::class)->middleware('auth');
Route::resource('shifts', ShiftController::class)->middleware('auth');

