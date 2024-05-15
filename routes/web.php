<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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