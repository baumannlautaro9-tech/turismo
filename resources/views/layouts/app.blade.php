<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Deportes - @yield('titulo')</title>
    
    <!-- Scripts y Estilos (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

 
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold flex items-center gap-2">
                <i class="fas fa-running"></i> DAW Sports
            </a>

            <!-- Catalogo -->
            <div class="flex items-center gap-6">
                <a href="{{ route('productos.index') }}" class="hover:text-blue-300 transition">Catálogo</a>
                <div class="relative group">
    <button class="flex items-center gap-1 hover:text-blue-300 transition focus:outline-none py-2">
        Categorías <i class="fas fa-chevron-down text-xs"></i>
    </button>
    
    <!-- Menú desplegable -->
    <div class="absolute left-0 mt-0 w-48 bg-white text-gray-800 rounded shadow-xl hidden group-hover:block z-50">
        @php
            //  cargar categorías en el menú
            $categoriasMenu = \App\Models\Categoria::all();
        @endphp

        @foreach($categoriasMenu as $cat)
            <!-- Enlace a cada categoría-->
            <a href="{{ route('categorias.show', $cat->id) }}" class="block px-4 py-2 hover:bg-blue-100 transition border-b border-gray-100">
                {{ $cat->nombre }}
            </a>
        @endforeach
    </div>
</div>
               <!-- Carrito Dinámico -->
@php
    $totalCarrito = 0;
    if(session('carrito')) {
        foreach(session('carrito') as $id => $details) {
            $totalCarrito += $details['precio'] * $details['cantidad'];
        }
    }
@endphp

<a href="{{ route('carrito.index') }}" class="bg-blue-600 px-4 py-2 rounded-full hover:bg-blue-500 transition flex items-center gap-2">
    <i class="fas fa-shopping-cart"></i> 
    <span class="font-bold">{{ $totalCarrito }} €</span>
</a>

                <!-- Login -->
                <div class="border-l border-blue-600 pl-6 ml-2">
                    @auth
                        <!-- Si esta logueado -->
                        <span class="text-sm mr-2">Hola, {{ Auth::user()->name }}</span>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs bg-red-500 px-2 py-1 rounded hover:bg-red-600 transition">
                                Salir
                            </button>
                        </form>
                   @else
           <!-- Si no lo esta-->
         <div class="flex items-center gap-4">
          <a href="{{ route('login') }}" class="text-gray-200 hover:text-white transition">
            Iniciar Sesión
         </a>
        
          <a href="{{ route('register') }}" class="bg-white text-blue-800 px-4 py-2 rounded font-bold hover:bg-gray-200 transition">
            Registrarse
          </a>
    </div>
   @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="container mx-auto px-4 py-8 flex-grow">
        <!-- Aquí se muestran los mensajes de éxito (verde) -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('contenido')
    </main>

    <!-- PIE DE PÁGINA -->
    <footer class="bg-gray-900 text-gray-400 py-6 text-center mt-auto">
        <p>&copy; {{ date('Y') }} Tienda de Deportes DAW. Proyecto de clase.</p>
    </footer>

</body>
</html>
