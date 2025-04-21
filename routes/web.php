<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MoviesController;
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

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

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
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');
