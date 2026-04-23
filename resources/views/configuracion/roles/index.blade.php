@extends('layouts.app')
@section('title', 'Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Roles</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-primary">+ Nuevo Rol</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre del Rol</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $rol)
                <tr>
                    <td>{{ $rol->id_rol }}</td>
                    <td>
                        @if($rol->id_rol == 1)
                        <span class="badge bg-warning text-dark">{{ $rol->nombre_rol }}</span>
                        @else
                        {{ $rol->nombre_rol }}
                        @endif
                    </td>
                    <td>{{ $rol->fecha_reg ? \Carbon\Carbon::parse($rol->fecha_reg)->format('d/m/Y H:i') : '-' }}</td>
                    <td>
                        <a href="{{ route('roles.show', $rol->id_rol) }}" class="btn btn-sm btn-outline-primary">Ver Permisos</a>
                        @if($rol->id_rol != 1)
                        <form method="POST" action="{{ route('roles.destroy', $rol->id_rol) }}" class="d-inline" onsubmit="return confirm('¿Eliminar rol?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-4">Sin roles</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection