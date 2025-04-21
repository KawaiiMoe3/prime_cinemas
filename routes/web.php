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
use App\Http\Controllers\FoodDrinksController;
use App\Http\Controllers\CheckoutController;

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
    
    // Proceed button after seats selection
    Route::post('/proceed', [MoviesController::class, 'proceed'])->name('proceed');
    
    // Display checkout details of a movie
    Route::get('/ticketing-journey/checkout/{movieSlug}/{showDate}/{id}', [
        MoviesController::class,
        'showCheckout'
    ])->name('movies.checkout');

    // Checkout booking
    Route::post('/checkout', [MoviesController::class, 'checkout'])->name('checkout');
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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/mobile',  [ProfileController::class, 'updateMobile'])->name('profile.updateMobile');
    Route::post('/profile/email',   [ProfileController::class, 'updateEmail']);
});

Route::get('/my-orders', [OrderController::class, 'index'])->name('profile.my_orders');

// --------------------- Cinemas Routes ------------------ //
Route::get('/cinemas', [
    CinemasController::class,
    'showCinemas'
])->name('cinemas');

// --------------------- More Routes ------------------ //
Route::get('/more/aboutUs', function () {
    return view('more.about');
})->name('about');

Route::get('/more/support', function () {
    return view('more.support');
})->name('support');


// --------------------- API Endpoints ------------------ //
// Dynamic Date Tabs Generated API
Route::get('/dates', [DateController::class, 'getDates']);
// Movie Showtimes Filter API
Route::get('/api/showtimes', [MoviesController::class, 'getShowtimes']);

// --------------------- Food and Drinks Routes ------------------ //
Route::get('/food-and-drinks', [FoodDrinksController::class, 'showFoodAndDrinks'])->name('food-and-drinks');

// Cart Routes
Route::post('/cart/add', [FoodDrinksController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [FoodDrinksController::class, 'getCart'])->name('cart.get');
Route::post('/cart/update', [FoodDrinksController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [FoodDrinksController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/edit/{cartItemId}', [FoodDrinksController::class, 'editCartItem'])->name('cart.edit');
Route::post('/cart/delete-all', [FoodDrinksController::class, 'deleteAll'])->name('cart.deleteAll');

// Checkout Routes
Route::get('/cart-checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
Route::post('/cart-checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/cart-checkout/success/{orderId}', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');
