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

    <h2>Visualizar cadastro de Aluno</h2><hr>

    <a href="{{ route('administrator.home') }}">Home</a><br>
    <a href="{{ route('administrator.students.index') }}">Listar Alunos</a>
    <hr>

    <p><strong>Nome:</strong> {{ $student->name }}</p>
    <p><strong>Telefone:</strong> {{ $student->phone }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>

    <p><strong>Idiomas:</strong>
        @php
            $languages = is_array($student->languages) ? implode(', ', array_map('ucfirst', $student->languages)) : ucfirst($student->languages);
        @endphp
        {{ $languages }}
    </p>

    <p><strong>Professor:</strong> {{ $student->teacher->name ?? 'N/A' }}</p>

    <p><strong>Disponibilidade:</strong>
        @php
            $availability = is_array($student->availability) ? implode(', ', array_map('ucfirst', $student->availability)) : ucfirst($student->availability);
        @endphp
        {{ $availability }}
    </p>

    <p><strong>Objetivo:</strong> {{ $student->goal }}</p>

    @if ($student->observation)
        <p><strong>Observações:</strong> {{ $student->observation }}</p>
    @endif
    <hr>

    <a href="{{ route('administrator.students.edit', $student->id) }}">Editar</a>

    <form action="{{ route('administrator.students.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
        @csrf
        @method('DELETE')
        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;"> Excluir </button>
    </form>

</body>
</html>
