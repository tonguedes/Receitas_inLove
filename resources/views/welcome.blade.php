@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

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

{{-- Banner Principal --}}
<section class="relative bg-cover bg-center h-[400px] md:h-[500px] rounded-b-3xl shadow-xl overflow-hidden"
         style="background-image: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=1200&q=80')">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg mb-4">
            Bem-vindo ao Receitas da Vovó 👩‍🍳
        </h1>
        <p class="text-lg md:text-xl max-w-2xl mb-6 drop-shadow-md">
            Descubra receitas deliciosas para todos os gostos. Favoritos, novidades e muito mais!
        </p>
        <a href="{{route('recipes.index')}}" class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition">
            Ver Receitas
        </a>
    </div>
</section>

{{-- Top Receitas Favoritas --}}
<section class="bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center text-pink-600">🍽️ Top Receitas Favoritas</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($topRecipes as $recipe)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 relative flex flex-col">
                    @if($recipe->image)
                        <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-52 object-cover rounded-xl mb-4">
                    @endif

                    <h3 class="text-xl font-bold text-pink-600 mb-1 truncate">{{ $recipe->title }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ $recipe->category->name }}</p>

                    <div class="absolute top-3 right-3 bg-pink-100 text-pink-700 text-xs px-2 py-1 rounded-full shadow">
                        ❤️ {{ $recipe->favorited_by_count }}
                    </div>

                    <a href="{{ route('recipes.show', $recipe) }}"
                       class="mt-auto inline-block bg-pink-500 hover:bg-pink-600 text-white text-center text-sm font-semibold px-4 py-2 rounded-full transition">
                        Ver Receita
                    </a>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">Nenhuma receita favoritada ainda.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Categorias de Receitas</h2>

           <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
    @foreach ($categorias as $categoria)
        <a href="{{ route('categorias.show', $categoria->id) }}"
           class="group relative rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 h-32 flex items-center justify-center">

            {{-- Imagem de fundo --}}
            @if ($categoria->image)
                <img src="{{ asset('storage/' . $categoria->image) }}"
                     alt="{{ $categoria->name }}"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 scale-100 group-hover:scale-110 brightness-80 saturate-150">
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-pink-200 via-purple-200 to-blue-200"></div>
            @endif

            {{-- Overlay com blur + cor + transição --}}
            <div class="absolute inset-0 backdrop-blur-sm bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>

            {{-- Nome da categoria --}}
            <div class="relative z-10 text-white text-lg font-bold text-center px-3 py-1 rounded-md bg-black/40 group-hover:bg-white/70 group-hover:text-black transition-all duration-300 backdrop-blur">
                {{ $categoria->name }}
            </div>
        </a>
    @endforeach
</div>

        </div>

    </div>



     @include('components.sabor-do-dia', ['randomRecipe' => $randomRecipe])
</section>







@endsection
