@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Minhas Receitas Favoritas</h1>

    @if($favorites->isEmpty())
        <p class="text-gray-600">Você ainda não favoritou nenhuma receita.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($favorites as $recipe)
                <div class="bg-white shadow rounded p-4">
                    @if($recipe->image)
                        <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-48 object-cover rounded">
                    @endif
                    <h2 class="text-xl font-semibold mt-2">{{ $recipe->title }}</h2>
                    <p class="text-gray-600">{{ $recipe->category->name }}</p>
                    <a href="{{ route('recipes.show', $recipe) }}" class="text-blue-500 mt-2 block">Ver Receita</a>
                        {{-- Autor --}}
        <p class="text-sm text-gray-500 mt-1">
            Por <span class="font-medium text-gray-700">{{ $recipe->user->name }}</span>
        </p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
