<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodDrinksController extends Controller
{
    public function showFoodAndDrinks()
    {
        $combos = FoodItem::where('category', 'combo')->get();
        $snacks = FoodItem::where('category', 'snack')->get();
        $beverages = FoodItem::where('category', 'beverage')->get();
        $specials = FoodItem::where('category', 'special')->get();

        $editCartItem = session('editCartItem');

        return view('foodDrinks.foodDrinks', compact('combos', 'snacks', 'beverages', 'specials'));
    }

    public function addToCart(Request $request)
    {
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity', 1);
        $selections = $request->input('selections', null);

        $foodItem = FoodItem::find($itemId);
        if (!$foodItem) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $user = Auth::user();
        $sessionId = session()->getId();

        // Normalize selections for comparison (sort keys and encode as JSON)
        $selectionsJson = null;
        if ($selections) {
            // Ensure consistent key order by sorting
            ksort($selections);
            $selectionsJson = json_encode($selections, JSON_FORCE_OBJECT);
        }

        // Check if the item already exists in the cart
        $cartItem = Cart::where('food_item_id', $itemId)
            ->where(function ($query) use ($user, $sessionId) {
                if ($user) {
                    $query->where('user_id', $user->id);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->where(function ($query) use ($selectionsJson) {
                if ($selectionsJson) {
                    $query->where('selections', $selectionsJson);
                } else {
                    $query->whereNull('selections');
                }
            })
            ->first();

        if ($cartItem) {
            // Update quantity if item exists
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            $cartItem = Cart::create([
                'user_id' => $user ? $user->id : null,
                'session_id' => $user ? null : $sessionId,
                'food_item_id' => $itemId,
                'quantity' => $quantity,
                'selections' => $selections,
            ]);
        }

        return response()->json(['message' => 'Item added to cart']);
    }
    public function getCart(Request $request) // Add Request parameter
    {
        $user = Auth::user();
        $sessionId = session()->getId();

        // If the user is not authenticated, check for existing cart items with a different session_id
        if (!$user) {
            $existingCartItems = Cart::whereNotNull('session_id')
                ->where('session_id', '!=', $sessionId)
                ->whereNull('user_id')
                ->get();

            if ($existingCartItems->isNotEmpty()) {
                // Update the session_id of existing cart items to the current session_id
                Cart::whereNotNull('session_id')
                    ->where('session_id', '!=', $sessionId)
                    ->whereNull('user_id')
                    ->update(['session_id' => $sessionId]);
            }
        }

        $cartItems = Cart::where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
        ->with('foodItem')
        ->get()
        ->map(function ($cartItem) {
            $imagePath = $cartItem->foodItem->image ? asset('images/' . $cartItem->foodItem->image) : asset('images/default.png');
            \Log::info('Cart Item Image Path: ' . $imagePath);
            return [
                'id' => $cartItem->id,
                'food_item_id' => $cartItem->food_item_id,
                'quantity' => $cartItem->quantity,
                'selections' => $cartItem->selections,
                'name' => $cartItem->foodItem->name,
                'price' => $cartItem->foodItem->price,
                'image' => $imagePath,
            ];
        });

        return response()->json(['cart' => $cartItems]);
    }

    public function updateCart(Request $request)
{
    $cartItemId = $request->input('cart_item_id');
    $quantity = $request->input('quantity'); // This is the new absolute quantity
    $selections = $request->input('selections', null);

    $user = Auth::user();
    $sessionId = session()->getId();

    $cartItem = Cart::where('id', $cartItemId)
        ->where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
        ->first();

    if (!$cartItem) {
        return response()->json(['error' => 'Item not found in cart'], 404);
    }

    if ($quantity <= 0) {
        $cartItem->delete();
    } else {
        $cartItem->quantity = $quantity;
        $cartItem->selections = $selections;
        $cartItem->save();
    }

    return response()->json(['message' => 'Cart updated']);
}

    public function removeFromCart(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');

        $user = Auth::user();
        $sessionId = session()->getId();

        $cartItem = Cart::where('id', $cartItemId)
            ->where(function ($query) use ($user, $sessionId) {
                if ($user) {
                    $query->where('user_id', $user->id);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if (!$cartItem) {
            return response()->json(['error' => 'Item not found in cart'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }

    public function editCartItem($cartItemId)
{
    $user = Auth::user();
    $sessionId = session()->getId();

    $cartItem = Cart::where('id', $cartItemId)
        ->where(function ($query) use ($user, $sessionId) {
            if ($user) {
                $query->where('user_id', $user->id);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
        ->with('foodItem')
        ->first();

    if (!$cartItem) {
        return redirect()->route('food-and-drinks')->with('error', 'Cart item not found.');
    }

    // Pass the cart item data to the food and drinks page
    return redirect()->route('food-and-drinks')->with('editCartItem', [
        'cartItemId' => $cartItem->id,
        'foodItemId' => $cartItem->food_item_id,
        'quantity' => $cartItem->quantity,
        'selections' => $cartItem->selections,
    ]);
}

public function deleteAll(Request $request)
{
    $user = Auth::user();
    $sessionId = session()->getId();

    Cart::where(function ($query) use ($user, $sessionId) {
        if ($user) {
            $query->where('user_id', $user->id);
        } else {
            $query->where('session_id', $sessionId);
        }
    })->delete();

    return response()->json(['message' => 'Cart cleared']);
}
}
