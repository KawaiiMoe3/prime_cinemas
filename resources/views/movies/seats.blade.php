@extends('layouts.index')
@section('hideFooter', true)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/movies/seats.css') }}">
@endsection

@section('title', 'PrimeCinemas | ' .$movie->title)

@section('content')
<div class="movie-banner">
    <div class="movie-banner-bg">
        <img src="{{ asset('images/'.($movie->bg_movie ?? 'bg_movie_default.jpg')) }}" class="d-block w-100">
        <div class="movie-banner_back-btn">
            <button class="btn-back" onclick="history.back()">
                <i class="fa-solid fa-caret-left"></i> &nbsp;
                Back
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

        <!-- Legends Info -->
        <div class="ticketing-journey-select-seats_legends">
            <div class="ticketing-journey-select-seats_legends-inner">
                @if (!empty($myBookedSeats))
                <div class="ticketing-journey-select-seats_legend ng-star-inserted">
                    <div class="ticketing-journey-select-seats_legend-icon">
                        <img src="{{ asset('images/my-sold-single-seat.svg') }}" alt="my-seat">
                    </div>
                    <div class="ticketing-journey-select-seats_legend-text">
                        My Seat
                    </div>
                </div>
                @endif
                <div class="ticketing-journey-select-seats_legend ng-star-inserted">
                    <div class="ticketing-journey-select-seats_legend-icon">
                        <img src="{{ asset('images/selected-seat.png') }}" alt="selected-seat">
                    </div>
                    <div class="ticketing-journey-select-seats_legend-text">
                        Selected
                    </div>
                </div>
                <div class="ticketing-journey-select-seats_legend ng-star-inserted">
                    <div class="ticketing-journey-select-seats_legend-icon">
                        <img src="{{ asset('images/sold-seat.png') }}" alt="sold-seat">
                    </div>
                    <div class="ticketing-journey-select-seats_legend-text">
                        Sold
                    </div>
                </div>
                <div class="ticketing-journey-select-seats_legend ng-star-inserted">
                    <div class="ticketing-journey-select-seats_legend-icon">
                        <img src="{{ asset('images/single-seat.svg') }}" alt="single-seat">
                    </div>
                    <div class="ticketing-journey-select-seats_legend-text">
                        Single
                    </div>
                </div>
                <div class="ticketing-journey-select-seats_legend ng-star-inserted">
                    <div class="ticketing-journey-select-seats_legend-icon">
                        <img src="{{ asset('images/double-seat.svg') }}" alt="double-seat">
                    </div>
                    <div class="ticketing-journey-select-seats_legend-text">
                        Twin
                    </div>
                </div>
            </div>
        </div>

        <!-- Screen -->
        <div class="ticketing-journey-select-seats_screens">
            <img src="{{ asset('images/screen-desktop.png') }}" alt="screen-desktop" class="screen-desktop">
            <img src="{{ asset('images/screen-mobile.png') }}" alt="screen-mobile" class="screen-mobile">
        </div>
        </div>

        <!-- Seats Layout -->
        <div class="seat-layout_seats">
        @php
            $rows = ['A','B','C','D','E','F','G','H','J'];
            $columns = range(1, 16);
        @endphp

        @foreach ($rows as $row)
        <div class="seat-layout_row">
            <div class="seat-layout_row-label">{{ $row }}</div>

            @foreach ($columns as $col)
            @php
                $seatCode = $row . $col;
                $isMySeat = in_array($seatCode, $myBookedSeats);
                $isGloballyBooked = in_array($seatCode, $allBookedSeats);
            @endphp
            <div class="ng-star-inserted">
                <button type="button" 
                        class="seat ng-star-inserted" 
                        data-seat="{{ $seatCode }}, Single"
                        {{ $isGloballyBooked ? 'disabled' : '' }}>
                    <img class="seat_icon" 
                        src="{{ asset(
                            $isMySeat ? 'images/my-sold-single-seat.svg' :
                            ($isGloballyBooked ? 'images/sold-seat.png' : 'images/single-seat.svg')
                        ) }}" 
                        alt="{{ $isMySeat ? 'my-seat' : ($isGloballyBooked ? 'sold' : 'available') }}">
                </button>
            </div>
            @endforeach
            <div class="seat-layout_row-label">{{ $row }}</div>
        </div>
        @endforeach
    </div>

    <!-- Footer Layout -->
    <div class="ticketing-journey-footer_wrapper">
        <div class="ticketing-journey-footer_inner-seats">
            <div class="ticketing-journey-footer_seats">
                <span class="ticketing-journey-footer_seats-label">
                    Your Seat(s):
                </span>
                <span class="ticketing-journey-footer__seat-numbers"></span>
            </div>
            <button type="button" class="ticketing-journey-footer_seats-button ng-star-inserted"
                    data-bs-toggle="modal" data-bs-target="#ticketConfirmationModal"
            >
                <span class="button-content">Book Seat(s)</span>
            </button>
        </div>
    </div>
</div>

<!-- Ticket Confirmation Modal -->
<div class="modal fade" id="ticketConfirmationModal" tabindex="-1" aria-labelledby="ticketConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content dark-modal">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ticketConfirmationModalLabel">
                    Ticket Confirmation
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="movie-banner-bg-modal">
                    <img src="{{ asset('images/'.($movie->bg_movie ?? 'bg_movie_default.jpg')) }}" class="d-block w-100">
                    <p class="movie-title">{{ $movie->title }}</p>
                </div>
                <div class="ticket-details">
                    <div class="item">
                        <i class="fa-solid fa-clapperboard"></i>
                        <span>{{ $showtime->cinema }}</span>
                    </div>
                    <div class="item">
                        <i class="fa-solid fa-tv"></i>
                        <span>{{ $showtime->hall_type }}, {{ $showtime->hall_name }}</span>
                    </div>
                    <div class="item">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span>{{ $formattedShowDate }}, {{ $formattedShowTime }}</span>
                    </div>
                </div>
                <div class="movie-banner_selected-seats">
                    <img class="seat_icon" src="{{ asset('images/seat.svg') }}" alt="single-seat">
                    <span class="movie-banner_info-selected-seats"></span>
                </div>
                <div class="ticket-item">
                    <div class="ticket-label">
                        <div class="ticket-type">SINGLE</div>
                        <div class="ticket-price" data-ticket-price="{{ $showtime->ticket_price }}">
                            RM {{ $showtime->ticket_price }}
                        </div>
                    </div>
                    <div class="ticket-quantity"></div>
                    <div class="ticket-total"></div>
                </div>
                <div class="movie-banner_edit-seats">
                    <button type="button" class="btn-edit-seat" data-bs-dismiss="modal">
                        Edit Seat
                        &nbsp;
                        <i class="fa-solid fa-greater-than"></i>
                    </button>
                </div>
            </div>
            <form id="seatSelectionForm" method="POST" action="{{ route('proceed') }}">
                @csrf
                <input type="hidden" name="selected_seats" id="selected_seats_input">
                <input type="hidden" name="ticket_quantity" id="ticket_quantity_input">
                <input type="hidden" name="ticket_total" id="ticket_total_input">
                <input type="hidden" name="net_total" id="ticket_net_total">
                <input type="hidden" name="movie_slug" id="movie_slug_input">
                <input type="hidden" name="show_date" id="show_date_input">
                <input type="hidden" name="showtime_id" id="showtime_id_input">
            
                <div class="modal-footer">
                    <button type="button" class="btn-proceed" disabled>Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-go-to-top-button />
@endsection

@section('scripts')
<script src="{{ asset('js/movies/seats.js') }}"></script>
<script>
$(document).ready(function () {
    const selectedSeats = new Set();
    const aislePairs = ['A2-A3', 'A14-A16'];
    const rowsWithGapRule = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J'];

    // Convert movie title to slug and assign to hidden input
    const movieTitle = @json($movie->title);
    const movieSlug = movieTitle.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    $('#movie_slug_input').val(movieSlug); // Fill hidden input

    const showDate = @json($showtime->show_date);
    const showtimeId = @json($showtime->id);
    $('#show_date_input').val(showDate);
    $('#showtime_id_input').val(showtimeId);

    // Handle seat click
    $('.seat').on('click', function () {
        const $button = $(this);
        const seatInfo = $button.data('seat');
        const seatName = seatInfo.split(',')[0].trim();
        const $img = $button.find('img');

        // Deselect if already selected
        if (selectedSeats.has(seatName)) {
            selectedSeats.delete(seatName);
            $img.attr('src', "{{ asset('images/single-seat.svg') }}");
        } else {
            // Limit selection to max 10 seats
            if (selectedSeats.size >= 10) {
                Swal.fire({
                    icon: 'warning',
                    background: "#454545",
                    text: 'Can\'t select more than 10 tickets at a time.',
                    confirmButtonColor: '#ff1e1e'
                });
                return;
            }

            // Gap rule validation
            const testSet = new Set(selectedSeats);
            testSet.add(seatName);

            if (!isValidSeatGap(testSet)) {
                Swal.fire({
                    icon: 'warning',
                    background: "#454545",
                    text: 'Please leave a minimum gap of two (2) seats.',
                    confirmButtonColor: '#ff1e1e'
                });
                return;
            }

            // Add to selected seats
            selectedSeats.add(seatName);
            $img.attr('src', "{{ asset('images/selected-seat.png') }}");
        }

        updateFooter(); // Update UI footer
    });

    // Update footer and price/seat summary
    function updateFooter() {
        const $seatLabel = $('.ticketing-journey-footer_seats-label');
        const $seatDisplay = $('.ticketing-journey-footer__seat-numbers');
        const $bookButton = $('.ticketing-journey-footer_seats-button');
        const $seatSelected = $('.movie-banner_info-selected-seats');

        const $ticketQuantity = $('.ticket-quantity');
        const ticketPrice = parseFloat($('.ticket-price').data('ticket-price')) || 0;
        const $ticketTotal = $('.ticket-total');
        const $proceedBtn = $('.btn-proceed');

        const selectedCount = selectedSeats.size;
        const totalPrice = selectedCount * ticketPrice;
        let netTotal = 0;
        netTotal += totalPrice

        if (selectedCount > 0) {
            const sortedSeats = getSortedSeats(Array.from(selectedSeats));
            $seatLabel.show();
            $seatDisplay.text(sortedSeats.join(', '));
            $bookButton.prop('disabled', false).css('cursor', 'pointer').removeClass('disabled');
            $seatSelected.text(sortedSeats.join(', '));
            $('#selected_seats_input').val(Array.from(sortedSeats).join(','));

            // Update quantity and total price
            $ticketQuantity.text(selectedCount);
            $('#ticket_quantity_input').val(selectedCount);
            $ticketTotal.text('RM ' + totalPrice.toFixed(2));
            $('#ticket_total_input').val(totalPrice.toFixed(2));
            $('#ticket_net_total').val(netTotal.toFixed(2));
            $proceedBtn.text('Proceed - RM ' + netTotal.toFixed(2)).prop('disabled', false).removeClass('disabled');
        } else {
            $seatLabel.hide();
            $seatDisplay.text('');
            $bookButton.prop('disabled', true).css('cursor', 'not-allowed').addClass('disabled');
            $seatSelected.text('');

            $ticketQuantity.text('0');
            $ticketTotal.text('RM 0.00');
            $proceedBtn.text('Proceed - RM 0.00').prop('disabled', true).addClass('disabled');
        }
    }

    // Sorting seats by row and column
    function getSortedSeats(seats) {
        return seats.sort((a, b) => {
            const [rowA, numA] = a.match(/([A-Z]+)(\d+)/).slice(1);
            const [rowB, numB] = b.match(/([A-Z]+)(\d+)/).slice(1);
            return rowA === rowB
                ? parseInt(numA) - parseInt(numB)
                : rowA.localeCompare(rowB);
        });
    }

    // Gap rule check
    function isValidSeatGap(seatSet) {
        const sorted = getSortedSeats(Array.from(seatSet));
        const seatMap = {};

        for (let seat of sorted) {
            const [row, num] = seat.match(/([A-Z]+)(\d+)/).slice(1);
            const col = parseInt(num);
            if (!seatMap[row]) seatMap[row] = [];
            seatMap[row].push(col);
        }

        for (let row in seatMap) {
            const cols = seatMap[row].sort((a, b) => a - b);
            if (!rowsWithGapRule.includes(row)) continue;

            for (let i = 0; i < cols.length - 1; i++) {
                const current = cols[i];
                const next = cols[i + 1];
                const gap = next - current;

                if (
                    gap === 2 &&
                    current >= 3 && current <= 14 &&
                    next >= 3 && next <= 14
                ) {
                    const middle = current + 1;
                    const middleSeat = `${row}${middle}`;
                    const pairId = `${row}${current}-${row}${next}`;
                    if (!seatSet.has(middleSeat) && !aislePairs.includes(pairId)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    updateFooter(); // Initial update on page load

    // Proceed button click triggers form submit
    $('.btn-proceed').on('click', function (e) {
        e.preventDefault();
        $('#seatSelectionForm').submit();
    });
    
});
</script>
@endsection