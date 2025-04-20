@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="relative">
        @if($recipe->image)
            <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-64 object-cover rounded-xl shadow">
        @endif

        {{-- Botão de Favoritar no canto da imagem --}}
        <div class="absolute top-4 right-4">
            @auth
                <form action="{{ route('recipes.favorite', $recipe) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-white/80 backdrop-blur-md p-2 rounded-full shadow hover:scale-105 transition">
                        @if(auth()->user()->favoriteRecipes->contains($recipe->id))
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600 fill-current" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364 4.318 12.682a4.5 4.5 0 010-6.364z"/>
                            </svg>
                        @endif
                    </button>
                </form>
            @endauth
        </div>
    </div>

    <h1 class="text-3xl font-bold text-green-700 mt-6 mb-2">{{ $recipe->title }}</h1>
    <p class="text-gray-600 mb-2"><strong>Categoria:</strong> {{ $recipe->category->name }}</p>
    <p class="mb-4 text-gray-700"><strong>Descrição:</strong> {{ $recipe->description }}</p>

    <div class="mb-4">
        <h2 class="text-xl font-semibold text-pink-700">Ingredientes:</h2>
        <p class="whitespace-pre-line text-gray-800">{{ $recipe->ingredients }}</p>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-pink-700">Modo de Preparo:</h2>
        <p class="whitespace-pre-line text-gray-800">{{ $recipe->instructions }}</p>
    </div>

    {{-- COMENTÁRIOS --}}
    <div class="border-t pt-6 mt-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Comentários:</h2>

        @auth
            <form method="POST" action="{{ route('recipes.comments.store', $recipe->id) }}" class="mb-6">
                @csrf
                <textarea name="body" rows="3" class="w-full border border-gray-300 p-3 rounded-md shadow-sm focus:ring-pink-300" placeholder="Escreva um comentário..." required></textarea>
                <button type="submit" class="mt-2 bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition">
                    Comentar
                </button>
            </form>
        @else
            <p class="text-sm text-gray-600 mb-6">🔒 Faça login para comentar nesta receita.</p>
        @endauth

        @forelse ($recipe->comments as $comment)
            <div class="mb-4 p-4 bg-gray-50 rounded-lg shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <strong class="text-green-700">{{ $comment->user->name }}</strong>
                        <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    {{-- Curtir comentário --}}
                    <form method="POST" action="{{ route('comments.like', $comment->id) }}">
                        @csrf
                        <button type="submit" class="text-sm text-blue-500 hover:underline">
                            👍 ({{ $comment->likes->count() }})
                            @if(auth()->check() && $comment->isLikedBy(auth()->user()))
                                <span class="text-green-600">(Você curtiu)</span>
                            @endif
                        </button>
                    </form>
                </div>
                <p class="text-gray-700">{{ $comment->body }}</p>
            </div>
        @empty
            <p class="text-gray-500">Nenhum comentário ainda.</p>
        @endforelse
    </div>

    <a href="{{ route('recipes.index') }}" class="inline-block mt-6 text-blue-500 hover:underline">
        ← Voltar para lista
    </a>
</div>
@endsection
