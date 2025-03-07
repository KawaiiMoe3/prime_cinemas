@extends('layouts.index')

@section('title', 'PrimeCinemas | Malaysia\'s Ultimate Movie Experience')

@section('content')
<div id="carouselCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="First Slide">
            <div class="container">
                <div class="carousel-caption text-start">
                    <p class="fw-bold text-uppercase m-title" style="font-size: 50px">NE ZHA 2 哪吒之魔童闹海</p>
                    <p class="fw-bold fs-2 text-uppercase m-description">showing on 13 Mar 2025 🔥</p>
                    <p>
                        <!-- Button trigger trailer modal -->
                        <button type="button" class="btn btn-trailer" data-bs-toggle="modal" data-bs-target="#trailerModal">
                            Watch Trailer
                        </button>
                        <a class="btn btn-lg btn-booknow text-uppercase" href="#">remind me</a>
                    </p>
                </div>
            </div>
      </div>
      <div class="carousel-item">
            <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="Second Slide">
            <div class="container">
                <div class="carousel-caption text-start">
                    <p class="fw-bold text-uppercase m-title" style="font-size: 50px">captain america ⍟🦸‍♂️</p>
                    <p class="fw-bold fs-2 text-uppercase m-description">THE SHIELD STANDS STRONG</p>
                    <p>
                        <a class="btn btn-lg btn-booknow text-uppercase" href="#">book now</a>
                    </p>
                </div>
            </div>
      </div>
      <div class="carousel-item">
            <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="Third Slide">
            <div class="container">
                <div class="carousel-caption text-start">
                    <p>
                        <a class="btn btn-lg btn-booknow text-uppercase" href="#">buy now</a>
                    </p>
                </div>
            </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container px-4 py-5">
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
            <div class="swiper movieSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
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
                    <div class="swiper-slide">
                        <div class="card c-movie-card">
                            <img src="{{ asset('images/m2.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    LEGENDS OF THE CONDOR HEROES: THE GALLANTS 射雕英雄传：侠之大者
                                </p>
                                <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card c-movie-card">
                            <img src="{{ asset('images/m3.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    Close Ur Kopitiam 关你茶室
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
                            <img src="{{ asset('images/m5.jpg') }}" class="card-img-top c-movie-img" alt="...">
                            <div class="card-body c-movie-body">
                                <p class="card-title c-movie-title">
                                    In The Lost Lands
                                </p>
                                <a href="#" class="btn btn-primary c-movie-btn">Book Now</a>
                            </div>
                        </div>
                    </div>
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
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
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

<div class="container px-4 py-5" id="cinemas-cards">
    <h2 class="pb-2 text-white text-center fw-bold text-uppercase cc-title">Experience our halls</h2>

    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
        <div class="col cc-col">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg cc-content"
            onclick="window.location.href='#';"
            style="background-image: url('../images/imax.jpg'); background-size: cover;">
                <div class="d-flex flex-column h-100 p-5 pb-3 text-white">
                    <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold cc-type">IMAX</h3>
                    <h4 class="text-white fw-bold cc-short">Bigger is Better</h4>
                    <p class="text-white cc-descrip">Experience immersion beyond imagination</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg cc-content"
            onclick="window.location.href='#';"
            style="background-image: url('../images/deluxe.jpg'); background-size: cover;">
                <div class="d-flex flex-column h-100 p-5 pb-3 text-white">
                    <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">DELUXE</h3>
                    <h4 class="text-white fw-bold">Comfort, Clarity, Perfection</h4>
                    <p class="text-white">Elegance in Every Frame, Experience Movies in Style</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg cc-content"
            onclick="window.location.href='#';"
            style="background-image: url('../images/indulge.jpg'); background-size: cover;">
                <div class="d-flex flex-column h-100 p-5 pb-3">
                    <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">INDULGE</h3>
                    <h4 class="text-white fw-bold">Elevate your experience</h4>
                    <p class="text-white">Watch movies while dining in style</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container px-4 py-5" id="cinemas-cards">
    <h2 class="pb-2 text-white text-center fw-bold text-uppercase cc-title">Promotions</h2>

    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5 d-flex justify-content-between">
        <div class="card cc-content c-promote" 
            onclick="window.location.href='#';"
            style="width: 18rem;">
            <img src="../images/p1.jpg" class="card-img-top" alt="promote pic">
            <div class="card-body">
                <h5 class="card-title c-promote-title">Exclusively for IMAX</h5>
                <p class="card-text c-promote-text">From 13 February 2025, while stocks last</p>
            </div>
        </div>

        <div class="card cc-content c-promote" 
            onclick="window.location.href='#';"
            style="width: 18rem;">
            <img src="../images/p2.jpg" class="card-img-top" alt="promote pic">
            <div class="card-body">
                <h5 class="card-title c-promote-title">Exclusively for INDULGE</h5>
                <p class="card-text c-promote-text">From 13 February 2025, while stocks last</p>
            </div>
        </div>

        <div class="card cc-content c-promote" 
            onclick="window.location.href='#';"
            style="width: 18rem;">
            <img src="../images/p3.jpg" class="card-img-top" alt="promote pic">
            <div class="card-body">
                <h5 class="card-title c-promote-title">Get Your Collectable Legends of the Condor Heroes: The Gallants Merch NOW!</h5>
                <p class="card-text c-promote-text">From 20 February 2025, while stocks last</p>
            </div>
        </div>

        <div class="card cc-content c-promote" 
            onclick="window.location.href='#';"
            style="width: 18rem;">
            <img src="../images/p4.png" class="card-img-top" alt="promote pic">
            <div class="card-body">
                <h5 class="card-title c-promote-title">Attack On Titans Is Back With Demand</h5>
                <p class="card-text c-promote-text">From 20 February 2025, while stocks last</p>
            </div>
        </div>
    </div>
</div>

<!-- Trailer Modal -->
<div class="modal fade" id="trailerModal" tabindex="-1" aria-labelledby="trailerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 bg-black">
            <div class="ratio ratio-16x9">
                <iframe id="youtubePlayer" src="https://www.youtube.com/embed/axIa5sTi9B4?si=GnzuE7a5Vd5uwqLp" 
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

<!-- Stop video when trailer modal closes -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let trailerModal = document.getElementById('trailerModal');
        let youtubePlayer = document.getElementById('youtubePlayer');
        
        trailerModal.addEventListener('hide.bs.modal', function () {
            youtubePlayer.src = youtubePlayer.src; // Reset the iframe src to stop the video
        });
    });
</script>
@endsection