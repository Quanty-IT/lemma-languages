<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lemma - Soluções em Linguística</title>
    <link rel="icon" href="https://cdn.interago.com.br/img/png/w_0_q_8/429/mc/Logo%20e%20favicon//lemma_favicon">
</head>

<h1>Lista de Alunos</h1>

    <hr>
    <a href="{{ route('administrator.home') }}">Home</a><br>
    <a href="{{ route('administrator.students.create') }}" class="btn">Cadastrar</a>
    <hr>
    
    @if ($students->isEmpty())
    <p>Nenhum registro de professores.</p>
@else
    <table border="1" cellpadding="8" cellspacing="0">

        <tbody>
        @foreach($students as $student)
            <div style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                border: 1px solid #ccc;
                padding: 10px 20px;
                margin-bottom: 10px;
                border-radius: 5px;
                background-color: #f9f9f9;
            ">
                <div style="font-weight: bold;">
                    <a href="{{ route('administrator.students.show', $student->id) }}">
                    {{ $student->name }}
                    </a>
                </div>

                <div>
                    <a href="{{ route('administrator.students.edit', $student->id) }}" style="margin-right: 10px;">Editar</a>

                    <form action="{{ route('administrator.students.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;"> Excluir </button>
                    </form>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
@endif

</body>

</html>