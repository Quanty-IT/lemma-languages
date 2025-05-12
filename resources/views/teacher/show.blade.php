@extends('layouts.admin')

@section('content')
    <h2>Registros de {{ $student->name }}</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('teacher.home') }}" class="btn btn-primary">Home</a>


    @if ($activityRecords->isEmpty())
        <p>Nenhum registro encontrado.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mês</th>
                    <th>Horas</th>
                    <th>Conteúdo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activityRecords as $record)
                    <tr>
                        <td>{{ $record->month }}</td>
                        <td>{{ $record->hours }}</td>
                        <td>{{ $record->content }}</td>

                        <td>
                            <form action="{{ route('activity.destroy', $record->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Tem certeza que deseja excluir este registro?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
