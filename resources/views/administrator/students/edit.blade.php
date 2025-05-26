@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="/css/administrator/students/edit.css">

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
                    <label class="form-label">Idiomas</label>
                    @php
                        $selectedLanguages = old(
                            'languages',
                            is_array($student->languages)
                                ? $student->languages
                                : (is_string($student->languages)
                                    ? explode(',', $student->languages)
                                    : []),
                        );
                    @endphp
                    @foreach (['ingles', 'espanhol', 'frances', 'italiano'] as $lang)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="lang-{{ $lang }}" name="languages[]"
                                value="{{ $lang }}" {{ in_array($lang, $selectedLanguages) ? 'checked' : '' }}>
                            <label class="form-check-label" for="lang-{{ $lang }}">{{ ucfirst($lang) }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label class="form-label">Disponibilidade</label>
                    @php
                        $selectedAvailability = old(
                            'availability',
                            is_array($student->availability)
                                ? $student->availability
                                : (is_string($student->availability)
                                    ? explode(',', $student->availability)
                                    : []),
                        );
                    @endphp
                    @foreach (['manha', 'tarde', 'noite'] as $period)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="disp-{{ $period }}"
                                name="availability[]" value="{{ $period }}"
                                {{ in_array($period, $selectedAvailability) ? 'checked' : '' }}>
                            <label class="form-check-label" for="disp-{{ $period }}">{{ ucfirst($period) }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label class="form-label">Professor</label>
                    <select name="teacher_id" id="teacher-select" class="form-select" required>
                        <option value="">Selecione um professor</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ old('teacher_id', $student->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
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
                    <textarea class="form-control" name="observation" rows="3">{{ old('observation', $student->observation) }}</textarea>
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
            });
        </script>

    </body>
@endsection
