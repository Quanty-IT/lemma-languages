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
        <a href="{{ route('administrator.teachers.index') }}">Listar</a>
        <hr>

        <form method="POST" action="{{ route('administrator.teachers.update', $teacher->id) }}">
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
            <input type="text" name="name" value="{{ $teacher->name }}" required><br><br>

            <label>Telefone</label>
            <input type="text" id="phone" name="phone" value="{{ $teacher->phone }}" maxlength="15"
                required><br><br>

            <label>Email</label>
            <input type="email" name="email" value="{{ $teacher->email }}"><br><br>

            <label>Idiomas</label><br>
            @php
                $selectedLanguages = is_array($teacher->languages)
                    ? $teacher->languages
                    : explode(',', $teacher->languages);
            @endphp
            <input type="checkbox" name="languages[]" value="ingles"
                {{ in_array('ingles', $selectedLanguages) ? 'checked' : '' }}> Inglês
            <input type="checkbox" name="languages[]" value="espanhol"
                {{ in_array('espanhol', $selectedLanguages) ? 'checked' : '' }}> Espanhol
            <input type="checkbox" name="languages[]" value="frances"
                {{ in_array('frances', $selectedLanguages) ? 'checked' : '' }}> Francês<br>
            <input type="checkbox" name="languages[]" value="italiano"
                {{ in_array('italiano', $selectedLanguages) ? 'checked' : '' }}> Italiano

            <label>Disponibilidade</label><br>
            @php
                $selectedAvailability = is_array($teacher->availability)
                    ? $teacher->availability
                    : explode(',', $teacher->availability);
            @endphp
            <input type="checkbox" name="availability[]" value="manha"
                {{ in_array('manha', $selectedAvailability) ? 'checked' : '' }}> Manhã
            <input type="checkbox" name="availability[]" value="tarde"
                {{ in_array('tarde', $selectedAvailability) ? 'checked' : '' }}> Tarde
            <input type="checkbox" name="availability[]" value="noite"
                {{ in_array('noite', $selectedAvailability) ? 'checked' : '' }}> Noite<br><br>

            <label>Valor da hora (R$)</label>
            <input type="number" name="hourly_rate" value="{{ $teacher->hourly_rate }}" min="0" max="99"
                required><br><br>

            <label>Repasse</label>
            <select name="commission" required>
                <option value="">Selecione</option>
                <option value="30" {{ $teacher->commission == 30 ? 'selected' : '' }}>30%</option>
                <option value="25" {{ $teacher->commission == 25 ? 'selected' : '' }}>25%</option>
                <option value="20" {{ $teacher->commission == 20 ? 'selected' : '' }}>20%</option>
            </select><br><br>

            <label>Chave Pix</label>
            <input type="text" name="pix" value="{{ $teacher->pix }}"><br><br>

            <label>Observações</label><br>
            <textarea name="notes" rows="4" cols="30">{{ $teacher->notes }}</textarea><br><br>

            <button type="submit">Salvar alterações</button>
        </form>

        <script>
            $(document).ready(function() {
                // Máscara para telefone
                $('#phone').mask('(00) 00000-0000');

                // Formatar telefone vindo do banco (apenas números)
                var rawPhone = '{{ $teacher->phone }}';
                if (rawPhone.length === 11) {
                    var formattedPhone = '(' + rawPhone.substring(0, 2) + ') ' + rawPhone.substring(2, 7) + '-' +
                        rawPhone.substring(7);
                    $('#phone').val(formattedPhone);
                }

                // Validação para garantir que o campo sempre seja um número positivo
                $('input[name="hourly_rate"]').on('input', function() {
                    let value = $(this).val();

                    // Remover qualquer caractere que não seja número
                    value = value.replace(/[^0-9]/g, '');

                    // Limita a até 2 caracteres (dois dígitos)
                    if (value.length > 2) value = value.slice(0, 2);

                    // Remover zeros à esquerda
                    value = parseInt(value, 10);

                    // Garantir que o valor seja positivo e corrigir se necessário
                    if (isNaN(value) || value < 0) value = 0;

                    // Atualizar o valor do campo para garantir que é um número positivo e sem zeros à esquerda
                    $(this).val(value);
                });
            });
        </script>
    </body>

@endsection
