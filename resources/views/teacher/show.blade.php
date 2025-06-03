@extends('layouts.app')

@section('content')
    <div class="p-5">
        <div class="position-relative mb-3">
            <a href="{{ route('teacher.home') }}" class="text-decoration-none text-muted">Home</a>

            <div class="position-absolute top-0 end-0 text-end d-flex flex-column gap-2">
                <form action="{{ route('logout') }}" method="POST" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>

                <a href="{{ route('lesson.create') }}" class="btn btn-success btn-sm text-white">Novo Registro</a>
            </div>

            <h2 class="fw-bold border-bottom pb-2 mt-4">Registros de {{ $student->name }}</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <p class="mb-0"><strong>Idioma do aluno:</strong></p>
            @php
                $languageNames = [
                    'english' => 'Inglês',
                    'spanish' => 'Espanhol',
                    'french' => 'Francês',
                    'german' => 'Alemão',
                    'italian' => 'Italiano',
                    'portuguese' => 'Português',
                ];
            @endphp
            <span class="text-muted">
                {{ $languageNames[$student->language] ?? ucfirst($student->language) }}
            </span>
        </div>

        @if ($lessons->isEmpty())
            <p>Nenhum registro encontrado.</p>
        @else
            @php
                $months = [
                    'january' => 'Janeiro',
                    'february' => 'Fevereiro',
                    'march' => 'Março',
                    'april' => 'Abril',
                    'may' => 'Maio',
                    'june' => 'Junho',
                    'july' => 'Julho',
                    'august' => 'Agosto',
                    'september' => 'Setembro',
                    'october' => 'Outubro',
                    'november' => 'Novembro',
                    'december' => 'Dezembro',
                ];
            @endphp

            <table class="table table-borderless align-middle">
                <thead class="fw-bold">
                    <tr>
                        <th>Mês</th>
                        <th>Horas</th>
                        <th>Conteúdo</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                        <tr>
                            <td>{{ $months[$lesson->month] ?? ucfirst($lesson->month) }}</td>
                            <td>{{ $lesson->hours }}</td>
                            <td>{{ $lesson->content }}</td>
                            <td class="text-end">
                                <a href="{{ route('lesson.edit', $lesson->id) }}"
                                    class="btn btn-primary btn-sm me-2">Editar</a>
                                <form action="{{ route('lesson.destroy', $lesson->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este registro?');">
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
