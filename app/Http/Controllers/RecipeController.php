<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{

    public function index()
    {
        $recipes = Recipe::with('category', 'user')->latest()->paginate(10);

        return view('recipes.index', compact('recipes'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('recipes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $recipe = new Recipe($validated);
        $recipe->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('recipes', 'public');
        }

        $recipe->save();

        return redirect()->route('recipes.index')->with('success', 'Receita criada com sucesso!');
    }

    public function show(Recipe $recipe)
    {
        // $this->authorizeAccess($recipe);
        return view('recipes.show', compact('recipe'));


    }

    public function edit(Recipe $recipe)
    {
        $this->authorizeAccess($recipe);
        $categories = Category::all();
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $this->authorizeAccess($recipe);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($validated);

        return redirect()->route('recipes.index')->with('success', 'Receita atualizada com sucesso!');
    }

    public function destroy(Recipe $recipe)
    {
        $this->authorizeAccess($recipe);

        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Receita excluída com sucesso!');
    }

    private function authorizeAccess(Recipe $recipe)
    {
        if ($recipe->user_id !== Auth::id()) {
            abort(403);
        }
    }

    public function top()
    {
        $recipes = Recipe::with('category')->mostFavorited(12)->get();
        return view('recipes.top', compact('recipes'));
    }




    public function addComment(Request $request, Recipe $recipe)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $recipe->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comentário adicionado!');
    }


}
