<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Deportes - @yield('titulo')</title>
    
    <!-- Scripts y Estilos (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- MENÚ DE NAVEGACIÓN -->
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold flex items-center gap-2">
                <i class="fas fa-running"></i> DAW Sports
            </a>

            <!-- Parte Derecha: Enlaces y Usuario -->
            <div class="flex items-center gap-6">
                <a href="{{ route('productos.index') }}" class="hover:text-blue-300 transition">Catálogo</a>
                
                <!-- Carrito (Simulado) -->
                <a href="#" class="bg-blue-600 px-4 py-2 rounded-full hover:bg-blue-500 transition flex items-center gap-2">
                    <i class="fas fa-shopping-cart"></i> 
                    <span class="font-bold">0 €</span>
                </a>

                <!-- ZONA DE LOGIN / USUARIO (Aquí estaba el error) -->
                <div class="border-l border-blue-600 pl-6 ml-2">
                    @auth
                        <!-- SOLO SI ESTÁ LOGUEADO -->
                        <span class="text-sm mr-2">Hola, {{ Auth::user()->name }}</span>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs bg-red-500 px-2 py-1 rounded hover:bg-red-600 transition">
                                Salir
                            </button>
                        </form>
                    @else
                        <!-- SI NO ESTÁ LOGUEADO -->
                        <a href="{{ route('login') }}" class="text-sm hover:underline mr-4">Entrar</a>
                        <a href="{{ route('register') }}" class="text-sm hover:underline">Registro</a>
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
