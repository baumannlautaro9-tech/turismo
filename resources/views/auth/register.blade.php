@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        
        <!-- Título -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Crear Cuenta</h2>
            <p class="text-gray-600 mt-2">Regístrate para guardar tus favoritos</p>
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
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Nombre -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre completo
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Juan Pérez"
                >
                @error('name')
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
                    value="{{ old('email') }}"
                    required
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
                    placeholder="Mínimo 8 caracteres"
                >
                <p class="mt-1 text-xs text-gray-500">Mínimo 8 caracteres</p>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Confirmar contraseña -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmar contraseña
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent"
                    placeholder="Repite tu contraseña"
                >
            </div>
            
            <!-- Captcha simple (matemático) -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Verifica que eres humano
                </label>
                <div class="flex items-center space-x-3">
                    <span class="text-lg font-medium text-gray-700" id="captchaQuestion"></span>
                    <input 
                        type="number" 
                        name="captcha_answer" 
                        id="captcha_answer" 
                        required
                        class="w-24 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-naranja-primary focus:border-transparent"
                        placeholder="?"
                    >
                </div>
                <input type="hidden" name="captcha_result" id="captcha_result">
                @error('captcha_answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Botón de envío -->
            <button 
                type="submit" 
                class="w-full bg-naranja-primary hover:bg-naranja-dark text-white font-bold py-3 px-4 rounded-lg transition duration-200"
            >
                Registrarse
            </button>
        </form>
        
        <!-- Enlaces -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" class="text-naranja-primary hover:text-naranja-dark font-medium">
                    Inicia sesión aquí
                </a>
            </p>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
// Generar captcha matemático simple
function generarCaptcha() {
    const num1 = Math.floor(Math.random() * 10) + 1;
    const num2 = Math.floor(Math.random() * 10) + 1;
    const resultado = num1 + num2;
    
    document.getElementById('captchaQuestion').textContent = `¿Cuánto es ${num1} + ${num2}?`;
    document.getElementById('captcha_result').value = resultado;
}

// Generar captcha al cargar la página
generarCaptcha();

// Validar antes de enviar
document.querySelector('form').addEventListener('submit', function(e) {
    const respuesta = parseInt(document.getElementById('captcha_answer').value);
    const resultado = parseInt(document.getElementById('captcha_result').value);
    
    if (respuesta !== resultado) {
        e.preventDefault();
        alert('La respuesta al captcha es incorrecta. Por favor, inténtalo de nuevo.');
        generarCaptcha();
        document.getElementById('captcha_answer').value = '';
    }
});
</script>
@endsection