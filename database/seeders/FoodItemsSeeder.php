<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodItem;

class FoodItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Popcorn Combo',
                'category' => 'combo',
                'price' => 25.50,
                'image' => 'popcorn-combo.jpg',
            ],
            [
                'name' => 'Nachos & Cheese',
                'category' => 'snack',
                'price' => 15.00,
                'image' => 'nachos.jpg',
            ],
            [
                'name' => 'Cola Drink',
                'category' => 'beverage',
                'price' => 8.00,
                'image' => 'cola.jpg',
            ],
            [
                'name' => 'Movie Night Special',
                'category' => 'special',
                'price' => 30.00,
                'image' => 'movie-night-special.jpg',
            ],
        ];

        foreach ($items as $item) {
            FoodItem::create($item);
        }
    }
}