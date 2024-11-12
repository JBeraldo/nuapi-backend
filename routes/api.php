<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AccessLevelController;

// Usuários
Route::get('/me', [UserController::class, 'getMe'])->middleware(['api', 'auth']);

// Login
Route::post('/login', [LoginController::class, 'login'])->middleware('api');


// Níveis de Acesso
Route::post('/role', [AccessLevelController::class, 'storeRole'])->middleware('api','auth');
Route::post('/permission', [AccessLevelController::class, 'storePermission'])->middleware('api','auth');
Route::post('/grant-role', [AccessLevelController::class, 'grateRoleToUser'])->middleware('api','auth');

//Professor

Route::resource('/professor', ProfessorController::class)->middleware(['api','auth']);

//Aluno

Route::resource('/student', StudentController::class)->middleware(['api']);

//Arquivos

Route::post('/store-pdf', [FileController::class, 'store'])->middleware(['api']);