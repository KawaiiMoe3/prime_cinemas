@extends('layouts.index')

@section('title', 'My Wallet | PrimeCinemas')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<script src="{{ asset('js/voucher.js') }}"></script>

@section('content')
@php
    $hasVouchers = isset($vouchers) && $vouchers->isNotEmpty();
@endphp

<div class="wallet-page">
    <div class="wallet-banner">
        <div class="wallet-banner-title">
            <h1 class="wallet-title">MY WALLET</h1>
        </div>
        <div class="wallet-banner-buttons">
            <a href="#" id="addVoucherBtn" class="btn-wallet">ADD VOUCHER CODE(S)</a>
            <a href="{{ route('profile.my_orders') }}" class="btn-wallet">MY ORDERS</a>
        </div>
    </div>

    @if (!$hasVouchers)
    <div class="wallet-empty">
        <img src="{{ asset('images/empty-wallet.png') }}" alt="Empty Wallet" class="zero-state-img">
        <h2 class="zero-state-title">Your wallet is empty</h2>
        <p class="zero-state-description">Vouchers and code(s) you have added will be shown here.</p>
    </div>
    @else
    <div class="wallet-voucher-list">
        @foreach($vouchers as $voucher)
            <div class="voucher-card">
                <div class="voucher-card-left">
                    <img src="{{ asset('images/' . ($voucher->voucher_img ?? 'voucher.jpg')) }}" alt="{{ $voucher->voucher_name }}" class="voucher-img">
                </div>
                <div class="voucher-card-middle">
                    <div class="voucher-name">{{ $voucher->voucher_name }}</div>
                    <div class="voucher-type">Type: {{ ucfirst($voucher->voucher_type) }}</div>
                    <div class="voucher-amount">Amount: {{ $voucher->voucher_amount }}</div>
                </div>
                <div class="voucher-card-right">
                    <img src="{{ asset('images/' . $voucher->voucher_qr) }}" alt="Voucher QR" class="voucher-qr">
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
