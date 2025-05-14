@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="title">Home</div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <div class="center-box">
        <a href="{{ route('administrator.teachers.index') }}">
            <button class="btn">Professores</button>
        </a>
        <a href="{{ route('administrator.students.index') }}">
            <button class="btn">Alunos</button>
        </a>
    </div>

    <hr>

    <div class="overview">
        <h3>Visão Geral</h3>

        <div class="stat">
            <span>Professores cadastrados:</span>
            <span>: <strong>{{ $countTeachers }}</strong></span>
        </div>

        <div class="stat">
            <span>Alunos cadastrados:</span>
            <span>: <strong>{{ $countStudents }}</strong></span>
        </div>
    </div>

    <footer>
        <div class="footer">
            <p>© 2025 Lemma - Soluções em Linguística. - QuantIT Todos os direitos reservados.</p>
        </div>
    </footer>
@endsection
