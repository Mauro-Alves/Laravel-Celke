<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Login
Route::GET('/', [LoginController::class, 'index'])->name('login.index');
Route::POST('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route::GET('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

// Rotas restrítas
Route::group(['middleware' => 'auth'], function () {


    // Dashboard
    Route::GET('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Usuários
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index');          // Listar
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');      // Visualizar
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');       // Carregar o formulário
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store');         // Receber os dados do formulário
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');      // Carregar form editar
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');  // receber os dados do for editar
    Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');  // Carregar form editar senha
    Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password'); // Receber os dados do form editar senha
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');    // Apagar usuário

    // Cursos
    Route::GET('/index-course', [CourseController::class, 'index'])->name('course.index');
    Route::GET('/show-course/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::GET('/create-course', [CourseController::class, 'create'])->name('course.create');
    Route::POST('/store-course', [CourseController::class, 'store'])->name('course.store');
    Route::GET('/edit-course/{course}', [CourseController::class, 'edit'])->name('course.edit');
    Route::PUT('/update-course/{course}', [CourseController::class, 'update'])->name('course.update');
    Route::DELETE('/destroy-course/{course}', [CourseController::class, 'destroy'])->name('course.destroy');

    // Aulas
    Route::GET('/index-classe/{course}', [ClasseController::class, 'index'])->name('classe.index');
    Route::GET('/show-classe/{classe}', [ClasseController::class, 'show'])->name('classe.show');
    Route::GET('/create-classe/{course}', [ClasseController::class, 'create'])->name('classe.create');
    Route::POST('/store-classe', [ClasseController::class, 'store'])->name('classe.store');
    Route::GET('/edit-classe/{classe}', [ClasseController::class, 'edit'])->name('classe.edit');
    Route::PUT('/update-classe/{classe}', [ClasseController::class, 'update'])->name('classe.update');
    Route::DELETE('/destroy-classe/{classe}', [ClasseController::class, 'destroy'])->name('classe.destroy');
});
