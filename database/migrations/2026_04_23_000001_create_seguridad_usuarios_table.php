<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seguridad_usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->integer('id_empleado')->nullable();
            $table->string('login_usuario', 150);
            $table->string('contrasenia_usuario', 250);
            $table->integer('id_rol')->nullable();
            $table->integer('estado')->default(1);
            $table->integer('id_usuario_reg')->nullable();
            $table->timestamp('fecha_reg')->nullable();
            $table->string('ipmaq_reg', 150)->nullable();
            $table->integer('id_usuario_act')->nullable();
            $table->timestamp('fecha_act')->nullable();
            $table->string('ipmaq_act', 150)->nullable();
            $table->integer('id_usuario_del')->nullable();
            $table->timestamp('fecha_del')->nullable();
            $table->string('ipmaq_del', 150)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguridad_usuarios');
    }
};