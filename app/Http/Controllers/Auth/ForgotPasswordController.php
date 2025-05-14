<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $admin = Administrator::where('email', $request->email)->first();
        $teacher = null;
        $userType = null;

        if ($admin) {
            $user = $admin;
            $userType = 'admin';
        } else {
            $teacher = Teacher::where('email', $request->email)->first();
            if ($teacher) {
                $user = $teacher;
                $userType = 'teacher';
            } else {
                return back()->withErrors(['email' => 'Email não encontrado']);
            }
        }

        // Gerar código alfanumérico
        $code = strtoupper(Str::random(6));
        $user->reset_code = $code;
        $user->reset_code_expires_at = now()->addMinutes(30);
        $user->save();

        // Envio de email via Resend
        Http::withToken(env('RESEND_API_KEY'))->post('https://api.resend.com/emails', [
            'from' => env('MAIL_FROM_ADDRESS'),
            'to' => $admin->email,
            'subject' => 'Código de Recuperação de Senha',
            'text' => "Seu código de verificação é: $code. Ele expira em 30 minutos.",
        ]);

        // Armazena o email e o tipo do usuário na sessão
        session([
            'reset_email' => $user->email,
            'reset_user_type' => $userType,
        ]);

        return redirect()->route('password.code')->with('status', 'Código enviado para seu email.');
    }

    public function showCodeForm()
    {
        if (!session()->has('reset_email') || !session()->has('reset_user_type')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-code');
    }

    public function verifyCode(Request $request)
    {
        if (!session()->has('reset_email') || !session()->has('reset_user_type')) {
            return redirect()->route('password.request');
        }

        $request->validate(['code' => 'required']);

        $email = session('reset_email');
        $userType = session('reset_user_type');

        $user = null;

        if ($userType === 'admin') {
            $user = Administrator::where('email', $email)->first();
        } elseif ($userType === 'teacher') {
            $user = Teacher::where('email', $email)->first();
        }

        if (
            !$user ||
            (string) $user->reset_code !== (string) $request->code ||
            now()->greaterThan($user->reset_code_expires_at)
        ) {
            return back()->withErrors(['code' => 'Código inválido ou expirado.']);
        }

        return redirect()->route('password.reset');
    }

    public function showResetForm()
    {
        if (!session()->has('reset_email') || !session()->has('reset_user_type')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        if (!session()->has('reset_email') || !session()->has('reset_user_type')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/', // Deve ter pelo menos uma letra minúscula
                'regex:/[A-Z]/', // Deve ter pelo menos uma letra maiúscula
                'regex:/[0-9]/', // Deve ter pelo menos um número
                'regex:/[@$!%*?&]/', // Deve ter pelo menos um caractere especial
            ],
        ]);

        $email = session('reset_email');
        $userType = session('reset_user_type');

        if ($userType === 'admin') {
            $user = Administrator::where('email', $email)->first();
        } elseif ($userType === 'teacher') {
            $user = Teacher::where('email', $email)->first();
        } else {
            return redirect()->route('password.request');
        }

        if (!$user) {
            return redirect()->route('password.request');
        }

        $user->password = Hash::make($request->password);
        $user->reset_code = null;
        $user->reset_code_expires_at = null;
        $user->save();

        session()->forget(['reset_email', 'reset_user_type']);

        return redirect()->route('login')->with('status', 'Senha redefinida com sucesso.');
    }
}
