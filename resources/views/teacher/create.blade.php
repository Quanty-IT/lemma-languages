@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/lesson/form.css">
    <link rel="stylesheet" href="/css/administrator/teachers/form.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('teacher.home') }}" class="text-decoration-none text-muted">Home</a>
        <form action="{{ route('logout') }}" method="POST" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
    </div>

    <div class="form-container">
        <form method="POST" action="{{ route('lesson.store') }}">
            @csrf

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label">Aluno</label>
                <div class="form-control bg-light">{{ $student->name }}</div>
                <input type="hidden" name="student_id" value="{{ $student->id }}">
            </div>

            @php
                $languageNames = [
                    'english' => 'Inglês',
                    'spanish' => 'Espanhol',
                    'french' => 'Francês',
                    'german' => 'Alemão',
                    'italian' => 'Italiano',
                    'portuguese' => 'Português',
                ];
                $studentLanguage = $student->language;
            @endphp

            <div class="mb-3">
                <label class="form-label">Idioma</label>
                <div class="form-control bg-light">
                    {{ $languageNames[$studentLanguage] ?? ucfirst($studentLanguage) }}
                </div>
                <input type="hidden" name="language" value="{{ $studentLanguage }}">
            </div>

            <div class="mb-3">
                <label class="form-label" for="month">Mês</label>
                <select class="form-select" name="month" id="month" required>
                    <option value="january">janeiro</option>
                    <option value="february">fevereiro</option>
                    <option value="march">março</option>
                    <option value="april">abril</option>
                    <option value="may">maio</option>
                    <option value="june">junho</option>
                    <option value="july">julho</option>
                    <option value="august">agosto</option>
                    <option value="september">setembro</option>
                    <option value="october">outubro</option>
                    <option value="november">novembro</option>
                    <option value="december">dezembro</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="hours">Horas</label>
                <input type="number" class="form-control" name="hours" id="hours" min="1" max="99"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="content">Conteúdo</label>
                <textarea class="form-control" name="content" id="content" rows="3" required></textarea>
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success">Registrar</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('hours').addEventListener('input', function() {
                let value = this.value.replace(/[^0-9]/g, '');
                if (value.length > 2) value = value.slice(0, 2);
                value = parseInt(value, 10);
                if (isNaN(value) || value < 1) value = 1;
                this.value = value;
            });
        });
    </script>
@endsection
