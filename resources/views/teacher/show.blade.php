@extends('layouts.app')

@section('content')
    <div class="p-5">
        <div class="position-relative mb-3">
            <a href="{{ route('teacher.home') }}" class="text-decoration-none text-muted">Home</a>

            <div class="position-absolute top-0 end-0 text-end d-flex flex-column gap-3">
                <form action="{{ route('logout') }}" method="POST" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>

                <a href="{{ route('lesson.create', ['id' => $student->id]) }}"
                    class="btn btn-success btn-sm text-white">Registrar</a>
            </div>

            <h2 class="fw-bold border-bottom pb-2 mt-4">Registros de {{ $student->name }}</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <p class="mb-0"><strong>Idioma do aluno:</strong>
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
                {{ $languageNames[$student->language] ?? strtolower($student->language) }}
            </p>
        </div>

        @if ($lessons->isEmpty())
            <p>Nenhum registro encontrado.</p>
        @else
            @php
                $months = [
                    'january' => 'janeiro',
                    'february' => 'fevereiro',
                    'march' => 'março',
                    'april' => 'abril',
                    'may' => 'maio',
                    'june' => 'junho',
                    'july' => 'julho',
                    'august' => 'agosto',
                    'september' => 'setembro',
                    'october' => 'outubro',
                    'november' => 'novembro',
                    'december' => 'dezembro',
                ];
            @endphp

            <table class="table table-borderless align-middle">
                <thead class="fw-bold">
                    <tr>
                        <th>mês</th>
                        <th>horas</th>
                        <th>conteúdo</th>
                        <th class="text-end">ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                        <tr>
                            <td>{{ $months[strtolower($lesson->month)] ?? strtolower($lesson->month) }}</td>
                            <td>{{ $lesson->hours }}</td>
                            <td>{{ $lesson->content }}</td>
                            <td class="text-end">
                                <a href="{{ route('lesson.edit', ['id' => $lesson->id]) }}"
                                    class="btn btn-primary btn-sm me-2">Editar</a>
                                <form action="{{ route('lesson.destroy', ['id' => $lesson->id]) }}" method="POST"
                                    class="d-inline"
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
