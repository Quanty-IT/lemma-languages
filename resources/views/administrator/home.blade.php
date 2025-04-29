<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD
    <title>Lemma Idiomas</title>
=======
    <title>Lemma - Soluções em Linguística</title>
>>>>>>> 5e7554bdbe479a1d7c99a1c62329f5018b7a3b9f
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">


</head>

<body>
    {{-- Título Home fora da caixa --}}
    <div class="title">Home </div>

    <div class="center-box">
        <a href="{{ route('administrator.teachers.index') }}">
            <button class="btn">Professores</button>
        </a>
        <a href="{{ route('administrator.students') }}">
            <button class="btn">Alunos</button>
        </a>
    </div>

    <hr>

    {{-- Visão Geral embaixo dos botões --}}
    <div class="overview">
        <h3>Visão Geral</h3>

        <div class="stat">
            <span>Professores cadastrados:</span>
            <span>: <strong>{{ $professoresCount ?? '16' }}</strong></span>
        </div>

        <div class="stat">
            <span>Alunos cadastrados:</span>
            <span>: <strong>{{ $alunosCount ?? '250' }}</strong></span>
        </div>
    </div>
    </div>

</body>
<footer>
    <div class="footer">
        <p>© 2025 Lemma - Soluções em Linguística. - QuantIT Todos os direitos reservados.</p>
    </div>


</html>
