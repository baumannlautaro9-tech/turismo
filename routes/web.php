<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;

Route::get('/', [ProductoController::class, 'welcome'])->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('productos.index');
})->name('dashboard');

// Rutas publicas
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/categorias/{categoria}', [ProductoController::class, 'mostrarPorCategoria'])->name('categorias.show');
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::get('/carrito/agregar/{id}', [CarritoController::class, 'add'])->name('carrito.add');
Route::get('/carrito/borrar/{id}', [CarritoController::class, 'delete'])->name('carrito.delete');
// Rutas privadas
Route::middleware(['auth'])->group(function () {

    // Comprar
     Route::get('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
    
    // Crear
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    
    // Editar 
    Route::get('/productos/{producto}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    
    // Borrar 
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

require __DIR__.'/auth.php';;