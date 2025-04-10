<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lemma - Soluções em Linguística</title>
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
</head>

<body>
    <h2>Login</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        @method('POST')

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Digite seu E-mail" value="{{ old('email') }}" >
        </div>
        <div>
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" placeholder="Digite sua senha" >
        </div>
        <button type="submit">Entrar</button>

        @if (session('status'))
            <p style="color: red;">
                {{ session('status') }}
            </p>
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $error)
            <p style="color: red;">
                {{ $error }}
            </p>
            @endforeach
        @endif

</body>

</html>
