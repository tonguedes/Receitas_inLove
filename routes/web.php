<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CommentLikeController;
use App\Models\Recipe;
use Database\Seeders\RecipeSeeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\GoogleController;


use Illuminate\Support\Facades\Mail;






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// rota criada com expression para nao dar conflito com create

Route::get('recipes/{recipe}', [RecipeController::class, 'show'])
    ->name('recipes.show')
    ->where('recipe', '[0-9]+');

Route::get('recipes', [RecipeController::class, 'index'])
    ->name('recipes.index');

// Dashboard só para admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/{id}aprovar', [DashboardController::class, 'aprovar'])->name('recipes.aprovar');
    Route::post('/dashboard/{id}rejeitar', [DashboardController::class, 'rejeitar'])->name('recipes.rejeitar');
});


Route::middleware('auth')->group(function () {
    // Aplica o middleware para todas as rotas, exceto 'show'
    Route::resource('recipes', RecipeController::class)->except(['show', 'index'])->middleware('auth');
    //Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\FavoriteController;

Route::middleware(['auth'])->group(function () {
    Route::post('/recipes/{recipe}/favorite', [FavoriteController::class, 'toggle'])->name('recipes.favorite');
    Route::get('/favoritas', [FavoriteController::class, 'index'])->name('recipes.favorites');
});







Route::get('categories/{category}', [CategoriaController::class, 'show']);


// Route::get('search', [RecipeController::class, 'search']);
Route::get('/', function (Request $request) {
    $query = $request->input('search');

    $recipes = Recipe::with('category')
        ->when($query, function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('ingredients', 'like', "%{$query}%");
        })
        ->orderBy('created_at', 'desc')
        ->take(9)
        ->get();

    $topRecipes = Recipe::with('category')->mostFavorited(6)->get();
    //    $randomRecipe = Recipe::inRandomOrder()->first();
    // Tenta pegar a receita do cache
    $randomRecipe = Cache::get('sabor_do_dia');

    if (!$randomRecipe) {
        // Se não estiver no cache, busca uma receita aleatória
        $randomRecipe = Recipe::inRandomOrder()->first();

        // Armazena a receita no cache por 24 horas
        Cache::put('sabor_do_dia', $randomRecipe, now()->addDay());
    }
    return view('welcome', compact('recipes', 'topRecipes', 'query', 'randomRecipe'));
});


// rota sugestão ajax

Route::get('/busca-sugestoes', function (Request $request) {
    $search = $request->get('q');

    $results = Recipe::where('title', 'like', '%' . $search . '%')
        ->select('id', 'title')
        ->take(5)
        ->get();

    return response()->json($results);
})->name('recipes.suggestions');



Route::get('/top-receitas', [RecipeController::class, 'top'])->name('recipes.top');


Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categorias.show');

Route::post('/recipes/{recipe}/comments', [RecipeController::class, 'addComment'])
    ->middleware('auth')->name('recipes.comments.store');


Route::post('/comments/{comment}/like', [CommentLikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('comments.like');


// autentificação com o google
Route::middleware('web')->group(function () {
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});


require __DIR__ . '/auth.php';
