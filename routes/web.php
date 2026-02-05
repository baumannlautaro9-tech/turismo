<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EstablecimientoController;
use App\Http\Controllers\FavoritoController;
use Illuminate\Support\Facades\Route;



// PÁGINA PRINCIPAL (Home)

Route::get('/', [EstablecimientoController::class, 'index'])->name('home');


// AUTENTICACIÓN (Login, Register, Logout)


// Mostrar formulario de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Procesar login
Route::post('/login', [AuthController::class, 'login']);

// Mostrar formulario de registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Procesar registro
Route::post('/register', [AuthController::class, 'register']);

// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ESTABLECIMIENTOS
// Ver detalle de un establecimiento
Route::get('/establecimiento/{id}', [EstablecimientoController::class, 'show'])->name('establecimiento.show');

// Buscar establecimientos (API para AJAX)
Route::get('/api/establecimientos/buscar', [EstablecimientoController::class, 'buscar'])->name('establecimientos.buscar');


// FAVORITOS 

Route::middleware('auth')->group(function () {
    
    // Ver mis favoritos
    Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
    
    // Toggle favorito (añadir/quitar)
    Route::post('/favoritos/toggle/{establecimiento}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
    
    // Añadir a favoritos
    Route::post('/favoritos/{establecimiento}', [FavoritoController::class, 'store'])->name('favoritos.store');
    
    // Eliminar de favoritos
    Route::delete('/favoritos/{establecimiento}', [FavoritoController::class, 'destroy'])->name('favoritos.destroy');
});

// CONTACTO

// Mostrar formulario de contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');

// Enviar mensaje de contacto
Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');



// Redirigir /home a la página principal
Route::redirect('/home', '/');