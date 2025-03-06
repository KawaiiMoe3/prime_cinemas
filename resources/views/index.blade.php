@extends('layouts.index')

@section('title', 'PrimeCinemas | Malaysia\'s Ultimate Movie Experience')

@section('content')
<div id="carouselCaptions" class="carousel slide" data-bs-ride="carousel">
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