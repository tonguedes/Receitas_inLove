<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class DashboardController extends Controller
{
    public function index()
{
    $recipes = Recipe::latest()->take(6)->get(); // ou ->paginate(6)
    
    return view('dashboard', compact('recipes'));
}
}