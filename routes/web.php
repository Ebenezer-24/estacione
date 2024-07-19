<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EstacionamientoController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\RecargaController;
use App\Http\Controllers\PagoComercioController;


Route::resource('usuarios', UsuarioController::class);
Route::resource('estacionamientos', EstacionamientoController::class)->except(['destroy']);
Route::put('estacionamientos/{estacionamiento}/liberar', [EstacionamientoController::class, 'liberar'])->name('estacionamientos.liberar');
Route::resource('comercios', ComercioController::class);
Route::resource('recargas', RecargaController::class)->except(['edit', 'update', 'destroy']);

Route::resource('pagos_comercios', PagoComercioController::class);



Route::get('/', function () {
    return view('welcome');
});
