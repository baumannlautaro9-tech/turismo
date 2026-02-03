@extends('layouts.app')

@section('title', 'Inicio - Turismo Castilla y León')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    
    <!-- Hero Section con Carruseles Laterales -->
    <div class="mb-8">
        <!-- Título Central -->
        <div class="text-center mb-6">
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Descubre Castilla y León</h2>
            <p class="text-gray-600">Encuentra los mejores establecimientos turísticos de la región</p>
        </div>

        <!-- Layout con carruseles laterales -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
            
            <!-- CARRUSEL IZQUIERDO -->
            <div class="lg:col-span-3 hidden lg:block">
                <div class="relative h-96 rounded-lg overflow-hidden shadow-lg">
                    <!-- Slide 1 -->
                    <div class="carousel-item active absolute inset-0 transition-opacity duration-700">
                        <img src="{{ asset('images/carousel/comida.jpg') }}" alt="Comida exquisita" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">Comida Exquisita</h3>
                            <p class="text-sm">Degusta la gastronomía tradicional</p>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item absolute inset-0 transition-opacity duration-700 opacity-0">
                        <img src="{{ asset('images/carousel/vino.jpg') }}" alt="Ruta del Vino" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">Ruta del Vino</h3>
                            <p class="text-sm">Descubre nuestras bodegas centenarias</p>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item absolute inset-0 transition-opacity duration-700 opacity-0">
                        <img src="{{ asset('images/carousel/paisaje.jpg') }}" alt="Paisajes imperdibles" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">Paisajes Imperdibles</h3>
                            <p class="text-sm">Naturaleza en estado puro</p>
                        </div>
                    </div>
                    <!-- Indicadores -->
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                        <button class="carousel-indicator w-2 h-2 rounded-full bg-white active" data-slide="0"></button>
                        <button class="carousel-indicator w-2 h-2 rounded-full bg-white/50" data-slide="1"></button>
                        <button class="carousel-indicator w-2 h-2 rounded-full bg-white/50" data-slide="2"></button>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN CENTRAL DE FILTROS -->
            <div class="lg:col-span-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">🔍 Filtrar establecimientos</h3>
                    
                    <form id="filtrosForm" class="space-y-4">
                        
                        <!-- Filtros Básicos -->
                        <div class="grid grid-cols-1 gap-4">
                            
                            <!-- Filtro: Tipo de establecimiento -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de establecimiento</label>
                                <select name="tipo" id="filtroTipo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent">
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">Provincia</label>
                                <select name="provincia" id="filtroProvincia" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent">
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
                            
                            <!-- Filtro: Municipio/Población -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Población</label>
                                <input type="text" name="municipio" id="filtroMunicipio" placeholder="Nombre de la población" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Toggle Filtros Avanzados -->
                        <div class="border-t pt-4">
                            <button type="button" id="toggleAvanzados" class="text-naranja-primary hover:text-naranja-dark font-medium flex items-center">
                                <svg id="iconAvanzados" class="w-5 h-5 mr-2 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                                Filtros avanzados
                            </button>
                        </div>
                        
                        <!-- Filtros Avanzados (colapsables) -->
                        <div id="filtrosAvanzados" class="hidden space-y-4 pt-4 border-t">
                            
                            <!-- Filtro: Accesibilidad -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Accesibilidad</label>
                                <select name="accesible" id="filtroAccesible" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent">
                                    <option value="">Todos</option>
                                    <option value="1">Solo accesibles</option>
                                </select>
                            </div>
                            
                            <!-- Filtro: Categoría -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                                <select name="categoria" id="filtroCategoria" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent">
                                    <option value="">Todas las categorías</option>
                                    <option value="1 estrella">1 estrella</option>
                                    <option value="2 estrellas">2 estrellas</option>
                                    <option value="3 estrellas">3 estrellas</option>
                                    <option value="4 estrellas">4 estrellas</option>
                                    <option value="5 estrellas">5 estrellas</option>
                                </select>
                            </div>
                            
                            <!-- Filtro: Plazas mínimas -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Plazas mínimas</label>
                                <input type="number" name="plazas_min" id="filtroPlazasMin" placeholder="Ej: 10" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Botones -->
                        <div class="flex space-x-2">
                            <button type="submit" class="flex-1 bg-naranja-primary hover:bg-naranja-dark text-white px-6 py-2 rounded-lg transition font-medium">
                                Buscar
                            </button>
                            <button type="button" id="btnLimpiar" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                Limpiar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- CARRUSEL DERECHO -->
            <div class="lg:col-span-3 hidden lg:block">
                <div class="relative h-96 rounded-lg overflow-hidden shadow-lg">
                    <!-- Slide 1 -->
                    <div class="carousel-item-right active absolute inset-0 transition-opacity duration-700">
                        <img src="{{ asset('images/carousel/castillo.jpg') }}" alt="Castillos históricos" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">Castillos Históricos</h3>
                            <p class="text-sm">Viaja al pasado medieval</p>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item-right absolute inset-0 transition-opacity duration-700 opacity-0">
                        <img src="{{ asset('images/carousel/cultura.jpg') }}" alt="Cultura y tradición" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">Cultura y Tradición</h3>
                            <p class="text-sm">Patrimonio de la Humanidad</p>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item-right absolute inset-0 transition-opacity duration-700 opacity-0">
                        <img src="{{ asset('images/carousel/aventura.jpg') }}" alt="Aventura" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">Aventura al Aire Libre</h3>
                            <p class="text-sm">Senderismo y deportes</p>
                        </div>
                    </div>
                    <!-- Indicadores -->
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                        <button class="carousel-indicator-right w-2 h-2 rounded-full bg-white active" data-slide="0"></button>
                        <button class="carousel-indicator-right w-2 h-2 rounded-full bg-white/50" data-slide="1"></button>
                        <button class="carousel-indicator-right w-2 h-2 rounded-full bg-white/50" data-slide="2"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mensaje de carga -->
    <div id="loading" class="hidden text-center py-8">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-naranja-primary"></div>
        <p class="mt-4 text-gray-600">Cargando establecimientos...</p>
    </div>
    
    <!-- Resultados -->
    <div id="resultados">
        <div class="mb-4 flex justify-between items-center">
            <p class="text-gray-600">
                <span id="totalResultados">{{ $establecimientos->total() }}</span> establecimientos encontrados
            </p>
        </div>
        
        <!-- Grid de establecimientos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($establecimientos as $establecimiento)
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
                            
                            @auth
                                <button onclick="toggleFavorito({{ $establecimiento->id }})" class="px-4 py-2 border border-naranja-primary text-naranja-primary hover:bg-naranja-primary hover:text-white rounded-lg transition">
                                    <svg class="w-5 h-5" fill="{{ Auth::user()->hasFavorito($establecimiento->id) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">No se encontraron establecimientos con los filtros seleccionados.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Paginación -->
        <div class="mt-8">
            {{ $establecimientos->links() }}
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
// CARRUSEL IZQUIERDO
let currentSlideLeft = 0;
const carouselItemsLeft = document.querySelectorAll('.carousel-item');
const indicatorsLeft = document.querySelectorAll('.carousel-indicator');

function showSlideLeft(index) {
    carouselItemsLeft.forEach((item, i) => {
        item.classList.toggle('opacity-0', i !== index);
        item.classList.toggle('active', i === index);
    });
    indicatorsLeft.forEach((indicator, i) => {
        indicator.classList.toggle('bg-white', i === index);
        indicator.classList.toggle('bg-white/50', i !== index);
        indicator.classList.toggle('active', i === index);
    });
}

function nextSlideLeft() {
    currentSlideLeft = (currentSlideLeft + 1) % carouselItemsLeft.length;
    showSlideLeft(currentSlideLeft);
}

// Indicadores clicables
indicatorsLeft.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
        currentSlideLeft = index;
        showSlideLeft(currentSlideLeft);
    });
});

// Auto-avanzar cada 5 segundos
setInterval(nextSlideLeft, 5000);

// CARRUSEL DERECHO
let currentSlideRight = 0;
const carouselItemsRight = document.querySelectorAll('.carousel-item-right');
const indicatorsRight = document.querySelectorAll('.carousel-indicator-right');

function showSlideRight(index) {
    carouselItemsRight.forEach((item, i) => {
        item.classList.toggle('opacity-0', i !== index);
        item.classList.toggle('active', i === index);
    });
    indicatorsRight.forEach((indicator, i) => {
        indicator.classList.toggle('bg-white', i === index);
        indicator.classList.toggle('bg-white/50', i !== index);
        indicator.classList.toggle('active', i === index);
    });
}

function nextSlideRight() {
    currentSlideRight = (currentSlideRight + 1) % carouselItemsRight.length;
    showSlideRight(currentSlideRight);
}

// Indicadores clicables
indicatorsRight.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
        currentSlideRight = index;
        showSlideRight(currentSlideRight);
    });
});

// Auto-avanzar cada 5 segundos (ligeramente desfasado del izquierdo)
setTimeout(() => {
    setInterval(nextSlideRight, 5000);
}, 2500);

// Toggle filtros avanzados
document.getElementById('toggleAvanzados').addEventListener('click', function() {
    const filtrosAvanzados = document.getElementById('filtrosAvanzados');
    const icon = document.getElementById('iconAvanzados');
    
    filtrosAvanzados.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
});

// Filtros con AJAX
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
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
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

// Toggle favorito
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