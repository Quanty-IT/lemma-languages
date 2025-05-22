@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="/css/administrator/students/create.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <body>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-3">
                <a href="{{ route('administrator.home') }}" class="text-decoration-none text-muted">Home</a>
                <a href="{{ route('administrator.students.index') }}" class="text-decoration-none text-muted">Listar</a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('administrator.students.store') }}">
                @csrf

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
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3 d-flex gap-3">
                    <div class="flex-fill">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone" maxlength="15"
                            value="{{ old('phone') }}" required>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Idiomas</label><br>
                    @foreach (['ingles', 'espanhol', 'frances', 'italiano'] as $lang)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input filter-language" id="lang-{{ $lang }}"
                                name="languages[]" value="{{ $lang }}"
                                {{ in_array($lang, old('languages', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="lang-{{ $lang }}">{{ ucfirst($lang) }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label class="form-label">Disponibilidade</label><br>
                    @foreach (['manha', 'tarde', 'noite'] as $period)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input filter-availability"
                                id="disp-{{ $period }}" name="availability[]" value="{{ $period }}"
                                {{ in_array($period, old('availability', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="disp-{{ $period }}">{{ ucfirst($period) }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label class="form-label">Professor</label>
                    <select name="teacher_id" id="teacher-select" class="form-select" data-loaded="true" required>
                        <option value="">Selecione</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Objetivo</label>
                    <textarea class="form-control" name="goal" rows="2">{{ old('goal') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea class="form-control" name="notes" rows="2">{{ old('notes') }}</textarea>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function() {
                $('#phone').mask('(00) 00000-0000');

                function updateTeacherOptions() {
                    let selectedLanguages = $('.filter-language:checked').map(function() {
                        return this.value;
                    }).get();

                    let selectedAvailability = $('.filter-availability:checked').map(function() {
                        return this.value;
                    }).get();

                    let teacherSelect = $('#teacher-select');

                    // Só faz requisição se houver filtros selecionados
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
                                    teacherSelect.append(
                                        `<option value="${teacher.id}">${teacher.name}</option>`
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
                        // Não sobrescreve os professores do Blade se nenhum filtro for selecionado
                        teacherSelect.prop('disabled', false);
                    }
                }

                // Executa update apenas se filtros forem usados
                $('.filter-language, .filter-availability').on('change', updateTeacherOptions);
            });
        </script>

    </body>
@endsection
