<?php

use App\Http\Controllers\TextController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [TextController::class, 'getUsers']);
