<?php

use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\VestidoController;
use Illuminate\Support\Facades\Route;

// Rutas públicas (no requieren autenticación)
Route::prefix('')->group(function () {
    
    // Categorías
    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::get('/categorias/{slug}', [CategoriaController::class, 'show']);
    Route::get('/categorias/{slug}/vestidos', [CategoriaController::class, 'vestidos']);
    
    // Vestidos
    Route::get('/vestidos', [VestidoController::class, 'index']);
    Route::get('/vestidos/destacados', [VestidoController::class, 'destacados']);
    Route::get('/vestidos/nuevos', [VestidoController::class, 'nuevos']);
    Route::get('/vestidos/{slug}', [VestidoController::class, 'show']);
    Route::get('/vestidos/{slug}/relacionados', [VestidoController::class, 'relacionados']);
});

// Rutas protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    // Aquí irán las rutas del carrito, pedidos, etc.
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});