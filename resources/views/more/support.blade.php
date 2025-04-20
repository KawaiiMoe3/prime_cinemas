@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/more.css') }}">
@endsection

@section('title', 'Support | PrimeCinemas')

@section('content')
<div class="container py-5">
    <div class="support-content">
        <h1 class="mb-4">Support & Help</h1>

        <h4>Frequently Asked Questions</h4>
        <ul>
            <li><strong>How do I book a movie ticket?</strong><br> 
                Simply browse the movie, select your showtime, choose your seats, and proceed to checkout.
            </li>
            <li><strong>Can I cancel or change my booking?</strong><br> 
                Yes, cancellations are allowed up to 1 hour before showtime. Visit the "My Bookings" page to manage your tickets.
            </li>
            <li><strong>What payment methods are accepted?</strong><br> 
                We accept online banking, credit/debit cards, and e-wallets like TNG and Boost.
            </li>
        </ul>

        <h4 class="mt-4">Contact Our Support Team</h4>
        <p>If you need assistance, feel free to reach out:</p>
        <ul>
            <li><strong>Email:</strong> support@primecinemas.my</li>
            <li><strong>Phone:</strong> +60 19-989 8989 (9AM - 6PM daily)</li>
            <li><strong>Live Chat:</strong> Coming soon!</li>
        </ul>

        <h4 class="mt-4">Report a Problem</h4>
        <p>If you encountered a technical issue or have feedback, please email to <<strong>report@primecinemas.my</strong>> and our team will get back to you within 24 hours.</p>
    </div>
</div>
@endsection