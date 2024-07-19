<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RecargaController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\PagoComercioController;

Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index']); 
    Route::post('/', [UsuarioController::class, 'store']); 
    Route::get('{id}', [UsuarioController::class, 'show']); 
    Route::put('{id}', [UsuarioController::class, 'update']); 
    Route::delete('{id}', [UsuarioController::class, 'destroy']); 
});
Route::prefix('recargas')->group(function () {
    Route::get('/', [RecargaController::class, 'index']); 
    Route::post('/', [RecargaController::class, 'store']); 
    Route::get('{id}', [RecargaController::class, 'show']); 
});
Route::prefix('comercios')->group(function () {
    Route::get('/', [ComercioController::class, 'index']); 
    Route::post('/', [ComercioController::class, 'store']);
    Route::get('{id}', [ComercioController::class, 'show']); 
    Route::put('{id}', [ComercioController::class, 'update']); 
    Route::delete('{id}', [ComercioController::class, 'destroy']); 
});

Route::prefix('pagos-comercio')->group(function () {
    Route::get('/', [PagoComercioController::class, 'index']); 
    Route::post('/', [PagoComercioController::class, 'store']); 
    Route::get('{id}', [PagoComercioController::class, 'show']);
});

Route::prefix('estacionamientos')->group(function () {
    Route::get('/', [EstacionamientoController::class, 'index']); 
    Route::post('/', [EstacionamientoController::class, 'store']);
    Route::put('{id}', [EstacionamientoController::class, 'update']); 
  
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
