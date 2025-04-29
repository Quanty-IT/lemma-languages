<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:admin'])->group(function(){
    Route::get('/', [AdministratorController::class, 'home'])->name('administrator.home');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login',[AuthController::class,'loginAttempt'])->name('auth');

Route::middleware(['auth:admin'])->group(function(){
    Route::get('/teachers', [TeacherController::class, 'index'])->name('administrator.teachers.index');

    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('administrator.teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('administrator.teachers.store');

    Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('administrator.teachers.show');

    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('administrator.teachers.edit');
    Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('administrator.teachers.update');

    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('administrator.teachers.destroy');
});

Route::middleware(['auth:admin'])->group(function(){
<<<<<<< HEAD
Route::get('/students', [AdministratorController::class, 'students'])->name('administrator.students');
});
=======
    Route::get('/students', [AdministratorController::class, 'students'])->name('administrator.students');
});
>>>>>>> 191a33b6d95dc18e055e7e5b82b63b2fab8d85e2
