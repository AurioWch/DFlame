<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login()
    {
        return view('index_login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'login_usuario' => 'required',
            'password' => 'required'
        ]);

        $usuario = DB::table('seguridad_usuarios')  
            ->where('login_usuario', $request->login_usuario)
            ->where('estado', 1)
            ->first();

        if (!$usuario) {
            return back()->withErrors(['login_usuario' => 'Usuario no encontrado']);
        }

        $verify = password_verify($request->password, $usuario->contrasenia_usuario);

        if (!$verify) {
            return back()->withErrors(['login_usuario' => 'Password incorrecto']);
        }

        session(['id_usuario' => $usuario->id_usuario, 'login_usuario' => $usuario->login_usuario, 'id_rol' => $usuario->id_rol]);
        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}