<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        // return response()->json($todos);

        return view('todos.index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $todo = new Todo;
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->completed = false;
        $todo->save();

        // return response()->json($todo, 201);
        return redirect()->route('todos.index')->with('success', 'Todo created successfully.');
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        // $todo->title = $request->input('title');
        // $todo->description = $request->input('description');
        // $todo->completed = $request->input('completed');

        // return response()->json($todo);

        $todo->completed = !$todo->completed;
        $todo->save();

        return redirect()->route('todos.index');
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json(null, 204);
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return view('todos.show', compact('todo'));
    }
}
