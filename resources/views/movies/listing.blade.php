@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/movies/listing.css') }}">
@endsection

@section('title', 'PrimeCinemas | Current & Upcoming Movies')

@section('content')
<div class="container movies-container">
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
                View all &nbsp;
                <i class="fa-solid fa-greater-than"></i>
            </button>
        </div>
    </div>
    <div class="tab-content py-4" id="myTabContent">
        <div class="tab-pane fade show active" id="nowshowing-tab-pane" role="tabpanel" aria-labelledby="nowshowing-tab" tabindex="0">
            <!-- Top Popular Movies -->
            <div class="row justify-content-center g-4 row-top-popular-movies">
                <!-- Left Poster (Bigger) -->
                <div class="col-md-4 col-top-popular-movies">
                    <div class="movie-card">
                        <img src="{{ asset('images/m10.jpg') }}" class="img-fluid rounded" alt="Ne Zha 2">
                        <p class="text-center fw-bold mt-2 ct-title">NE ZHA 2 哪吒之魔童闹海</p>
                        <p>
                            <a href="#" class="btn btn-primary ct-movie-btn">Book Now</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-top-popular-movies">
                    <div class="movie-card">
                        <img src="{{ asset('images/m10.jpg') }}" class="img-fluid rounded" alt="Mickey 17">
                        <p class="text-center fw-bold mt-2 ct-title">MICKEY 17</p>
                        <p>
                            <a href="#" class="btn ct-movie-btn">Book Now</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-top-popular-movies">
                    <div class="movie-card">
                        <img src="{{ asset('images/m10.jpg') }}" class="img-fluid rounded" alt="Mickey 17">
                        <p class="text-center fw-bold mt-2 ct-title">MICKEY 17</p>
                        <p>
                            <a href="#" class="btn btn-primary ct-movie-btn">Book Now</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Normal Movies -->
            <div class="row row-normal-movies row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                <div class="card c-movie-card">
                    <img src="{{ asset('images/m1.jpg') }}" class="card-img-top c-movie-img" alt="...">
                    <div class="card-body c-movie-body">
                        <p class="card-title c-movie-title">
                            Attack On Titan: The Last Attack
                        </p>
                        <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                    </div>
                </div>
                <div class="card c-movie-card">
                    <img src="{{ asset('images/m1.jpg') }}" class="card-img-top c-movie-img" alt="...">
                    <div class="card-body c-movie-body">
                        <p class="card-title c-movie-title">
                            Attack On Titan: The Last Attack
                        </p>
                        <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                    </div>
                </div>
                <div class="card c-movie-card">
                    <img src="{{ asset('images/m1.jpg') }}" class="card-img-top c-movie-img" alt="...">
                    <div class="card-body c-movie-body">
                        <p class="card-title c-movie-title">
                            Attack 
                        </p>
                        <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                    </div>
                </div>
                <div class="card c-movie-card">
                    <img src="{{ asset('images/m1.jpg') }}" class="card-img-top c-movie-img" alt="...">
                    <div class="card-body c-movie-body">
                        <p class="card-title c-movie-title">
                            Attack On Titan: The Last Attack
                        </p>
                        <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                    </div>
                </div>
                <div class="card c-movie-card">
                    <img src="{{ asset('images/m1.jpg') }}" class="card-img-top c-movie-img" alt="...">
                    <div class="card-body c-movie-body">
                        <p class="card-title c-movie-title">
                            Attack On Titan: The Last Attack
                        </p>
                        <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                    </div>
                </div>
                <div class="card c-movie-card">
                    <img src="{{ asset('images/m1.jpg') }}" class="card-img-top c-movie-img" alt="...">
                    <div class="card-body c-movie-body">
                        <p class="card-title c-movie-title">
                            Attack On Titan: The Last Attack
                        </p>
                        <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                    </div>
                </div>
                <div class="card c-movie-card">
                    <img src="{{ asset('images/m1.jpg') }}" class="card-img-top c-movie-img" alt="...">
                    <div class="card-body c-movie-body">
                        <p class="card-title c-movie-title">
                            Attack On Titan: The Last Attack
                        </p>
                        <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="kids-special-tab-pane" role="tabpanel" aria-labelledby="kids-special-tab" tabindex="0">
            <div class="swiper movieSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card c-movie-card">
                            <img src="{{ asset('images/m6.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    Mobile Suit Gundam GQUUUUUUX - Beginning-
                                </p>
                                <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card c-movie-card">
                            <img src="{{ asset('images/m4.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    Captain America: Brave New World
                                </p>
                                <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card c-movie-card">
                            <img src="{{ asset('images/m9.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    Sonic The Hedgehog 3
                                </p>
                                <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card c-movie-card">
                            <img src="{{ asset('images/m8.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    Paddington in peru
                                </p>
                                <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="bookearly-tab-pane" role="tabpanel" aria-labelledby="bookearly-tab" tabindex="0">
            <div class="swiper movieSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card c-movie-card">
                            <img src="{{ asset('images/m9.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    Sonic The Hedgehog 3
                                </p>
                                <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="comingsoon-tab-pane" role="tabpanel" aria-labelledby="comingsoon-tab" tabindex="0">
            <div class="swiper movieSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card c-movie-card">
                            <img src="{{ asset('images/m10.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    NE ZHA 2 哪吒之魔童闹海
                                </p>
                                <a href="#" class="btn btn-primary c-movie-btn">More Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card c-movie-card">
                            <img src="{{ asset('images/m11.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    DEMON SLAYER: KIMETSU NO YAIBA INFINITY CASTLE
                                </p>
                                <a href="#" class="btn btn-primary c-movie-btn">More Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-go-to-top-button />
@endsection