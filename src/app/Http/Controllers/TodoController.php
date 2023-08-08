<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="My API", version="0.1")
 */

class TodoController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api",
     *     @OA\Response(response="200", description="get all todos")
     * )
     */
    public function index()
    // public function index(): JsonResponse
    {
        $todos = Todo::paginate(3);
        // return response()->json($todos, 200);

        // $todos = Todo::all();
        // return response()->json($todos, 200);

        return view('todos.index', ['todos' => $todos]);
    }

    /**
     * @OA\Get(
     *     path="/api/todos",
     *     @OA\Response(response="200", description="get all todos")
     * )
     */
    public function getTodos(Request $request)
    {
        $completed = $request->input('completed');

        if ($completed === 'incomplete') {
            $todos = Todo::where('completed', false)->get();
        } elseif ($completed === 'completed') {
            $todos = Todo::where('completed', true)->get();
        } else {
            $todos = Todo::all();
        }

        return response()->json($todos, 200);
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

        return response()->json($todo, 201);
        // return redirect()->route('todos.index')->with('success', 'Todo created successfully.');
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

        return response()->json($todo, 201);
        // return redirect()->route('todos.index');
    }

    public function destroy(Request $request)
    {
        $id = $request->route('id');

        // $todo = Todo::findOrFail($id);
        // $todo->delete();

        // return response()->json(null, 200);


        try {
            $todo = Todo::findOrFail($id);
            $todo->delete();

            return response()->json(['message' => 'Todo successfully deleted.'], 201);

        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Todo not found.'], 404);

        } catch (Exception $e) {

            return response()->json(['error' => 'Failed to delete the todo.'], 500);

        }
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return response()->json($todo, 201);
        // return view('todos.show', compact('todo'));
    }
}
