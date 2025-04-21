<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // For logged-in users
            $table->string('session_id')->nullable(); // For guest users
            $table->unsignedBigInteger('food_item_id'); // References food_items table
            $table->integer('quantity')->default(1);
            $table->json('selections')->nullable(); // Store food and drink selections (e.g., {"food": "Signature Large Popcorn", "drink": "Coke No Sugar"})
            $table->foreign('food_item_id')->references('id')->on('food_items')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
