@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-8 pt-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Receitas</h1>

            <a href="{{ route('recipes.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg shadow transition">
                + Contribua com uma receita
            </a>
        </div>
{{-- Seção de Busca --}}
<section class="bg-white py-8">
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-3xl font-bold mb-4 text-pink-600">🔍 Buscar Receitas</h1>

        <div class="relative">
            <input type="text" id="search-input"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition"
                   placeholder="Digite o nome da receita...">

            <ul id="suggestions"
                class="absolute z-10 left-0 right-0 bg-white border border-gray-200 rounded mt-1 hidden shadow">
            </ul>
        </div>
    </div>
</section>

{{-- Resultados da busca --}}
@if(isset($query))
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6">
                Resultados para: "<span class="text-pink-600">{{ $query }}</span>"
            </h2>

            @if($recipes->isEmpty())
                <p class="text-gray-500">Nenhuma receita encontrada.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($recipes as $recipe)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 flex flex-col">
                            @if($recipe->image)
                                <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-52 object-cover rounded-xl mb-4">
                            @endif

                            <h3 class="text-xl font-bold text-pink-600 mb-1 truncate">{{ $recipe->title }}</h3>
                            <p class="text-sm text-gray-500 mb-3">{{ $recipe->category->name }}</p>

                            <a href="{{ route('recipes.show', $recipe) }}"
                               class="mt-auto inline-block bg-pink-500 hover:bg-pink-600 text-white text-sm font-semibold px-4 py-2 rounded-full transition">
                                Ver Receita
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endif
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filtro por categoria (opcionalmente pode ter dropdown ou tabs) --}}
        <section class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Categorias de Receitas</h2>

                <div class="overflow-x-auto">
                    <div class="flex space-x-4 pb-2">
                        @foreach ($categorias as $categoria)
                            <a href="{{ route('categorias.show', $categoria->id) }}"
                                class="group relative min-w-[140px] max-w-[140px] h-28 rounded-xl overflow-hidden shadow hover:shadow-lg transition-shadow duration-300 flex-shrink-0 bg-white flex items-center justify-center">

                                {{-- Imagem ou fundo gradiente --}}
                                @if ($categoria->image)
                                    <img src="{{ asset('storage/' . $categoria->image) }}" alt="{{ $categoria->name }}"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 scale-100 group-hover:scale-105 brightness-75 rounded-xl">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-pink-100 to-pink-300 rounded-xl"></div>
                                @endif

                                {{-- Overlay escuro com hover suave --}}
                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition duration-300 rounded-xl"></div>

                                {{-- Nome da categoria --}}
                                <span class="relative z-10 text-white group-hover:text-gray-900 font-semibold text-sm text-center px-2 transition-colors duration-300">
                                    {{ $categoria->name }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($recipes as $recipe)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 relative">
                <div class="relative">
                    <a href="{{ route('recipes.show', $recipe) }}">
                        @if ($recipe->image)
                            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                                class="w-full h-56 object-cover" />
                        @else
                            <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-400">
                                Sem imagem
                            </div>
                        @endif
                    </a>

                    {{-- Botão de favoritar dentro da imagem --}}
                    @auth
                        <form action="{{ route('recipes.favorite', $recipe) }}" method="POST"
                            class="absolute top-2 right-2 bg-white/80 backdrop-blur-sm p-1 rounded-full shadow">
                            @csrf
                            <button type="submit" class="text-pink-600 hover:text-pink-700">
                                @if (auth()->user()->favoriteRecipes->contains($recipe->id))
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364 4.318 12.682a4.5 4.5 0 010-6.364z" />
                                    </svg>
                                @endif
                            </button>
                        </form>
                    @endauth
                </div>

                <div class="p-5">
                    <h2 class="text-2xl font-bold text-pink-600 mb-1 truncate">
                        {{ $recipe->title }}
                    </h2>

                    <p class="text-sm text-gray-500 mb-3">
                        {{ $recipe->category->name ?? 'Sem categoria' }}
                    </p>

                    <p class="text-gray-700 text-sm line-clamp-3">
                        {{ Str::limit(strip_tags($recipe->description), 100) }}
                    </p>

                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('recipes.show', $recipe) }}"
                            class="bg-pink-500 hover:bg-pink-600 text-white text-sm font-semibold px-4 py-2 rounded-full transition">
                            Ver Receita
                        </a>
                    </div>

                    <p class="text-sm text-gray-500 mt-2">
                        Por <span class="font-medium text-gray-700">{{ $recipe->user->name }}</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $recipes->links() }}
    </div>
    </div>
@endsection
