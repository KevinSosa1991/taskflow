<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Mostrar el panel principal.
     */
    public function index(Request $request)
    {
        $query = Task::query();

        // Buscar por título.
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where('title', 'like', "%{$search}%");
        }

        // Filtrar por estado.
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filtrar por prioridad.
        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }

        // Obtener las tareas filtradas.
        $tasks = $query->latest()->get();

        // Indicadores generales del panel.
        $totalTasks = Task::count();

        $pendingTasks = Task::where(
            'status',
            'pendiente'
        )->count();

        $inProgressTasks = Task::where(
            'status',
            'en_progreso'
        )->count();

        $completedTasks = Task::where(
            'status',
            'completada'
        )->count();

        // Tareas vencidas que todavía no se han completado.
        $overdueTasks = Task::whereDate(
            'due_date',
            '<',
            now()->toDateString()
        )
            ->where('status', '!=', 'completada')
            ->count();

        return view('tasks.index', compact(
            'tasks',
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'overdueTasks'
        ));
    }

    /**
     * Mostrar el formulario de creación.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Guardar una tarea nueva.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'priority' => 'required|in:baja,media,alta',
            'due_date' => 'nullable|date',
        ]);

        $validated['status'] = 'pendiente';

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarea creada correctamente.');
    }

    /**
     * Mostrar una tarea.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Actualizar una tarea.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'priority' => 'required|in:baja,media,alta',
            'status' => 'required|in:pendiente,en_progreso,completada',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Eliminar una tarea.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarea eliminada correctamente.');
    }
}