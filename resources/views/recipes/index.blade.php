@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-8">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Minhas Receitas</h1>
        <a href="{{ route('recipes.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">+ Nova Receita</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($recipes as $recipe)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
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
            </div>
        </div>
    @endforeach
</div>

    <div class="mt-6">
        {{ $recipes->links() }}
    </div>
</div>
@endsection
