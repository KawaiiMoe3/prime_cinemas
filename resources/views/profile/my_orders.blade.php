@extends('layouts.index')

@section('title', 'My Orders | PrimeCinemas')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<script src="{{ asset('js/order.js') }}"></script>

@section('content')
@php
    $user = session('user');
    $hasOrders = $orders->isNotEmpty();
@endphp

<div class="orders-page">
    <div class="orders-banner">
        <h1 class="orders-title">MY ORDERS</h1>
    </div>

    @if (!$hasOrders)
        <div class="orders-empty">
            <img src="{{ asset('images/no-order.png') }}" alt="No Orders" class="zero-state-img">
            <h2 class="zero-state-title">No Orders Yet</h2>
            <p class="zero-state-description">It's time to treat yourself!</p>
            <a href="{{ route('index') }}" class="btn-confirm-style">BOOK NOW</a>
        </div>
    @else
        <div class="orders-list">
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-card-left">
                        <img src="{{ asset('images/' . $order->movie->poster) }}" alt="{{ $order->movie->title }}" class="order-poster">
                    </div>
                    
                    <div class="order-card-middle">
                        <div class="order-row order-row-1">
                            <div class="order-title">{{ $order->movie->title }}</div>
                            <div class="order-genre">{{ $order->movie->genre }}</div>
                            <div class="order-duration">
                                <i class="fa-solid fa-clock"></i> {{ $order->movie->duration }} mins
                            </div>
                            <div class="order-ticket-type">{{ ucfirst($order->movie_type) }}</div>
                        </div>
                        <div class="order-row order-row-2">
                            <div class="order-date">
                                <i class="fa-solid fa-calendar"></i> {{ \Carbon\Carbon::parse($order->selected_movie_date)->format('d M Y') }}
                            </div>
                            <div class="order-time">
                                <i class="fa-solid fa-clock"></i> {{ \Carbon\Carbon::parse($order->selected_movie_time)->format('h:i A') }}
                            </div>
                        </div>
                        <div class="order-row order-row-3">
                            <div class="order-seats">
                                <i class="fa-solid fa-chair"></i> Seats: {{ $order->selected_seats }}
                            </div>
                            <div class="order-quantities">
                                @if($order->adults > 0 && $order->children == 0)
                                    <i class="fa-solid fa-user"></i> Adults: {{ $order->adults }}
                                @elseif($order->adults > 0 && $order->children > 0)
                                    <i class="fa-solid fa-user"></i> Adults: {{ $order->adults }},
                                    <i class="fa-solid fa-user"></i> Children: {{ $order->children }}
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="order-card-right">
                        <img src="{{ asset('images/' . $order->ticket_qr) }}" alt="Ticket QR" class="ticket-qr">
                        <div class="booking-number">Booking #: {{ $order->booking_id }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection