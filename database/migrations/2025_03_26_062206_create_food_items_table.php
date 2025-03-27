<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodItemsTable extends Migration
{
    public function up()
    {
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the food item (e.g., "Popcorn Combo")
            $table->string('category'); // Category (e.g., "combo", "snack", "beverage", "special")
            $table->decimal('price', 8, 2); // Price (e.g., 15.50)
            $table->string('image'); // Path to the image (e.g., "popcorn.jpg")
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_items');
    }
}