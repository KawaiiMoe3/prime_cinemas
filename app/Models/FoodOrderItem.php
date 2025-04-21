<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodOrderItem extends Model
{
    protected $fillable = ['food_order_id', 'food_item_id', 'quantity', 'price', 'selections'];

    protected $casts = [
        'selections' => 'array', // auto convert JSON to array
    ];

    public function order()
    {
        return $this->belongsTo(FoodOrder::class, 'food_order_id');
    }

    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }
}
