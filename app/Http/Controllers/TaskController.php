<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() 
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // otras reglas de validación
        ]);
        $task = new Task();
        $task->title = $request->title;
        $task->title = $request->input('title');
    
        // Establecer la posición predeterminada como "TODO"
        $task->position = "TODO";
        $task->save();

        return redirect()->route('tasks.index');
    }
    public function show($id)
    {

    }
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('tasks'));
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
    // Guardar la pocision de la tarea
    public function updatePosition(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->position = $request->position;
        $task->save();

        return redirect()->route('tasks.index');

    }
}
