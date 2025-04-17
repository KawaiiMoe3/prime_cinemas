@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/movies/seats.css') }}">
@endsection

@section('title', 'PrimeCinemas | ')

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
                <span class="movie-banner_info-hall-type">{{ $showtime->hall_type }}</span>
            </div>
            <div class="movie-banner_info-movie-group">
                <i class="fa-regular fa-calendar-days"></i>
                <span class="movie-banner_info-show-date-time">{{ $formattedShowDate }}, {{ $formattedShowTime }}</span>
            </div>
        </div>
    </div>
</div>
<x-go-to-top-button />
@endsection

@section('scripts')
<script src="{{ asset('js/movies/seats.js') }}"></script>
@endsection