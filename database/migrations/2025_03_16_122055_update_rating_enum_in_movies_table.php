<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateRatingEnumInMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE movies MODIFY COLUMN rating ENUM('U', 'P12', '13', '16', '18', 'TBA') NOT NULL DEFAULT 'TBA';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE movies MODIFY COLUMN rating ENUM('U', 'P12', '13', '16', '18') NOT NULL;");
    }
}
