@extends('layouts.app')

@section('title', 'Editar tarea')

@section('content')

<div class="page-heading">
    <div>
        <h1>Editar tarea</h1>
        <p>Actualiza la información y el estado de tu actividad.</p>
    </div>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
        ← Volver al panel
    </a>
</div>

<div class="form-panel">

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group full-width">
                <label for="title">Nombre de la tarea *</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="form-control"
                    value="{{ old('title', $task->title) }}"
                    maxlength="150"
                    required
                >

                @error('title')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group full-width">
                <label for="description">Descripción</label>

                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                >{{ old('description', $task->description) }}</textarea>

                @error('description')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="priority">Prioridad *</label>

                <select
                    id="priority"
                    name="priority"
                    class="form-control"
                    required
                >
                    <option value="baja"
                        @selected(old('priority', $task->priority) === 'baja')>
                        Baja
                    </option>

                    <option value="media"
                        @selected(old('priority', $task->priority) === 'media')>
                        Media
                    </option>

                    <option value="alta"
                        @selected(old('priority', $task->priority) === 'alta')>
                        Alta
                    </option>
                </select>

                @error('priority')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Estado *</label>

                <select
                    id="status"
                    name="status"
                    class="form-control"
                    required
                >
                    <option value="pendiente"
                        @selected(old('status', $task->status) === 'pendiente')>
                        Pendiente
                    </option>

                    <option value="en_progreso"
                        @selected(old('status', $task->status) === 'en_progreso')>
                        En progreso
                    </option>

                    <option value="completada"
                        @selected(old('status', $task->status) === 'completada')>
                        Completada
                    </option>
                </select>

                @error('status')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group full-width">
                <label for="due_date">Fecha límite</label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    class="form-control"
                    value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                >

                @error('due_date')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                Cancelar
            </a>

            <button type="submit" class="btn btn-primary">
                Guardar cambios
            </button>
        </div>

    </form>

</div>

@endsection