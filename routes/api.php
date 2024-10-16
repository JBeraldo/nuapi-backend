<?php

use App\Http\Controllers\AccessLevelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Usuários
Route::get('/me', [UserController::class, 'getMe'])->middleware(['api', 'auth']);

// Login
Route::post('/login', [LoginController::class, 'login'])->middleware('api');


// Níveis de Acesso
Route::post('/role', [AccessLevelController::class, 'storeRole'])->middleware('api','auth');
Route::post('/permission', [AccessLevelController::class, 'storePermission'])->middleware('api','auth');
Route::post('/grant-role', [AccessLevelController::class, 'grateRoleToUser'])->middleware('api','auth');

