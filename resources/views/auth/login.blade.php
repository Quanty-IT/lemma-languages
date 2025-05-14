@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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

                @if (session('status'))
                    <p style="color: red;">
                        {{ session('status') }}
                    </p>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p style="color: red;">
                            {{ $error }}
                        </p>
                    @endforeach
                @endif
            </form>
        </div>
    @endsection
