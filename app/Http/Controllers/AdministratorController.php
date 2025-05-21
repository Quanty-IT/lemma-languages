<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher; // Importe o model de Teacher
use App\Models\Student; // Importe o model de Student
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    // Remova o método home() ou renomeie-o
    // public function home()
    // {
    //     return view('administrator.home');
    // }

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

    public function index()
    {
        $professoresCount = Teacher::count();
        $alunosCount = Student::count();

        // dd($professoresCount, $alunosCount);

        return view('administrator.home', compact('professoresCount', 'alunosCount'));
    }
}