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

@if(session('success'))
    <div style="
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: 9999;
    ">
        {{ session('success') }}
    </div>
@endif

<h2>Professores</h2>
    <hr>
    <a href="{{ route('administrator.home') }}">Home</a><br>
    <a href="{{ route('administrator.teachers.create') }}">Cadastrar</a>
    <hr>

    @if ($teachers->isEmpty())
        <p>Nenhum registro de professores.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">

            <tbody>
            @foreach($teachers as $teacher)
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
                        <a href="{{ route('administrator.teachers.show', $teacher->id) }}">
                        {{ $teacher->name }}
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('administrator.teachers.edit', $teacher->id) }}" style="margin-right: 10px;">Editar</a>

                        <form action="{{ route('administrator.teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
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