<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CinemasController extends Controller
{
    function showCinemas(){
        return view('cinemas.cinemas');
    }
}
