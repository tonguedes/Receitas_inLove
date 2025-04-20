@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Top Receitas Favoritas</h1>

    @if($recipes->isEmpty())
        <p class="text-gray-600">Ainda não há receitas favoritadas.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($recipes as $recipe)
                <div class="bg-white shadow rounded p-4 relative">
                    @if($recipe->image)
                        <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-48 object-cover rounded">
                    @endif
                    <h2 class="text-xl font-semibold mt-2">{{ $recipe->title }}</h2>
                    <p class="text-gray-600">{{ $recipe->category->name }}</p>

                    <div class="absolute top-2 right-2 bg-pink-100 text-pink-700 text-sm px-2 py-1 rounded">
                        ❤️ {{ $recipe->favorited_by_count }}
                    </div>

                    <a href="{{ route('recipes.show', $recipe) }}" class="text-blue-500 mt-2 block">Ver Receita</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
