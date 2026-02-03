@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        
        <!-- Título -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Iniciar Sesión</h2>
            <p class="text-gray-600 mt-2">Accede a tu cuenta</p>
        </div>
        
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
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Correo electrónico
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent @error('email') border-red-500 @enderror"
                    placeholder="tu@email.com"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Contraseña -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Contraseña
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent @error('password') border-red-500 @enderror"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Recordarme -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        class="rounded border-gray-300 text-naranja-primary focus:ring-naranja-primary"
                    >
                    <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                </label>
            </div>
            
            <!-- Botón de envío -->
            <button 
                type="submit" 
                class="w-full bg-naranja-primary hover:bg-naranja-dark text-white font-bold py-3 px-4 rounded-lg transition duration-200"
            >
                Iniciar Sesión
            </button>
        </form>
        
        <!-- Enlaces -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                ¿No tienes cuenta? 
                <a href="{{ route('register') }}" class="text-naranja-primary hover:text-naranja-dark font-medium">
                    Regístrate aquí
                </a>
            </p>
        </div>
    </div>
</div>
@endsection