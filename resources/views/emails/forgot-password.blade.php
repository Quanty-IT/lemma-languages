<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Redefinição de senha</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .wrapper {
            padding: 40px 20px;
        }

        .email-container {
            max-width: 480px;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            background-color: #ffffff;
        }

        .logo {
            background-color: #12A9B7;
            text-align: center;
            padding: 20px;
        }

        .logo img {
            max-width: 140px;
            height: auto;
        }

        .content-area {
            background: linear-gradient(135deg, #d1f0f7, #c7e4f2);
            padding: 30px;
        }

        h2 {
            text-align: center;
            font-size: 22px;
            margin-top: 0;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        .code-box {
            text-align: center;
            margin: 30px 0;
        }

        .code {
            display: inline-block;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 10px;
            padding: 18px 24px;
            background-color: #b3e8f2;
            color: #003740;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .footer {
            font-size: 12px;
            color: #555;
            margin-top: 30px;
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
            .code {
                font-size: 22px;
                letter-spacing: 6px;
                padding: 12px 16px;
            }

            .wrapper {
                padding: 20px 10px;
            }
        }
    </style>
</head>

<body>
    <div
        style="display: none; font-size: 1px; color: #f5f5f5; line-height: 1px; max-height: 0; max-width: 0; opacity: 0; overflow: hidden;">
        Use o código abaixo para continuar:
    </div>
    <span style="display: none;">&#8203;</span>

    <div class="wrapper">
        <div class="email-container">
            <div class="logo">
                <img src="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon"
                    alt="Logo Lemma">
            </div>

            <div class="content-area">
                <h2>Redefinição de senha</h2>
                <p>Olá, {{ $capitalizeName }}!</p>
                <p>Você solicitou a redefinição de senha. Use o código abaixo para continuar:</p>

                <div class="code-box">
                    <div class="code">{{ $tokenString }}</div>
                </div>

                <p><strong>Importante:</strong> este código expira em 30 minutos.</p>
                <p>Se você não solicitou isso, apenas ignore este e-mail.</p>
                <p><strong>Não compartilhe este e-mail com ninguém por segurança.</strong></p>
                <p>Equipe Lemma</p>

                <div class="footer">
                    &copy; {{ date('Y') }} Lemma. Todos os direitos reservados.
                </div>
            </div>
        </div>
    </div>
</body>

</html>
