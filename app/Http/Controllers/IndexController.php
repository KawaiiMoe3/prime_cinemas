<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movies;

class IndexController extends Controller
{
    function index(){
        $movies = Movies::whereIn('status', [
            'now_showing', 
            'kids_special', 
            'book_early', 
            'coming_soon'])
            ->where('is_active', true)
            ->get()
            ->groupBy('status');
                    
        $values = [
            'nowShowingMovies' => $movies->get('now_showing', collect()),
            'kidsSpecialMovies' => $movies->get('kids_special', collect()),
            'bookEarlyMovies' => $movies->get('book_early', collect()),
            'comingSoonMovies' => $movies->get('coming_soon', collect()),
        ];
        
        return view('index', $values);
    }
}
