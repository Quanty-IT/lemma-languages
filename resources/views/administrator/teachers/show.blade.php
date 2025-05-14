@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">

    <body>
        <h2>Visualizar cadastro</h2>
        <hr>

        <a href="{{ route('administrator.home') }}">Home</a><br>
        <a href="{{ route('administrator.teachers.index') }}">Listar</a>

        <p><strong>Nome:</strong> {{ $teacher->name }}</p>
        <p><strong>Telefone:</strong> {{ $teacher->phone }}</p>
        <p><strong>Email:</strong> {{ $teacher->email }}</p>

        <p><strong>Idiomas:</strong>
            {{ implode(', ', array_map(fn($lang) => ucfirst($lang), $teacher->languages ?? [])) }}
        </p>

        <p><strong>Disponibilidade:</strong>
            {{ implode(', ', array_map(fn($slot) => ucfirst($slot), $teacher->availability ?? [])) }}
        </p>

        <p><strong>Valor da hora:</strong> R$ {{ number_format($teacher->hourly_rate, 2, ',', '.') }}</p>
        <p><strong>Repasse:</strong> {{ $teacher->commission }}%</p>
        <p><strong>Chave Pix:</strong> {{ $teacher->pix }}</p>

        @if ($teacher->notes)
            <p><strong>Observações:</strong> {{ $teacher->notes }}</p>
        @endif

        <a href="{{ route('administrator.teachers.edit', $teacher->id) }}">Editar</a>

        <form action="{{ route('administrator.teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;"
            onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Excluir</button>
        </form>
    </body>
@endsection
