@extends('layouts.app')

@section('title', 'Nueva tarea')

@section('content')

<div class="page-heading">
    <div>
        <h1>Nueva tarea</h1>
        <p>Registra una actividad y define cuándo quieres completarla.</p>
    </div>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
        ← Volver al panel
    </a>
</div>

<div class="form-panel">

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            <div class="form-group full-width">
                <label for="title">Nombre de la tarea *</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="form-control"
                    placeholder="Ej. Preparar presentación"
                    value="{{ old('title') }}"
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
                    placeholder="Describe brevemente lo que necesitas hacer..."
                >{{ old('description') }}</textarea>

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
                        @selected(old('priority', 'media') === 'baja')>
                        Baja
                    </option>

                    <option value="media"
                        @selected(old('priority', 'media') === 'media')>
                        Media
                    </option>

                    <option value="alta"
                        @selected(old('priority', 'media') === 'alta')>
                        Alta
                    </option>
                </select>

                @error('priority')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="due_date">Fecha límite</label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    class="form-control"
                    value="{{ old('due_date') }}"
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
                Guardar tarea
            </button>
        </div>

    </form>

</div>

@endsection