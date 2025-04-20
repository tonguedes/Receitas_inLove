<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Receitas')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    @vite('resources/css/app.css') {{-- Vite com Tailwind --}}
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- NAVBAR --}}
<nav class="bg-green-500 shadow-sm" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-4">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-pink-600">Receitinhas</a>
            @auth
                <span class="hidden md:inline text-gray-100">Olá, {{ Auth::user()->name }}</span>
            @endauth
        </div>

        <!-- Menu Desktop -->
        <div class="hidden md:flex items-center space-x-6">
            <!-- Dropdown de Categorias -->
            <div class="relative group">
                <button class="text-white hover:text-yellow-200 font-medium focus:outline-none">
                    Categorias
                </button>
                <div class="absolute hidden group-hover:block bg-white shadow-lg rounded mt-2 w-48 z-50">
                    <ul class="py-2">
                        @foreach($categorias as $categoria)
                            <li>
                                <a href="{{ route('categorias.show', $categoria->id) }}"
                                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-pink-500">
                                    {{ $categoria->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Links principais -->
            <a href="{{ route('recipes.index') }}" class="text-white hover:text-pink-200">Receitas</a>
            
            @auth
            <a href="{{ route('recipes.create') }}" class="text-white hover:text-pink-200">Nova Receita</a>

            @endauth

            <!-- Ícones e ações -->
            <a href="{{ route('recipes.favorites') }}" class="text-white hover:text-pink-200 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z"/>
                </svg>
                <span>Favoritas</span>
            </a>
            <a href="{{ route('recipes.top') }}" class="text-white hover:text-yellow-300 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-300" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8l-2 4h4l-2 4m0-4v6m0-6L8 8m4 0l4 4"/>
                </svg>
                <span>Top Receitas</span>
            </a>

            <!-- Autenticação -->
            @auth
                <a href="{{ url('/dashboard') }}" class="text-white hover:text-pink-300">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 ml-2">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white hover:text-pink-300">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-white hover:text-pink-300">Registrar</a>
                @endif
            @endauth
        </div>

        <!-- Botão Hamburguer -->
        <button @click="open = !open" class="md:hidden text-white focus:outline-none">
            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Menu Mobile -->
    <div x-show="open" class="md:hidden px-4 pb-4 space-y-2 bg-green-500">
        <a href="{{ route('recipes.index') }}" class="block text-white hover:text-pink-300">Receitas</a>
        <a href="{{ route('recipes.create') }}" class="block text-white hover:text-pink-300">Nova Receita</a>

        <a href="{{ route('recipes.favorites') }}" class="block text-white hover:text-pink-300">Favoritas</a>
        <a href="{{ route('recipes.top') }}" class="block text-white hover:text-yellow-300">Top Receitas</a>

        @auth
            <a href="{{ url('/dashboard') }}" class="block text-white hover:text-pink-300">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-white bg-red-500 px-4 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block text-white hover:text-pink-300">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="block text-white hover:text-pink-300">Registrar</a>
            @endif
        @endauth
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

    <!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper(".mySwiper", {
    slidesPerView: 1.2,
    spaceBetween: 16,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      640: { slidesPerView: 2.2 },
      768: { slidesPerView: 3.2 },
      1024: { slidesPerView: 4.2 },
    },
  });
</script>


    {{-- script ajax --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let timer;

        $('#search-input').on('input', function () {
            const query = $(this).val();

            clearTimeout(timer);

            if (query.length < 2) {
                $('#suggestions').empty().hide();
                return;
            }

            timer = setTimeout(() => {
                $.ajax({
                    url: '{{ route('recipes.suggestions') }}',
                    data: { q: query },
                    success: function (data) {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                html += `<li class="px-4 py-2 hover:bg-pink-100 cursor-pointer" data-id="${item.id}">
                                            ${item.title}
                                         </li>`;
                            });
                        } else {
                            html = '<li class="px-4 py-2 text-gray-500">Nenhum resultado</li>';
                        }
                        $('#suggestions').html(html).show();
                    }
                });
            }, 300);
        });

        $('#suggestions').on('click', 'li[data-id]', function () {
            const id = $(this).data('id');
            window.location.href = `/recipes/${id}`;
        });

        // Esconde ao clicar fora
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#search-input, #suggestions').length) {
                $('#suggestions').hide();
            }
        });
    });
</script>

</body>
</html>
