@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="/css/administrator/teachers/form.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <body>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-3">
                <a href="{{ route('administrator.home') }}" class="text-decoration-none text-muted">Home</a>
                <a href="{{ route('administrator.teachers.index') }}" class="text-decoration-none text-muted">Listar</a>
                <a href="{{ route('administrator.teachers.show', $teacher->id) }}"
                    class="text-decoration-none text-muted">Visualizar</a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('administrator.teachers.update', $teacher->id) }}">
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
                    <input type="text" class="form-control" name="name" value="{{ old('name', $teacher->name) }}"
                        required>
                </div>

                <div class="mb-3 d-flex gap-3">
                    <div class="flex-fill">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone" maxlength="15"
                            value="{{ old('phone', $teacher->phone) }}" required>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"
                            value="{{ old('email', $teacher->email) }}">
                    </div>
                </div>

                @php
                    $languageOptions = [
                        'english' => 'Inglês',
                        'spanish' => 'Espanhol',
                        'french' => 'Francês',
                        'italian' => 'Italiano',
                        'portuguese' => 'Português',
                    ];
                    $selectedLanguages = old(
                        'languages',
                        is_array($teacher->languages)
                            ? $teacher->languages
                            : (is_string($teacher->languages)
                                ? explode(',', $teacher->languages)
                                : []),
                    );
                @endphp

                <div class="mb-3">
                    <label class="form-label">Idiomas</label>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($languageOptions as $lang => $label)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="lang-{{ $lang }}"
                                    name="languages[]" value="{{ $lang }}"
                                    {{ in_array($lang, $selectedLanguages) ? 'checked' : '' }}>
                                <label class="form-check-label" for="lang-{{ $lang }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                @php
                    $availabilityOptions = [
                        'morning' => 'Manhã',
                        'afternoon' => 'Tarde',
                        'evening' => 'Noite',
                    ];
                    $selectedAvailability = old(
                        'availability',
                        is_array($teacher->availability)
                            ? $teacher->availability
                            : (is_string($teacher->availability)
                                ? explode(',', $teacher->availability)
                                : []),
                    );
                @endphp

                <div class="mb-3">
                    <label class="form-label">Disponibilidade</label>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($availabilityOptions as $period => $label)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="disp-{{ $period }}"
                                    name="availability[]" value="{{ $period }}"
                                    {{ in_array($period, $selectedAvailability) ? 'checked' : '' }}>
                                <label class="form-check-label" for="disp-{{ $period }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3 d-flex gap-3">
                    <div class="flex-fill">
                        <label class="form-label">Valor da hora (R$)</label>
                        <input type="number" class="form-control" name="hourly_rate" min="0"
                            value="{{ old('hourly_rate', $teacher->hourly_rate) }}" required>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Percentual de Repasse</label>
                        <select name="commission" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="30" {{ old('commission', $teacher->commission) == 30 ? 'selected' : '' }}>
                                30%</option>
                            <option value="25" {{ old('commission', $teacher->commission) == 25 ? 'selected' : '' }}>
                                25%</option>
                            <option value="20" {{ old('commission', $teacher->commission) == 20 ? 'selected' : '' }}>
                                20%</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Chave Pix</label>
                    <input type="text" class="form-control" name="pix" value="{{ old('pix', $teacher->pix) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea class="form-control" name="notes" rows="3">{{ old('notes', $teacher->notes) }}</textarea>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-success">Salvar alterações</button>
                    <a href="{{ route('administrator.teachers.show', $teacher->id) }}"
                        class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function() {
                // Máscara para telefone
                $('#phone').mask('(00) 00000-0000');

                // Validação para garantir que o campo sempre seja um número positivo de até 2 dígitos
                $('input[name="hourly_rate"]').on('input', function() {
                    let value = $(this).val();
                    value = value.replace(/[^0-9]/g, '');
                    if (value.length > 2) value = value.slice(0, 2);
                    value = parseInt(value, 10);
                    if (isNaN(value) || value < 0) value = 0;
                    $(this).val(value);
                });
            });
        </script>
    </body>
@endsection
