<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'food_item_id', 'quantity', 'price', 'selections'];

    protected $casts = [
        'selections' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }
}
