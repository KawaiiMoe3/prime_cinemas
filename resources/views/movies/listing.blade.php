@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/movies/listing.css') }}">
@endsection

@section('title', 'PrimeCinemas | Current & Upcoming Movies')

@section('content')
<div class="container movies-container">
    <!-- Tabs -->
    <div class="d-flex justify-content-between align-items-center">
        <ul class="nav m-tabs" id="myTab" role="tablist">
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item active" id="nowshowing-tab" data-bs-toggle="tab" data-bs-target="#nowshowing-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                    Now Showing
                </button>
            </li>
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item" id="kids-special-tab" data-bs-toggle="tab" data-bs-target="#kids-special-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                    Kids Special
                </button>
            </li>
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item" id="bookearly-tab" data-bs-toggle="tab" data-bs-target="#bookearly-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                    Book Early
                </button>
            </li>
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item" id="comingsoon-tab" data-bs-toggle="tab" data-bs-target="#comingsoon-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">
                    Coming Soon
                </button>
            </li>
        </ul>
        <div class="view-all-tab">
            <button class="btn-viewall" onclick="window.location.href='#';">
                <i class="fa-solid fa-sliders"></i> &nbsp;
                Filter By
            </button>
        </div>
    </div>

    <div class="tab-content py-4" id="myTabContent">
        <!-- Tabs: Now Showing -->
        <div class="tab-pane fade show active" id="nowshowing-tab-pane" role="tabpanel" aria-labelledby="nowshowing-tab" tabindex="0">
            <!-- Top Popular Movies -->
            <div class="row justify-content-center g-4 row-top-popular-movies">
                <!-- Left Poster (Bigger) -->
                @if($nowShowingTopFamousMovies->isNotEmpty())
                    @foreach($nowShowingTopFamousMovies as $movie)
                    <div class="col-md-4 col-top-popular-movies">
                        <div class="movie-card" onclick="window.location.href='{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}'">
                            <img src="{{ asset('images/'.$movie->poster) }}" class="img-fluid rounded" alt="Ne Zha 2">
                            <p class="text-center fw-bold mt-2 ct-title">{{ $movie->title }}</p>
                            <p>
                                <a href="{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}" class="btn btn-primary ct-movie-btn">
                                    Book Now
                                </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="empty-movies">
                    <img src="{{ asset('images/movie-unavailable.svg') }}" alt="No Movies">
                    <p class="empty-movies-content">
                        Top famous movies will be release soon. <br>
                        Please wait for further announcements. Thank you. <br>
                        👉👈
                    </p>
                </div>
                @endif
            </div>

            <!-- Normal Movies -->
            <div class="row row-normal-movies row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                @if($nowShowingMovies->isNotEmpty())
                    @foreach($nowShowingMovies as $movie)
                        <div class="card c-movie-card" onclick="window.location.href='{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}'">
                            <img src="{{ asset('images/'.$movie->poster) }}" class="card-img-top c-movie-img" alt="{{ $movie->title }}">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">{{ $movie->title }}</p>
                                <a href="{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-movies">
                        <img src="{{ asset('images/movie-unavailable.svg') }}" alt="No Movies">
                        <p class="empty-movies-content">
                            No upcoming movies at the moment. <br>
                            Please wait for further announcements. Thank you. <br>
                            👉👈
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tabs: Kid Special -->
        <div class="tab-pane fade" id="kids-special-tab-pane" role="tabpanel" aria-labelledby="kids-special-tab" tabindex="0">
            <!-- Normal Movies -->
            <div class="row row-normal-movies row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                @if($kidsSpecialMovies->isNotEmpty())
                    @foreach($kidsSpecialMovies as $movie)
                        <div class="card c-movie-card" onclick="window.location.href='{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}'">
                            <img src="{{ asset('images/'.$movie->poster) }}" class="card-img-top c-movie-img" alt="{{ $movie->title }}">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">{{ $movie->title }}</p>
                                <a href="{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-movies">
                        <img src="{{ asset('images/movie-unavailable.svg') }}" alt="No Movies">
                        <p class="empty-movies-content">
                            No upcoming movies at the moment. <br>
                            Please wait for further announcements. Thank you. <br>
                            👉👈
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tabs: Book Early -->
        <div class="tab-pane fade" id="bookearly-tab-pane" role="tabpanel" aria-labelledby="bookearly-tab" tabindex="0">
            <!-- Normal Movies -->
            <div class="row row-normal-movies row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                @if($bookEarlyMovies->isNotEmpty())
                    @foreach($bookEarlyMovies as $movie)
                        <div class="card c-movie-card" onclick="window.location.href='{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}'">
                            <img src="{{ asset('images/'.$movie->poster) }}" class="card-img-top c-movie-img" alt="{{ $movie->title }}">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">{{ $movie->title }}</p>
                                <a href="{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-movies">
                        <img src="{{ asset('images/movie-unavailable.svg') }}" alt="No Movies">
                        <p class="empty-movies-content">
                            No upcoming movies at the moment. <br>
                            Please wait for further announcements. Thank you. <br>
                            👉👈
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tabs: Coming Soon -->
        <div class="tab-pane fade" id="comingsoon-tab-pane" role="tabpanel" aria-labelledby="comingsoon-tab" tabindex="0">
            <!-- Normal Movies -->
            <div class="row row-normal-movies row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                @if($comingSoonMovies->isNotEmpty())
                    @foreach($comingSoonMovies as $movie)
                        <div class="card c-movie-card" onclick="window.location.href='{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}'">
                            <img src="{{ asset('images/'.$movie->poster) }}" class="card-img-top c-movie-img" alt="{{ $movie->title }}">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">{{ $movie->title }}</p>
                                <a href="{{ route('movies.details', ['movieSlug' => Str::slug($movie->title)]) }}" class="btn btn-primary c-movie-btn">More Info</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-movies">
                        <img src="{{ asset('images/movie-unavailable.svg') }}" alt="No Movies">
                        <p class="empty-movies-content">
                            No upcoming movies at the moment. <br>
                            Please wait for further announcements. Thank you. <br>
                            👉👈
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<x-go-to-top-button />
@endsection