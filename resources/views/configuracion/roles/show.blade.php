@extends('layouts.app')
@section('title', 'Permisos - ' . $rol->nombre_rol)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $rol->nombre_rol }}</h1>
    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">← Volver</a>
</div>

<form method="POST" action="{{ route('roles.permisos', $rol->id_rol) }}">
    @csrf
    
<div class="row">
    @foreach($modulos as $modulo)
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">{{ $modulo->titulo }}</h5>
                <small class="text-muted">{{ $modulo->descripcion }}</small>
            </div>
            <div class="card-body">
                @php
                $accionesModulo = $todasAcciones->where('id_modulo', $modulo->id_modulo);
                @endphp
                
                @forelse($accionesModulo as $accion)
                <div class="form-check">
                    <input 
                        type="checkbox" 
                        class="form-check-input" 
                        name="acciones[]" 
                        value="{{ $accion->id_accion }}"
                        id="accion_{{ $accion->id_accion }}"
                        {{ in_array($accion->id_accion, $accionesPermitidas) ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="accion_{{ $accion->id_accion }}">
                        {{ $accion->descripcion }}
                    </label>
                </div>
                @empty
                <p class="text-muted mb-0">Sin acciones</p>
                @endforelse
            </div>
        </div>
    </div>
    @endforeach
</div>

<button type="submit" class="btn btn-primary">Guardar Permisos</button>
</form>
@endsection