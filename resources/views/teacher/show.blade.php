@extends('layouts.app')

@section('content')
    <h2>Registros de {{ $student->name }}</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('teacher.home') }}" class="btn btn-primary">Home</a>

    <p><strong>Idioma do aluno:</strong>
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
        {{ $languageNames[$student->language] ?? $student->language }}
    </p>

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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mês</th>
                    <th>Horas</th>
                    <th>Conteúdo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lessons as $lesson)
                    <tr>
                        <td>{{ $months[$lesson->month] ?? $lesson->month }}</td>
                        <td>{{ $lesson->hours }}</td>
                        <td>{{ $lesson->content }}</td>
                        <td>
                            <form action="{{ route('lesson.destroy', $lesson->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Tem certeza que deseja excluir este registro?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                            <a href="{{ route('lesson.edit', $lesson->id) }}" class="btn btn-warning">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
