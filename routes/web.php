<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdministratorController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:admin'])->group(function(){
    Route::get('/', [AdministratorController::class, 'home'])->name('administrator.home');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login',[AuthController::class,'loginAttempt'])->name('auth');

Route::middleware(['auth:admin'])->group(function(){
Route::get('/teachers', [AdministratorController::class, 'teachers'])->name('administrator.teachers');
});

Route::middleware(['auth:admin'])->group(function(){
Route::get('/students', [AdministratorController::class, 'students'])->name('administrator.students');
});
