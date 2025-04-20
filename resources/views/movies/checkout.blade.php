@extends('layouts.index')
@section('hideFooter', true)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/movies/checkout.css') }}">
@endsection

@section('title', 'PrimeCinemas | Checkout')

@section('content')
<div class="movie-banner">
    <div class="movie-banner-bg">
        <img src="{{ asset('images/'.($movie->bg_movie ?? 'bg_movie_default.jpg')) }}" class="d-block w-100">
        <div class="movie-banner_back-btn">
            <button class="btn-back">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
    <div class="container">
        <p class="movie-title">{{ $movie->title }}</p>
        <div class="movie-banner_info-holder">
            <div class="movie-banner_info-rating">
                @switch($movie->rating)
                    @case('U')
                        <img src="{{ asset('images/c5.png') }}" alt="U">
                        @break
                    @case('P12')
                        <img src="{{ asset('images/c1.png') }}" alt="P12">
                        @break
                    @case('13')
                        <img src="{{ asset('images/c4.png') }}" alt="13">
                        @break
                    @case('16')
                        <img src="{{ asset('images/c3.png') }}" alt="16">
                        @break
                    @case('18')
                        <img src="{{ asset('images/c2.png') }}" alt="18">
                        @break
                    @default
                    <img src="{{ asset('images/c6.png') }}" alt="TBA">
                @endswitch
            </div>
            <div class="movie-banner_info-text">
                <span class="movie-banner_info-text-group">{{ $movie->genre }}</span>
                <span class="movie-banner_info-text-group">{{ $movie->formatted_duration }}</span>
                <span class="movie-banner_info-text-group">{{ $movie->language }}</span>
            </div>
        </div>
        <div class="movie-banner_info-movie">
            <div class="movie-banner_info-movie-group">
                <i class="fa-solid fa-clapperboard"></i>
                <span class="movie-banner_info-cinema">{{ $showtime->cinema }}</span>
            </div>
            <div class="movie-banner_info-movie-group">
                <i class="fa-solid fa-tv"></i>
                <span class="movie-banner_info-hall-type">
                    {{ $showtime->hall_type }}, {{ $showtime->hall_name }}
                </span>
            </div>
            <div class="movie-banner_info-movie-group">
                <i class="fa-regular fa-calendar-days"></i>
                <span class="movie-banner_info-show-date-time">{{ $formattedShowDate }}, {{ $formattedShowTime }}</span>
            </div>
        </div>
        <div class="movie-banner_selected-seats">
            <img class="seat_icon" src="{{ asset('images/seat.svg') }}" alt="single-seat">
            <span class="movie-banner_info-selected-seats">{{ $seats }}</span>
        </div>
    </div>
    <div class="container">
        <div class="checkout_wrapper">
            <div class="checkout__summary">
                <div class="checkout__summary-header">
                    <div class="checkout__summary-header-title">
                        Order Details
                    </div>
                    <div class="checkout__summary-header-points">
                        You'll earn <strong class="points">{{ $movieMoney }}</strong> MovieMoney
                    </div>
                </div>
                <div class="checkout__summary-content">
                    <div class="checkout__summary-content-group">
                        <div class="checkout__summary-content-group-header">
                            <div class="header-title">Seats</div>
                            <div class="header-item">
                                <button class="checkout__summary-content-group-edit btn-edit-seats"
                                    data-url="{{ route('movies.seats', ['movieSlug' => $movieSlug, 'showDate' => $showDate, 'id' => $id]) }}"
                                >
                                    Edit Seat
                                    &nbsp;
                                    <i class="fa-solid fa-greater-than"></i>
                                </button>
                            </div>
                        </div>
                        <div class="checkout__summary-content-group-content-detail">
                            <div class="checkout__summary-content-group-content-detail-item">
                                <div class="ticket-type">SINGLE</div>
                                <div class="ticket-price" data-ticket-price="">
                                    RM {{ $showtime->ticket_price }}
                                </div>
                            </div>
                            <div class="ticket-quantity">{{ $quantity }}</div>
                            <div class="ticket-total">RM {{ $total }}</div>
                        </div>
                        <div class="checkout__summary-content-group-fee">
                            <div class="item-fee">Processing Fee</div>
                            <div class="item-fee">RM <span class="processing-fee">{{ number_format($processingFee, 2) }}</span></div>
                        </div>
                    </div>
                    <div class="checkout__details-line"></div>
                    <div class="checkout__summary-content-group">
                        <div class="checkout__summary-content-group-header">
                            <div class="header-title">Food & Drinks</div>
                            <button class="checkout__summary-content-group-edit-food">
                                Add
                                &nbsp;
                                <i class="fa-solid fa-greater-than"></i>
                            </bu    tton>
                        </div>
                    </div>
                </div>
            </div>
            <div class="checkout__summary-content-group-codes">
                <button class="checkout__summary-content-group-edit-codes">
                    <p class="button__content">
                        <span><img src="{{ asset('images/redeem-reward.png') }}" alt="voucher-icon"></span>
                        <span class="button-title">My Rewards</span>
                    </p>
                    <span><i class="fa-solid fa-greater-than"></i></span>
                </button>
                <button class="checkout__summary-content-group-edit-codes">
                    <p class="button__content">
                        <span><img src="{{ asset('images/voucher.png') }}" alt="voucher-icon"></span>
                        <span class="button-title">Voucher Code(s)</span>
                    </p>
                    <span><i class="fa-solid fa-greater-than"></i></span>
                </button>
            </div>
        </div>
    </div>
    <div class="ticketing-journey-footer_wrapper">
        <div class="ticketing-journey-footer_inner-seats">
            <!-- Countdown Timer Display -->
            <div id="countdown-timer">
                <img src="{{ asset('images/stopwatch.svg') }}" alt="Clock" class="countdown-icon">
                <span class="countdown-text">Time Left:</span>
                <span id="time-remaining" class="countdown-time">07:00</span>
            </div>
            <form id="checkoutForm" action="{{ route('checkout') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="movie_id" value="{{ $showtime->movie_id }}">
                <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
                <input type="hidden" name="ticket_quantity" value="{{ $quantity }}">
                <input type="hidden" name="selected_seats" value="{{ $seats }}">
                <input type="hidden" name="ticket_total" value="{{ $total }}">
                <input type="hidden" name="net_total" value="{{ $netTotal }}">
                <input type="hidden" name="processing_fee" value="{{ $processingFee }}">
                <input type="hidden" name="grand_total" value="{{ $grandTotal }}">
                <input type="hidden" name="movie_money" value="{{ $movieMoney }}">
                <!-- Checkout Button -->
                <button id="checkout-button" type="button" class="ticketing-journey-footer_checkout-button ng-star-inserted">
                    <span class="button-content">Checkout - RM {{ $grandTotal }}</span>
                </button>
            </form>
        </div>
    </div>
</div>

<x-go-to-top-button />
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    // Clear session after cancel checkout
    $('.btn-back').on('click', function(){
        Swal.fire({
            title: 'Leaving so soon?',
            text: "Any details entered will be lost.",
            imageUrl: "/images/leave.png",
            background: "#454545",
            showCancelButton: true,
            confirmButtonText: 'Leave This Page',
            cancelButtonText: 'Stay On This Page',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to route that clears session
                window.location.href = "{{ route('session.expired') }}";
            }
        });
    });

    // Go back to select-seats page
    $('.btn-edit-seats').on('click', function(){
        const url = $(this).data('url');
        window.location.href = url;
    });

    // Handle session timeout
    let remainingTime = {{ $remainingSeconds ?? 420 }};

    function updateTimerDisplay() {
        const minutes = String(Math.floor(remainingTime / 60)).padStart(2, '0');
        const seconds = String(remainingTime % 60).padStart(2, '0');
        $('#time-remaining').text(`${minutes}:${seconds}`);
    }

    updateTimerDisplay(); // Initial display

    const countdownInterval = setInterval(function () {
        remainingTime--;

        if (remainingTime <= 0) {
            clearInterval(countdownInterval);

            // Disable the checkout button
            $('#checkout-button').prop('disabled', true).addClass('disabled');

            Swal.fire({
                imageUrl: "/images/expired.png",
                title: 'Time Out',
                text: 'Your session has timed out, please try again.',
                background: "#454545",
                confirmButtonColor: '#ff1e1e'
            }).then(() => {
                window.location.href = `{{ route('session.expired') }}`;
            });
        } else {
            updateTimerDisplay();
        }
    }, 1000);

    // Checkout form submission
    $('#checkout-button').on('click', function (e) {
        e.preventDefault();
        $('#checkoutForm').submit();
    });
});
</script>
@endsection