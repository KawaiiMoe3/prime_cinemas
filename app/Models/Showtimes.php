<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtimes extends Model
{
    use HasFactory;

    protected $table = 'showtimes';

    protected $fillable = [
        'movie_id',
        'show_date',
        'show_time',
        'hall_name',
        'hall_type',
        'available_seats',
        'ticket_price',
        'is_active',
    ];

    public function movie()
    {
        return $this->belongsTo(Movies::class);
    }
}
