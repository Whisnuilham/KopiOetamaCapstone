<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas=[
            [
                'ingredient_name' => 'Kopi Arabica',
                'category' => 'Beans',
                'unit' => 'Gram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Kopi Robusta',
                'category' => 'Beans',
                'unit' => 'Gram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Dark Chocolate',
                'category' => 'Powder Beverage',
                'unit' => 'Gram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Matcha Powder',
                'category' => 'Powder Beverage',
                'unit' => 'Gram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Straw',
                'category' => 'Cup Plastic',
                'unit' => 'Pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Cup',
                'category' => 'Beans',
                'unit' => 'pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Dried Lemon',
                'category' => 'Garnish',
                'unit' => 'pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Rosemary',
                'category' => 'Garnish',
                'unit' => 'pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Susu UHT',
                'category' => 'Syrup',
                'unit' => 'Ml',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ingredient_name' => 'Aren Syrup',
                'category' => 'Syrup',
                'unit' => 'Ml',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Ingredient::insert($datas);
    }
}
