<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class PermisosHelper
{
    public static function tienePermiso($accion)
    {
        $idRol = session('id_rol');
        
        if (!$idRol) {
            return false;
        }

        // Super Administrador (rol 1) tiene todos los permisos
        if ($idRol == 1) {
            return true;
        }

        $permiso = DB::table('roles_acciones')
            ->where('id_rol', $idRol)
            ->where('id_accion', $accion)
            ->exists();

        return $permiso;
    }

    public static function getModulos()
    {
        return DB::table('seguridad_modulos')
            ->orderBy('orden')
            ->get();
    }

    public static function getAccionesModulo($idModulo)
    {
        return DB::table('seguridad_acciones')
            ->where('id_modulo', $idModulo)
            ->get();
    }

    public static function getAccionesPermitidas()
    {
        $idRol = session('id_rol');
        
        if (!$idRol) {
            return [];
        }

        if ($idRol == 1) {
            return DB::table('seguridad_acciones')
                ->pluck('id_accion')
                ->toArray();
        }

        return DB::table('roles_acciones')
            ->where('id_rol', $idRol)
            ->pluck('id_accion')
            ->toArray();
    }

    public static function getNombreRol()
    {
        $idRol = session('id_rol');
        
        if (!$idRol) {
            return 'Invitado';
        }

        $rol = DB::table('seguridad_roles')
            ->where('id_rol', $idRol)
            ->first();

        return $rol ? $rol->nombre_rol : 'Sin rol';
    }
}