<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::get('/organization', [OrganizationController::class, 'index']);

