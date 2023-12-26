@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <h1>Editar Cliente</h1>

        <form action="{{ route('clients.update', $client->id) }}" method="post">
            @csrf
            @method('PUT') <!-- Use the PUT method for updates -->

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $client->phone }}" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Active" {{ $client->status === 'Active' ? 'selected' : '' }}>Ativo</option>
                    <option value="Inactive" {{ $client->status === 'Inactive' ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@endsection
