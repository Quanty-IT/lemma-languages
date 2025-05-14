<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;

class PasswordController extends Controller
{
    public function showForm(Request $request)
    {
        $email = session('email');

        if (!$email) {
            return redirect()->route('login')->withErrors(['email' => 'Email não encontrado na sessão']);
        }

        return view('set-password', compact('email'));
    }

    public function storePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',   // Deve ter pelo menos uma letra minúscula
                'regex:/[A-Z]/',   // Deve ter pelo menos uma letra maiúscula
                'regex:/[0-9]/',   // Deve ter pelo menos um número
                'regex:/[@$!%*?&]/', // Deve ter pelo menos um caractere especial
            ],
        ]);

        $email = $request->email;
        $teacher = Teacher::where('email', $email)->first();

        if ($teacher) {
            // Salva a senha hasheada
            $teacher->password = Hash::make($request->password);
            $teacher->is_first_access = false; // Marca como não sendo mais o primeiro acesso
            $teacher->save();

            Auth::guard('teacher')->login($teacher); // Faz login automaticamente
            return redirect()->route('teacher.home');
        }

        return redirect()->route('login')->withErrors(['email' => 'Email não encontrado']);
    }
}
