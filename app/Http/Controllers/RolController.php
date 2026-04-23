<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    public function index()
    {
        $roles = DB::table('seguridad_roles')
            ->orderBy('id_rol', 'desc')
            ->get();

        return view('configuracion.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('configuracion.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_rol' => 'required|unique:seguridad_roles,nombre_rol'
        ]);

        DB::table('seguridad_roles')->insert([
            'nombre_rol' => $request->nombre_rol,
            'id_usuario_reg' => session('id_usuario'),
            'fecha_reg' => now(),
            'ipmaq_reg' => $request->ip()
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol registrado');
    }

    public function show($id)
    {
        $rol = DB::table('seguridad_roles')->where('id_rol', $id)->first();
        
        $modulos = DB::table('seguridad_modulos')->orderBy('orden')->get();
        
        $accionesPermitidas = DB::table('roles_acciones')
            ->where('id_rol', $id)
            ->pluck('id_accion')
            ->toArray();

        $todasAcciones = DB::table('seguridad_acciones')->get();

        return view('configuracion.roles.show', compact('rol', 'modulos', 'accionesPermitidas', 'todasAcciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_rol' => 'required|unique:seguridad_roles,nombre_rol,' . $id . ',id_rol'
        ]);

        DB::table('seguridad_roles')
            ->where('id_rol', $id)
            ->update([
                'nombre_rol' => $request->nombre_rol,
                'id_usuario_act' => session('id_usuario'),
                'fecha_act' => now(),
                'ipmaq_act' => $request->ip()
            ]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado');
    }

    public function destroy($id)
    {
        if ($id == 1) {
            return redirect()->route('roles.index')->with('error', 'No puedes eliminar el Super Administrador');
        }

        DB::table('seguridad_roles')->where('id_rol', $id)->delete();
        DB::table('roles_acciones')->where('id_rol', $id)->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado');
    }

    public function updatePermisos(Request $request, $id)
    {
        DB::table('roles_acciones')->where('id_rol', $id)->delete();

        if ($request->has('acciones')) {
            foreach ($request->acciones as $idAccion) {
                DB::table('roles_acciones')->insert([
                    'id_rol' => $id,
                    'id_accion' => $idAccion,
                    'id_usuario_reg' => session('id_usuario'),
                    'fecha_reg' => now(),
                    'ipmaq_reg' => $request->ip()
                ]);
            }
        }

        return redirect()->route('roles.show', $id)->with('success', 'Permisos actualizados');
    }
}