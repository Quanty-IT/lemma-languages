@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">

    <body>
        <h2>Visualizar cadastro</h2>
        <hr>

        <a href="{{ route('administrator.home') }}">Home</a><br>
        <a href="{{ route('administrator.students.index') }}">Listar Alunos</a>

        <p><strong>Nome:</strong> {{ $student->name }}</p>
        <p><strong>Telefone:</strong> {{ $student->phone }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>

        <p><strong>Idiomas:</strong>
            {{ is_array($student->languages)
                ? implode(', ', array_map(fn($lang) => ucfirst($lang), $student->languages))
                : ucfirst($student->languages) }}
        </p>

        <p><strong>Professor:</strong> {{ $student->teacher->name ?? 'N/A' }}</p>

        <p><strong>Disponibilidade:</strong>
            {{ is_array($student->availability)
                ? implode(', ', array_map(fn($slot) => ucfirst($slot), $student->availability))
                : ucfirst($student->availability) }}
        </p>

        <p><strong>Objetivo:</strong> {{ $student->goal }}</p>

        @if ($student->observation)
            <p><strong>Observações:</strong> {{ $student->observation }}</p>
        @endif

        <a href="{{ route('administrator.students.edit', $student->id) }}">Editar</a>

        <form action="{{ route('administrator.students.destroy', $student->id) }}" method="POST" style="display:inline;"
            onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Excluir</button>
        </form>
    </body>
@endsection
