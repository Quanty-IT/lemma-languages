<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Student;

class AdministratorController extends Controller
{
    public function home()
    {
        $countTeachers = Teacher::count();
        $countStudents = Student::count();

        return view('administrator.home', compact('countTeachers', 'countStudents'));
    }


    public function login()
    {
        return view('login');
    }


    public function teachers()
    {
        return view('administrator.teachers.index');
    }

    public function students()
    {
        return view('administrator.students');
    }
}
