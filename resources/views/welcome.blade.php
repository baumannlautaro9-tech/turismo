@extends('layouts.app')

@section('titulo', 'Página Principal')

@section('contenido')
    <!-- Banner de Bienvenida -->
    <div class="bg-blue-600 text-white rounded-lg p-10 mb-10 text-center shadow-lg">
        <h1 class="text-4xl font-bold mb-4">Bienvenido a DAW Sports</h1>
        <p class="text-xl mb-6">El mejor equipamiento deportivo al mejor precio.</p>
        <a href="{{ route('productos.index') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full font-bold hover:bg-gray-100 transition">
            Ver Catálogo Completo
        </a>
    </div>

    <!-- Sección Productos Destacados -->
    <h2 class="text-3xl font-bold mb-6 text-gray-800">🔥 Productos Más Vendidos</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($productos as $producto)
            <div class="bg-white border rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500 text-4xl"><i class="fas fa-star"></i></span>
                </div>
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2">{{ $producto->nombre }}</h3>
                    <p class="text-gray-600 text-sm mb-4 truncate">{{ $producto->descripcion }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-blue-600">{{ $producto->precio }} €</span>
                        <a href="#" class="text-blue-600 hover:underline">Ver</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection