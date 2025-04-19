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

    function proceed(Request $request){
        // Store the values in the session
        session([
            'selected_seats' => $request->selected_seats,
            'ticket_quantity' => $request->ticket_quantity,
            'ticket_total' => $request->ticket_total,
            'net_total' => $request->net_total,
            'seat_selection_time' => now(),
        ]);

        // Pass the values to the route
        $values = [
            'movieSlug' => $request->movie_slug,
            'showDate' => $request->show_date,
            'id' => $request->showtime_id,
        ];

        return redirect()->route('movies.checkout', $values);
    }

    function showCheckout($movieSlug, $showDate, $id){
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

        // Handle processing fee
        $netTotal = (float) session('net_total'); // ensure it's a float
        $processingFee = 0.50;
        $grandTotal = number_format($netTotal + $processingFee, 2); // format to 2 decimal places

        // Every RM 1 spent will be converted into 5 points
        $movieMoney = round($netTotal * 5); // Rounded to nearest whole number

        // Handle session timeout
        $startTime = session('seat_selection_time');
        $expiryDuration = 420; // 7 minutes in seconds
        $remainingSeconds = 0;

        if ($startTime) {
            $now = Carbon::now();
            $start = Carbon::parse($startTime);
            $elapsed = $now->diffInSeconds($start);
            $remainingSeconds = max($expiryDuration - $elapsed, 0);
        }

        $values = [
            'movie' => $movie,
            'showtime' => $showtime,
            'formattedShowDate' => $formattedShowDate,
            'formattedShowTime' => $formattedShowTime,
            'movieSlug' => $movieSlug,
            'showDate' => $showDate,
            'id' => $id,
            'seats' => session('selected_seats'),
            'quantity' => session('ticket_quantity'),
            'total' => session('ticket_total'),
            'netTotal' => $netTotal,
            'processingFee' => $processingFee,
            'grandTotal' => $grandTotal,
            'movieMoney' => $movieMoney,
            'remainingSeconds' => $remainingSeconds,
        ];

        return view('movies.checkout', $values);
    }
}
