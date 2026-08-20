<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Página principal pública
Route::get('/', [HomeController::class, 'index'])->name('home');
// Página Nosotros
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
// Página principal pública
Route::get('/marcas', [HomeController::class, 'index'])->name('marcas');
// Página principal pública
Route::get('/productos', [HomeController::class, 'index'])->name('productos');
// Página principal pública
Route::get('/servicios', [HomeController::class, 'index'])->name('servicios');
// Página principal pública
Route::get('/contacto', [HomeController::class, 'index'])->name('contacto');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
