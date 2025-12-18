<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('productos.index');
})->name('dashboard');

// 1. RUTA PÚBLICA
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

// 2. RUTAS PRIVADAS
Route::middleware(['auth'])->group(function () {
    
    // Crear
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    
    // Editar (Añade esto para que no de error la vista)
    Route::get('/productos/{producto}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    
    // Borrar (Añade esto también)
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

require __DIR__.'/auth.php';;