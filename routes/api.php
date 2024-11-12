<?php

use App\Http\Controllers\AccessLevelController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Usuários
Route::get('/me', [UserController::class, 'getMe'])->middleware(['api', 'auth']);

// Login
Route::post('/login', [LoginController::class, 'login'])->middleware('api');

// Níveis de Acesso
Route::post('/role', [AccessLevelController::class, 'storeRole'])->middleware('api');
Route::post('/permission', [AccessLevelController::class, 'storePermission'])->middleware('api');
Route::post('/grant-role', [AccessLevelController::class, 'grateRoleToUser'])->middleware('api');

//Professor
Route::resource('/professor', ProfessorController::class)->middleware(['api', 'auth']);

//Aluno
Route::resource('/student', StudentController::class)->middleware(['api']);

//Arquivos
Route::post('/store-pdf', [FileController::class, 'store'])->middleware(['api']);

//Disciplinas
Route::resource('/disciplinas', SubjectController::class)->middleware(['api', 'auth']);
