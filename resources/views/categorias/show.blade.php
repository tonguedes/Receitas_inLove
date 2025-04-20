@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Receitas da categoria: {{ $categoria->name }}</h1>

        @if ($receitas->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($receitas as $recipe)
                    <a href="{{ route('recipes.show', $recipe) }}" class="block bg-white rounded-xl shadow hover:shadow-lg transition">
                        <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-48 object-cover rounded-t-xl" alt="{{ $recipe->title }}">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold">{{ $recipe->title }}</h2>
                            <p class="text-sm text-gray-600 truncate">{{ $recipe->description }}</p>
                                {{-- Autor --}}
        <p class="text-sm text-gray-500 mt-1">
            Por <span class="font-medium text-gray-700">{{ $recipe->user->name }}</span>
        </p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">Nenhuma receita encontrada para esta categoria.</p>
        @endif
    </div>
@endsection
