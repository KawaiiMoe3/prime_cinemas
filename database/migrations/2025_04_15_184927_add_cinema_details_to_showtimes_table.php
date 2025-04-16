<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCinemaDetailsToShowtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('showtimes', function (Blueprint $table) {
            $table->string('cinema')->after('movie_id');
            $table->string('location')->nullable()->after('cinema');
            $table->string('city')->nullable()->after('location');
            $table->string('state')->nullable()->after('city');
            $table->string('area')->nullable()->after('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('showtimes', function (Blueprint $table) {
            $table->dropColumn(['cinema', 'location', 'city', 'state', 'area']);
        });
    }
}
