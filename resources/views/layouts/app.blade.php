<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Turismo Castilla y León')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Configuración naranja personalizado-->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'naranja-primary': '#FF9966',
                        'naranja-light': '#FFB38A',
                        'naranja-dark': '#FF7A33',
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Estilos adicionales*/
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
    
    @yield('extra-css')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    
    <!-- HEADER -->
    <header class="bg-gradient-to-r from-naranja-primary to-naranja-light shadow-md">
        <nav class="container mx-auto px-4 py-2">
            <!-- Navegación superior derecha -->
            <div class="flex justify-end mb-2">
                <div class="flex items-center space-x-6">
                    @auth
                        <a href="{{ route('favoritos.index') }}" class="text-white hover:text-gray-100 transition font-medium text-sm">
                            Mis Favoritos
                        </a>
                        <div class="flex items-center space-x-3">
                            <span class="text-white text-sm">{{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-white text-naranja-primary px-4 py-2 rounded-lg hover:bg-gray-100 transition font-medium text-sm">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-100 transition font-medium text-sm">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-naranja-primary px-4 py-2 rounded-lg hover:bg-gray-100 transition font-medium text-sm">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Logo centrado (más pequeño) -->
            <div class="text-center py-2">
                <a href="{{ route('home') }}" class="inline-block">
                    <img src="{{ asset('images/logo.png') }}" alt="Turismo Castilla y León" class="h-16 w-auto mx-auto">
                </a>
            </div>
        </nav>
    </header>
    
    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>
    
    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Columna 1: Sobre nosotros -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Sobre Nosotros</h3>
                    <p class="text-gray-300 text-sm">
                        Plataforma de turismo de Castilla y León. 
                        Descubre los mejores establecimientos turísticos de la región.
                    </p>
                </div>
                
                <!-- Columna 2: Enlaces rápidos -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition text-sm">
                                Inicio
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="{{ route('favoritos.index') }}" class="text-gray-300 hover:text-white transition text-sm">
                                    Mis Favoritos
                                </a>
                            </li>
                        @endauth
                        <li>
                            <a href="{{ route('contacto') }}" class="text-gray-300 hover:text-white transition text-sm">
                                Contacto
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Columna 3: Contacto -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Contacto</h3>
                    <p class="text-gray-300 text-sm mb-3">
                        ¿Tienes sugerencias o comentarios?
                    </p>
                    <a href="{{ route('contacto') }}" class="inline-block bg-naranja-primary hover:bg-naranja-dark text-white px-6 py-2 rounded-lg transition font-medium text-sm">
                        Enviar mensaje
                    </a>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Turismo Castilla y León. Datos abiertos de la Junta de Castilla y León.
                </p>
            </div>
        </div>
    </footer>
    
    @yield('extra-js')
</body>
</html>
