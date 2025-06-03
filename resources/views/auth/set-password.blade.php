@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/auth/login.css">

    <div class="login-container">
        <div class="container">
            <h2 style="text-align: center;">Definir Senha</h2>

            <form method="POST" action="{{ route('set.password.store') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label for="password">Nova Senha:</label>
                    <input type="password" id="password" name="password" placeholder="Digite a nova senha" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nova Senha:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirme a senha" required>
                </div>

                <button type="submit">Confirmar</button>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="error-message">{{ $error }}</p>
                    @endforeach
                @endif
            </form>
        </div>
    </div>
@endsection
