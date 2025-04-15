<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Café da Manhã',
            'Almoço',
            'Jantar',
            'Sobremesas',
            'Lanches',
            'Vegetariano',
            'Vegano',
            'Low Carb',
            'Fitness',
            'Bebidas'
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}