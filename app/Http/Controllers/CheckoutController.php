<?php

namespace App\Http\Controllers;

use App\Models\FoodOrder;
use App\Models\FoodOrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // 🛒 Show the checkout page
    public function showCheckout()
    {
        $user = Auth::user();
        $sessionId = session()->getId();

        $cartItems = Cart::where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
        ->with('foodItem') // Eager load food item
        ->get();

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->foodItem ? ($item->foodItem->price * $item->quantity) : 0;
        }

        return view('foodDrinks.foodCheckout', compact('cartItems', 'total'));
    }

    // 🧾 Process checkout and create FoodOrder
    public function processCheckout(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required',
        ]);

        $user = Auth::user();
        $sessionId = session()->getId();

        $cartItems = Cart::where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
        ->with('foodItem')
        ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('food-and-drinks')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cartItems as $cartItem) {
                if (!$cartItem->foodItem) {
                    throw new \Exception('Missing food item for cart ID ' . $cartItem->id);
                }
                $total += $cartItem->foodItem->price * $cartItem->quantity;
            }

            $foodOrder = FoodOrder::create([
                'user_id' => $user ? $user->id : null,
                'name' => $user ? $user->name : 'Guest',
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $cartItem) {
                FoodOrderItem::create([
                    'food_order_id' => $foodOrder->id,
                    'food_item_id' => $cartItem->food_item_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->foodItem ? $cartItem->foodItem->price : 0,
                    'selections' => $cartItem->selections ?? null,
                ]);
            }

            Cart::where(function ($query) use ($user, $sessionId) {
                if ($user) {
                    $query->where('user_id', $user->id);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->delete();

            DB::commit();

            return redirect()->route('checkout.success', ['orderId' => $foodOrder->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    // ✅ Show success page after checkout
    public function checkoutSuccess($orderId)
    {
        $order = FoodOrder::with('foodOrderItems.foodItem')->findOrFail($orderId);


        return view('foodDrinks.foodCheckoutSuccess', compact('order'));
    }
}
