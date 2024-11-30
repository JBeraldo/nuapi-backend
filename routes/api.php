<?php

use App\Http\Controllers\AccessLevelController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
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
Route::resource('/student', StudentController::class)->middleware(['api', 'auth']);

//Arquivos
Route::post('/store-pdf', [StudentController::class, 'uploadPEI'])->middleware(['api', 'auth']);
Route::get('/download/{id}', [FileController::class, 'downloadPEI'])->middleware(['api', 'auth']);

//Disciplinas
Route::get('/subjects/{active?}', [SubjectController::class, 'index'])->middleware(['api', 'auth']);
Route::resource('/subjects', SubjectController::class)->middleware(['api', 'auth'])->except([
    'index'
]);

//Notificacoes
Route::get('/notifications/{read?}', [NotificationController::class, 'index'])->middleware(['api', 'auth']);
Route::put('/notifications', [NotificationController::class, 'read'])->middleware(['api', 'auth']);
