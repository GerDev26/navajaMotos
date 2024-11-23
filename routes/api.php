<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\VehicleController;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/customer', [CustomerController::class, 'get_customers']);

Route::group(['prefix' => '/vehicle'], function() {
    Route::get('/', [VehicleController::class, 'index']);
    Route::post('/', [VehicleController::class, 'store']);
});

