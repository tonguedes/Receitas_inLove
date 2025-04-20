<div>
 @props(['recipe', 'isFavorited'])

<form method="POST" action="{{ route('recipes.toggleFavorite', $recipe->id) }}">
    @csrf
    <button
        type="submit"
        class="text-sm px-3 py-1 rounded-full transition-all
            {{ $isFavorited ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
    >
        {{ $isFavorited ? 'Desfavoritar ❤️' : 'Favoritar 🤍' }}
    </button>
</form>

</div>