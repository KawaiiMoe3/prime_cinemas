@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/cinemas/cinemas.css') }}">
@endsection

@section('title', 'PrimeCinemas')

@section('content')
<div class="container cinemas-container">
    <!-- Tabs -->
    <div class="d-flex justify-content-between align-items-center">
        <ul class="nav m-tabs" id="myTab" role="tablist">
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item active" id="movie-showing-time1-tab" data-bs-toggle="tab" data-bs-target="#movie-showing-time1-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                    Today
                    20 Mar
                </button>
            </li>
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item" id="movie-showing-time2-tab" data-bs-toggle="tab" data-bs-target="#movie-showing-time2-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                    Fri
                    21 Mar
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
        <!-- Movie Showing Time1 -->
        <div class="tab-pane fade show active" id="movie-showing-time1-tab-pane" role="tabpanel" aria-labelledby="movie-showing-time1-tab" tabindex="0">
            <div class="row row-normal-movies row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                111
            </div>
        </div>
        <!-- Movie Showing Time2 -->
        <div class="tab-pane fade" id="movie-showing-time2-tab-pane" role="tabpanel" aria-labelledby="movie-showing-time2-tab" tabindex="0">
            <div class="row row-normal-movies row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                222
            </div>
        </div>
    </div>
</div>

<x-go-to-top-button />
@endsection