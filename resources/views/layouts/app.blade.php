<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Receitas')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css') {{-- Vite com Tailwind --}}
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- NAVBAR --}}
<nav class="bg-white shadow-sm" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-2xl font-bold text-pink-600">Receitinhas</a>

        <!-- Botão Hamburguer (mobile) -->
        <button @click="open = !open" class="md:hidden text-gray-700 focus:outline-none">
            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Links (desktop) -->
        <div class="hidden md:flex items-center space-x-4">
            <a href="{{ route('recipes.index') }}" class="text-gray-700 hover:text-pink-500">Receitas</a>
            <a href="{{ route('recipes.create') }}" class="text-gray-700 hover:text-pink-500">Nova Receita</a>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-[#1b1b18] hover:text-pink-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-[#1b1b18] hover:text-pink-500">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm text-[#1b1b18] hover:text-pink-500">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <!-- Menu mobile -->
    <div x-show="open" class="md:hidden px-4 pb-4 space-y-2">
        <a href="{{ route('recipes.index') }}" class="block text-gray-700 hover:text-pink-500">Receitas</a>
        <a href="{{ route('recipes.create') }}" class="block text-gray-700 hover:text-pink-500">Nova Receita</a>

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="block text-sm text-[#1b1b18] hover:text-pink-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block text-sm text-[#1b1b18] hover:text-pink-500">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="block text-sm text-[#1b1b18] hover:text-pink-500">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>



    {{-- CONTEÚDO --}}
    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-500 text-center">
            &copy; {{ date('Y') }} Receitinhas. Todos os direitos reservados.
        </div>
    </footer>

</body>
</html>
