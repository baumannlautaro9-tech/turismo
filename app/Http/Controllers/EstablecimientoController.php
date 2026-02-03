<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use Illuminate\Http\Request;

class EstablecimientoController extends Controller
{
    /**
     * Mostrar listado de establecimientos (página principal)
     */
    public function index(Request $request)
    {
        $query = Establecimiento::query();

        // Filtro por provincia
        if ($request->filled('provincia')) {
            $query->where('provincia', $request->provincia);
        }

        // Filtro por tipo
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Filtro por accesibilidad
        if ($request->filled('accesible')) {
            $query->where('accesible', true);
        }

        // Ordenar por nombre
        $query->orderBy('nombre', 'asc');

        // Paginar resultados (15 por página)
        $establecimientos = $query->paginate(15);

        return view('home', compact('establecimientos'));
    }

    /**
     * Mostrar detalle de un establecimiento
     */
    public function show($id)
    {
        $establecimiento = Establecimiento::findOrFail($id);

        return view('establecimiento.show', compact('establecimiento'));
    }

    /**
     * Buscar establecimientos (API para AJAX)
     */
    public function buscar(Request $request)
    {
        $query = Establecimiento::query();

        // Búsqueda por nombre
        if ($request->filled('q')) {
            $query->where('nombre', 'like', '%' . $request->q . '%');
        }

        // Filtros adicionales
        if ($request->filled('provincia')) {
            $query->where('provincia', $request->provincia);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('accesible')) {
            $query->where('accesible', true);
        }

        $establecimientos = $query->limit(10)->get();

        return response()->json($establecimientos);
    }
}