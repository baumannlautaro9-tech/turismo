@extends('layouts.app')

@section('titulo', 'Crear Producto')

@section('contenido')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Nuevo Producto</h2>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf <!-- OBLIGATORIO: Token de seguridad -->

        <!-- Nombre -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nombre</label>
            <input type="text" name="nombre" class="w-full border p-2 rounded" value="{{ old('nombre') }}" required>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Descripción</label>
            <textarea name="descripcion" class="w-full border p-2 rounded" required>{{ old('descripcion') }}</textarea>
        </div>

        <!-- Precio y Stock (en dos columnas) -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Precio (€)</label>
                <input type="number" step="0.01" name="precio" class="w-full border p-2 rounded" value="{{ old('precio') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Stock</label>
                <input type="number" name="stock" class="w-full border p-2 rounded" value="{{ old('stock') }}" required>
            </div>
        </div>

        <!-- Categoría -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Categoría</label>
            <select name="categoria_id" class="w-full border p-2 rounded">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('productos.index') }}" class="text-gray-500 hover:underline py-2">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar Producto</button>
        </div>
    </form>
</div>
@endsection