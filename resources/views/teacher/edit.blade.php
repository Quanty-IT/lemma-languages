@extends('layouts.admin')

@section('content')
    <h2>Editar Registro de Atividade</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('activity.update', ['record' => $record->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="month">Mês</label>
            <select name="month" required>
                <option value="Janeiro">Janeiro</option>
                <option value="Fevereiro">Fevereiro</option>
                <option value="Março">Março</option>
                <option value="Abril">Abril</option>
                <option value="Maio">Maio</option>
                <option value="Junho">Junho</option>
                <option value="Julho">Julho</option>
                <option value="Agosto">Agosto</option>
                <option value="Setembro">Setembro</option>
                <option value="Outubro">Outubro</option>
                <option value="Novembro">Novembro</option>
                <option value="Dezembro">Dezembro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="hours">Horas</label>
            <input type="number" name="hours" class="form-control" value="{{ old('hours', $record->hours) }}" required>
        </div>

        <div class="form-group">
            <label for="content">Conteúdo</label>
            <textarea name="content" class="form-control" required>{{ old('content', $record->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
