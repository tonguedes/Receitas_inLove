<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

  
   @section('content')
     <div class="space-y-4">
    @foreach($recipes as $recipe)
        <div class="bg-white shadow rounded-xl p-4 flex items-center gap-4">
            {{-- Imagem --}}
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}"
                     alt="Imagem da Receita"
                     class="w-20 h-20 object-cover rounded-md border" />
            @else
                <div class="w-20 h-20 bg-gray-100 flex items-center justify-center rounded-md text-gray-400">
                    Sem imagem
                </div>
            @endif

            {{-- Detalhes da Receita --}}
            <div class="flex-1">
                <h2 class="text-lg font-semibold text-pink-600">
                    {{ $recipe->title }}
                </h2>
                <p class="text-sm text-gray-500">
                    {{ $recipe->category->name ?? 'Sem categoria' }}
                </p>
            </div>

            {{-- Ações --}}
            <div class="flex items-center space-x-4">
                <a href="{{ route('recipes.show', $recipe) }}" class="text-sm text-blue-500 hover:underline">Ver</a>
                <a href="{{ route('recipes.edit', $recipe) }}" class="text-sm text-yellow-500 hover:underline">Editar</a>
                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                    @csrf
                    @method('DELETE')
                    <button class="text-sm text-red-500 hover:underline">Excluir</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

   @endsection
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
