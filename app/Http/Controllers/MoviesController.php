<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    // Movies Listing
    function showMovies(){
        $values = [
            'nowShowingTopFamousMovies' => Movies::where('status', 'now_showing')
                                                ->where('is_top_famous', true)
                                                ->where('is_active', true)
                                                ->get(),
            'nowShowingMovies' => Movies::where('status', 'now_showing')
                                        ->where('is_top_famous', false)
                                        ->where('is_active', true)
                                        ->get(),
            'kidsSpecialMovies' => Movies::where('status', 'kids_special')
                                        ->where('is_active', true)
                                        ->get(),
            'bookEarlyMovies' => Movies::where('status', 'book_early')
                                        ->where('is_active', true)
                                        ->get(),
            'comingSoonMovies' => Movies::where('status', 'coming_soon')
                                        ->where('is_active', true)
                                        ->get(),
        ];

        return view('movies.listing', $values);
    }
}
