<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator\StudentController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ActivityRecordController;

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/', [AdministratorController::class, 'home'])->name('administrator.home');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('auth');
Route::get('/set-password', [PasswordController::class, 'showform'])->name('set.password');
Route::post('/set-password', [PasswordController::class, 'storePassword'])->name('set.password.store');


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/teachers', [TeacherController::class, 'index'])->name('administrator.teachers.index');

    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('administrator.teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('administrator.teachers.store');

    Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('administrator.teachers.show');

    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('administrator.teachers.edit');
    Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('administrator.teachers.update');

    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('administrator.teachers.destroy');
});

Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'home'])->name('teacher.home');
    Route::get('/teacher/create', [ActivityRecordController::class, 'create'])->name('teacher.create');
    Route::post('/teacher', [ActivityRecordController::class, 'store'])->name('activity.store');
    Route::get('/teacher/{record}/edit', [ActivityRecordController::class, 'edit'])->name('activity.edit');
    Route::put('/teacher/{record}', [ActivityRecordController::class, 'update'])->name('activity.update');
    Route::delete('/teacher/{record}', [ActivityRecordController::class, 'destroy'])->name('activity.destroy');
    Route::get('/students/{student}', [ActivityRecordController::class, 'show'])->name('students.show');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/students', [AdministratorController::class, 'students'])->name('administrator.students');
    Route::get('/', [AdministratorController::class, 'index'])->name('administrator.home');
    Route::post('/administrator/students', [StudentController::class, 'store'])->name('administrator.students.store');
    Route::prefix('administrator')->name('administrator.')->group(function () {
        Route::resource('students', StudentController::class);
    });
});
