<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function home()
    {
        // Carregar a VIEW
        return view('administrator.home');
    }
    
    public function login()
    {
        return view('login');
    }

    public function teachers()
    {
        // Carregar a VIEW
        return view('administrator.teachers');
    }

    public function students()
    {
        // Carregar a VIEW
        return view('administrator.students');
    }
}