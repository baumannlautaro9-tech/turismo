<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto; 

use App\Models\Categoria;

class ProductoController extends Controller
{
     public function index()
    {
       
        $productos = Producto::all(); 
        
        
        return view('productos.index', ['productos' => $productos]);
    }
    
    public function create()
    {
        if (auth()->user()->rol != 'admin') {
    return redirect()->route('productos.index'); 
}

        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

   
    public function store(Request $request)
    
        {
        
        if (auth()->user()->rol != 'admin') {
            return redirect()->route('productos.index');
        }
      
        $validated = $request->validate([
            'nombre' => 'required|min:3|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id', 
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();

    
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }


    //  Formulario de edicion
    public function edit($id)
    {
        // SEGURIDAD
        if (auth()->user()->rol != 'admin') {
            return redirect()->route('productos.index');
        }

        $producto = Producto::find($id);
        $categorias = Categoria::all(); 
        
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar en Base de Datos
    public function update(Request $request, $id)
    {
        // SEGURIDAD
        if (auth()->user()->rol != 'admin') {
            return redirect()->route('productos.index');
        }

        // Validación
        $request->validate([
            'nombre' => 'required|min:3',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'required',
        ]);

        // Actualizar
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;
        
        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado');
    }

    //  Borrar Producto
    public function destroy($id)
    {
        // Seguridad
        if (auth()->user()->rol != 'admin') {
            return redirect()->route('productos.index');
        }

        $producto = Producto::find($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado');
    }
    // Función para la página de inicio (Home)
    public function welcome()
    {
        //Productos mas vendidos
        $productos = Producto::inRandomOrder()->take(6)->get();
        
        return view('welcome', compact('productos'));
    }
    // Filtrar productos por categoría
    public function mostrarPorCategoria(Categoria $categoria)
    {
        
        $productos = $categoria->products; 
        
        
        return view('productos.index', compact('productos'));
    }
}
