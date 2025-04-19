<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VoucherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CinemasController;
use App\Http\Controllers\DateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// --------------------- Index Routes ------------------ //
Route::get('/', [
    IndexController::class,
    'index'
])->name('index');

// --------------------- Authentication Routes ------------------ //
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['web'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --------------------- Protected Routes (Only Logged-in Users can Access) ------------------ //
Route::middleware(['authCheck'])->group(function () {
    // Seats Selection for a movie
    Route::get('/ticketing-journey/select-seats/{movieSlug}/{showDate}/{id}', [
        MoviesController::class,
        'showSeats'
    ])->name('movies.seats');

    Route::post('/proceed', [MoviesController::class, 'proceed'])->name('proceed');

    Route::get('/ticketing-journey/checkout/{movieSlug}/{showDate}/{id}', [
        MoviesController::class,
        'showCheckout'
    ])->name('movies.checkout');
});

// --------------------- Movies Routes ------------------ //
Route::get('/movies/listing', [
    MoviesController::class,
    'showMovies'
])->name('movies.listing');

Route::get('/movies/details/{movieSlug}', [
    MoviesController::class,
    'showMovieDetails'
])->where('movieSlug', '[A-Za-z0-9\-]+')
    ->name('movies.details');

Route::get('/session/expired', function () {
    session()->forget([
        'selected_seats',
        'ticket_quantity',
        'ticket_total',
        'net_total',
        'seat_selection_time'
    ]);

    return redirect()->route('movies.listing')
        ->with('timeout', true);
})->name('session.expired');

// --------------------- Profile Routes ------------------ //
Route::get('/profile/my-profile', function () {
    return view('profile.my_profile');
})->name('profile.my_profile');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/my-profile', [ProfileController::class, 'showProfile'])->name('profile.my_profile')->middleware('auth');
Route::post('/update-mobile', [ProfileController::class, 'updateMobile'])->name('profile.updateMobile');
Route::post('/update-email', [ProfileController::class, 'updateEmail']);
Route::post('/update-profile', [ProfileController::class, 'updateProfile']);
Route::post('/update-pin', [ProfileController::class, 'updatePin'])->name('update.pin');
Route::get('/check-pin-status', [ProfileController::class, 'checkPinStatus']);
Route::post('/delete-account', [ProfileController::class, 'deleteAccount'])->name('delete.account');

Route::get('/profile/my-orders', function () {
    return view('profile.my_orders');
})->name('profile.my_orders');

Route::get('/profile/my-orders', [OrderController::class, 'index'])->name('profile.my_orders');

// --------------------- Cinemas Routes ------------------ //
Route::get('/cinemas', [
    CinemasController::class,
    'showCinemas'
])->name('cinemas');

// --------------------- API Endpoints ------------------ //
// Dynamic Date Tabs Generated API
Route::get('/dates', [DateController::class, 'getDates']);
// Movie Showtimes Filter API
Route::get('/api/showtimes', [MoviesController::class, 'getShowtimes']);
