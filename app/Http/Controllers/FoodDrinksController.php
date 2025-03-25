<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodDrinksController extends Controller
{
    public function showFoodAndDrinks()
    {
        return view('foodDrinks.foodDrinks');
    }
}
