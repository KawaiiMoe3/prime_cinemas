<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    function showMovies(){
        return view('movies.listing');
    }
}
