@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        
        <!-- Título -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Contacto</h2>
            <p class="text-gray-600">¿Tienes alguna sugerencia o comentario? Escríbenos</p>
        </div>
        
        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Errores de validación -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Formulario -->
        <form method="POST" action="{{ route('contacto.enviar') }}">
            @csrf
            
            <!-- Nombre -->
            <div class="mb-6">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre completo
                </label>
                <input 
                    type="text" 
                    name="nombre" 
                    id="nombre" 
                    value="{{ old('nombre', Auth::user()->name ?? '') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent @error('nombre') border-red-500 @enderror"
                    placeholder="Tu nombre"
                >
                @error('nombre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Correo electrónico
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email', Auth::user()->email ?? '') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent @error('email') border-red-500 @enderror"
                    placeholder="tu@email.com"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Asunto -->
            <div class="mb-6">
                <label for="asunto" class="block text-sm font-medium text-gray-700 mb-2">
                    Asunto
                </label>
                <select 
                    name="asunto" 
                    id="asunto" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent @error('asunto') border-red-500 @enderror"
                >
                    <option value="">Selecciona un asunto</option>
                    <option value="Sugerencia" {{ old('asunto') == 'Sugerencia' ? 'selected' : '' }}>Sugerencia</option>
                    <option value="Consulta" {{ old('asunto') == 'Consulta' ? 'selected' : '' }}>Consulta</option>
                    <option value="Problema técnico" {{ old('asunto') == 'Problema técnico' ? 'selected' : '' }}>Problema técnico</option>
                    <option value="Actualización de datos" {{ old('asunto') == 'Actualización de datos' ? 'selected' : '' }}>Actualización de datos</option>
                    <option value="Otro" {{ old('asunto') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('asunto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Mensaje -->
            <div class="mb-6">
                <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-2">
                    Mensaje
                </label>
                <textarea 
                    name="mensaje" 
                    id="mensaje" 
                    rows="6"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent @error('mensaje') border-red-500 @enderror"
                    placeholder="Escribe tu mensaje aquí..."
                >{{ old('mensaje') }}</textarea>
                @error('mensaje')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Botones -->
            <div class="flex space-x-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-naranja-primary hover:bg-naranja-dark text-white font-bold py-3 px-6 rounded-lg transition duration-200"
                >
                    Enviar mensaje
                </button>
                <a 
                    href="{{ route('home') }}" 
                    class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-center"
                >
                    Cancelar
                </a>
            </div>
        </form>
        
        <!-- Información adicional -->
        <div class="mt-8 pt-8 border-t">
            <h3 class="font-bold text-gray-800 mb-4">Otras formas de contacto</h3>
            <div class="space-y-3 text-sm text-gray-600">
                <p>
                    <strong>Nota:</strong> Esta plataforma utiliza datos abiertos de la Junta de Castilla y León.
                </p>
                <p>
                    Si necesitas actualizar información de un establecimiento, por favor contacta directamente con la 
                    <a href="https://datosabiertos.jcyl.es/" target="_blank" class="text-naranja-primary hover:text-naranja-dark underline">
                        Dirección General de Turismo de Castilla y León
                    </a>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection