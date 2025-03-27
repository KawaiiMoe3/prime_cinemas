<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;

class FoodDrinksController extends Controller
{
    public function showFoodAndDrinks()
    {
        $combos = FoodItem::where('category', 'combo')->get();
        $snacks = FoodItem::where('category', 'snack')->get();
        $beverages = FoodItem::where('category', 'beverage')->get();
        $specials = FoodItem::where('category', 'special')->get();

        return view('foodDrinks.foodDrinks', compact('combos', 'snacks', 'beverages', 'specials'));
    }
}