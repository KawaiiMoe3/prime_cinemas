<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model
{
    protected $fillable = ['user_id', 'name', 'email', 'mobile', 'total', 'status'];

    public function foodOrderItems()
    {
        return $this->hasMany(FoodOrderItem::class, 'food_order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
