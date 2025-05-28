@extends('layouts.app')

@section('content')
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="/css/administrator/students/form.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <body>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-3">
                <a href="{{ route('administrator.home') }}" class="text-decoration-none text-muted">Home</a>
                <a href="{{ route('administrator.students.index') }}" class="text-decoration-none text-muted">Listar</a>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>

        <div class="form-container">
            <div class="student-info">

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <div class="form-control bg-light">{{ $student->name }}</div>
                </div>

                <div class="mb-3 d-flex gap-3">
                    <div class="flex-fill">
                        <label class="form-label">Telefone</label>
                        <div class="form-control bg-light p-0">
                            <input type="text" id="phone" class="form-control border-0 bg-light"
                                value="{{ $student->phone }}" readonly>
                        </div>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">Email</label>
                        <div class="form-control bg-light">{{ $student->email ?: 'Não informado' }}</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Idioma</label>
                    @php
                        $languageLabels = [
                            'english' => 'Inglês',
                            'spanish' => 'Espanhol',
                            'french' => 'Francês',
                            'italian' => 'Italiano',
                            'portuguese' => 'Português',
                        ];
                    @endphp
                    <div class="form-control bg-light">
                        {{ $languageLabels[$student->language] ?? ucfirst($student->language) }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Disponibilidade</label>
                    @php
                        $availabilityLabels = [
                            'morning' => 'Manhã',
                            'afternoon' => 'Tarde',
                            'evening' => 'Noite',
                        ];
                        $availability = is_array($student->availability)
                            ? $student->availability
                            : (is_string($student->availability)
                                ? explode(',', $student->availability)
                                : []);
                    @endphp
                    <div class="form-control bg-light">
                        {{ $availability
                            ? implode(', ', array_map(fn($slot) => $availabilityLabels[$slot] ?? ucfirst($slot), $availability))
                            : '—' }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Professor</label>
                    <div class="form-control bg-light">{{ $student->teacher->name ?? 'Não atribuído' }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Objetivo</label>
                    <div class="form-control bg-light">{{ $student->goal ?: 'Não informado' }}</div>
                </div>

                @if ($student->notes)
                    <div class="mb-3">
                        <label class="form-label">Observações</label>
                        <div class="form-control bg-light">{{ $student->notes }}</div>
                    </div>
                @endif
            </div>

            <div class="button-container">
                <a href="{{ route('administrator.students.edit', $student->id) }}" class="btn btn-primary">Editar</a>

                <form action="{{ route('administrator.students.destroy', $student->id) }}" method="POST"
                    style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // Máscara para telefone (mesmo código do edit)
                $('#phone').mask('(00) 00000-0000');
            });
        </script>
    </body>
@endsection
