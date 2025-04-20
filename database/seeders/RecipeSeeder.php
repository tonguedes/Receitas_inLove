<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $recipes = [
            [
                'title' => 'Bolo de Cenoura com Chocolate',
                'description' => 'Clássico bolo de cenoura com cobertura de chocolate.',
                'ingredients' => 'cenoura, ovos, farinha, açúcar, óleo, fermento, chocolate',
                'instructions' => 'teste',
                'category_id' => 1,
                'image' => 'images/receitas/bolo-cenoura.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Lasanha à Bolonhesa',
                'description' => 'Lasanha com camadas de massa, molho e queijo.',
                'ingredients' => 'carne moída, molho de tomate, queijo, presunto, massa de lasanha',
                  'instructions' => 'teste',
                'category_id' => 2,
                'image' => 'images/receitas/lasanha.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Panqueca de Frango',
                'description' => 'Panquecas recheadas com frango desfiado.',
                'ingredients' => 'leite, ovos, farinha, frango desfiado, molho',
                'instructions' => 'teste',
                'category_id' => 2,
                'image' => 'images/receitas/panqueca.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Torta de Limão',
                'description' => 'Sobremesa refrescante com base crocante.',
                'ingredients' => 'bolacha, manteiga, leite condensado, limão, creme de leite',
                'instructions' => 'teste',
                'category_id' => 3,
                'image' => 'images/receitas/torta-limao.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Escondidinho de Carne Seca',
                'description' => 'Purê de mandioca com recheio de carne seca.',
                'ingredients' => 'mandioca, carne seca, queijo, cebola, leite',
                'instructions' => 'teste',
                'category_id' => 2,
                'image' => 'images/receitas/escondidinho.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Feijoada Completa',
                'description' => 'Tradicional prato brasileiro com feijão e carnes.',
                'ingredients' => 'feijão preto, linguiça, carne seca, bacon, laranja',
                'instructions' => 'teste',
                'category_id' => 2,
                'image' => 'images/receitas/feijoada.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Pudim de Leite Condensado',
                'description' => 'Clássica sobremesa caramelizada.',
                'ingredients' => 'leite condensado, ovos, leite, açúcar',
               'instructions' => 'teste',
                'category_id' => 3,
                'image' => 'images/receitas/pudim.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Macarrão Alho e Óleo',
                'description' => 'Receita rápida e saborosa.',
                'ingredients' => 'macarrão, alho, azeite, sal, pimenta',
                 'instructions' => 'teste',
                'category_id' => 2,
                'image' => 'images/receitas/macarrao.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Salada Colorida',
                'description' => 'Opção leve e nutritiva.',
                'ingredients' => 'alface, tomate, cenoura, pepino, molho de iogurte',
                 'instructions' => 'teste',
                'category_id' => 4,
                'image' => 'images/receitas/salada.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Cuscuz Nordestino',
                'description' => 'Receita típica com flocão de milho.',
                'ingredients' => 'flocão de milho, água, sal, manteiga',
                 'instructions' => 'teste',
                'category_id' => 2,
                'image' => 'images/receitas/cuscuz.jpg',
                'user_id' => 1
            ]
        ];

        foreach ($recipes as $data) {
            Recipe::create($data);
        }
    }
}