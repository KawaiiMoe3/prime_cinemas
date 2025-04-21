@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/foodDrinks/food-drinks-checkout.css') }}">
@endsection

@section('title', 'Order Success')

@section('content')
<div class="checkout-success-container">
    <h1>🎉 Thank You for Your Order!</h1>

    <div class="order-details">
        <h3>Order #{{ $order->id }}</h3>
        <p>Status: <strong>{{ ucfirst($order->status) }}</strong></p>
        <p>Total Paid: <strong>RM {{ number_format($order->total, 2) }}</strong></p>
    </div>

    <div class="order-items-list">
        <h4>Items:</h4>
        <ul>
            @forelse($order->foodOrderItems as $item)
                <li>
                    {{ $item->foodItem->name }} (x{{ $item->quantity }}) - RM {{ number_format($item->price, 2) }}
                </li>
            @empty
                <li>No items found for this order.</li>
            @endforelse
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('food-and-drinks') }}" class="btn btn-primary">🎬 Continue Shopping</a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    title: 'Order Successful!',
    text: 'Thank you for your order. You will be redirected shortly.',
    icon: 'success',
    background: '#1a1a1a', // dark background
    color: '#fff', // text color
    iconColor: '#e50914', // make success tick red
    confirmButtonColor: '#e50914', // make OK button red
    confirmButtonText: 'OK',
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = "{{ route('index') }}"; // Redirect to main page
    }
});
</script>
@endsection

