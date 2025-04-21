<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('food_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_order_id'); // Link to food_orders
            $table->unsignedBigInteger('food_item_id'); // Link to food_items
            $table->integer('quantity');
            $table->decimal('price', 8, 2); // Price at time of order
            $table->json('selections')->nullable(); // Selections like food & drink options
            $table->timestamps();

            // Foreign keys
            $table->foreign('food_order_id')->references('id')->on('food_orders')->onDelete('cascade');
            $table->foreign('food_item_id')->references('id')->on('food_items')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_order_items');
    }
}
