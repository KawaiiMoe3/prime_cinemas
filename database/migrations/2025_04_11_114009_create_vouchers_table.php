<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_name')->nullable();
            $table->string('voucher_code')->unique();
            $table->enum('voucher_type', ['percentage', 'MYR']);
            $table->decimal('voucher_value', 8, 2);
            $table->date('expiry_date');
            $table->integer('redeem_limit')->default(1);
            $table->integer('redeemed_quantity')->default(0);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('vouchers');
    }
}
