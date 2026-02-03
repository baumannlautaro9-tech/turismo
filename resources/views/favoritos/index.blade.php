@extends('layouts.app')

@section('title', 'Mis Favoritos')

@section('content')
<div class="max-w-7xl mx-auto">
    
    <!-- Título -->
    <div class="mb-8">
        <h2 class="text-4xl font-bold text-gray-800 mb-2">Mis Favoritos</h2>
        <p class="text-gray-600">Tus establecimientos guardados</p>
    </div>
    
    <!-- Contenido -->
    @if($favoritos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($favoritos as $establecimiento)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
                    <!-- Cabecera de la tarjeta -->
                    <div class="bg-gradient-to-r from-naranja-primary to-naranja-light p-4">
                        <h3 class="text-white font-bold text-lg truncate">
                            {{ $establecimiento->nombre }}
                        </h3>
                        <p class="text-white text-sm opacity-90">
                            {{ $establecimiento->tipo ?? 'Sin especificar' }}
                        </p>
                    </div>
                    
                    <!-- Contenido de la tarjeta -->
                    <div class="p-4">
                        <div class="space-y-2 mb-4">
                            <p class="text-gray-600 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $establecimiento->municipio }}, {{ $establecimiento->provincia }}
                            </p>
                            
                            @if($establecimiento->categoria)
                                <p class="text-gray-600 text-sm">
                                    <span class="font-medium">Categoría:</span> {{ $establecimiento->categoria }}
                                </p>
                            @endif
                            
                            @if($establecimiento->plazas)
                                <p class="text-gray-600 text-sm">
                                    <span class="font-medium">Plazas:</span> {{ $establecimiento->plazas }}
                                </p>
                            @endif
                            
                            @if($establecimiento->accesible)
                                <p class="text-green-600 text-sm font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Accesible
                                </p>
                            @endif
                        </div>
                        
                        <!-- Botones de acción -->
                        <div class="flex space-x-2">
                            <a href="{{ route('establecimiento.show', $establecimiento->id) }}" class="flex-1 bg-naranja-primary hover:bg-naranja-dark text-white text-center px-4 py-2 rounded-lg transition font-medium text-sm">
                                Ver detalles
                            </a>
                            
                            <form action="{{ route('favoritos.destroy', $establecimiento->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Paginación -->
        <div class="mt-8">
            {{ $favoritos->links() }}
        </div>
        
    @else
        <!-- Sin favoritos -->
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">No tienes favoritos todavía</h3>
            <p class="text-gray-600 mb-6">Explora establecimientos y guarda tus preferidos</p>
            <a href="{{ route('home') }}" class="inline-block bg-naranja-primary hover:bg-naranja-dark text-white px-6 py-3 rounded-lg transition font-medium">
                Explorar establecimientos
            </a>
        </div>
    @endif
</div>
@endsection