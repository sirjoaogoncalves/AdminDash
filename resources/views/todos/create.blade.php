@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar</h1>

        <form action="{{ route('todos.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
    </div>

    <script>
        // Your scripts go here
    </script>
@endsection
