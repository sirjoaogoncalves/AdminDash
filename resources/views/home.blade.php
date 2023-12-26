@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-flex">
                        <div class="card mr-10">
                            <div class="card-body">
                                <h3 class="mb-3">A fazer</h3>
                                <ul class="list-group list-group-flush">
                                    @forelse ($todos as $todo)
                                        <li class="list-group-item">{{ $todo->title }}</li>
                                    @empty
                                        <li class="list-group-item">Nenhum item a fazer no momento.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="card mr-5">
                            <div class="card-body">
                                <h3 class="mb-3">Top Serviços</h3>
                                <ul class="list-group list-group-flush">
                                    @forelse ($mostUsedServices as $service)
                                        <li class="list-group-item">
                                            {{ $service->name }} ({{ $service->service_count }})
                                        </li>
                                    @empty
                                        <li class="list-group-item">Nenhum serviço registrado.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-3">Top Clientes</h3>
                                <ul class="list-group list-group-flush">
                                    @forelse ($mostClients as $client)
                                        <li class="list-group-item">
                                            {{ $client->name }} ({{ $client->client_count }})
                                        </li>
                                    @empty
                                        <li class="list-group-item">Nenhum cliente registrado.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

    </div>
</div>
@endsection
