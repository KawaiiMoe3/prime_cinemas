<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('cast')->nullable();
            $table->string('director', 255)->nullable();
            $table->string('subtitles', 255)->nullable();
            $table->integer('duration');
            $table->date('release_date');
            $table->string('language', 100);
            $table->string('genre', 255);
            $table->string('poster')->nullable();
            $table->string('trailer_url')->nullable();
            $table->enum('status', [
                'now_showing', 'kids_special',
                'book_early', 'coming_soon'
            ])->default('coming_soon');
            $table->enum('rating', [
                'U', 'P12', '13', '16', '18'
            ])->nullable();
            $table->boolean('is_top_famous')->default(false);
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
        Schema::dropIfExists('movies');
    }
}
