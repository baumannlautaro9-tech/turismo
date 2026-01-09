<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;       // <--- CAMBIADO A ESPAÑOL
use App\Models\LineaPedido;  // <--- CAMBIADO A ESPAÑOL
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    public function add($id)
    {
        $producto = Producto::find($id);
        if(!$producto) abort(404);

        $carrito = session()->get('carrito', []);

        if(isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                "nombre" => $producto->nombre,
                "cantidad" => 1,
                "precio" => $producto->precio,
                "imagen" => $producto->imagen
            ];
        }
        session()->put('carrito', $carrito);
        return redirect()->back()->with('success', 'Producto añadido');
    }

    public function delete($id)
    {
        $carrito = session()->get('carrito');
        if(isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        return redirect()->back()->with('success', 'Producto eliminado');
    }

    // CONFIRMAR PEDIDO (VERSIÓN ESPAÑOL)
    public function confirmar()
    {
        if(!Auth::check()) return redirect()->route('login');

        $carrito = session()->get('carrito');
        if(!$carrito || count($carrito) == 0) return redirect()->route('productos.index');

        $total = 0;
        foreach($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        DB::transaction(function () use ($total, $carrito) {
            
            // 1. Crear Pedido
            $pedido = Pedido::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'estado' => 'pagado',
            ]);

            // 2. Crear Líneas
            foreach($carrito as $idProducto => $item) {
                LineaPedido::create([
                    'pedido_id' => $pedido->id, 
                    'producto_id' => $idProducto,
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio']
                ]);
            }
        });

        session()->forget('carrito');
        return redirect()->route('productos.index')->with('success', '¡Pedido realizado con éxito!');
    }
}