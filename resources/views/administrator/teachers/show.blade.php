@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="/css/administrator/teachers/form.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

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

                <div class="mb-3 d-flex gap-3">
                    <div class="flex-fill">
                        <label class="form-label">Telefone</label>
                        <div class="form-control bg-light p-0">
                            <input type="text" id="phone" class="form-control border-0 bg-light"
                                value="{{ $teacher->phone }}" readonly>
                        </div>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Email</label>
                        <div class="form-control bg-light">{{ $teacher->email ?: 'Não informado' }}</div>
                    </div>
                </div>

                @php
                    $languageLabels = [
                        'english' => 'Inglês',
                        'spanish' => 'Espanhol',
                        'french' => 'Francês',
                        'italian' => 'Italiano',
                        'portuguese' => 'Português',
                    ];
                    $availabilityLabels = [
                        'morning' => 'Manhã',
                        'afternoon' => 'Tarde',
                        'evening' => 'Noite',
                    ];
                @endphp

                <div class="info-row">
                    <div class="info-item">
                        <label class="info-label">Idiomas</label>
                        <div class="info-value d-flex flex-wrap gap-3">
                            @if (!empty($teacher->languages))
                                @foreach ($teacher->languages as $lang)
                                    <span>{{ $languageLabels[$lang] ?? ucfirst($lang) }}</span>
                                @endforeach
                            @else
                                —
                            @endif
                        </div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-item">
                        <label class="info-label">Disponibilidade</label>
                        <div class="info-value d-flex flex-wrap gap-3">
                            @if (!empty($teacher->availability))
                                @foreach ($teacher->availability as $period)
                                    <span>{{ $availabilityLabels[$period] ?? ucfirst($period) }}</span>
                                @endforeach
                            @else
                                —
                            @endif
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

        <script>
            $(document).ready(function() {
                $('#phone').mask('(00) 00000-0000');
            });
        </script>
    </body>
@endsection
