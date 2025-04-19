<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'movie_id', 'booking_id', 'ticket_qr', 'movie_type',
        'selected_movie_date', 'selected_movie_time', 'selected_seats',
        'adults', 'children'
    ];

    // A user has an order
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A movie has an order
    public function movie()
    {
        return $this->belongsTo(Movies::class);
    }

    // A showtime has an order
    public function showtime()
    {
        return $this->belongsTo(Showtimes::class);
    }

}
