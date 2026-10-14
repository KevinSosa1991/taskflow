@extends('layouts.app')

@section('title', 'Panel principal')

@section('content')

<div class="page-heading">
    <div>
        <h1>Mi espacio de trabajo</h1>
        <p>Administra tus tareas y mantén tus objetivos en orden.</p>
    </div>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        ＋ Nueva tarea
    </a>
</div>

<div class="stats-grid">

    <article class="stat-card">
        <div class="stat-label">Total de tareas</div>
        <div class="stat-value">{{ $totalTasks }}</div>
        <div class="stat-description">Todas tus tareas registradas</div>
    </article>

    <article class="stat-card">
        <div class="stat-label">Pendientes</div>
        <div class="stat-value">{{ $pendingTasks }}</div>
        <div class="stat-description">Por comenzar o atender</div>
    </article>

    <article class="stat-card">
        <div class="stat-label">En progreso</div>
        <div class="stat-value">{{ $inProgressTasks }}</div>
        <div class="stat-description">Actualmente en desarrollo</div>
    </article>

    <article class="stat-card">
        <div class="stat-label">Tareas vencidas</div>
        <div class="stat-value">{{ $overdueTasks }}</div>
        <div class="stat-description">
            Pendientes de completar después de su fecha límite
        </div>
    </article>

</div>

<section class="panel">

        <div class="panel-header">
            <h2>Mis tareas</h2>

            <span class="stat-label">
                {{ $tasks->count() }} resultados
            </span>
        </div>

        <form
            action="{{ route('tasks.index') }}"
            method="GET"
            style="padding: 20px 24px; border-bottom: 1px solid var(--border);"
        >
            <div
                style="
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                    gap: 12px;
                    align-items: end;
                "
            >
                <div class="form-group">
                    <label for="search">Buscar tarea</label>

                    <input
                        type="search"
                        id="search"
                        name="search"
                        class="form-control"
                        placeholder="Escribe un título..."
                        value="{{ request('search') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>

                    <select id="status" name="status" class="form-control">
                        <option value="">Todos los estados</option>

                        <option value="pendiente"
                            @selected(request('status') === 'pendiente')>
                            Pendiente
                        </option>

                        <option value="en_progreso"
                            @selected(request('status') === 'en_progreso')>
                            En progreso
                        </option>

                        <option value="completada"
                            @selected(request('status') === 'completada')>
                            Completada
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="priority">Prioridad</label>

                    <select id="priority" name="priority" class="form-control">
                        <option value="">Todas las prioridades</option>

                        <option value="baja"
                            @selected(request('priority') === 'baja')>
                            Baja
                        </option>

                        <option value="media"
                            @selected(request('priority') === 'media')>
                            Media
                        </option>

                        <option value="alta"
                            @selected(request('priority') === 'alta')>
                            Alta
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Buscar y filtrar
                    </button>

                    <a
                        href="{{ route('tasks.index') }}"
                        class="btn btn-secondary"
                        style="margin-top: 6px;"
                    >
                        Limpiar
                    </a>
                </div>
            </div>
        </form>

    @if ($tasks->isEmpty())

        <div class="empty-state">
            <div class="empty-icon">🗂️</div>

            <h3>Aún no tienes tareas</h3>

            <p>
                Comienza creando tu primera tarea y organiza tus actividades.
            </p>

            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                ＋ Crear primera tarea
            </a>
        </div>

    @else

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Tarea</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Fecha límite</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>
                                <div class="task-title">
                                    {{ $task->title }}
                                </div>

                                @if ($task->description)
                                    <div class="description-text">
                                        {{ \Illuminate\Support\Str::limit($task->description, 55) }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <span class="priority-{{ $task->priority }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </td>

                            <td>
                                <span class="badge status-{{ $task->status }}">
                                    @switch($task->status)
                                        @case('pendiente')
                                            Pendiente
                                            @break

                                        @case('en_progreso')
                                            En progreso
                                            @break

                                        @case('completada')
                                            Completada
                                            @break
                                    @endswitch
                                </span>
                            </td>

                            <td>
                                {{ $task->due_date?->format('d/m/Y') ?? 'Sin fecha' }}
                            </td>

                            <td>
                                <div class="actions">
                                    <a
                                        href="{{ route('tasks.edit', $task) }}"
                                        class="action-link"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('tasks.destroy', $task) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="action-button">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif

</section>

@endsection