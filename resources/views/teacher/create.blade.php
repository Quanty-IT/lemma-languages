@extends('layouts.admin')
@section('content')
<form method="POST" action="{{ route('activity.store') }}">
    @csrf

    <a href="{{ route('teacher.home') }}" class="btn btn-primary">Home</a>
    <br>
    

    <label>Aluno</label>
    <select name="student_id" required>
        @foreach($students as $student)
            <option value="{{ $student->id }}">{{ $student->name }}</option>
        @endforeach
    </select>

    <label>Mês</label>
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

    <label>Horas</label>
    <input type="number" name="hours" required>

    <label>Conteúdo</label>
    <textarea name="content" required></textarea>

    <button type="submit">Registrar</button>
</form>

@endsection

