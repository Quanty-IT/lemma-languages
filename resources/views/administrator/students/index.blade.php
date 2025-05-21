@extends('layouts.app')

@section('content')
    <div class="p-5">
        <div class="position-relative mb-3">
            <a href="{{ route('administrator.home') }}" class="text-decoration-none text-muted">Home</a>

            <div class="position-absolute top-0 end-0 text-end d-flex flex-column gap-3">
                <form action="{{ route('logout') }}" method="POST" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>

                <a href="{{ route('administrator.students.create') }}" class="btn btn-success btn-sm text-white">Criar</a>
            </div>

            <h2 class="fw-bold border-bottom pb-2 mt-4">Alunos</h2>
        </div>

        @if ($students->isEmpty())
            <p>Nenhum registro de alunos.</p>
        @else
            <table class="table table-borderless align-middle">
                <thead class="fw-bold">
                    <tr>
                        <th>Nome</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                <a href="{{ route('administrator.students.show', $student->id) }}"
                                    class="text-decoration-none text-dark">
                                    {{ $student->name }}
                                </a>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('administrator.students.edit', $student->id) }}"
                                    class="btn btn-primary btn-sm me-2">Editar</a>
                                <form action="{{ route('administrator.students.destroy', $student->id) }}" method="POST"
                                    class="d-inline"
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
