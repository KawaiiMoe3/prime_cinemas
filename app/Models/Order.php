<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'movie_id', 'showtime_id', 'ticket_quantity',
        'selected_seats', 'ticket_total', 'net_total',
        'grand_total', 'movie_money', 'status'
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
