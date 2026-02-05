@extends('layouts.app')

@section('title', $establecimiento->nombre)

@section('content')
<div class="max-w-4xl mx-auto">
    
    <!-- Botón volver -->
    <div class="mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center text-naranja-primary hover:text-naranja-dark transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver al listado
        </a>
    </div>
    
    <!-- Tarjeta principal del establecimiento -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        
        <!-- Cabecera -->
        <div class="bg-gradient-to-r from-naranja-primary to-naranja-light p-8">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h1 class="text-white text-3xl font-bold mb-2">{{ $establecimiento->nombre }}</h1>
                    <p class="text-white text-lg opacity-90">{{ $establecimiento->tipo ?? 'Sin especificar' }}</p>
                    @if($establecimiento->categoria)
                        <p class="text-white text-sm mt-1">{{ $establecimiento->categoria }}</p>
                    @endif
                </div>
                
                @auth
                    <button onclick="toggleFavorito({{ $establecimiento->id }})" class="bg-white hover:bg-gray-100 text-naranja-primary px-6 py-3 rounded-lg transition flex items-center space-x-2">
                        <svg class="w-6 h-6" fill="{{ Auth::user()->hasFavorito($establecimiento->id) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="font-medium">
                            {{ Auth::user()->hasFavorito($establecimiento->id) ? 'Quitar de favoritos' : 'Añadir a favoritos' }}
                        </span>
                    </button>
                @endauth
            </div>
        </div>
        
        <!-- Contenido -->
        <div class="p-8">
            
            <!-- Información general -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                
                <!-- Columna izquierda: Ubicación -->
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-naranja-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Ubicación
                    </h2>
                    <div class="space-y-2">
                        @if($establecimiento->direccion)
                            <p class="text-gray-700">
                                <span class="font-medium">Dirección:</span><br>
                                {{ $establecimiento->direccion }}
                            </p>
                        @endif
                        @if($establecimiento->c_postal)
                            <p class="text-gray-700">
                                <span class="font-medium">Código Postal:</span> {{ $establecimiento->c_postal }}
                            </p>
                        @endif
                        @if($establecimiento->localidad)
                            <p class="text-gray-700">
                                <span class="font-medium">Localidad:</span> {{ $establecimiento->localidad }}
                            </p>
                        @endif
                        <p class="text-gray-700">
                            <span class="font-medium">Municipio:</span> {{ $establecimiento->municipio }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-medium">Provincia:</span> {{ $establecimiento->provincia }}
                        </p>
                    </div>
                </div>
                
                <!-- Columna derecha: Características -->
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-naranja-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Características
                    </h2>
                    <div class="space-y-2">
                        @if($establecimiento->plazas)
                            <p class="text-gray-700">
                                <span class="font-medium">Plazas disponibles:</span> {{ $establecimiento->plazas }}
                            </p>
                        @endif
                        
                        <p class="text-gray-700">
                            <span class="font-medium">Accesibilidad:</span> 
                            @if($establecimiento->accesible)
                                <span class="text-green-600 font-medium">✓ Accesible para personas con discapacidad</span>
                            @else
                                <span class="text-gray-500">No especificado</span>
                            @endif
                        </p>
                        
                        @if($establecimiento->n_registro)
                            <p class="text-gray-600 text-sm">
                                <span class="font-medium">Nº Registro:</span> {{ $establecimiento->n_registro }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Contacto -->
            @if($establecimiento->telefono_1 || $establecimiento->email || $establecimiento->web)
                <div class="border-t pt-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-naranja-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Contacto
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if($establecimiento->telefono_1)
                            <div class="flex items-center space-x-3">
                                <div class="bg-naranja-primary bg-opacity-10 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-naranja-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Teléfono</p>
                                    <a href="tel:{{ $establecimiento->telefono_1 }}" class="text-gray-800 hover:text-naranja-primary">
                                        {{ $establecimiento->telefono_1 }}
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        @if($establecimiento->email)
                            <div class="flex items-center space-x-3">
                                <div class="bg-naranja-primary bg-opacity-10 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-naranja-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Email</p>
                                    <a href="mailto:{{ $establecimiento->email }}" class="text-gray-800 hover:text-naranja-primary break-all">
                                        {{ $establecimiento->email }}
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        @if($establecimiento->web)
                            <div class="flex items-center space-x-3">
                                <div class="bg-naranja-primary bg-opacity-10 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-naranja-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Sitio web</p>
                                    <a href="{{ $establecimiento->web_url }}" target="_blank" class="text-gray-800 hover:text-naranja-primary break-all">
                                        Visitar web
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            
            <!-- Mapa  -->
            @if($establecimiento->tiene_coordenadas)
                <div class="border-t pt-8 mt-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Ubicación en el mapa</h2>
                    <div class="bg-gray-200 rounded-lg overflow-hidden" style="height: 400px;">
                        <iframe 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0" 
                            marginwidth="0" 
                            src="https://www.openstreetmap.org/export/embed.html?bbox={{ $establecimiento->gps_longitud-0.01 }}%2C{{ $establecimiento->gps_latitud-0.01 }}%2C{{ $establecimiento->gps_longitud+0.01 }}%2C{{ $establecimiento->gps_latitud+0.01 }}&layer=mapnik&marker={{ $establecimiento->gps_latitud }}%2C{{ $establecimiento->gps_longitud }}"
                        ></iframe>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
function toggleFavorito(establecimientoId) {
    fetch(`/favoritos/toggle/${establecimientoId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection