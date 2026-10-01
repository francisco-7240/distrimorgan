<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\UserController;

// Página principal pública
Route::get('/', [HomeController::class, 'index'])->name('home');
// Página Nosotros
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
// Página para mostrar todos los productos
Route::get('/productos/sugerencias', [ProductoController::class, 'suggestions'])->name('productos.sugerencias');
Route::get('/productos', [ProductoController::class, 'show'])->name('productos.catalogo');
Route::get('/producto/{producto}/{slug}', [ProductoController::class, 'detail'])->name('producto.detalle');
// Página principal pública
Route::get('/servicios', [HomeController::class, 'servicios'])->name('servicios');
// Página principal pública
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [HomeController::class, 'guardarContacto'])->name('contacto.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas para el carrito de compras
Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('index');
    Route::post('/productos', [CarritoController::class, 'productos'])->name('productos');

    Route::post('/agregar', [CarritoController::class, 'agregar'])->name('agregar');
    Route::patch('/{productoColorId}', [CarritoController::class, 'actualizar'])->name('actualizar');
    Route::delete('/{productoColorId}', [CarritoController::class, 'eliminar'])->name('eliminar');
    Route::delete('/', [CarritoController::class, 'vaciar'])->name('vaciar');
});

// Grupo de rutas del panel de administración
Route::prefix('dashboard')->group(function () {

    // Administrador y Editor
    Route::middleware(['auth'])->group(function () {
        Route::resource('productos', ProductoController::class);
        Route::resource('usuarios', UserController::class)->except(['show', 'destroy']);
        Route::resource('categorias', CategoriaController::class)->except('show');
        Route::resource('marcas', MarcaController::class)->except('show');
        Route::resource('colores', ColorController::class)
            ->except('show')
            ->parameters(['colores' => 'color']);
        Route::get('/contactos', [ContactoController::class, 'index'])->name('contactos.index');
        Route::patch('/contactos/{contacto}/estado', [ContactoController::class, 'updateEstado'])->name('contactos.estado');
    });

});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
