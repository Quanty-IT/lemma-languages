@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Definir senha</h1>
        <form method="POST" action="{{ route('set.password.store') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <label for="password">Nova Senha</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirmar Nova Senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button class="btn" type="submit">Confirmar</button>

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
