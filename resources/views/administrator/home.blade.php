@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="/css/administrator/home.css">

    <div class="p-5">
        <div class="position-relative mb-3">
            <a href="{{ route('administrator.teachers.index') }}" class="text-decoration-none text-muted">Professores</a>
            <a href="{{ route('administrator.students.index') }}" class="text-decoration-none text-muted ms-4">Alunos</a>

            <div class="position-absolute top-0 end-0 text-end d-flex flex-column gap-3">
                <form action="{{ route('logout') }}" method="POST" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>

            <h2 class="fw-bold border-bottom pb-2 mt-4">Home</h2>
        </div>

        @if ($sortedSummaries->isEmpty())
            <p>Nenhum dado encontrado.</p>
        @else
            <div class="table-header bg-white">
                <div>Professor</div>
                <div>Mês</div>
                <div>Horas</div>
                <div>Valor Total</div>
                <div>Valor Professor</div>
                <div>Valor Empresa</div>
            </div>

            @foreach ($sortedSummaries as $summary)
                <div class="row-box">
                    <div class="row-content">
                        <div>{{ $summary['name'] }}</div>
                        <div>{{ ucfirst($summary['month']) }}</div>
                        <div>{{ $summary['hours'] }}</div>
                        <div>{{ $summary['total_value'] }}</div>
                        <div>{{ $summary['value_professor'] }}</div>
                        <div>{{ $summary['value_company'] }}</div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
