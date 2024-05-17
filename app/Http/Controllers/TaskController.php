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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // otras reglas de validación
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->position = "TODO"; // Establecer la posición predeterminada como "TODO"
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            // otras reglas de validación
        ]);

        $task = Task::find($id);
        if ($task) {
            $task->title = $request->input('title');
            $task->save();
            return response()->json(['success' => 'Tarea actualizada correctamente', 'title' => $task->title]);
        } else {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        }
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}