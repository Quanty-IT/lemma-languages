@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="/css/administrator/teachers/show.css">

    <body>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-3">
                <a href="{{ route('administrator.home') }}" class="text-decoration-none text-muted">Home</a>
                <a href="{{ route('administrator.teachers.index') }}" class="text-decoration-none text-muted">Listar</a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>

        <div class="form-container">

            <div class="student-info">
                <div class="info-row">
                    <div class="info-item">
                        <label class="info-label">Nome</label>
                        <div class="info-value">{{ $teacher->name }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <label class="info-label">Telefone</label>
                        <div class="info-value">{{ $teacher->phone ?: 'Não informado' }}</div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Email</label>
                        <div class="info-value">{{ $teacher->email ?: 'Não informado' }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <label class="info-label">Idiomas</label>
                        <div class="info-value">
                            {{ $teacher->languages ? implode(', ', array_map('ucfirst', $teacher->languages)) : '—' }}
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <label class="info-label">Disponibilidade</label>
                        <div class="info-value">
                            {{ $teacher->availability ? implode(', ', array_map('ucfirst', $teacher->availability)) : '—' }}
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <label class="info-label">Valor da hora</label>
                        <div class="info-value">R$ {{ number_format($teacher->hourly_rate, 2, ',', '.') }}</div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Repasse</label>
                        <div class="info-value">{{ $teacher->commission }}%</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <label class="info-label">Chave Pix</label>
                        <div class="info-value">{{ $teacher->pix ?: 'Não informado' }}</div>
                    </div>
                </div>

                @if ($teacher->notes)
                    <div class="info-row">
                        <div class="info-item">
                            <label class="info-label">Observações</label>
                            <div class="info-value">{{ $teacher->notes }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="button-container">
                <a href="{{ route('administrator.teachers.edit', $teacher->id) }}" class="btn btn-primary">Editar</a>

                <form action="{{ route('administrator.teachers.destroy', $teacher->id) }}" method="POST"
                    style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </body>
@endsection
