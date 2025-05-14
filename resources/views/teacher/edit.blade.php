@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('lesson.update', $lesson->id) }}">
        @csrf
        @method('PUT')

        <a href="{{ route('teacher.home') }}" class="btn btn-primary">Home</a>
        <br>

        <label>Aluno</label>
        <!-- Campo apenas leitura para o aluno -->
        <input type="text" value="{{ $student->name }}" disabled class="form-control" />

        <label>Idioma</label>
        <select name="language" id="language" required>
            <option value="">Selecione o idioma</option>
            @php
                // Interseção dos idiomas que o professor pode ensinar e que o aluno quer aprender
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
            <option value="Janeiro" {{ old('month', $lesson->month) == 'Janeiro' ? 'selected' : '' }}>Janeiro</option>
            <option value="Fevereiro" {{ old('month', $lesson->month) == 'Fevereiro' ? 'selected' : '' }}>Fevereiro</option>
            <option value="Março" {{ old('month', $lesson->month) == 'Março' ? 'selected' : '' }}>Março</option>
            <option value="Abril" {{ old('month', $lesson->month) == 'Abril' ? 'selected' : '' }}>Abril</option>
            <option value="Maio" {{ old('month', $lesson->month) == 'Maio' ? 'selected' : '' }}>Maio</option>
            <option value="Junho" {{ old('month', $lesson->month) == 'Junho' ? 'selected' : '' }}>Junho</option>
            <option value="Julho" {{ old('month', $lesson->month) == 'Julho' ? 'selected' : '' }}>Julho</option>
            <option value="Agosto" {{ old('month', $lesson->month) == 'Agosto' ? 'selected' : '' }}>Agosto</option>
            <option value="Setembro" {{ old('month', $lesson->month) == 'Setembro' ? 'selected' : '' }}>Setembro</option>
            <option value="Outubro" {{ old('month', $lesson->month) == 'Outubro' ? 'selected' : '' }}>Outubro</option>
            <option value="Novembro" {{ old('month', $lesson->month) == 'Novembro' ? 'selected' : '' }}>Novembro</option>
            <option value="Dezembro" {{ old('month', $lesson->month) == 'Dezembro' ? 'selected' : '' }}>Dezembro</option>
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
