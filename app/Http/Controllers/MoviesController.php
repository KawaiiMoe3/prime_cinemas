<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;

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
}
