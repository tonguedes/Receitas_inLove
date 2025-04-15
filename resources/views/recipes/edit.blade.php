@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Editar Receita</h1>

    <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        @include('recipes._form', ['button' => 'Salvar Alterações'])
    </form>
</div>
@endsection


