@extends('layouts.app')
@section('title', 'Editar Usuario')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Editar Usuario</h1>
    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">← Volver</a>
</div>

<div class="card" style="max-width: 480px;">
    <div class="card-body">
        <form method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
            @csrf @method('PUT')

            <div class="mb-3">
                <label for="login_usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="login_usuario" id="login_usuario" required value="{{ $usuario->login_usuario }}">
                @error('login_usuario')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="contrasenia_usuario" class="form-label">Nueva contraseña</label>
                <input type="password" class="form-control" name="contrasenia_usuario" id="contrasenia_usuario" minlength="6">
                <div class="form-text">Dejar vacío para mantener actual</div>
                @error('contrasenia_usuario')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_rol" class="form-label">Rol</label>
                    <select class="form-select" name="id_rol" id="id_rol" required>
                        <option value="1" {{ $usuario->id_rol == 1 ? 'selected' : '' }}>Administrador</option>
                        <option value="2" {{ $usuario->id_rol == 2 ? 'selected' : '' }}>Usuario</option>
                        <option value="3" {{ $usuario->id_rol == 3 ? 'selected' : '' }}>Consulta</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" name="estado" id="estado" required>
                        <option value="1" {{ $usuario->estado == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $usuario->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Actualizar</button>
        </form>
    </div>
</div>
@endsection