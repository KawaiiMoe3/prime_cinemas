<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Showtimes;

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

        $showtimesGrouped = Showtimes::where('movie_id', $movie->id)
            ->where('is_active', true)
            ->orderBy('show_date')
            ->orderBy('show_time')
            ->get()
            ->groupBy('show_date');

        $values = [
            'movie' => $movie,
            'showtimesGrouped' => $showtimesGrouped,
        ];
        return view('movies.details', $values);
    }

    // Movie Showtimes Filter API
    public function getShowtimes(Request $request)
    {
        $movieId = $request->query('movie_id');
        $date = $request->query('date');

        $showtimes = Showtimes::with('movie')
                ->where('movie_id', $movieId)
                ->whereDate('show_date', $date)
                ->get()
                ->map(function ($showtime) {
                    return [
                        'id' => $showtime->id,
                        'cinema' => $showtime->cinema,
                        'location' => $showtime->location,
                        'city' => $showtime->city,
                        'state' => $showtime->state,
                        'area' => $showtime->area,
                        'show_date' => $showtime->show_date,
                        'show_time' => $showtime->show_time,
                        'hall_name' => $showtime->hall_name,
                        'hall_type' => $showtime->hall_type,
                        'available_seats' => $showtime->available_seats,
                        'ticket_price' => $showtime->ticket_price,
                        'is_active' => $showtime->is_active,
                        'movie_title' => $showtime->movie->title, // this will be used for slug
                    ];
                });

        return response()->json($showtimes);
    }

    // Movie Seat Selections
    function showSeats($movieSlug, $showDate, $id){
        // Find the showtime first
        $showtime = Showtimes::with('movie') // eager load the movie
            ->where('id', $id)
            ->whereDate('show_date', $showDate)
            ->firstOrFail();

        // Get the movie from the showtime relationship
        $movie = $showtime->movie;

        // Check if the movie title matches the slug
        $slugFromTitle = Str::slug($movie->title);

        if ($slugFromTitle !== $movieSlug) {
            abort(404); // Slug doesn't match
        }

        // Format the date and time 
        $formattedShowDate = Carbon::parse($showtime->show_date)->format('d M Y');
        $formattedShowTime = Carbon::parse($showtime->show_time)->format('h:i A');

        $values = [
            'movie' => $movie,
            'showtime' => $showtime,
            'formattedShowDate' => $formattedShowDate,
            'formattedShowTime' => $formattedShowTime,
        ];

        // Proceed to seat selection view
        return view('movies.seats', $values);
    }
}
