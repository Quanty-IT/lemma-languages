@extends('layouts.admin')

@section('content')
    <h2>Home</h2>

    <a href="{{ route('lesson.create') }}" class="btn btn-primary">Novo Registro</a>
    <br>
    <br>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Alunos com Registro de Aulas</h2>

    @if ($students && $students->isNotEmpty())
        <ul class="list-group">
            @foreach ($students as $student)
                <li class="list-group-item">
                    <a href="{{ route('teacher.show', $student->id) }}">{{ $student->name }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Você ainda não cadastrou alunos.</p>
    @endif
@endsection
