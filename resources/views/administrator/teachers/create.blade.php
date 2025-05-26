@extends('layouts.app')

@section('content')

    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">

    <!-- jQuery e jQuery Mask -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="/css/administrator/teachers/create.css">


    <body>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-3">
                <a href="{{ route('administrator.home') }}" class="text-decoration-none text-muted">Home</a>
                <a href="{{ route('administrator.teachers.index') }}" class="text-decoration-none text-muted">Listar</a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>


        <div class="form-container">
            <form method="POST" action="{{ route('administrator.teachers.store') }}">
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

                {{-- Nome --}}
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>

                {{-- Telefone e Email lado a lado --}}
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

                {{-- Idiomas --}}
                <div class="mb-3">
                    <label class="form-label">Idiomas</label><br>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="lang-ingles" name="languages[]" value="ingles"
                            {{ in_array('ingles', old('languages', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="lang-ingles">Inglês</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="lang-espanhol" name="languages[]"
                            value="espanhol" {{ in_array('espanhol', old('languages', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="lang-espanhol">Espanhol</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="lang-frances" name="languages[]" value="frances"
                            {{ in_array('frances', old('languages', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="lang-frances">Francês</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="lang-italiano" name="languages[]"
                            value="italiano" {{ in_array('italiano', old('languages', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="lang-italiano">Italiano</label>
                    </div>
                </div>

                {{-- Disponibilidade --}}
                <div class="mb-3">
                    <label class="form-label">Disponibilidade</label><br>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="disp-manha" name="availability[]" value="manha"
                            {{ in_array('manha', old('availability', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="disp-manha">Manhã</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="disp-tarde" name="availability[]" value="tarde"
                            {{ in_array('tarde', old('availability', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="disp-tarde">Tarde</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="disp-noite" name="availability[]" value="noite"
                            {{ in_array('noite', old('availability', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="disp-noite">Noite</label>
                    </div>
                </div>

                {{-- Valor da hora e Percentual lado a lado --}}
                <div class="mb-3 d-flex gap-3">
                    <div class="flex-fill">
                        <label class="form-label">Valor da hora (R$)</label>
                        <input type="number" class="form-control" name="hourly_rate" min="0"
                            value="{{ old('hourly_rate') }}" required>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Percentual de Repasse</label>
                        <select name="commission" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="30" {{ old('commission') == '30' ? 'selected' : '' }}>30%</option>
                            <option value="25" {{ old('commission') == '25' ? 'selected' : '' }}>25%</option>
                            <option value="20" {{ old('commission') == '20' ? 'selected' : '' }}>20%</option>
                        </select>
                    </div>
                </div>

                {{-- Chave Pix --}}
                <div class="mb-3">
                    <label class="form-label">Chave Pix</label>
                    <input type="text" class="form-control" name="pix" value="{{ old('pix') }}">
                </div>

                {{-- Observações --}}
                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea class="form-control" name="notes" rows="3">{{ old('notes') }}</textarea>
                </div>

                {{-- Botão --}}
                <div class="button-container">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>


            </form>
        </div>

        <script>
            $(document).ready(function() {
                // Máscara para telefone
                $('#phone').mask('(00) 00000-0000');

                // Validação para garantir que o campo sempre seja um número positivo
                $('input[name="hourly_rate"]').on('input', function() {
                    let value = $(this).val();

                    // Remover qualquer caractere que não seja número
                    value = value.replace(/[^0-9]/g, '');

                    // Limita a até 2 caracteres (dois dígitos)
                    if (value.length > 3) value = value.slice(0, 2);

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
