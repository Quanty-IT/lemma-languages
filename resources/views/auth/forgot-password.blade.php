@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/auth/login.css">

    <div class="login-container">
        <div class="container">
            <h2 style="text-align: center;">Recuperar Senha</h2>

            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Digite seu email cadastrado:</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>

                <button type="submit">Enviar código</button>

                @if (session('status'))
                    <p style="color: green;">{{ session('status') }}</p>
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                @endif
            </form>
        </div>
    </div>
@endsection
