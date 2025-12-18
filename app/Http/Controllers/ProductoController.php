<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto; 

use App\Models\Categoria;

class ProductoController extends Controller
{
     public function index()
    {
        // 1. Pedimos todos los productos a la base de datos
        $productos = Producto::all(); 
        
        // 2. Retornamos la vista y le pasamos los datos
        return view('productos.index', ['productos' => $productos]);
    }
    // Muestra el formulario
    public function create()
    {
        if (auth()->user()->rol != 'admin') {
    return redirect()->route('productos.index'); // O abort(403);
}

        // Necesitamos las categorías para el <select>
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    // Guarda el producto en la BBDD
    public function store(Request $request)
    
        {
        // SEGURIDAD: Si no es admin, fuera
        if (auth()->user()->rol != 'admin') {
            return redirect()->route('productos.index');
        }
        // 1. VALIDACIÓN (Requisito de tu rúbrica)
        // Esto comprueba los datos antes de hacer nada. Si falla, vuelve atrás automáticamente.
        $validated = $request->validate([
            'nombre' => 'required|min:3|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id', // Debe existir en la tabla categorias
        ]);

        // 2. CREAR EL PRODUCTO
        // Usamos asignación masiva (Mass Assignment)
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;
        // La imagen la dejamos pendiente para no complicar ahora mismo
        $producto->save();

        // 3. REDIRECCIONAR
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }
}
