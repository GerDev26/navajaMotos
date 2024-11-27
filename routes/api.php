<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReplacementController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WorkController;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/customer', [CustomerController::class, 'get_customers']);

Route::group(['prefix' => '/vehicle'], function() {
    Route::get('/', [VehicleController::class, 'index']);
    Route::get('/model', [VehicleController::class, 'models_index']);
    Route::post('/', [VehicleController::class, 'store']);
});
Route::group(['prefix' => '/customer'], function() {
    Route::post('/', [CustomerController::class, 'store']);
});
Route::group(['prefix' => '/invoice'], function() {
    Route::post('/', [InvoiceController::class, 'store']);
});
Route::group(['prefix' => '/work'], function() {
    Route::post('/', [WorkController::class, 'store']);
    Route::get('/', [WorkController::class, 'index']);
    Route::get('/invoice', [WorkController::class, 'invoice_work_index']);
});
Route::group(['prefix' => '/replacement'], function() {
    Route::post('/', [ReplacementController::class, 'store']);
    Route::get('/', [ReplacementController::class, 'index']);
    Route::get('/invoice', [ReplacementController::class, 'invoice_replacement_index']);
});


Route::post('/invoiceForm', [FormController::class, 'invoice_form']);

