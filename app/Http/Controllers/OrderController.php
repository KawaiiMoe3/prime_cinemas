<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('movie', 'showtime')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Format the date and time 
        foreach ($orders as $order) {
            $order->formattedShowDate = Carbon::parse($order->showtime->show_date)->format('d M Y');
            $order->formattedShowTime = Carbon::parse($order->showtime->show_time)->format('h:i A');
            $order->formattedSeats = implode(', ', json_decode($order->selected_seats));
        }        

        $values = [
            'orders' => $orders,
        ];

        return view('profile.my_orders', $values);
    }
}
