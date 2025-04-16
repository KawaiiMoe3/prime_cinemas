<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::with('movie')
        ->where('user_id', Auth::id())
        ->orderByDesc('selected_movie_date')
        ->get();


        $orders = $orders->sortByDesc('selected_movie_date');

        return view('profile.my_orders', compact('orders'));
    }
}
