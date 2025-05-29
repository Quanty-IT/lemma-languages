@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/auth/login.css">

    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Lemma">
        </div>

        <div class="container">
            <h2 style="text-align: center;">Login</h2>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Digite seu E-mail"
                        value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="password" placeholder="Digite sua senha">
                </div>

                <button type="submit">Entrar</button>

                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
                </div>

                @if (session('status'))
                    <p class="error-message">{{ session('status') }}</p>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="error-message">{{ $error }}</p>
                    @endforeach
                @endif
            </form>
        </div>
    </div>
@endsection
