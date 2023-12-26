<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $todos = Todo::where('title', 'LIKE', '%' . $search . '%')->paginate(10);

    return view('todos.index', compact('todos'));
}

    public function create(){
        return view('todos.create');
    }

   public function store(Request $request)
{
     $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable',
    ]);


     Todo::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
    ]);

    return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
}

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index');
    }
}
