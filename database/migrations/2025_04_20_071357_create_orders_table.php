<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('showtime_id')->constrained()->onDelete('cascade');
            $table->integer('ticket_quantity'); // count of selected seats
            $table->json('selected_seats'); // store selected seats as ["A1", "A2"]
            $table->decimal('ticket_total', 8, 2); // ticket_quantity * ticket_price
            $table->decimal('net_total', 8, 2);    // cumulative of ticket_total
            $table->decimal('processing_fee', 8, 2)->default(0.50); // processing fee of a ticket
            $table->decimal('grand_total', 8, 2);    // cumulative of ticket_total + processing fee
            $table->integer('movie_money');
            $table->string('status')->default('successful'); // pending, successful, failure
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
