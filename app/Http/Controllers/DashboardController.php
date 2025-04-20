<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $recipes = Recipe::where('user_id', Auth::id())->get();
    // $recipes = Recipe::latest()->take(6)->get();  
    return view('dashboard', compact('recipes'));
}
}