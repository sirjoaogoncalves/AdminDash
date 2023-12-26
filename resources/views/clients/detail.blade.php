@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <h1>Detalhes do Cliente</h1>

        <div class="card">
            <div class="card-body">
                <h2>{{ $client->name }}</h2>

                <p>Telefone: {{ $client->phone }}</p>
                <p>Status: {{ $client->status }}</p>

                <h3>Serviços</h3>
                <ul>
                    @forelse ($client->services as $service)
                        <li>
                            {{ $service->name }}
                            <form action="{{ route('clients.removeService', ['client' => $client->id, 'service' => $service->id]) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        </li>
                    @empty
                        <li>Nenhum serviço associado a este cliente.</li>
                    @endforelse
                </ul>
                 <h3>Adicionar Serviço</h3>
                <form action="{{ route('clients.addService', $client->id) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="service">Serviço</label>
                        <select class="form-control" id="service" name="service" required>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Adicionar Serviço</button>
                </form>
                <form action="{{ route('clients.updateStatus', $client->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Active" {{ $client->status == 'Active' ? 'selected' : '' }}>Ativo</option>
                                <option value="Inactive" {{ $client->status == 'Inactive' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <!-- Delete Button -->
                <form action="{{ route('clients.destroy', $client->id) }}" method="post" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?')">Apagar Cliente</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@endsection
