<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Cursos
Route::GET('/index-course', [CourseController::class, 'index'])->name('courses.index');
Route::GET('/show-course/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::GET('/create-course', [CourseController::class, 'create'])->name('courses.create');
Route::POST('/store-course', [CourseController::class, 'store'])->name('courses.store');
Route::GET('/edit-course/{course}', [CourseController::class, 'edit'])->name('courses.edit');
Route::PUT('/update-course/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::DELETE('/destroy-course/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');