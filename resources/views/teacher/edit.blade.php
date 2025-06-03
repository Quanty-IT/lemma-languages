@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/administrator/students/form.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-3">
            <a href="{{ route('teacher.home') }}" class="text-decoration-none text-muted">Home</a>
            <a href="{{ route('lesson.create') }}" class="text-decoration-none text-muted">Novo Registro</a>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
    </div>

    <div class="form-container">
        <form method="POST" action="{{ route('lesson.update', $lesson->id) }}">
            @csrf
            @method('PUT')

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
                <input type="text" value="{{ $student->name }}" disabled class="form-control" />
            </div>

            <div class="mb-3">
                <label class="form-label">Idioma</label>
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

                @if (in_array($studentLanguage, $teacherLanguages))
                    <input type="text" class="form-control"
                        value="{{ $languageNames[$studentLanguage] ?? $studentLanguage }}" disabled>
                    <input type="hidden" name="language" value="{{ $studentLanguage }}">
                @else
                    <p><em>Idioma do aluno não está disponível entre os idiomas do professor.</em></p>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Mês</label>
                @php
                    $months = [
                        'january' => 'janeiro',
                        'february' => 'fevereiro',
                        'march' => 'março',
                        'april' => 'abril',
                        'may' => 'maio',
                        'june' => 'junho',
                        'july' => 'julho',
                        'august' => 'agosto',
                        'september' => 'setembro',
                        'october' => 'outubro',
                        'november' => 'novembro',
                        'december' => 'dezembro',
                    ];
                @endphp
                <select name="month" class="form-select" required>
                    @foreach ($months as $key => $label)
                        <option value="{{ $key }}" {{ old('month', $lesson->month) == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Horas</label>
                <input type="number" name="hours" id="hours" class="form-control" min="1" max="99"
                    value="{{ old('hours', $lesson->hours) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Conteúdo</label>
                <textarea name="content" class="form-control" rows="3" required>{{ old('content', $lesson->content) }}</textarea>
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ route('teacher.home') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('hours').addEventListener('input', function() {
                let value = this.value;
                value = value.replace(/[^0-9]/g, '');
                if (value.length > 2) value = value.slice(0, 2);
                value = parseInt(value, 10);
                if (isNaN(value) || value < 1) value = 1;
                this.value = value;
            });
        });
    </script>
@endsection
