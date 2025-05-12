<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher; 
use Illuminate\Support\Facades\Hash;

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
        'password' => 'required|confirmed', 
    ]);

    $email = $request->email;
    
    $teacher = Teacher::where('email', $email)->first();

    if ($teacher) {
        $teacher->custom_password = Hash::make($request->password);
        $teacher->save(); 

        Auth::guard('teacher')->login($teacher);

        return redirect()->route('teacher.home');
    }

    return redirect()->route('login')->withErrors(['email' => 'Email não encontrado']);
}
}
