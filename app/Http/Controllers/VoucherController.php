<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function addVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string|min:6'
        ]);

        $voucher = Voucher::where('voucher_code', $request->voucher_code)
                    ->where('is_active', true)
                    ->where('expiry_date', '>', Carbon::now())
                    ->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher code is invalid or expired.'
            ]);
        }

        $user = Auth::user();
        $wallet = Wallet::where('user_id', $user->id)
                    ->where('voucher_id', $voucher->id)
                    ->first();

        if ($wallet) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher already added to your wallet.'
            ]);
        }

        Wallet::create([
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'wallet_balance' => $voucher->voucher_value
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Voucher code added successfully!'
        ]);
    }

    public function index()
    {
        // Dummy data: four vouchers.
        $vouchers = collect([
            (object)[
                'voucher_name'   => 'Genshin Impact 10% OFF',
                'voucher_type'    => 'percentage',
                'voucher_amount'  => '10%',
                'voucher_qr'      => 'ticket-qr.png'
            ],
            (object)[
                'voucher_name'   => 'Genshin Impact',
                'voucher_type'    => 'MYR',
                'voucher_amount'  => 'MYR5',
                'voucher_qr'      => 'ticket-qr.png'
            ],
            (object)[
                'voucher_name'   => 'Genshin Impact 15% OFF',
                'voucher_type'    => 'percentage',
                'voucher_amount'  => '15%',
                'voucher_qr'      => 'ticket-qr.png'
            ],
            (object)[
                'voucher_name'   => 'Genshin Impact MYR10 Discount',
                'voucher_type'    => 'MYR',
                'voucher_amount'  => 'MYR10',
                'voucher_qr'      => 'ticket-qr.png'
            ]
        ]);
        
        return view('profile.my_wallet', compact('vouchers'));
    }
}
