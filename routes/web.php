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

// --------------------- Protected Routes (Only for Logged-in Users) ------------------ //
Route::middleware(['authCheck'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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

// --------------------- Profile Routes ------------------ //
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/mobile',  [ProfileController::class, 'updateMobile'])->name('profile.updateMobile');
    Route::post('/profile/email',   [ProfileController::class, 'updateEmail']);
});

// --------------------- Order Routes ------------------ //
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
// Movie Showtimes API
Route::get('/api/showtimes', [MoviesController::class, 'getShowtimes']);
