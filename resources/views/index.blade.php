@extends('layouts.app')

@section('title', 'PrimeCinemas | Malaysia\'s Ultimate Movie Experience')

@section('content')
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="First Slide">
            <div class="container">
                <div class="carousel-caption text-start">
                    <p class="fw-bold text-uppercase m-title" style="font-size: 50px">NE ZHA 2 哪吒之魔童闹海</p>
                    <p class="fw-bold fs-2 text-uppercase m-description">showing on 13 Mar 2025 🔥</p>
                    <p>
                        <a class="btn btn-lg btn-trailer text-uppercase" href="https://youtu.be/axIa5sTi9B4?si=hJRcwn5Kawf1GHGd">
                            watch trailer
                        </a>
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
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endsection