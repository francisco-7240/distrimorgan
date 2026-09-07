<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarritoController;

// Página principal pública
Route::get('/', [HomeController::class, 'index'])->name('home');
// Página Nosotros
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
// Página principal pública
Route::get('/productos', [HomeController::class, 'productos'])->name('productos');
// Página principal pública
Route::get('/servicios', [HomeController::class, 'servicios'])->name('servicios');
// Página principal pública
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('index');
    Route::post('/agregar', [CarritoController::class, 'agregar'])->name('agregar');
    Route::patch('/{productoColorId}', [CarritoController::class, 'actualizar'])->name('actualizar');
    Route::delete('/{productoColorId}', [CarritoController::class, 'eliminar'])->name('eliminar');
    Route::delete('/', [CarritoController::class, 'vaciar'])->name('vaciar');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
