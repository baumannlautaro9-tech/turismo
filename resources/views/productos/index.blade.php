@extends('layouts.app')

@section('titulo', 'Catálogo de Productos')

@section('contenido')
    <!-- Encabezado y Botón Crear -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Nuestros Productos</h1>

        <!-- Comprobamos si está logueado Y ADEMÁS es admin -->
        @if(Auth::check() && Auth::user()->rol == 'admin')
            <a href="{{ route('productos.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                <i class="fas fa-plus"></i> Añadir Producto
            </a>
        @endif
    </div>

    <!-- Rejilla de productos -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Bucle Foreach de Blade -->
        @foreach($productos as $producto)
            <div class="bg-white border rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                <!-- Imagen (Simulada por ahora) -->
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">Imagen</span>
                </div>
                
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $producto->nombre }}</h2>
                    <p class="text-gray-600 text-sm mb-4 truncate">{{ $producto->descripcion }}</p>
                    
                    <!-- Bloque de Precio y Botones -->
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-xl font-bold text-blue-600">{{ $producto->precio }} €</span>

                        <div class="flex gap-2">
                            <!-- Botón Ver (Para todo el mundo) -->
                            <button class="bg-gray-200 text-gray-700 px-3 py-1 rounded text-sm hover:bg-gray-300">
                                Ver
                            </button>

                            <!-- BOTONES ADMIN (Amarillo y Rojo) -->
                            <!-- Solo se ven si estás logueado y eres admin -->
                            @if(Auth::check() && Auth::user()->rol == 'admin')
                                
                                <!-- Editar -->
                                <a href="{{ route('productos.edit', $producto->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Borrar -->
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Borrar producto?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-2 text-xs text-gray-500">
                        Stock: {{ $producto->stock }}
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection