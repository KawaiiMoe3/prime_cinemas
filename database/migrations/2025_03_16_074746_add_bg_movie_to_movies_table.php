<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBgMovieToMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            // Check if the bg_movie column does not exist before adding it
            if (!Schema::hasColumn('movies', 'bg_movie')) {
                $table->string('bg_movie')->nullable()->after('poster');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            // Only drop the column if it exists
            if (Schema::hasColumn('movies', 'bg_movie')) {
                $table->dropColumn('bg_movie');
            }
        });
    }
}