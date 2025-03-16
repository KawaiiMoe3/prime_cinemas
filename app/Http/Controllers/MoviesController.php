<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Movies;

class MoviesController extends Controller
{
    // Movies Listing
    function showMovies(){
        $movies = Movies::whereIn('status', [
            'now_showing', 
            'kids_special', 
            'book_early', 
            'coming_soon'
        ])
        ->where('is_active', true)
        ->get()
        ->groupBy('status');

        $values = [
            'nowShowingTopFamousMovies' => $movies->get('now_showing', collect())->where('is_top_famous', true),
            'nowShowingMovies' => $movies->get('now_showing', collect())->where('is_top_famous', false),
            'kidsSpecialMovies' => $movies->get('kids_special', collect()),
            'bookEarlyMovies' => $movies->get('book_early', collect()),
            'comingSoonMovies' => $movies->get('coming_soon', collect()),
        ];

        return view('movies.listing', $values);
    }

    // Movies Details
    function showMovieDetails($movieSlug){
        // Convert slug back to title format and fetch for movie
        $movie = Movies::get()->first(function ($m) use ($movieSlug) {
            return Str::slug($m->title) === $movieSlug;
        });

        // Show 404 if no movie is found
        if (!$movie) {
            abort(404); 
        }

        $values = [
            'movie' => $movie
        ];
        return view('movies.details', $values);
    }
}
