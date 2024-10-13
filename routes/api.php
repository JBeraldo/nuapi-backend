<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Usuários
Route::get('/me', [UserController::class, 'getMe'])->middleware(['api', 'auth']);

// Login
Route::post('/login', [LoginController::class, 'login'])->middleware('api');
