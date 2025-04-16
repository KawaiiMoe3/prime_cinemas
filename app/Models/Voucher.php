<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_name','voucher_code', 'voucher_type', 'voucher_value', 'voucher_img', 'voucher_qr',
        'expiry_date', 'redeem_limit', 'redeemed_quantity', 'is_active'
    ];

    public function index()
    {
        $vouchers = Voucher::where('user_id', auth()->id())->orderBy('expiry_date')->get();
        return view('profile.my_wallet', compact('vouchers'));
    }
}
