<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('food_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // If guest, can be NULL
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->decimal('total', 8, 2);
            $table->string('status')->default('pending'); // pending, completed
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_orders');
    }
}
