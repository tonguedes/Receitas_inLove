@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $recipe->title }}</h1>

    @if($recipe->image)
        <img src="{{ asset('storage/' . $recipe->image) }}" class="w-full h-64 object-cover rounded mb-4">
    @endif

    <p class="text-gray-600 mb-2"><strong>Categoria:</strong> {{ $recipe->category->name }}</p>
    <p class="mb-4"><strong>Descrição:</strong> {{ $recipe->description }}</p>
    <div class="mb-4">
        <h2 class="text-xl font-semibold">Ingredientes:</h2>
        <p class="whitespace-pre-line">{{ $recipe->ingredients }}</p>
    </div>
    <div class="mb-4">
        <h2 class="text-xl font-semibold">Modo de Preparo:</h2>
        <p class="whitespace-pre-line">{{ $recipe->instructions }}</p>
    </div>

    <a href="{{ route('recipes.index') }}" class="text-blue-500">← Voltar</a>
</div>
@endsection
