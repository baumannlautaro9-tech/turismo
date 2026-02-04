<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    /**
     * Mostrar favoritos del usuario
     */
    public function index()
    {
        // Verificar autenticación manualmente
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para ver tus favoritos.');
        }

        $favoritos = Auth::user()->favoritos()
            ->orderBy('nombre', 'asc')
            ->paginate(15);

        return view('favoritos.index', compact('favoritos'));
    }

    /**
     * Añadir/eliminar favorito (toggle)
     */
    public function toggle($establecimientoId)
    {
        // Verificar autenticación
        if (!Auth::check()) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Debes iniciar sesión'
                ], 401);
            }
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para añadir favoritos.');
        }

        $establecimiento = Establecimiento::findOrFail($establecimientoId);
        
        $esFavorito = Auth::user()->toggleFavorito($establecimientoId);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'is_favorito' => $esFavorito,
                'message' => $esFavorito 
                    ? 'Añadido a favoritos' 
                    : 'Eliminado de favoritos'
            ]);
        }

        return back()->with('success', $esFavorito 
            ? 'Añadido a favoritos correctamente.' 
            : 'Eliminado de favoritos correctamente.'
        );
    }

    /**
     * Añadir a favoritos
     */
    public function store($establecimientoId)
    {
        // Verificar autenticación
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para añadir favoritos.');
        }

        $establecimiento = Establecimiento::findOrFail($establecimientoId);
        
        Auth::user()->addFavorito($establecimientoId);

        return back()->with('success', 'Añadido a favoritos correctamente.');
    }

    /**
     * Eliminar de favoritos
     */
    public function destroy($establecimientoId)
    {
        // Verificar autenticación
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión.');
        }

        Auth::user()->removeFavorito($establecimientoId);

        return back()->with('success', 'Eliminado de favoritos correctamente.');
    }
}