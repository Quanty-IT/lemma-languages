@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('lesson.update', $lesson->id) }}">
        @csrf
        @method('PUT')

        <a href="{{ route('teacher.home') }}" class="btn btn-primary">Home</a>
        <br>

        <label>Aluno</label>
        <input type="text" value="{{ $student->name }}" disabled class="form-control" />

        <label>Idioma</label>
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
            <select name="language" id="language" disabled>
                <option value="{{ $studentLanguage }}" selected>
                    {{ $languageNames[$studentLanguage] ?? $studentLanguage }}
                </option>
            </select>
            <input type="hidden" name="language" value="{{ $studentLanguage }}">
        @else
            <p><em>Idioma do aluno não está disponível entre os idiomas do professor.</em></p>
        @endif

        <label>Mês</label>
        <select name="month" required>
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
            @foreach ($months as $key => $label)
                <option value="{{ $key }}" {{ old('month', $lesson->month) == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>

        <label>Horas</label>
        <input type="number" name="hours" id="hours" min="1" max="99"
            value="{{ old('hours', $lesson->hours) }}" required>

        <label>Conteúdo</label>
        <textarea name="content" required>{{ old('content', $lesson->content) }}</textarea>

        <button type="submit">Atualizar</button>
    </form>

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
