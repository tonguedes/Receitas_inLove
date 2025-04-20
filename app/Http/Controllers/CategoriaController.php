<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function show($id)
{
    $categoria = Category::findOrFail($id);
    $receitas = $categoria->recipes; // se tiver relação

    return view('categorias.show', compact('categoria', 'receitas'));
}
}