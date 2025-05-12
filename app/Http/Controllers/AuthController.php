<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Administrator;
use App\Models\Teacher;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loginAttempt(LoginRequest $request)
{
    // Validação dos campos
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    $email = $request->email;
    $password = $request->password;

    // 1. Verifica se é ADMIN
    $admin = Administrator::where('email', $email)->first();
    if ($admin) {
        if (Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('administrator.home');
        } else {
            return back()->withErrors(['password' => 'Senha inválida']);
        }
    }

    // 2. Verifica se é PROFESSOR
$prof = Teacher::where('email', $email)->first();
if ($prof) {
    $senhaBanco = null;

    if (!empty($prof->password) && empty($prof->custom_password)) {
        // Usa o campo 'password'
        $senhaBanco = $prof->password;
    } elseif (!empty($prof->password) && !empty($prof->custom_password)) {
        // Usa o campo 'custom_password'
        $senhaBanco = $prof->custom_password;
    }

    if ($senhaBanco && Hash::check($password, $senhaBanco)) {
        // Verifica se o professor tem uma senha personalizada
        if (is_null($prof->custom_password)) {
            session(['email' => $email]);
            return redirect()->route('set.password');
        }

        Auth::guard('teacher')->login($prof);
        return redirect()->route('teacher.home');
    } else {
        return back()->withErrors(['password' => 'Senha inválida']);
    }
}


    // Caso não seja encontrado
    return back()->withErrors(['email' => 'Email não encontrado']);
}


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Deslogado com sucesso');
    }
}
