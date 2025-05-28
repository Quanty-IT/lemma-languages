@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('lesson.store') }}">
        @csrf

        <a href="{{ route('teacher.home') }}" class="btn btn-primary">Home</a>
        <br>

        <label>Aluno</label>
        <select name="student_id" id="student_id" required>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" data-languages="{{ json_encode($student->languages) }}">
                    {{ $student->name }}
                </option>
            @endforeach
        </select>

        <label>Idioma</label>
        <select name="language" id="language" required>
            <option value="">Selecione o idioma</option>
        </select>

        <label>Mês</label>
        <select name="month" required>
            <option value="january">Janeiro</option>
            <option value="february">Fevereiro</option>
            <option value="march">Março</option>
            <option value="april">Abril</option>
            <option value="may">Maio</option>
            <option value="june">Junho</option>
            <option value="july">Julho</option>
            <option value="august">Agosto</option>
            <option value="september">Setembro</option>
            <option value="october">Outubro</option>
            <option value="november">Novembro</option>
            <option value="december">Dezembro</option>
        </select>

        <label>Horas</label>
        <input type="number" name="hours" id="hours" min="0" max="99" required>

        <label>Conteúdo</label>
        <textarea name="content" required></textarea>

        <button type="submit">Registrar</button>
    </form>

    <script>
        const teacherLanguages = @json($teacherLanguages);
        const studentSelect = document.getElementById('student_id');
        const languageSelect = document.getElementById('language');

        function updateLanguages() {
            const selectedOption = studentSelect.options[studentSelect.selectedIndex];
            const studentLanguages = JSON.parse(selectedOption.getAttribute('data-languages'));

            // Interseção entre os arrays (professor & aluno)
            const availableLanguages = teacherLanguages.filter(lang => studentLanguages.includes(lang));

            // Limpar select e colocar a opção padrão
            languageSelect.innerHTML = '<option value="">Selecione o idioma</option>';

            availableLanguages.forEach(lang => {
                const option = document.createElement('option');
                option.value = lang;
                option.textContent = lang;
                languageSelect.appendChild(option);
            });
        }

        studentSelect.addEventListener('change', updateLanguages);

        // Inicializa ao carregar a página
        document.addEventListener("DOMContentLoaded", function() {
            updateLanguages();

            // Validação para garantir que o campo horas seja número positivo e max 2 dígitos
            document.getElementById('hours').addEventListener('input', function() {
                let value = this.value;

                // Remove tudo que não for número
                value = value.replace(/[^0-9]/g, '');

                // Limita a 2 caracteres
                if (value.length > 2) value = value.slice(0, 2);

                value = parseInt(value, 10);
                if (isNaN(value) || value < 0) value = 0;

                this.value = value;
            });
        });
    </script>
@endsection
