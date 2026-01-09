@extends('layouts.app')

@section('titulo', 'Mi Carrito')

@section('contenido')
    <h1 class="text-3xl font-bold mb-6">🛒 Tu Carrito de Compra</h1>

    <!-- Comprobamos si hay cosas en el carrito -->
    @if(session('carrito') && count(session('carrito')) > 0)
        
        <div class="bg-white rounded shadow overflow-hidden">
            <!-- Tabla de productos -->
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4">Producto</th>
                        <th class="p-4">Precio</th>
                        <th class="p-4">Cantidad</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach(session('carrito') as $id => $detalles)
                        @php $total += $detalles['precio'] * $detalles['cantidad'] @endphp
                        <tr class="border-b">
                            <td class="p-4 font-bold flex items-center gap-4">
                                <!-- Si tuviéramos imagen, iría aquí -->
                                {{ $detalles['nombre'] }}
                            </td>
                            <td class="p-4">{{ $detalles['precio'] }} €</td>
                            <td class="p-4">{{ $detalles['cantidad'] }}</td>
                            <td class="p-4">{{ $detalles['precio'] * $detalles['cantidad'] }} €</td>
                            <td class="p-4">
                                <a href="{{ route('carrito.delete', $id) }}" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i> Borrar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- ZONA DEL TOTAL Y BOTÓN TRAMITAR -->
            <div class="p-6 flex justify-between items-center bg-gray-50 border-t">
                <span class="text-2xl font-bold text-gray-800">Total: {{ $total }} €</span>
                
                <!-- AQUÍ ESTÁ EL BOTÓN -->
                <a href="{{ route('carrito.confirmar') }}" class="bg-green-600 text-white px-6 py-3 rounded font-bold hover:bg-green-700 transition shadow-lg">
                    Tramitar Pedido <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

    @else
        <!-- Carrito Vacío -->
        <div class="text-center py-16 bg-white rounded shadow">
            <div class="text-6xl text-gray-300 mb-4">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <p class="text-xl text-gray-500 mb-6">Tu carrito está vacío.</p>
            <a href="{{ route('productos.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition">
                Volver a la tienda
            </a>
        </div>
    @endif
@endsection