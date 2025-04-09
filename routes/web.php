<?php

use App\Http\Controllers\AdministratorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdministratorController::class, 'home'])->name('administrator.home');
Route::get('/teachers', [AdministratorController::class, 'teachers'])->name('administrator.teachers');
Route::get('/students', [AdministratorController::class, 'students'])->name('administrator.students');
