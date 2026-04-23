<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$u = DB::table('seguridad_usuarios')->where('login_usuario', 'dev')->first();
echo "Hash: " . $u->contrasenia_usuario . "\n";
echo "Verify: " . (password_verify('dev', $u->contrasenia_usuario) ? 'OK' : 'FAIL') . "\n";