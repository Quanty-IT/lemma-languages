<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Administrators\AdministratorController;
use App\Http\Controllers\Administrators\TeacherController;
use App\Http\Controllers\Administrators\StudentController;
use App\Http\Controllers\Teachers\LessonController;

// Rota raiz redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Recuperação de senha
Route::get('/esqueci-senha', [ForgotPasswordController::class, 'showEmailForm'])->name('password.request');
Route::post('/esqueci-senha', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');
Route::get('/codigo-verificacao', [ForgotPasswordController::class, 'showCodeForm'])->name('password.code');
Route::post('/verificar-codigo', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify');
Route::get('/nova-senha', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/nova-senha', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

// Configurar senha inicial
Route::get('/set-password', [SetPasswordController::class, 'showform'])->name('set.password');
Route::post('/set-password', [SetPasswordController::class, 'storePassword'])->name('set.password.store');

// Rotas para administradores
Route::middleware(['auth:administrator'])->group(function () {
    Route::get('/admin', [AdministratorController::class, 'home'])->name('administrator.home');

    // Professores
    Route::get('/teachers', [TeacherController::class, 'index'])->name('administrator.teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('administrator.teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('administrator.teachers.store');
    Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('administrator.teachers.show');
    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('administrator.teachers.edit');
    Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('administrator.teachers.update');
    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('administrator.teachers.destroy');
    Route::get('/api/teachers/filter', [TeacherController::class, 'filter'])->name('teachers.filter');

    // Alunos
    Route::get('/students', [StudentController::class, 'index'])->name('administrator.students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('administrator.students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('administrator.students.store');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('administrator.students.show');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('administrator.students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('administrator.students.update');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('administrator.students.destroy');
});

// Rotas para professores
Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'home'])->name('teacher.home');

    // Aulas
    Route::get('/student/{id}/create', [LessonController::class, 'create'])->name('lesson.create'); // PADRONIZADA COM {id}
    Route::post('/store', [LessonController::class, 'store'])->name('lesson.store');
    Route::get('/lesson/{id}/edit', [LessonController::class, 'edit'])->name('lesson.edit');
    Route::put('/lesson/{id}', [LessonController::class, 'update'])->name('lesson.update');
    Route::delete('/lesson/{id}', [LessonController::class, 'destroy'])->name('lesson.destroy');

    // Visualizar registros do aluno
    Route::get('/student/{id}', [LessonController::class, 'show'])->name('teacher.show');
});
