@extends('layouts.app')
@section('title', 'Nuevo Usuario')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Nuevo Usuario</h1>
    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">← Volver</a>
</div>

<div class="card" style="max-width: 480px;">
    <div class="card-body">
        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf

            <div class="mb-3">
                <label for="login_usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="login_usuario" id="login_usuario" required value="{{ old('login_usuario') }}">
                @error('login_usuario')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="contrasenia_usuario" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasenia_usuario" id="contrasenia_usuario" required minlength="6">
                @error('contrasenia_usuario')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_rol" class="form-label">Rol</label>
                    <select class="form-select" name="id_rol" id="id_rol" required>
                        <option value="">Seleccionar</option>
                        <option value="1">Administrador</option>
                        <option value="2">Usuario</option>
                        <option value="3">Consulta</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" name="estado" id="estado" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Guardar</button>
        </form>
    </div>
</div>
@endsection