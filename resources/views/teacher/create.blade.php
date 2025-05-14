@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('lesson.store') }}">
        @csrf

        <a href="{{ route('teacher.home') }}" class="btn btn-primary">Home</a>
        <br>

        <label>Aluno</label>
        <select name="student_id" id="student_id" required>
            @foreach ($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>

        <label>Idioma</label>
        <select name="language" id="language" required>
            <option value="">Selecione o idioma</option>
            @foreach ($availableLanguages as $language)
                <option value="{{ $language }}">{{ $language }}</option>
            @endforeach
        </select>

        <label>Mês</label>
        <select name="month" required>
            <option value="Janeiro">Janeiro</option>
            <option value="Fevereiro">Fevereiro</option>
            <option value="Março">Março</option>
            <option value="Abril">Abril</option>
            <option value="Maio">Maio</option>
            <option value="Junho">Junho</option>
            <option value="Julho">Julho</option>
            <option value="Agosto">Agosto</option>
            <option value="Setembro">Setembro</option>
            <option value="Outubro">Outubro</option>
            <option value="Novembro">Novembro</option>
            <option value="Dezembro">Dezembro</option>
        </select>

        <label>Horas</label>
        <input type="number" name="hours" id="hours" min="0" required>

        <label>Conteúdo</label>
        <textarea name="content" required></textarea>

        <button type="submit">Registrar</button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Validação para garantir que o campo sempre seja um número positivo
            document.getElementById('hours').addEventListener('input', function() {
                let value = this.value;

                // Remover qualquer caractere que não seja número
                value = value.replace(/[^0-9]/g, '');

                // Remover zeros à esquerda
                value = parseInt(value, 10); // Converte para número inteiro e remove zeros à esquerda

                // Garantir que o valor seja positivo e corrigir se necessário
                if (isNaN(value) || value < 0) value = 0;

                // Atualizar o valor do campo para garantir que é um número positivo e sem zeros à esquerda
                this.value = value;
            });
        });
    </script>
@endsection
