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
<<<<<<< HEAD
=======
    
    public function login(){
        return view('login');
    }
>>>>>>> 5e7554bdbe479a1d7c99a1c62329f5018b7a3b9f

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