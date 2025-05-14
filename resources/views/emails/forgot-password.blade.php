<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Redefinição de senha</title>
    <link href="https://fonts.googleapis.com/css2?family=Geologica:ital,wght@0,500&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Geologica', cursive;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-weight: 500;
            font-size: 16px;
            line-height: 1.25;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #202020;
            color: #ffffff;
            padding: 30px;
            text-align: left;
        }

        .logo {
            display: block;
            width: 100px;
            margin-bottom: 30px;
        }

        .header-info {
            display: flex;
            align-items: center;
        }

        .header-bar {
            width: 2px;
            height: 24px;
            background-color: #12A9B7;
            margin-right: 12px;
        }

        .header-text {
            font-size: 18px;
            font-weight: 500;
            margin: 0;
        }

        .header-text span {
            color: #D2B3F9;
        }

        .content {
            padding: 30px;
            color: #000;
        }

        .content h1 {
            font-size: 22px;
            margin-top: 0;
        }

        .token {
            display: flex;
            justify-content: center;
            margin: 25px 0;
            position: relative;
        }

        .token-hidden {
            position: absolute;
            font-size: 0;
            height: 0;
            overflow: hidden;
            color: transparent;
            user-select: all;
        }

        .token-box {
            display: inline-block;
            background-color: #E6E6E6;
            border-radius: 8px;
            padding: 15px 20px;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            width: 44px;
            margin-right: 8px;
            white-space: nowrap;
        }

        .token-box:last-child {
            margin-right: 0;
        }

        .footer {
            background-color: #202020;
            color: #B8B8B8;
            text-align: left;
            font-size: 12px;
            padding: 15px 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon"
                alt="Logo Lemma" class="logo" />
            <div class="header-info">
                <div class="header-bar"></div>
                <p class="header-text">Redefinição de senha</p>
            </div>
        </div>
        <div class="content">
            <h1>Olá, {{ $capitalizeName }}</h1>
            <p>Tudo bem?</p>
            <p>Utilize o código abaixo para redefinir sua senha:</p>
            <div class="token">
                <span class="token-hidden">{{ $tokenString }}</span>
                {!! $tokenDigits !!}
            </div>
            <p><strong>Atenção!</strong> Esse código expira em 30 minutos</p>
            <p>Estamos te esperando!<br />Equipe Lemma</p>
        </div>
        <div class="footer">
            <p><strong>Não compartilhe este e-mail</strong></p>
            <p>Para sua segurança não compartilhe este e-mail para ninguém.</p>
        </div>
    </div>
</body>

</html>
