@extends('layouts.app')

@section('content')
    <div class="container mt-4"> {{-- ADICIONA ESPAÇAMENTO ACIMA --}}

        {{-- Alerta de sucesso --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Cabeçalho e Botões --}}
        <div class="position-relative mb-4">
            <a href="{{ route('administrator.home') }}" class="text-decoration-none text-muted">Home</a>

            <div class="position-absolute top-0 end-0 text-end">
                <form action="{{ route('logout') }}" method="POST" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>

                <a href="{{ route('administrator.students.create') }}" class="btn btn-outline-success btn-sm">Criar</a>
            </div>

            <h2 class="fw-bold border-bottom pb-2 mt-4">Alunos</h2>
        </div>

        {{-- Lista de alunos --}}
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
                            <td class="text-dark fw-normal">
                                <a href="{{ route('administrator.students.show', $student->id) }}" class="text-decoration-none text-dark">
                                    {{ $student->name }}
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('administrator.students.edit', $student->id) }}" class="btn btn-primary btn-sm me-2">Editar</a>
                                <form action="{{ route('administrator.students.destroy', $student->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
