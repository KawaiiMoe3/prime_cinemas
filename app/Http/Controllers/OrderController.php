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
        
        /* Dummy Data, check when database didnt have data and u lazy to add on, if dun want just hide it */
        $orders = collect([
            (object)[
                'movie' => (object)[
                    'id'       => 1,
                    'title'    => 'Minecraft',
                    'duration' => 140,
                    'poster'   => 'm1.jpg',
                    'genre'    => 'Animation'
                ],
                'movie_type'           => 'deluxe',
                'selected_movie_date'  => '2025-04-10',
                'selected_movie_time'  => '20:30:00',
                'selected_seats'       => 'H1, H2',
                'adults'               => 2,
                'children'             => 0,
                'booking_id'           => '1234567',
                'ticket_qr'            => 'ticket-qr.png'
            ],
            (object)[
                'movie' => (object)[
                    'id'       => 2,
                    'title'    => 'Fast & Furious',
                    'duration' => 130,
                    'poster'   => 'm2.jpg',
                    'genre'    => 'Action'
                ],
                'movie_type'           => 'normal',
                'selected_movie_date'  => '2025-04-11',
                'selected_movie_time'  => '18:00:00',
                'selected_seats'       => 'C3, C4, C5',
                'adults'               => 3,
                'children'             => 1,
                'booking_id'           => '1234567',
                'ticket_qr'            => 'ticket-qr.png'
            ],
            (object)[
                'movie' => (object)[
                    'id'       => 3,
                    'title'    => 'The Lion King',
                    'duration' => 110,
                    'poster'   => 'm3.jpg',
                    'genre'    => 'Drama'
                ],
                'movie_type'           => '3D',
                'selected_movie_date'  => '2025-04-12',
                'selected_movie_time'  => '21:00:00',
                'selected_seats'       => 'D2, D3',
                'adults'               => 2,
                'children'             => 2,
                'booking_id'           => '1234567',
                'ticket_qr'            => 'ticket-qr.png'
            ]
        ]);

        $orders = $orders->sortByDesc('selected_movie_date');

        return view('profile.my_orders', compact('orders'));
    }
}
