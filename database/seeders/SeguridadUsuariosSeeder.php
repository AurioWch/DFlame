<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeguridadUsuariosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('seguridad_usuarios')->insert([
            'login_usuario' => 'wuider',
            'contrasenia_usuario' => '$2y$10$pjp../aRBRQR3BKHZQ/cBeaCuS7C0MVBSccbr8qmN5EXgJHIdEi56',
            'id_rol' => 1,
            'estado' => 1,
            'fecha_reg' => now(),
            'ipmaq_reg' => '::1'
        ]);
    }
}