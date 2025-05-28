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
        <select name="language" id="language" required>
            <option value="">Selecione o idioma</option>
            @php
                $availableLanguages = array_intersect($teacherLanguages, $student->languages);
            @endphp
            @foreach ($availableLanguages as $language)
                <option value="{{ $language }}" {{ old('language', $lesson->language) == $language ? 'selected' : '' }}>
                    {{ $language }}
                </option>
            @endforeach
        </select>

        <label>Mês</label>
        <select name="month" required>
            <option value="january" {{ old('month', $lesson->month) == 'january' ? 'selected' : '' }}>Janeiro</option>
            <option value="february" {{ old('month', $lesson->month) == 'february' ? 'selected' : '' }}>Fevereiro</option>
            <option value="march" {{ old('month', $lesson->month) == 'march' ? 'selected' : '' }}>Março</option>
            <option value="april" {{ old('month', $lesson->month) == 'april' ? 'selected' : '' }}>Abril</option>
            <option value="may" {{ old('month', $lesson->month) == 'may' ? 'selected' : '' }}>Maio</option>
            <option value="june" {{ old('month', $lesson->month) == 'june' ? 'selected' : '' }}>Junho</option>
            <option value="july" {{ old('month', $lesson->month) == 'july' ? 'selected' : '' }}>Julho</option>
            <option value="august" {{ old('month', $lesson->month) == 'august' ? 'selected' : '' }}>Agosto</option>
            <option value="september" {{ old('month', $lesson->month) == 'september' ? 'selected' : '' }}>Setembro</option>
            <option value="october" {{ old('month', $lesson->month) == 'october' ? 'selected' : '' }}>Outubro</option>
            <option value="november" {{ old('month', $lesson->month) == 'november' ? 'selected' : '' }}>Novembro</option>
            <option value="december" {{ old('month', $lesson->month) == 'december' ? 'selected' : '' }}>Dezembro</option>
        </select>

        <label>Horas</label>
        <input type="number" name="hours" id="hours" min="0" max="99"
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
                if (isNaN(value) || value < 0) value = 0;
                this.value = value;
            });
        });
    </script>
@endsection
