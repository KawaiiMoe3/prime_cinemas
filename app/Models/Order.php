<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'movie_id', 'booking_id', 'ticket_qr', 'movie_type',
        'selected_movie_date', 'selected_movie_time', 'selected_seats',
        'adults', 'children'
    ];
    
    public function movie()
    {
        return $this->belongsTo(Movies::class, 'movie_id');
    }
}
