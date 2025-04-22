<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lemma - Soluções em Linguística</title>
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
</head>

<body>

    <h2>Cadastrar novo</h2><hr>
    <a href="{{ route('administrator.home') }}">Home</a><br>
    <a href="{{ route('administrator.teachers.index')}}">Listar</a><hr>

    <form method="POST" action="{{ route('administrator.teachers.store') }}">
    @csrf

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
    <input type="text" name="name" value="{{ old('name') }}" required><br><br>

    <label>Telefone</label>
    <input type="text" name="phone" value="{{ old('phone') }}" required><br><br>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}"><br><br>

    <label>Idiomas</label><br>
    <input type="checkbox" name="languages[]" value="inglês" {{ in_array('inglês', old('languages', [])) ? 'checked' : '' }}> Inglês
    <input type="checkbox" name="languages[]" value="espanhol" {{ in_array('espanhol', old('languages', [])) ? 'checked' : '' }}> Espanhol
    <input type="checkbox" name="languages[]" value="francês" {{ in_array('francês', old('languages', [])) ? 'checked' : '' }}> Francês<br>
    <input type="checkbox" name="languages[]" value="italiano" {{ in_array('italiano', old('languages', [])) ? 'checked' : '' }}> Italiano
    <input type="checkbox" name="languages[]" value="português" {{ in_array('português', old('languages', [])) ? 'checked' : '' }}> Português<br><br>

    <label>Disponibilidade</label><br>
    <input type="checkbox" name="availability[]" value="manhã" {{ in_array('manhã', old('availability', [])) ? 'checked' : '' }}> Manhã
    <input type="checkbox" name="availability[]" value="tarde" {{ in_array('tarde', old('availability', [])) ? 'checked' : '' }}> Tarde
    <input type="checkbox" name="availability[]" value="noite" {{ in_array('noite', old('availability', [])) ? 'checked' : '' }}> Noite<br><br>

    <label>Valor da hora (R$)</label>
    <input type="number" step="5" name="hourly_rate" value="{{ old('hourly_rate') }}" required><br><br>

    <label>Repasse</label>
    <select name="commission" required>
        <option value="">Selecione</option>
        <option value="30" {{ old('commission') == 30 ? 'selected' : '' }}>30%</option>
        <option value="25" {{ old('commission') == 25 ? 'selected' : '' }}>25%</option>
        <option value="20" {{ old('commission') == 20 ? 'selected' : '' }}>20%</option>
    </select><br><br>

    <label>Chave Pix</label>
    <input type="text" name="pix" value="{{ old('pix') }}"><br><br>

    <label>Observações</label><br>
    <textarea name="notes" rows="4" cols="30">{{ old('notes') }}</textarea><br><br>

    <button type="submit">Cadastrar</button>
</form>

</body>

</html>