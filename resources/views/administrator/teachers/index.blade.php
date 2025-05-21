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

                <a href="{{ route('administrator.teachers.create') }}" class="btn btn-success btn-sm text-white">Criar</a>
            </div>

            <h2 class="fw-bold border-bottom pb-2 mt-4">Professores</h2>
        </div>

        @if ($teachers->isEmpty())
            <p>Nenhum registro de professores.</p>
        @else
            <table class="table table-borderless align-middle">
                <thead class="fw-bold">
                    <tr>
                        <th>Nome</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>
                                <a href="{{ route('administrator.teachers.show', $teacher->id) }}"
                                    class="text-decoration-none text-dark">
                                    {{ $teacher->name }}
                                </a>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('administrator.teachers.edit', $teacher->id) }}"
                                    class="btn btn-primary btn-sm me-2">Editar</a>
                                <form action="{{ route('administrator.teachers.destroy', $teacher->id) }}" method="POST"
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
