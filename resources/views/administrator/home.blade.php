@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    {{-- Título Home fora da caixa --}}
    <div class="title">Home </div>

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
            <span>: <strong>{{ $professoresCount }}</strong></span>
        </div>

        <div class="stat">
            <span>Alunos cadastrados:</span>
            <span>: <strong>{{ $alunosCount }}</strong></span>
        </div>
    </div>
    </div>

</body>
<footer>
    <div class="footer">
        <p>© 2025 Lemma - Soluções em Linguística. - QuantIT Todos os direitos reservados.</p>
    </div>
@endsection
