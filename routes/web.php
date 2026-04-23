<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;

// Login (público)
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// Rutas protegidas
Route::middleware(\App\Http\Middleware\AuthMiddleware::class)->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // Configuración
    Route::get('/configuracion/roles', [RolController::class, 'index'])->name('roles.index');
    Route::get('/configuracion/roles/create', [RolController::class, 'create'])->name('roles.create');
    Route::post('/configuracion/roles', [RolController::class, 'store'])->name('roles.store');
    Route::get('/configuracion/roles/{id}', [RolController::class, 'show'])->name('roles.show');
    Route::get('/configuracion/roles/{id}/edit', [RolController::class, 'edit'])->name('roles.edit');
    Route::put('/configuracion/roles/{id}', [RolController::class, 'update'])->name('roles.update');
    Route::delete('/configuracion/roles/{id}', [RolController::class, 'destroy'])->name('roles.destroy');
    Route::post('/configuracion/roles/{id}/permisos', [RolController::class, 'updatePermisos'])->name('roles.permisos');

    Route::resource('usuarios', UsuarioController::class);
});