<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevUserSeeder extends Seeder
{
    public function run(): void
    {
        $hash = password_hash('dev', PASSWORD_BCRYPT);
        DB::table('seguridad_usuarios')->updateOrInsert(
            ['login_usuario' => 'dev'],
            [
                'contrasenia_usuario' => $hash,
                'id_rol' => 1,
                'estado' => 1,
                'fecha_reg' => now()
            ]
        );
        echo "Hash: " . $hash . "\n";
    }
}