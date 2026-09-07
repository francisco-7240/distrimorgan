<?php

use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

// --- Añade estas rutas a tu routes/web.php ---

Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('index');
    Route::post('/agregar', [CarritoController::class, 'agregar'])->name('agregar');
    Route::patch('/{productoColorId}', [CarritoController::class, 'actualizar'])->name('actualizar');
    Route::delete('/{productoColorId}', [CarritoController::class, 'eliminar'])->name('eliminar');
    Route::delete('/', [CarritoController::class, 'vaciar'])->name('vaciar');
});
