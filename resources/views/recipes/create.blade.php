@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Nova Receita</h1>

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @include('recipes._form', ['button' => 'Criar Receita',
         ])
    </form>
</div>
@endsection
