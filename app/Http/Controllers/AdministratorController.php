<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher; // Importe o model de Teacher
use App\Models\Student; // Importe o model de Student
use App\Http\Controllers\Controller;

class AdministratorController extends Controller
{
    public function home()
    {
        // Carregar a VIEW
        return view('administrator.home');
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======

>>>>>>> fddd98ccb9b01109ba9a19944caaea17bf37d63b
    
    public function login()
    {
        return view('login');
    }
>>>>>>> 5e7554bdbe479a1d7c99a1c62329f5018b7a3b9f


    public function teachers()
    {
        // Carregar a VIEW
        return view('administrator.teachers.index');
    }

    public function students()
    {
        // Carregar a VIEW
        return view('administrator.students');
    }
    public function index()
    {
        $professoresCount = Teacher::count();
        $alunosCount = Student::count();

        //dd($professoresCount, $alunosCount); // Use isto para debug

        return view('administrator.home', compact('professoresCount', 'alunosCount'));
    }
}