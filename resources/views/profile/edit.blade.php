@extends('layouts.app')

@section('titulo', 'Editar Producto')

@section('contenido')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Editar Producto</h2>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- IMPORTANTE: Método PUT para actualizar -->

        <!-- Nombre -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nombre</label>
            <input type="text" name="nombre" class="w-full border p-2 rounded" value="{{ $producto->nombre }}" required>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Descripción</label>
            <textarea name="descripcion" class="w-full border p-2 rounded" required>{{ $producto->descripcion }}</textarea>
        </div>

        <!-- Precio y Stock -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Precio (€)</label>
                <input type="number" step="0.01" name="precio" class="w-full border p-2 rounded" value="{{ $producto->precio }}" required>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Stock</label>
                <input type="number" name="stock" class="w-full border p-2 rounded" value="{{ $producto->stock }}" required>
            </div>
        </div>

        <!-- Categoría -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Categoría</label>
            <select name="categoria_id" class="w-full border p-2 rounded">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" 
                        {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('productos.index') }}" class="text-gray-500 hover:underline py-2">Cancelar</a>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Actualizar</button>
        </div>
    </form>
</div>
@endsection
