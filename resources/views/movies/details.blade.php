@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/movies/details.css') }}">
@endsection

@section('title', 'PrimeCinemas | '. $movie->title)

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
        <div class="movie-banner_info-cta">
            <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMovieSynopsis" aria-expanded="false" aria-controls="collapseMovieSynopsis" id="toggleButton">
                <span class="btn-more-less-info">More Info</span> &nbsp;
                <i class="fa-solid fa-caret-down"></i>
            </button>
            @if(!empty($movie->trailer_url))
            <button type="button" class="btn btn-trailer-modal" data-bs-toggle="modal" data-bs-target="#trailerModal">
                Watch Trailer
            </button>
            <!-- Trailer Modal -->
            <div class="modal fade" id="trailerModal" tabindex="-1" aria-labelledby="trailerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content rounded-4 bg-black">
                        <div class="ratio ratio-16x9">
                            <iframe id="youtubePlayer" src="{{ $movie->trailer_url }}" 
                                class="rounded-4"
                                title="YouTube video player" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                referrerpolicy="strict-origin-when-cross-origin" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="collapse" id="collapseMovieSynopsis">
                <div class="card card-body movie-banner_card">
                    <div class="movie-banner_info-synopsis">
                        <div class="movie-banner_info-synopsis-header">
                            Synopsis
                        </div>
                        <div class="movie-banner_info-synopsis-content">
                            {!! nl2br(e($movie->description)) !!}
                        </div>
                        <div class="movie-banner_info-synopsis-header">
                            Cast
                        </div>
                        <div class="movie-banner_info-synopsis-content">
                            {{ $movie->cast }}
                        </div>
                        <div class="movie-banner_info-more-holder">
                            <div class="movie-banner_info-more-item">
                                <div class="movie-banner_info-more-item-header">
                                    Director
                                </div>
                                <div class="movie-banner_info-more-item-desc">
                                    {{ $movie->director }}
                                </div>
                            </div>
                            <div class="movie-banner_info-more-item">
                                <div class="movie-banner_info-more-item-header">
                                    Release date
                                </div>
                                <div class="movie-banner_info-more-item-desc">
                                    {{ $movie->release_date }}
                                </div>
                            </div>
                            <div class="movie-banner_info-more-item">
                                <div class="movie-banner_info-more-item-header">
                                    Subtitles
                                </div>
                                <div class="movie-banner_info-more-item-desc">
                                    {{ $movie->subtitles }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Date Tabs -->
<div id="movieShowtimeWrapper" data-movie-id="{{ $movie->id }}">
    <div class="container showtime-container">
        <div class="d-flex justify-content-between align-items-center showtime-tabs">
            <ul class="nav m-tabs" id="movieShowtimeDateTab" role="tablist"></ul>
        </div>

        <!-- Regions Filter -->
        <div class="showtime-filter">
            <p class="showtime-tab-title text-uppercase">Select Cinemas & Time</p>
            <div class="region-filter">
                <label for="region-select" class="text-uppercase">Regions:</label>
                <div class="region-dropdown">
                    <div class="selected-option">
                        <span id="selected-text">All</span>
                        <span class="caret-icon"><i class="fa-solid fa-caret-down"></i></span>
                    </div>
                    <ul class="dropdown-options">
                        <li data-value="all" class="active">All</li>
                        <li data-value="klang-valley">Klang Valley</li>
                        <li data-value="johor">Johor</li>
                        <li data-value="perak">Perak</li>
                        <li data-value="pulau-pinang">Pulau Pinang</li>
                        <li data-value="melaka">Melaka</li>
                        <li data-value="negeri-sembilan">Negeri Sembilan</li>
                        <li data-value="pahang">Pahang</li>
                        <li data-value="perlis">Perlis</li>
                        <li data-value="sabah">Sabah</li>
                        <li data-value="sarawak">Sarawak</li>
                        <li data-value="kedah">Kedah</li>
                        <li data-value="labuan">Labuan</li>
                        <li data-value="putrajaya">Putrajaya</li>
                    </ul>
                </div>
                <input type="hidden" name="region" id="region-select" value="all">
            </div>
        </div>
        
        <!-- Movie Showing Times -->
        <div class="tab-content" id="myTabContent">
            <!-- Movie Showing Time1 -->
            <div class="tab-pane fade show active" id="movie-showing-time1-tab-pane" role="tabpanel" aria-labelledby="movie-showing-time1-tab" tabindex="0">
                <div class="row">
                    <div class="col-12"> <!-- Ensures full width inside the row -->
                        <div class="accordion" id="accordionShowtimesPanels">
                            <div class="accordion-item"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-go-to-top-button />
@endsection

@section('scripts')
<script src="{{ asset('js/movies/details.js') }}"></script>
@endsection