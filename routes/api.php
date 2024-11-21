<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TextController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/customer', [CustomerController::class, 'get_customers']);
