@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-8 pt-12">
    {{-- AQUI adicionamos pt-12 --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Minhas Receitas</h1>
        <a href="{{ route('recipes.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg shadow transition">
            + Nova Receita
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($recipes as $recipe)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <a href="{{ route('recipes.show', $recipe) }}">
                    @if($recipe->image)
                        <img src="{{ asset('storage/' . $recipe->image) }}"
                             alt="{{ $recipe->title }}"
                             class="w-full h-56 object-cover" />
                    @else
                        <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-400">
                            Sem imagem
                        </div>
                    @endif
                </a>

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

                    <div class="mt-4">
                        <a href="{{ route('recipes.show', $recipe) }}"
                           class="inline-block bg-pink-500 hover:bg-pink-600 text-white text-sm font-semibold px-4 py-2 rounded-full transition">
                            Ver Receita
                        </a>
                    </div>
                     @auth
                     <form action="{{ route('recipes.favorite', $recipe) }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="flex items-center space-x-1 text-pink-600 hover:text-pink-700 transition">
                            @if(auth()->user()->favoriteRecipes->contains($recipe->id))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z"/>
                                </svg>
                                <span>Favorita</span>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-none stroke-current" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364 4.318 12.682a4.5 4.5 0 010-6.364z"/>
                                </svg>
                                <span>Favoritar</span>
                            @endif
                        </button>
                    </form>
                     @endauth


                        {{-- Autor --}}
        <p class="text-sm text-gray-500 mt-1">
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
