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
    <h2>Cadastrar novo</h2><hr>
    <a href="{{ route('administrator.home') }}">Home</a><br>
    <a href="{{ route('administrator.teachers.index')}}">Listar</a><hr>

    <form method="POST" action="{{ route('administrator.teachers.store') }}">
    @csrf

    <label>Nome</label>
    <input type="text" name="name" required><br><br>

    <label>Telefone</label>
    <input type="text" name="phone" required><br><br>

    <label>Email</label>
    <input type="email" name="email"><br><br>

    <label>Idiomas</label><br>
    <input type="checkbox" name="language[]" value="english"> Inglês
    <input type="checkbox" name="language[]" value="spanish"> Espanhol
    <input type="checkbox" name="language[]" value="french"> Francês<br>
    <input type="checkbox" name="language[]" value="italian"> Italiano
    <input type="checkbox" name="language[]" value="portuguese"> Português<br><br>

    <label>Disponibilidade</label><br>
    <input type="checkbox" name="availability[]" value="morning"> Manhã
    <input type="checkbox" name="availability[]" value="afternoon"> Tarde
    <input type="checkbox" name="availability[]" value="evening"> Noite<br><br>

    <label>Valor da hora (R$)</label>
    <input type="number" step="5" name="hourly_rate" required><br><br>

    <label>Repasse</label>
	<select name="commission" required>
		<option value="">Selecione</option>
			<option value="30">30%</option>
			<option value="25">25%</option>
            <option value="20">20%</option>
	</select><br><br>


    <label>Chave Pix</label>
    <input type="text" name="pix"><br><br>

    <label>Observações</label><br>
    <textarea name="notes" rows="4" cols="30"></textarea><br><br>

    <button type="submit">Salvar</button>
</form>

</body>

</html>