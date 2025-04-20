@extends('layouts.index')

@section('title', 'My Orders | PrimeCinemas')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<script src="{{ asset('js/order.js') }}"></script>

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile/orders.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="orders-page">
        <div class="my-orders-banner">
            <h1 class="orders-title">MY ORDERS</h1>
        </div>
    
        @if ($orders->isEmpty())
            <div class="orders-empty">
                <img src="{{ asset('images/no-order.png') }}" alt="No Orders" class="zero-state-img">
                <h2 class="zero-state-title">No Orders Yet</h2>
                <p class="zero-state-description">It's time to treat yourself!</p>
                <a href="{{ route('index') }}" class="btn-confirm-style">BOOK NOW</a>
            </div>
        @else
        <div class="my-orders__wrapper">
                @foreach($orders as $order)
                <div class="my-orders__upcoming-order">
                    <div class="order-card">
                        <div class="order-card__details">
                            <img src="{{ asset('images/'.$order->movie->poster) }}" alt="poster-movie">
                            <div class="order-card__details-info">
                                <div class="order-card__details-info-header">
                                    <div class="order-card__details-info-header-title">
                                        <h4 class="order-card__details-info-header-title-label">
                                            {{ $order->movie->title }}
                                        </h4>
                                        <span><i class="fa-solid fa-greater-than"></i></span>
                                    </div>
                                    <div class="order-card__details-info-header-status">
                                        <div class="order-card__details-info-header-status-inner">
                                            <strong>{{ $order->status }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-card__details-info-content">
                                    <span class="cinema">{{ $order->showtime->cinema }}</span> &nbsp; | &nbsp;
                                    <span class="hall_name">{{ $order->showtime->hall_name }}</span> <br>
                                    <span class="show-date-time">{{ $order->formattedShowDate }}, {{ $order->formattedShowTime }}</span>
                                    <span class="seats">
                                        &nbsp; | &nbsp;
                                        {{ $order->formattedSeats }}
                                    </span>
                                </div>
                                <p class="order-card__details-info-price-points">
                                    <strong>RM {{ $order->grand_total }}</strong> &nbsp; | &nbsp;
                                    EARNED: <strong>{{ $order->movie_money }} MovieMoney</strong>
                                </p>
                            </div>
                        </div>
                        <div class="order-card__action">
                            <button class="order-card__action-buy-button">
                                <p class="button__content">Get More</p>
                            </button>
                            <button class="tgv-order-card__action-qr-button">
                                <span class="button__inner">
                                    <p class="button__content">
                                        <i class="fa-solid fa-qrcode"></i>
                                        View QR
                                    </p>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<x-go-to-top-button />
@endsection

@section('scripts')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Order Success',
        text: '{{ session('success') }}',
        background: "#454545",
        confirmButtonColor: '#ff1e1e'
    });
</script>
@endif
<script>
$(document).ready(function(){
    $('.order-card__action-buy-button').on('click', function(){
        window.location.href = "{{ route('movies.listing') }}";
    });
});
</script>
@endsection