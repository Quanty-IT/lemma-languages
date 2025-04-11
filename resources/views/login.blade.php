<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lemma - Soluções em Linguística</title>
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
    <style>
        body {
            background-color: #0d1117; /* fundo escuro para destacar a logo */
            color: #0d1117;
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 40px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        img.logo {
            width: 150px;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
        }
        .form-group { /*aling form to center*/
            display: flex;
            align-items: center;
            gap: 10px;
        }

        label {
            width: 80px;
            font-weight: bold;
            text-align: right;
        }

        input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }


        button {
            padding: 10px;
            background-color: #004aad;
            color: #fff;
            border: none;
            border-radius: 4px;
            justify-content: center;
            cursor: pointer;
            max-width: 100px;
        }

        button:hover { /*cursor above button*/
            background-color: #00307a;
        }

        h2 { /*text login*/
            margin: 0;
            font-size: 24px;
        }

        p {
            margin: 0; /* fail login*/
        }
        .logo {
        margin-bottom: 30px;
        background-color:rgb(53, 181, 203); /* fundo preto atrás da logo branca */
        padding: 10px 20px;
        border-radius: 50px 0 50px 0;
        }

        .logo img {
        max-width: 500px;
         }
         
    </style>
</head>

<body>
<div class="login-container">
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Lemma">
    </div>
    <div class="container">
    <h2 style="text-align: center;">Login</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Digite seu E-mail" value="{{ old('email') }}" >
        </div>
        <div class="form-group">
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
	</form>
    </div>
</body>

</html>
