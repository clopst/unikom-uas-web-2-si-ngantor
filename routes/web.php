<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

// 10123914 - DIMAS NURFAUZI
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'authenticate']);
Route::get('/auth/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('index');

Route::resource('attendances', AttendanceController::class)->middleware('auth');
Route::resource('employees', EmployeeController::class)->middleware('auth');

// 10123909 - Andi Tegar Permadi
Route::resource('positions', PositionController::class)->middleware('auth');

// 10123910 - Gilbert Santoso
Route::resource('shifts', ShiftController::class)->middleware('auth');

