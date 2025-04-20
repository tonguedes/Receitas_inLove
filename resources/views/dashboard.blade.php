<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard de Receitas') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-6 px-4 max-w-7xl mx-auto space-y-6">
        @foreach($recipes as $recipe)
            <div class="bg-white shadow-md rounded-2xl p-5 flex items-center gap-6 hover:shadow-lg transition-shadow">
                {{-- Imagem --}}
                @if($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}"
                         alt="Imagem da Receita"
                         class="w-24 h-24 object-cover rounded-lg border" />
                @else
                    <div class="w-24 h-24 bg-gray-100 flex items-center justify-center rounded-lg text-gray-400 text-sm">
                        Sem imagem
                    </div>
                @endif

                {{-- Detalhes da Receita --}}
                <div class="flex-1">
                    <h3 class="text-xl font-semibold text-pink-600">
                        {{ $recipe->title }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ $recipe->category->name ?? 'Sem categoria' }}
                    </p>
                </div>

                {{-- Ações --}}
                <div class="flex items-center space-x-2">
                    <a href="{{ route('recipes.show', $recipe) }}"
                       class="px-4 py-2 text-sm font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        Ver
                    </a>
                    <a href="{{ route('recipes.edit', $recipe) }}"
                       class="px-4 py-2 text-sm font-medium bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                        Editar
                    </a>
                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    @endsection

    {{-- Mensagem de login --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6 text-gray-800 text-center">
                {{ __("Você está logado!") }}
            </div>
        </div>
    </div>
</x-app-layout>
