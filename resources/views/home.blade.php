@extends('layouts.app')

@section('title', 'Inicio - Turismo Castilla y León')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    
    <!-- Título  -->
    <div class="text-center mb-6">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Descubre Castilla y León</h1>
        <p class="text-lg text-gray-700">Encuentra los mejores establecimientos turísticos de la región</p>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
        
        <!--  CARRUSEL IZQUIERDO  -->
        <div class="lg:col-span-3 hidden lg:block">
            <div class="relative h-96 rounded-lg overflow-hidden shadow-lg" role="region" aria-label="Carrusel de imágenes izquierdo">
                <!-- Comida -->
                <div class="carousel-item-left active absolute inset-0 transition-opacity duration-700 opacity-100">
                    <img src="{{ asset('images/carousel/comida.jpg') }}" alt="Comida tradicional de Castilla y León" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold mb-2 text-white">Comida Exquisita</h3>
                        <p class="text-sm text-white">Degusta la gastronomía tradicional</p>
                    </div>
                </div>
                <!-- Vino -->
                <div class="carousel-item-left absolute inset-0 transition-opacity duration-700 opacity-0">
                    <img src="{{ asset('images/carousel/vino.jpg') }}" alt="Ruta del vino en Castilla y León" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold mb-2 text-white">Ruta del Vino</h3>
                        <p class="text-sm text-white">Descubre nuestras bodegas centenarias</p>
                    </div>
                </div>
                <!-- Paisaje -->
                <div class="carousel-item-left absolute inset-0 transition-opacity duration-700 opacity-0">
                    <img src="{{ asset('images/carousel/paisaje.jpg') }}" alt="Paisajes naturales de Castilla y León" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold mb-2 text-white">Paisajes Imperdibles</h3>
                        <p class="text-sm text-white">Naturaleza en estado puro</p>
                    </div>
                </div>
                <!-- Indicadores -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    <button class="carousel-indicator-left w-3 h-3 rounded-full bg-white transition-opacity" data-slide="0" aria-label="Ir a slide 1"></button>
                    <button class="carousel-indicator-left w-3 h-3 rounded-full bg-white/50 transition-opacity" data-slide="1" aria-label="Ir a slide 2"></button>
                    <button class="carousel-indicator-left w-3 h-3 rounded-full bg-white/50 transition-opacity" data-slide="2" aria-label="Ir a slide 3"></button>
                </div>
            </div>
        </div>

        <!-- SECCIÓN CENTRAL DE FILTROS-->
        <div class="lg:col-span-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">🔍 Filtrar establecimientos</h2>
                
                <form id="filtrosForm" class="space-y-4">
                    
                    <!-- Filtros Básicos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Filtro: Tipo -->
                        <div>
                            <label for="filtroTipo" class="block text-sm font-medium text-gray-900 mb-2">
                                Tipo de establecimiento
                            </label>
                            <select 
                                name="tipo" 
                                id="filtroTipo" 
                                class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-naranja-primary bg-white text-gray-900"
                            >
                                <option value="">Todos los tipos</option>
                                <option value="Hotel">Hotel</option>
                                <option value="Casa Rural">Casa Rural</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Camping">Camping</option>
                                <option value="Albergue">Albergue</option>
                                <option value="Hostal">Hostal</option>
                            </select>
                        </div>
                        
                        <!-- Filtro: Provincia -->
                        <div>
                            <label for="filtroProvincia" class="block text-sm font-medium text-gray-900 mb-2">
                                Provincia
                            </label>
                            <select 
                                name="provincia" 
                                id="filtroProvincia" 
                                class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-naranja-primary bg-white text-gray-900"
                            >
                                <option value="">Todas las provincias</option>
                                <option value="Ávila">Ávila</option>
                                <option value="Burgos">Burgos</option>
                                <option value="León">León</option>
                                <option value="Palencia">Palencia</option>
                                <option value="Salamanca">Salamanca</option>
                                <option value="Segovia">Segovia</option>
                                <option value="Soria">Soria</option>
                                <option value="Valladolid">Valladolid</option>
                                <option value="Zamora">Zamora</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Toggle Filtros Avanzados -->
                    <div class="border-t pt-4">
                        <button 
                            type="button" 
                            id="toggleAvanzados" 
                            class="text-naranja-dark hover:text-naranja-primary font-medium flex items-center focus:outline-none focus:ring-2 focus:ring-naranja-primary rounded px-2 py-1"
                            aria-expanded="false"
                            aria-controls="filtrosAvanzados"
                        >
                            <svg 
                                id="iconAvanzados" 
                                class="w-5 h-5 mr-2 transform transition-transform duration-200" 
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                            <span id="textoAvanzados">Mostrar filtros avanzados</span>
                        </button>
                    </div>
                    
                    <!-- Filtros Avanzados -->
                    <div id="filtrosAvanzados" class="hidden space-y-4 pt-4 border-t">
                        
                        <!-- Municipio -->
                        <div>
                            <label for="filtroMunicipio" class="block text-sm font-medium text-gray-900 mb-2">
                                Población / Municipio
                            </label>
                            <input 
                                type="text" 
                                name="municipio" 
                                id="filtroMunicipio" 
                                placeholder="Nombre de la población" 
                                class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-naranja-primary bg-white text-gray-900"
                            >
                        </div>
                        
                        <!-- Accesibilidad -->
                        <div>
                            <label for="filtroAccesible" class="block text-sm font-medium text-gray-900 mb-2">
                                Accesibilidad
                            </label>
                            <select 
                                name="accesible" 
                                id="filtroAccesible" 
                                class="w-full px-4 py-2 border border-gray-400 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-naranja-primary bg-white text-gray-900"
                            >
                                <option value="">Todos</option>
                                <option value="1">Solo establecimientos accesibles</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Botones -->
                    <div class="flex gap-3 pt-4">
                        <button 
                            type="submit" 
                            class="flex-1 bg-naranja-dark hover:bg-naranja-primary text-white px-6 py-3 rounded-lg transition font-medium focus:outline-none focus:ring-2 focus:ring-naranja-primary focus:ring-offset-2"
                        >
                            Buscar
                        </button>
                        <button 
                            type="button" 
                            id="btnLimpiar" 
                            class="px-6 py-3 border-2 border-gray-400 rounded-lg hover:bg-gray-100 transition text-gray-900 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                        >
                            Limpiar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- CARRUSEL DERECHO -->
        <div class="lg:col-span-3 hidden lg:block">
            <div class="relative h-96 rounded-lg overflow-hidden shadow-lg" role="region" aria-label="Carrusel de imágenes derecho">
                <!-- Castillo -->
                <div class="carousel-item-right active absolute inset-0 transition-opacity duration-700 opacity-100">
                    <img src="{{ asset('images/carousel/castillo.jpg') }}" alt="Castillos históricos de Castilla y León" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold mb-2 text-white">Castillos Históricos</h3>
                        <p class="text-sm text-white">Viaja al pasado medieval</p>
                    </div>
                </div>
                <!-- Cultura-->
                <div class="carousel-item-right absolute inset-0 transition-opacity duration-700 opacity-0">
                    <img src="{{ asset('images/carousel/cultura.jpg') }}" alt="Cultura y tradición de Castilla y León" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold mb-2 text-white">Cultura y Tradición</h3>
                        <p class="text-sm text-white">Patrimonio de la Humanidad</p>
                    </div>
                </div>
                <!-- aventura -->
                <div class="carousel-item-right absolute inset-0 transition-opacity duration-700 opacity-0">
                    <img src="{{ asset('images/carousel/aventura.jpg') }}" alt="Aventura y deportes en Castilla y León" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold mb-2 text-white">Aventura al Aire Libre</h3>
                        <p class="text-sm text-white">Senderismo y deportes</p>
                    </div>
                </div>
                <!-- Indicadores -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                    <button class="carousel-indicator-right w-3 h-3 rounded-full bg-white transition-opacity" data-slide="0" aria-label="Ir a slide 1"></button>
                    <button class="carousel-indicator-right w-3 h-3 rounded-full bg-white/50 transition-opacity" data-slide="1" aria-label="Ir a slide 2"></button>
                    <button class="carousel-indicator-right w-3 h-3 rounded-full bg-white/50 transition-opacity" data-slide="2" aria-label="Ir a slide 3"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensaje de carga -->
    <div id="loading" class="hidden text-center py-8" role="status" aria-live="polite">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-naranja-primary"></div>
        <p class="mt-4 text-gray-700">Cargando establecimientos...</p>
    </div>
    
    <!-- Resultados -->
    <div id="resultados">
        <div class="mb-6">
            <p class="text-lg text-gray-900 font-medium">
                <span id="totalResultados">{{ $establecimientos->total() }}</span> establecimientos encontrados
            </p>
        </div>
        
        <!-- Grid establecimientos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($establecimientos as $establecimiento)
                <article class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow overflow-hidden">
                    <!-- Cabecera -->
                    <div class="bg-gradient-to-r from-naranja-primary to-naranja-dark p-4">
                        <h3 class="text-white font-bold text-lg mb-1">
                            {{ $establecimiento->nombre }}
                        </h3>
                        <p class="text-white text-sm opacity-95">
                            {{ $establecimiento->tipo ?? 'Sin especificar' }}
                        </p>
                    </div>
                    
                    <!-- Contenido -->
                    <div class="p-4">
                        <div class="space-y-2 mb-4">
                            <p class="text-gray-900 text-sm flex items-start">
                                <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ $establecimiento->municipio }}, {{ $establecimiento->provincia }}</span>
                            </p>
                            
                            @if($establecimiento->categoria)
                                <p class="text-gray-900 text-sm">
                                    <span class="font-semibold">Categoría:</span> {{ $establecimiento->categoria }}
                                </p>
                            @endif
                            
                            @if($establecimiento->plazas)
                                <p class="text-gray-900 text-sm">
                                    <span class="font-semibold">Plazas:</span> {{ $establecimiento->plazas }}
                                </p>
                            @endif
                            
                            @if($establecimiento->accesible)
                                <p class="text-green-700 text-sm font-semibold flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Accesible
                                </p>
                            @endif
                        </div>
                        
                        <!-- Botones -->
                        <div class="flex gap-2">
                            <a 
                                href="{{ route('establecimiento.show', $establecimiento->id) }}" 
                                class="flex-1 bg-naranja-dark hover:bg-naranja-primary text-white text-center px-4 py-2.5 rounded-lg transition font-medium focus:outline-none focus:ring-2 focus:ring-naranja-primary focus:ring-offset-2"
                            >
                                Ver detalles
                            </a>
                            
                            @auth
                                <button 
                                    onclick="toggleFavorito({{ $establecimiento->id }}, this)" 
                                    class="favorito-btn px-4 py-2.5 border-2 border-naranja-dark text-naranja-dark hover:bg-naranja-dark hover:text-white rounded-lg transition focus:outline-none focus:ring-2 focus:ring-naranja-primary focus:ring-offset-2"
                                    data-favorito="{{ Auth::user()->hasFavorito($establecimiento->id) ? 'true' : 'false' }}"
                                    aria-label="{{ Auth::user()->hasFavorito($establecimiento->id) ? 'Quitar de favoritos' : 'Añadir a favoritos' }}"
                                    title="{{ Auth::user()->hasFavorito($establecimiento->id) ? 'Quitar de favoritos' : 'Añadir a favoritos' }}"
                                >
                                    <svg 
                                        class="w-5 h-5" 
                                        fill="{{ Auth::user()->hasFavorito($establecimiento->id) ? 'currentColor' : 'none' }}" 
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24"
                                        aria-hidden="true"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span class="sr-only">{{ Auth::user()->hasFavorito($establecimiento->id) ? 'Quitar de favoritos' : 'Añadir a favoritos' }}</span>
                                </button>
                            @endauth
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-700 text-lg">No se encontraron establecimientos.</p>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if($establecimientos->hasPages())
            <div class="mt-8">
                {{ $establecimientos->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Toast -->
<div id="toast-container" class="fixed top-20 right-4 z-50 space-y-2" aria-live="polite" aria-atomic="true"></div>

@endsection

@section('extra-js')
<script>
// ============================================================================
// CARRUSEL IZQUIERDO
// ============================================================================
let currentSlideLeft = 0;
const itemsLeft = document.querySelectorAll('.carousel-item-left');
const indicatorsLeft = document.querySelectorAll('.carousel-indicator-left');

function showSlideLeft(index) {
    itemsLeft.forEach((item, i) => {
        item.classList.toggle('opacity-100', i === index);
        item.classList.toggle('opacity-0', i !== index);
    });
    indicatorsLeft.forEach((ind, i) => {
        ind.classList.toggle('bg-white', i === index);
        ind.classList.toggle('bg-white/50', i !== index);
    });
}

function nextSlideLeft() {
    currentSlideLeft = (currentSlideLeft + 1) % itemsLeft.length;
    showSlideLeft(currentSlideLeft);
}

indicatorsLeft.forEach((ind, i) => {
    ind.addEventListener('click', () => {
        currentSlideLeft = i;
        showSlideLeft(i);
    });
});

if (itemsLeft.length > 0) {
    setInterval(nextSlideLeft, 5000);
}

// ============================================================================
// CARRUSEL DERECHO
// ============================================================================
let currentSlideRight = 0;
const itemsRight = document.querySelectorAll('.carousel-item-right');
const indicatorsRight = document.querySelectorAll('.carousel-indicator-right');

function showSlideRight(index) {
    itemsRight.forEach((item, i) => {
        item.classList.toggle('opacity-100', i === index);
        item.classList.toggle('opacity-0', i !== index);
    });
    indicatorsRight.forEach((ind, i) => {
        ind.classList.toggle('bg-white', i === index);
        ind.classList.toggle('bg-white/50', i !== index);
    });
}

function nextSlideRight() {
    currentSlideRight = (currentSlideRight + 1) % itemsRight.length;
    showSlideRight(currentSlideRight);
}

indicatorsRight.forEach((ind, i) => {
    ind.addEventListener('click', () => {
        currentSlideRight = i;
        showSlideRight(i);
    });
});

if (itemsRight.length > 0) {
    setTimeout(() => setInterval(nextSlideRight, 5000), 2500);
}

// ============================================================================
// TOGGLE FILTROS AVANZADOS
// ============================================================================
document.getElementById('toggleAvanzados').addEventListener('click', function() {
    const filtros = document.getElementById('filtrosAvanzados');
    const icon = document.getElementById('iconAvanzados');
    const texto = document.getElementById('textoAvanzados');
    const isHidden = filtros.classList.contains('hidden');
    
    filtros.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
    this.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
    texto.textContent = isHidden ? 'Ocultar filtros avanzados' : 'Mostrar filtros avanzados';
});

// ============================================================================
// FILTROS
// ============================================================================
document.getElementById('filtrosForm').addEventListener('submit', function(e) {
    e.preventDefault();
    aplicarFiltros();
});

document.getElementById('btnLimpiar').addEventListener('click', function() {
    document.getElementById('filtrosForm').reset();
    aplicarFiltros();
});

function aplicarFiltros() {
    const form = document.getElementById('filtrosForm');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    
    document.getElementById('loading').classList.remove('hidden');
    document.getElementById('resultados').classList.add('opacity-50');
    
    fetch(`{{ route('home') }}?${params}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newResultados = doc.getElementById('resultados');
        
        document.getElementById('resultados').innerHTML = newResultados.innerHTML;
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('resultados').classList.remove('opacity-50');
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('resultados').classList.remove('opacity-50');
    });
}

// ============================================================================
// FAVORITOS - ACTUALIZACIÓN INMEDIATA
// ============================================================================
function toggleFavorito(establecimientoId, button) {
    button.disabled = true;
    
    fetch(`/favoritos/toggle/${establecimientoId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const svg = button.querySelector('svg');
            const esFavorito = data.is_favorito;
            
            // Actualizar INMEDIATAMENTE
            svg.setAttribute('fill', esFavorito ? 'currentColor' : 'none');
            button.setAttribute('data-favorito', esFavorito ? 'true' : 'false');
            button.setAttribute('aria-label', esFavorito ? 'Quitar de favoritos' : 'Añadir a favoritos');
            button.setAttribute('title', esFavorito ? 'Quitar de favoritos' : 'Añadir a favoritos');
            
            mostrarToast(data.message, 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarToast('Error al procesar favorito', 'error');
    })
    .finally(() => {
        button.disabled = false;
    });
}

// ============================================================================
// TOAST NOTIFICATIONS
// ============================================================================
function mostrarToast(mensaje, tipo = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    const bgColor = tipo === 'success' ? 'bg-green-600' : 'bg-red-600';
    
    toast.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 opacity-0 translate-x-full`;
    toast.textContent = mensaje;
    
    container.appendChild(toast);
    setTimeout(() => toast.classList.remove('opacity-0', 'translate-x-full'), 10);
    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-x-full');
        setTimeout(() => container.removeChild(toast), 300);
    }, 3000);
}
</script>
@endsection