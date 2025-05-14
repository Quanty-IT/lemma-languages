@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="titulo">Alunos</h1>

        <div class="top-buttons">
            <a href="{{ route('administrator.home') }}" class="botao">Home</a>
            <a href="{{ route('administrator.students.create') }}" class="botao">Cadastrar</a>
        </div>

        @if ($students->isEmpty())
            <p>Nenhum registro de alunos.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                <div class="aluno-card">
                                    <div class="aluno-nome">
                                        <a href="{{ route('administrator.students.show', $student->id) }}">
                                            {{ $student->name }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="acoes">
                                    <a href="{{ route('administrator.students.edit', $student->id) }}"
                                        class="btn btn-primary">Editar</a>
                                    <form action="{{ route('administrator.students.destroy', $student->id) }}"
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
