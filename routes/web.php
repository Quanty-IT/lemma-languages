<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Administrators\AdministratorController;
use App\Http\Controllers\Administrators\TeacherController;
use App\Http\Controllers\Administrators\StudentController;
use App\Http\Controllers\Teachers\LessonController;

// Rota de login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth');

// Rota de logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas de recuperação de senha
Route::get('/esqueci-senha', [ForgotPasswordController::class, 'showEmailForm'])->name('password.request');
Route::post('/esqueci-senha', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');
Route::get('/codigo-verificacao', [ForgotPasswordController::class, 'showCodeForm'])->name('password.code');
Route::post('/verificar-codigo', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify');
Route::get('/nova-senha', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/nova-senha', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

// Rotas para os administradores
Route::middleware(['auth:administrator'])->group(function () {
    Route::get('/', [AdministratorController::class, 'home'])->name('administrator.home');

    // Rotas de registro de professores
    Route::get('/teachers', [TeacherController::class, 'index'])->name('administrator.teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('administrator.teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('administrator.teachers.store');
    Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('administrator.teachers.show');
    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('administrator.teachers.edit');
    Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('administrator.teachers.update');
    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('administrator.teachers.destroy');
    Route::get('/api/teachers/filter', [TeacherController::class, 'filter'])->name('teachers.filter');


Route::middleware(['auth:admin'])->group(function(){
<<<<<<< HEAD
<<<<<<< HEAD
Route::get('/students', [AdministratorController::class, 'students'])->name('administrator.students');
});
=======
    Route::get('/students', [AdministratorController::class, 'students'])->name('administrator.students');
});
>>>>>>> 191a33b6d95dc18e055e7e5b82b63b2fab8d85e2
=======
Route::get('/students', [AdministratorController::class, 'students'])->name('administrator.students');
Route::get('/', [AdministratorController::class, 'index'])->name('administrator.home');
Route::post('/administrator/students', [StudentController::class, 'store'])->name('administrator.students.store');
Route::prefix('administrator')->name('administrator.')->group(function () {
        Route::resource('students', StudentController::class);
    });
});
>>>>>>> fddd98ccb9b01109ba9a19944caaea17bf37d63b
=======
    // Rotas de registro de alunos
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

// Rotas para os professores
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
>>>>>>> 094d669295b3a95567ff78ebc5d2e95126ba4000
