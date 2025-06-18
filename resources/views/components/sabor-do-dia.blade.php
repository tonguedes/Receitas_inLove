<div>
   <div class="bg-orange-50 rounded-2xl p-6 shadow-xl mt-10 animate-fade-in">
    <h2 class="text-2xl font-bold text-orange-700 mb-4">🍽️ Descubra o Sabor do Dia</h2>

    <div class="flex flex-col md:flex-row items-center gap-6">
        @if ($randomRecipe)
    <img src="{{ asset('storage/' . $randomRecipe->image ) }}"
             alt="{{ $randomRecipe->title }}"
             class="w-full md:w-48 h-48 object-cover rounded-xl shadow-lg">

                <div class="flex-1">
            <h3 class="text-xl font-semibold">{{ $randomRecipe->title }}</h3>
            <p class="text-sm text-gray-600">{{ $randomRecipe->category->name ?? 'Sem categoria' }} • {{ $randomRecipe->time }} min</p>
            <p class="mt-2 text-gray-700">{{ Str::limit($randomRecipe->description, 100) }}</p>

            <a href="{{ route('recipes.show', $randomRecipe->id) }}"
               class="inline-block mt-4 px-4 py-2 bg-orange-600 text-white rounded-xl hover:bg-orange-700 transition">
                Ver Receita
            </a>
        </div>
@else
    <p>Nenhuma receita disponível.</p>
@endif




    </div>
</div>

</div>
