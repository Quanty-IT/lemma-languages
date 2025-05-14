@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">

    <!-- jQuery e jQuery Mask -->
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
            <input type="text" name="name" value="{{ old('name', $student->name) }}" required><br><br>

            <label>Telefone</label>
            <input type="text" id="phone" name="phone" maxlength="15" value="{{ old('phone', $student->phone) }}"
                required><br><br>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $student->email) }}"><br><br>

            <label>Idiomas</label><br>
            @php
                $selectedLanguages = old(
                    'languages',
                    is_array($student->languages) ? $student->languages : explode(',', $student->languages),
                );
            @endphp
            <input type="checkbox" name="languages[]" value="ingles" class="filter-language"
                {{ in_array('ingles', $selectedLanguages) ? 'checked' : '' }}> Inglês
            <input type="checkbox" name="languages[]" value="espanhol" class="filter-language"
                {{ in_array('espanhol', $selectedLanguages) ? 'checked' : '' }}> Espanhol
            <input type="checkbox" name="languages[]" value="frances" class="filter-language"
                {{ in_array('frances', $selectedLanguages) ? 'checked' : '' }}> Francês<br>
            <input type="checkbox" name="languages[]" value="italiano" class="filter-language"
                {{ in_array('italiano', $selectedLanguages) ? 'checked' : '' }}> Italiano
            <br><br>

            <label>Disponibilidade</label><br>
            @php
                $selectedAvailability = old(
                    'availability',
                    is_array($student->availability) ? $student->availability : explode(',', $student->availability),
                );
            @endphp
            <input type="checkbox" name="availability[]" value="manha" class="filter-availability"
                {{ in_array('manha', $selectedAvailability) ? 'checked' : '' }}> Manhã
            <input type="checkbox" name="availability[]" value="tarde" class="filter-availability"
                {{ in_array('tarde', $selectedAvailability) ? 'checked' : '' }}> Tarde
            <input type="checkbox" name="availability[]" value="noite" class="filter-availability"
                {{ in_array('noite', $selectedAvailability) ? 'checked' : '' }}> Noite
            <br><br>

            <label>Professor</label><br>
            <select name="teacher_id" id="teacher-select"
                {{ empty($selectedLanguages) || empty($selectedAvailability) ? 'disabled' : '' }}>
                <option value="">Selecione</option>
                {{-- Será populado via JS --}}
            </select><br><br>

            <label>Objetivo</label><br>
            <textarea name="goal" rows="4" cols="30">{{ old('goal', $student->goal) }}</textarea><br><br>

            <label>Observações</label><br>
            <textarea name="notes" rows="4" cols="30">{{ old('notes', $student->notes) }}</textarea><br><br>

            <button type="submit">Salvar alterações</button>
        </form>

        <script>
            $(document).ready(function() {
                // Máscara para telefone
                $('#phone').mask('(00) 00000-0000');

                function updateTeacherOptions() {
                    let selectedLanguages = $('.filter-language:checked').map(function() {
                        return this.value;
                    }).get();

                    let selectedAvailability = $('.filter-availability:checked').map(function() {
                        return this.value;
                    }).get();

                    let teacherSelect = $('#teacher-select');

                    if (selectedLanguages.length > 0 && selectedAvailability.length > 0) {
                        $.ajax({
                            url: "{{ route('teachers.filter') }}",
                            method: "GET",
                            data: {
                                languages: selectedLanguages,
                                availability: selectedAvailability
                            },
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(teachers) {
                                teacherSelect.empty();
                                teacherSelect.append('<option value="">Selecione</option>');
                                teachers.forEach(function(teacher) {
                                    const selected = teacher.id ==
                                        "{{ old('teacher_id', $student->teacher_id) }}" ?
                                        'selected' : '';
                                    teacherSelect.append(
                                        `<option value="${teacher.id}" ${selected}>${teacher.name}</option>`
                                        );
                                });
                                teacherSelect.prop('disabled', false);
                            }
                        });
                    } else {
                        teacherSelect.empty();
                        teacherSelect.append('<option value="">Selecione</option>');
                        teacherSelect.prop('disabled', true);
                    }
                }

                // Inicializar dropdown professor com base nos valores já selecionados
                updateTeacherOptions();

                // Atualizar dropdown professor quando idiomas ou disponibilidade mudarem
                $('.filter-language, .filter-availability').on('change', updateTeacherOptions);
            });
        </script>
    </body>
@endsection
