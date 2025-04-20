<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class FavoriteButton extends Component
{
    public $recipe;
    public $isFavorited;

    public function __construct($recipe, $isFavorited = false)
    {
        $this->recipe = $recipe;
        $this->isFavorited = $isFavorited;
    }

    public function render(): View|Closure|string
    {
        return view('components.favorite-button');
    }
}