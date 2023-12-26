@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('todos.index') }}" method="GET" class="mb-4">
            <input type="text" id="searchInput" name="search" placeholder="Pesquisar por título" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>

        @if($todos->isEmpty())
            <p>Não foi encontrado nada com esse título.</p>
        @else
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <td>Descrição</td>
                        <td>Concluído</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                        <tr>
                            <td>{{ $todo->id }}</td>
                            <td>{{ $todo->title }}</td>
                            <td>{{ $todo->description }}</td>
                            <td>{{ $todo->completed ? 'Sim' : 'Não' }}</td>
                            <td>
                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('todos.create') }}" class="btn btn-primary mt-4">Adicionar</a>
    </div>

    <script>
        $(document).ready(function () {
            $('#searchInput').keyup(function () {
                var searchTerm = $(this).val().toLowerCase();
                filterResults(searchTerm);
            });

            function filterResults(searchTerm) {
                $('tbody tr').each(function () {
                    var text = $(this).text().toLowerCase();
                    if (text.indexOf(searchTerm) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            }
        });
    </script>
@endsection
