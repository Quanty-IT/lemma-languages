@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <div class="login-container">
        <div class="container">
            <h2 style="text-align: center;">Nova Senha</h2>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="password">Nova senha:</label>
                    <input type="password" name="password" id="password" placeholder="Digite a nova senha" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirme a nova senha:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirme a senha" required>
                </div>

                <button type="submit">Redefinir senha</button>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                @endif
            </form>
        </div>
    </div>
@endsection
