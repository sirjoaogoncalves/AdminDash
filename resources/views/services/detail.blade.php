@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <h1>Detalhes do Serviço</h1>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $service->name }}</h2>

                <h3 class="card-subtitle mb-3">Clientes Associados</h3>
                <ul class="list-group">
                    @forelse ($service->clients as $client)
                        <li class="list-group-item">{{ $client->name }}</li>
                    @empty
                        <li class="list-group-item">Não existem clientes associados a este serviço.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@endsection
