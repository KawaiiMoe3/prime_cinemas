<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'voucher_id', 'wallet_balance'];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }
}
