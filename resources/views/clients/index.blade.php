@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Estatísticas</h4>
        </div>
        <div class="card-body">
            <p>Total Clientes: {{ $totalClients }}</p>
            <p>Ativos: {{ $activeClients }}</p>
            <p>Inativos: {{ $inactiveClients }}</p>
        </div>
    </div>

    <h1 class="mt-4">Clientes</h1>

    <form id="searchForm" action="{{ route('clients.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" id="searchInput" placeholder="Pesquisar por nome">
    </form>

    @if($clients->isEmpty())
        <p>Nao foram encontrados clientes com esse nome.</p>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary mt-3">Mostrar Todos os Clientes</a>
    @else
        <table class="table mt-4">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome Do Cliente</th>
                <td>Telefone</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->status }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">
                            Ver Detalhes
                        </a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Adicionar Novo Cliente</a>
        <a href="{{ route('clients.export') }}" class="btn btn-success">Exportar Para Excel</a>

    @endif
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@endsection
