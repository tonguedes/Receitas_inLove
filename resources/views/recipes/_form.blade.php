<div>
    <label class="block font-semibold">Título</label>
    <input type="text" name="title" value="{{ old('title', $recipe->title ?? '') }}"
           class="w-full border p-2 rounded" required>
</div>

<div>
    <label class="block font-semibold">Categoria</label>
    <select name="category_id" class="w-full border p-2 rounded" required>
        <option value="">Selecione</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $recipe->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label class="block font-semibold">Descrição</label>
    <textarea name="description" class="w-full border p-2 rounded" required>{{ old('description', $recipe->description ?? '') }}</textarea>
</div>

<div>
    <label class="block font-semibold">Ingredientes</label>
    <textarea name="ingredients" class="w-full border p-2 rounded" required>{{ old('ingredients', $recipe->ingredients ?? '') }}</textarea>
</div>

<div>
    <label class="block font-semibold">Modo de Preparo</label>
    <textarea name="instructions" class="w-full border p-2 rounded" required>{{ old('instructions', $recipe->instructions ?? '') }}</textarea>
</div>

<div>
    <label class="block font-semibold">Imagem</label>
    <input type="file" name="image" class="w-full border p-2 rounded">
    @if(!empty($recipe->image))
        <img src="{{ asset('storage/' . $recipe->image) }}" class="w-32 mt-2">
    @endif
</div>

<div>
    <button class="bg-blue-500 text-white px-4 py-2 rounded">{{ $button }}</button>
</div>
