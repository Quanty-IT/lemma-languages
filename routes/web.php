<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SetPasswordController;
use App\Http\Controllers\Administrators\AdministratorController;
use App\Http\Controllers\Administrators\TeacherController;
use App\Http\Controllers\Administrators\StudentController;
use App\Http\Controllers\Teachers\LessonController;

// Rota de login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'loginAttempt'])->name('auth');

// Rotas para administrator
Route::middleware(['auth:administrator'])->group(function () {
    Route::get('/', [AdministratorController::class, 'home'])->name('administrator.home');

    // Roteamento para professores
    Route::get('/teachers', [TeacherController::class, 'index'])->name('administrator.teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('administrator.teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('administrator.teachers.store');
    Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('administrator.teachers.show');
    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('administrator.teachers.edit');
    Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('administrator.teachers.update');
    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('administrator.teachers.destroy');

    // Roteamento para alunos
    Route::get('/students', [AdministratorController::class, 'students'])->name('administrator.students');
    Route::get('/students/create', [StudentController::class, 'create'])->name('administrator.students.create');
    Route::post('/administrator/students', [StudentController::class, 'store'])->name('administrator.students.store');
    Route::prefix('administrator')->name('administrator.')->group(function () {
        Route::resource('students', StudentController::class);
    });
});

// Rota para configurar senha
Route::get('/set-password', [SetPasswordController::class, 'showform'])->name('set.password');
Route::post('/set-password', [SetPasswordController::class, 'storePassword'])->name('set.password.store');

// Rotas para o professor (rota de ensino)
Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/teacher', [TeacherController::class, 'home'])->name('teacher.home');

    // Rota para criar nova aula
    Route::get('/teacher/create', [LessonController::class, 'create'])->name('lesson.create');
    Route::post('/teacher/store', [LessonController::class, 'store'])->name('lesson.store');

    // Rota para editar e atualizar aula
    Route::get('/teacher/{lesson}/edit', [LessonController::class, 'edit'])->name('lesson.edit');
    Route::put('/teacher/{lesson}', [LessonController::class, 'update'])->name('lesson.update');

    // Rota para deletar aula
    Route::delete('/teacher/{lesson}', [LessonController::class, 'destroy'])->name('lesson.destroy');

    // Rota para visualizar registros de aulas de um aluno
    Route::get('/teacher/student/{student}', [LessonController::class, 'show'])->name('teacher.show');
});
