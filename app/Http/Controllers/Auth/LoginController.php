<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Administrator;
use App\Models\Teacher;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginAttempt(LoginRequest $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Verifica se é administrador
        $administrator = Administrator::where('email', $email)->first();
        if ($administrator) {
            if (Hash::check($password, $administrator->password)) {
                Auth::guard('administrator')->login($administrator);
                return redirect()->route('administrator.home');
            } else {
                return back()->withErrors(['password' => 'Senha inválida']);
            }
        }

        // Verifica se é professor
        $prof = Teacher::where('email', $email)->first();
        if ($prof) {
            // Verifica a senha do professor
            if (Hash::check($password, $prof->password)) {
                // Se for o primeiro acesso, redireciona para a tela de redefinir senha
                if ($prof->is_first_access) {
                    session(['email' => $email]);
                    return redirect()->route('set.password');
                }

                Auth::guard('teacher')->login($prof);
                return redirect()->route('teacher.home');
            } else {
                return back()->withErrors(['password' => 'Senha inválida']);
            }
        }

        return back()->withErrors(['email' => 'Email não encontrado']);
    }

    public function logout(Request $request)
    {
        Auth::guard('administrator')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Deslogado com sucesso');
    }
}
