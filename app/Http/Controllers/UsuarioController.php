<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = DB::table('seguridad_usuarios')
            ->orderBy('id_usuario', 'desc')
            ->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login_usuario' => 'required|unique:seguridad_usuarios,login_usuario',
            'contrasenia_usuario' => 'required|min:6',
            'id_rol' => 'required|integer',
            'estado' => 'required|integer'
        ]);

        DB::table('seguridad_usuarios')->insert([
            'login_usuario' => $request->login_usuario,
            'contrasenia_usuario' => password_hash($request->contrasenia_usuario, PASSWORD_BCRYPT),
            'id_rol' => $request->id_rol,
            'estado' => $request->estado,
            'id_usuario_reg' => session('id_usuario'),
            'fecha_reg' => now(),
            'ipmaq_reg' => $request->ip()
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado');
    }

    public function edit($id)
    {
        $usuario = DB::table('seguridad_usuarios')
            ->where('id_usuario', $id)
            ->first();

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'login_usuario' => 'required|unique:seguridad_usuarios,login_usuario,' . $id . ',id_usuario',
            'id_rol' => 'required|integer',
            'estado' => 'required|integer'
        ]);

        $data = [
            'login_usuario' => $request->login_usuario,
            'id_rol' => $request->id_rol,
            'estado' => $request->estado,
            'id_usuario_act' => session('id_usuario'),
            'fecha_act' => now(),
            'ipmaq_act' => $request->ip()
        ];

        if ($request->contrasenia_usuario) {
            $data['contrasenia_usuario'] = password_hash($request->contrasenia_usuario, PASSWORD_BCRYPT);
        }

        DB::table('seguridad_usuarios')
            ->where('id_usuario', $id)
            ->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado');
    }

    public function destroy($id)
    {
        DB::table('seguridad_usuarios')
            ->where('id_usuario', $id)
            ->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado');
    }
}