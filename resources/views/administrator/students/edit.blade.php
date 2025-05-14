@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">

    <!-- jQuery e jQuery Mask - Biblioteca para aplicar máscaras -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <body>
        <h2>Editar cadastro</h2>
        <hr>

        <a href="{{ route('administrator.home') }}">Home</a><br>
        <a href="{{ route('administrator.students.index') }}">Listar</a>
        <hr>

        <form method="POST" action="{{ route('administrator.students.update', $student->id) }}">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <label>Nome</label>
            <input type="text" name="name" value="{{ $student->name }}" required><br><br>

            <label>Telefone</label>
            <input type="text" id="phone" name="phone" maxlength="15" value="{{ $student->phone }}"
                required><br><br>

            <label>Email</label>
            <input type="email" name="email" value="{{ $student->email }}"><br><br>

            <label>Idiomas</label><br>
            @php
                $selectedLanguages = is_array($student->languages)
                    ? $student->languages
                    : explode(',', $student->languages);
            @endphp
            <input type="checkbox" name="languages[]" value="ingles"
                {{ in_array('ingles', $selectedLanguages) ? 'checked' : '' }}> Inglês
            <input type="checkbox" name="languages[]" value="espanhol"
                {{ in_array('espanhol', $selectedLanguages) ? 'checked' : '' }}> Espanhol
            <input type="checkbox" name="languages[]" value="frances"
                {{ in_array('frances', $selectedLanguages) ? 'checked' : '' }}> Francês<br>
            <input type="checkbox" name="languages[]" value="italiano"
                {{ in_array('italiano', $selectedLanguages) ? 'checked' : '' }}> Italiano

            <label>Professor</label><br>
            <select name="teacher_id">
                <option value="">Selecione</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $student->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select><br><br>

            <label>Disponibilidade</label><br>
            @php
                $selectedAvailability = is_array($student->availability)
                    ? $student->availability
                    : explode(',', $student->availability);
            @endphp
            <input type="checkbox" name="availability[]" value="manha"
                {{ in_array('manha', $selectedAvailability) ? 'checked' : '' }}> Manhã
            <input type="checkbox" name="availability[]" value="tarde"
                {{ in_array('tarde', $selectedAvailability) ? 'checked' : '' }}> Tarde
            <input type="checkbox" name="availability[]" value="noite"
                {{ in_array('noite', $selectedAvailability) ? 'checked' : '' }}> Noite<br><br>

            <label>Objetivo</label><br>
            <textarea name="goal" rows="4" cols="30">{{ $student->goal }}</textarea><br><br>

            <label>Observações</label><br>
            <textarea name="notes" rows="4" cols="30">{{ $student->notes }}</textarea><br><br>

            <button type="submit">Salvar alterações</button>
        </form>

        <script>
            $(document).ready(function() {
                // Máscara para telefone
                $('#phone').mask('(00) 00000-0000');

                // Formatar telefone vindo do banco (apenas números)
                var rawPhone = '{{ $student->phone }}';
                if (rawPhone.length === 11) {
                    var formattedPhone = '(' + rawPhone.substring(0, 2) + ') ' + rawPhone.substring(2, 7) + '-' +
                        rawPhone.substring(7);
                    $('#phone').val(formattedPhone);
                }
            });
        </script>
    </body>
@endsection
