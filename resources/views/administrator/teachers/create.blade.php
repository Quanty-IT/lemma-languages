@extends('layouts.admin')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">

    <!-- jQuery e jQuery Mask -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <body>
        <h1 class="titulo">Cadastrar novo</h1>

        <div class="top-buttons">
            <a href="{{ route('administrator.home') }}" class="botao">Home</a>
            <a href="{{ route('administrator.teachers.index') }}" class="botao">Listar</a>
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

                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" id="phone" name="phone" maxlength="15" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>

                <div class="form-group">
                    <label>Idiomas</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="languages[]" value="ingles"> Inglês</label>
                        <label><input type="checkbox" name="languages[]" value="espanhol"> Espanhol</label>
                        <label><input type="checkbox" name="languages[]" value="frances"> Francês</label>
                        <label><input type="checkbox" name="languages[]" value="italiano"> Italiano</label>
                        <label><input type="checkbox" name="languages[]" value="portugues"> Português</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Disponibilidade</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="availability[]" value="manha"> Manhã</label>
                        <label><input type="checkbox" name="availability[]" value="tarde"> Tarde</label>
                        <label><input type="checkbox" name="availability[]" value="noite"> Noite</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Valor da hora (R$)</label>
                    <input type="number" name="hourly_rate" min="0" required>
                </div>

                <div class="form-group">
                    <label>Repasse</label>
                    <select name="commission" required>
                        <option value="">Selecione</option>
                        <option value="30">30%</option>
                        <option value="25">25%</option>
                        <option value="20">20%</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Chave Pix</label>
                    <input type="text" name="pix">
                </div>

                <div class="form-group">
                    <label>Observações</label>
                    <textarea name="notes" rows="4"></textarea>
                </div>

                <div class="button-container">
                    <button type="submit">Cadastrar</button>
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

                    // Remover zeros à esquerda
                    value = parseInt(value, 10);

                    // Garantir que o valor seja positivo e corrigir se necessário
                    if (isNaN(value) || value < 0) value = 0;

                    // Atualizar o valor do campo para garantir que é um número positivo e sem zeros à esquerda
                    $(this).val(value);
                });

                // Validação para garantir que o campo sempre seja um número positivo
                $('#hours').on('input', function() {
                    let value = $(this).val();

                    // Remover qualquer caractere que não seja número
                    value = value.replace(/[^0-9]/g, '');

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
