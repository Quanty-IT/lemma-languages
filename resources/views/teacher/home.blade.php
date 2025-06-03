@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/teacher/home.css">

    <div class="p-5">
        <div class="position-relative mb-4">
            <h2 class="fw-bold border-bottom pb-2">Home</h2>

            <div class="position-absolute top-0 end-0 text-end d-flex flex-column gap-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>

        <div class="mb-4">
            <a href="{{ route('lesson.create') }}" class="btn btn-primary">+ Novo Registro</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h4 class="fw-semibold mb-3">Alunos com Registro de Aulas</h4>

        @if ($students && $students->isNotEmpty())
            <div class="d-flex flex-column gap-3">
                @foreach ($students as $student)
                    <div class="card shadow-sm border-0 w-100">
                        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <i class="bi bi-person-circle fs-2 text-primary"></i>
                                <div>
                                    <h5 class="mb-0">{{ $student->name }}</h5>
                                </div>
                            </div>
                            <a href="{{ route('teacher.show', $student->id) }}" class="btn btn-outline-dark">Visualizar</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">Você ainda não cadastrou alunos.</div>
        @endif
    </div>
@endsection
