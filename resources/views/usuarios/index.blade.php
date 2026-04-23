@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo usuario
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                <tr>
                    <td>{{ $u->id_usuario }}</td>
                    <td>{{ $u->login_usuario }}</td>
                    <td>{{ $u->id_rol }}</td>
                    <td>
                        <span class="badge bg-{{ $u->estado == 1 ? 'success' : 'danger' }}">
                            {{ $u->estado == 1 ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>{{ $u->fecha_reg ? \Carbon\Carbon::parse($u->fecha_reg)->format('d/m/Y H:i') : '-' }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $u->id_usuario) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                        <form method="POST" action="{{ route('usuarios.destroy', $u->id_usuario) }}" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4">Sin registros</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection