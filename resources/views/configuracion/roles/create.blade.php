@extends('layouts.app')
@section('title', 'Nuevo Rol')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Nuevo Rol</h1>
    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">← Volver</a>
</div>

<div class="card" style="max-width: 480px;">
    <div class="card-body">
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nombre_rol" class="form-label">Nombre del Rol</label>
                <input type="text" class="form-control" name="nombre_rol" id="nombre_rol" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Guardar</button>
        </form>
    </div>
</div>
@endsection