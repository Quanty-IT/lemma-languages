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

    <h2>Editar cadastro</h2><hr>

    <a href="{{ route('administrator.home') }}">Home</a><br>
    <a href="{{ route('administrator.teachers.index') }}">Listar</a><hr>

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
        <input type="text" name="phone" value="{{ $teacher->phone }}" required><br><br>

        <label>Email</label>
        <input type="email" name="email" value="{{ $teacher->email }}"><br><br>

        <label>Idiomas</label><br>
        @php $selectedLanguages = explode(',', $teacher->languages); @endphp
        <input type="checkbox" name="languages[]" value="inglês" {{ in_array('inglês', $selectedLanguages) ? 'checked' : '' }}> Inglês
        <input type="checkbox" name="languages[]" value="espanhol" {{ in_array('espanhol', $selectedLanguages) ? 'checked' : '' }}> Espanhol
        <input type="checkbox" name="languages[]" value="francês" {{ in_array('francês', $selectedLanguages) ? 'checked' : '' }}> Francês<br>
        <input type="checkbox" name="languages[]" value="italiano" {{ in_array('italiano', $selectedLanguages) ? 'checked' : '' }}> Italiano
        <input type="checkbox" name="languages[]" value="português" {{ in_array('português', $selectedLanguages) ? 'checked' : '' }}> Português<br><br>

        <label>Disponibilidade</label><br>
        @php $selectedAvailability = explode(',', $teacher->availability); @endphp
        <input type="checkbox" name="availability[]" value="manhã" {{ in_array('manhã', $selectedAvailability) ? 'checked' : '' }}> Manhã
        <input type="checkbox" name="availability[]" value="tarde" {{ in_array('tarde', $selectedAvailability) ? 'checked' : '' }}> Tarde
        <input type="checkbox" name="availability[]" value="noite" {{ in_array('noite', $selectedAvailability) ? 'checked' : '' }}> Noite<br><br>

        <label>Valor da hora (R$)</label>
        <input type="number" step="5" name="hourly_rate" value="{{ $teacher->hourly_rate }}" required><br><br>

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

</body>

</html>