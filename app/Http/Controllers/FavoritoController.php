<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    /**
     * Constructor - Requiere autenticación
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar favoritos del usuario
     */
    public function index()
    {
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
        $establecimiento = Establecimiento::findOrFail($establecimientoId);
        
        Auth::user()->addFavorito($establecimientoId);

        return back()->with('success', 'Añadido a favoritos correctamente.');
    }

    /**
     * Eliminar de favoritos
     */
    public function destroy($establecimientoId)
    {
        Auth::user()->removeFavorito($establecimientoId);

        return back()->with('success', 'Eliminado de favoritos correctamente.');
    }
}
