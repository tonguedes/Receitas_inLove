<?php

namespace App\Http\Controllers;

use App\Notifications\ReceitaStatusNotification;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index()
    {
        $recipes = Recipe::with('category', 'user')
            ->where('status', 'pendente')
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('recipes'));
    }


    public function aprovar($id)
    {
        $receita = Recipe::findOrFail($id);
        $receita->status = 'aprovada';
        $receita->user->notify(new ReceitaStatusNotification('aprovada', $receita->titulo));
        $receita->save();



        //$receita->user->notify(new ReceitaStatusNotification('aprovada', $receita->titulo));

        return redirect()->route('dashboard')->with('success', 'Receita aprovada com sucesso!');
    }

    public function rejeitar($id)
    {
        /* $receita = Recipe::findOrFail($id);
        $receita->update(['status' => 'rejeitada']); */

        $receita = Recipe::findOrFail($id);
        $receita->update(['status' => 'rejeitada']);

        $receita->user->notify(new ReceitaStatusNotification('rejeitada', $receita->titulo));
        //$receita->user->notify(new ReceitaStatusNotification('rejeitada', $receita->titulo));

        return back()->with('error', 'Receita rejeitada.');
    }
}
