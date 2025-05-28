@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="/css/administrator/students/form.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <body>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-3">
                <a href="{{ route('administrator.home') }}" class="text-decoration-none text-muted">Home</a>
                <a href="{{ route('administrator.students.index') }}" class="text-decoration-none text-muted">Listar</a>
                <a href="{{ route('administrator.students.show', $student->id) }}"
                    class="text-decoration-none text-muted">Visualizar</a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('administrator.students.update', $student->id) }}">
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
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $student->name) }}"
                        required>
                </div>

                <div class="mb-3 d-flex gap-3">
                    <div class="flex-fill">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone" maxlength="15"
                            value="{{ old('phone', $student->phone) }}" required>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"
                            value="{{ old('email', $student->email) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Idioma</label>
                    @php
                        $languageOptions = [
                            'english' => 'Inglês',
                            'spanish' => 'Espanhol',
                            'french' => 'Francês',
                            'italian' => 'Italiano',
                            'portuguese' => 'Português',
                        ];
                    @endphp

                    <div class="d-flex flex-wrap">
                        @foreach ($languageOptions as $lang => $label)
                            <div class="form-check d-flex align-items-center" style="margin-right: 20px; margin-top: 5px;">
                                <input type="radio" class="form-check-input filter-language" id="lang-{{ $lang }}"
                                    name="language" value="{{ $lang }}"
                                    {{ old('language', $student->language) === $lang ? 'checked' : '' }}>
                                <label class="form-check-label" for="lang-{{ $lang }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Disponibilidade</label>
                    @php
                        $availabilityOptions = [
                            'morning' => 'Manhã',
                            'afternoon' => 'Tarde',
                            'evening' => 'Noite',
                        ];
                        $selectedAvailability = old(
                            'availability',
                            is_array($student->availability)
                                ? $student->availability
                                : (is_string($student->availability)
                                    ? explode(',', $student->availability)
                                    : []),
                        );
                    @endphp

                    <div class="d-flex flex-wrap">
                        @foreach ($availabilityOptions as $period => $label)
                            <div class="form-check d-flex align-items-center" style="margin-right: 20px; margin-top: 5px;">
                                <input type="checkbox" class="form-check-input filter-availability"
                                    id="disp-{{ $period }}" name="availability[]" value="{{ $period }}"
                                    {{ in_array($period, $selectedAvailability) ? 'checked' : '' }}>
                                <label class="form-check-label" for="disp-{{ $period }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Professor</label>
                    <select name="teacher_id" id="teacher-select" class="form-select" required>
                        @if ($teachers->isEmpty())
                            <option value="">Nenhum professor no horário selecionado</option>
                        @else
                            <option value="">Selecione</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id', $student->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('teacher_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Objetivo</label>
                    <textarea class="form-control" name="goal" rows="2" required>{{ old('goal', $student->goal) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea class="form-control" name="notes" rows="3">{{ old('notes', $student->notes) }}</textarea>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="{{ route('administrator.students.show', $student->id) }}"
                        class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>

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
                                teacherSelect.empty().append('<option value="">Selecione</option>');

                                teachers.forEach(function(teacher) {
                                    // Mantém selecionado o professor atual se existir na lista
                                    let selected = '';
                                    if (teacher.id ==
                                        "{{ old('teacher_id', $student->teacher_id) }}") {
                                        selected = 'selected';
                                    }
                                    teacherSelect.append(
                                        `<option value="${teacher.id}" ${selected}>${teacher.name}</option>`
                                    );
                                });

                                teacherSelect.prop('disabled', false);
                            },
                            error: function() {
                                alert('Erro ao carregar professores. Tente novamente.');
                                teacherSelect.prop('disabled', false);
                            }
                        });
                    } else {
                        // Se não tiver filtros, mantém a lista atual sem alterar
                        teacherSelect.prop('disabled', false);
                    }
                }

                // Atualiza os professores se o usuário alterar filtros
                $('.filter-language, .filter-availability').on('change', updateTeacherOptions);
            });
        </script>
    </body>
@endsection
