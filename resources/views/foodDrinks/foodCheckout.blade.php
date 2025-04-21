@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/foodDrinks/food-drinks-checkout.css') }}">

@endsection
@section('title', 'Order Success')

@section('content')

<div class="checkout-wrapper">
    <div class="checkout-top">
        <!-- Left: MovieClub Sign-In -->
        <div class="checkout-box movieclub-signin">
            <h3>SIGN IN NOW</h3>
            <p>Earn up to <strong>225 MovieMoney</strong> for this transaction</p>
            <div class="divider"></div>
            <p>Join MovieClub to earn and redeem rewards</p>
            <a href="#" class="btn btn-movieclub">BENEFITS</a>
        </div>

        <!-- Right: Send Confirmation Email -->
        <div class="checkout-box confirmation-form">
            <h3>SEND CONFIRMATION EMAIL</h3>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" required>

                <label for="mobile">Mobile no.</label>
                <input type="tel" name="mobile" id="mobile" required>

                <div class="terms-checkbox">
                    <input type="checkbox" name="terms" id="terms" required>
                    <label for="terms">
                        I have read and agreed to Terms of Use and Privacy Policy.
                    </label>
                </div>

                <div class="opt-in">
                    <input type="checkbox" name="opt_in" id="opt_in" checked>
                    <label for="opt_in">Opt-in for MovieClub</label>
                </div>

                <button type="submit" class="btn btn-proceed">Proceed to Checkout</button>
            </form>
        </div>
    </div>

    <div class="divider-line"></div> <!-- Divider between sections -->

    <!-- Order Summary -->
    <div class="order-summary">
        <h3>ORDER DETAILS</h3>
        <ul class="order-items">
            @forelse($cartItems as $item)
                <li>
                    <div class="item-name">{{ $item->foodItem->name }}</div>
                    <div class="item-quantity">x{{ $item->quantity }}</div>
                    <div class="item-price">RM {{ number_format($item->foodItem->price, 2) }}</div>
                </li>
            @empty
                <li>No items in cart</li>
            @endforelse
        </ul>

        <div class="order-total">
            <span>Total</span>
            <span>RM {{ number_format($total, 2) }}</span>
        </div>
    </div>
</div>

@endsection
