<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'movies';

    protected $fillable = [
        'title', 'description', 'cast', 'director', 'subtitles', 'duration',
        'release_date', 'language', 'genre', 'poster', 'trailer_url',
        'status', 'rating', 'is_active', 'is_top_famous'
    ];

    // Maximum of 3 top famous movies
    public static function boot()
    {
        parent::boot();

        static::saving(function ($movie) {
            if ($movie->is_top_famous) {
                $topFamousCount = self::where('is_top_famous', true)
                                      ->where('id', '!=', $movie->id)
                                      ->count();
    
                if ($topFamousCount >= 3) {
                    throw new \Exception('Only 3 movies can be top famous!');
                }
            }
        });
    }

    // Accessor for formatted duration - $movies->formatted_duration
    public function getFormattedDurationAttribute()
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        if ($hours > 0) {
            return $minutes > 0 ? "{$hours} hr {$minutes} mins" : "{$hours} hr 0 mins";
        } else {
            return "0 hr {$minutes} mins";
        }
    }
}
