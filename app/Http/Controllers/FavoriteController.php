<?php
namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Recipe $recipe)
    {
        $user = Auth::user();

        if ($user->favoriteRecipes()->where('recipe_id', $recipe->id)->exists()) {
            $user->favoriteRecipes()->detach($recipe->id);
        } else {
            $user->favoriteRecipes()->attach($recipe->id);
        }

        return back();
    }

    public function index()
    {
        $favorites = Auth::user()->favoriteRecipes()->with('category')->get();
        return view('recipes.favorites', compact('favorites'));
    }
}