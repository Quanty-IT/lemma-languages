@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/auth/login.css">

    <div class="login-container">
        <div class="container">
            <h2 style="text-align: center;">Verificar Código</h2>

            <form action="{{ route('password.verify') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="code">Código enviado por email:</label>
                    <input type="text" name="code" id="code" placeholder="Ex: 123456" required>
                </div>

                <button type="submit">Verificar</button>

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p style="color: red;">{{ $error }}</p>
                    @endforeach
                @endif
            </form>

            <form action="{{ route('password.email') }}" method="POST" style="margin-top: 15px;">
                @csrf
                <input type="hidden" name="email" value="{{ session('reset_email') }}">
                <button type="submit" style="background: transparent; border: none; color: blue; cursor: pointer;">
                    Reenviar código
                </button>
            </form>
        </div>
    </div>

    <script>
        const codeInput = document.getElementById('code');

        // Remove espaços enquanto o usuário digita
        codeInput.addEventListener('input', function() {
            this.value = this.value.replace(/\s+/g, '');
        });

        // Remove espaços ao colar texto
        codeInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text');
            this.value = text.replace(/\s+/g, '');
        });
    </script>
@endsection
