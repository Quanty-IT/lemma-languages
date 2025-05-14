@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="titulo">Professores</h1>
        <div class="top-buttons">
            <a href="{{ route('administrator.home') }}" class="botao">Home</a>
            <a href="{{ route('administrator.teachers.create') }}" class="botao">Cadastrar</a>
        </div>

        @if ($teachers->isEmpty())
            <p>Nenhum registro de professores.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>
                                <div class="professor-card">
                                    <div class="professor-nome">
                                        <a href="{{ route('administrator.teachers.show', $teacher->id) }}">
                                            {{ $teacher->name }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="acoes">
                                    <a href="{{ route('administrator.teachers.edit', $teacher->id) }}"
                                        class="btn btn-primary">Editar</a>
                                    <form action="{{ route('administrator.teachers.destroy', $teacher->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
