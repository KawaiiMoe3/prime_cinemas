@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/foodDrinks/food-drinks.css') }}">
@endsection

@section('title', 'PrimeCinemas | Food & Drinks Menu')

@section('content')
<div class="container food-drinks-container">
    <!-- Tabs -->
    <div class="d-flex justify-content-between align-items-center">
        <ul class="nav m-tabs" id="foodTab" role="tablist">
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item active" id="combos-tab" data-bs-toggle="tab" data-bs-target="#combos-tab-pane" type="button" role="tab" aria-controls="combos-tab-pane" aria-selected="true">
                    Combos
                </button>
            </li>
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item" id="snacks-tab" data-bs-toggle="tab" data-bs-target="#snacks-tab-pane" type="button" role="tab" aria-controls="snacks-tab-pane" aria-selected="false">
                    Snacks
                </button>
            </li>
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item" id="beverages-tab" data-bs-toggle="tab" data-bs-target="#beverages-tab-pane" type="button" role="tab" aria-controls="beverages-tab-pane" aria-selected="false">
                    Beverages
                </button>
            </li>
            <li class="nav-item tab-item" role="presentation">
                <button class="nav-link btn-tab-item" id="specials-tab" data-bs-toggle="tab" data-bs-target="#specials-tab-pane" type="button" role="tab" aria-controls="specials-tab-pane" aria-selected="false">
                    Specials
                </button>
            </li>
        </ul>
        <div class="view-all-tab">
            <button class="btn-viewall" onclick="window.location.href='#';">
                <i class="fa-solid fa-sliders"></i> Filter By
            </button>
        </div>
    </div>

    <div class="tab-content py-4" id="foodTabContent">
        <!-- Tab: Combos -->
        <div class="tab-pane fade show active" id="combos-tab-pane" role="tabpanel" aria-labelledby="combos-tab" tabindex="0">
            <div class="row row-food-items row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                @if($combos->isNotEmpty())
                @foreach($combos as $item)
                <div class="card c-food-card">
                    <img src="{{ asset('images/food/'.$item->image) }}" class="card-img-top c-food-img" alt="{{ $item->name }}" loading="lazy">
                    <div class="card-body c-food-body">
                        <p class="card-title c-food-title">{{ $item->name }}</p>
                        <p class="card-text c-food-price">RM {{ number_format($item->price, 2) }}</p>
                        <a href="#" class="btn btn-primary c-food-btn">Add to Cart</a>
                        {{--<a href="{{ route('cart.add', $item->id) }}" class="btn btn-primary c-food-btn">Add to Cart</a>--}}
                    </div>
                </div>
                @endforeach
                @else
                <p class="empty-items">
                    No combos available at the moment. Please check back later. <br>
                    👉👈
                </p>
                @endif
            </div>
        </div>

        <!-- Tab: Snacks -->
        <div class="tab-pane fade" id="snacks-tab-pane" role="tabpanel" aria-labelledby="snacks-tab" tabindex="0">
            <div class="row row-food-items row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                @if($snacks->isNotEmpty())
                @foreach($snacks as $item)
                <div class="card c-food-card">
                    <img src="{{ asset('images/food/'.$item->image) }}" class="card-img-top c-food-img" alt="{{ $item->name }}" loading="lazy">
                    <div class="card-body c-food-body">
                        <p class="card-title c-food-title">{{ $item->name }}</p>
                        <p class="card-text c-food-price">RM {{ number_format($item->price, 2) }}</p>
                        <a href="#" class="btn btn-primary c-food-btn">Add to Cart</a>
                        {{--<a href="{{ route('cart.add', $item->id) }}" class="btn btn-primary c-food-btn">Add to Cart</a>--}}
                    </div>
                </div>
                @endforeach
                @else
                <p class="empty-items">
                    No snacks available at the moment. Please check back later. <br>
                    👉👈
                </p>
                @endif
            </div>
        </div>

        <!-- Tab: Beverages -->
        <div class="tab-pane fade" id="beverages-tab-pane" role="tabpanel" aria-labelledby="beverages-tab" tabindex="0">
            <div class="row row-food-items row-ssscols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                @if($beverages->isNotEmpty())
                @foreach($beverages as $item)
                <div class="card c-food-card">
                    <img src="{{ asset('images/food/'.$item->image) }}" class="card-img-top c-food-img" alt="{{ $item->name }}" loading="lazy">
                    <div class="card-body c-food-body">
                        <p class="card-title c-food-title">{{ $item->name }}</p>
                        <p class="card-text c-food-price">RM {{ number_format($item->price, 2) }}</p>
                        <a href="#" class="btn btn-primary c-food-btn">Add to Cart</a>
                        {{--<a href="{{ route('cart.add', $item->id) }}" class="btn btn-primary c-food-btn">Add to Cart</a>--}}
                    </div>
                </div>
                @endforeach
                @else
                <p class="empty-items">
                    No beverages available at the moment. Please check back later. <br>
                    👉👈
                </p>
                @endif
            </div>
        </div>

        <!-- Tab: Specials -->
        <div class="tab-pane fade" id="specials-tab-pane" role="tabpanel" aria-labelledby="specials-tab" tabindex="0">
            <div class="row row-food-items row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                @if($specials->isNotEmpty())
                @foreach($specials as $item)
                <div class="card c-food-card">
                    <img src="{{ asset('images/food/'.$item->image) }}" class="card-img-top c-food-img" alt="{{ $item->name }}" loading="lazy">
                    <div class="card-body c-food-body">
                        <p class="card-title c-food-title">{{ $item->name }}</p>
                        <p class="card-text c-food-price">RM {{ number_format($item->price, 2) }}</p>
                        <a href="#" class="btn btn-primary c-food-btn">Add to Cart</a>
                        {{--<a href="{{ route('cart.add', $item->id) }}" class="btn btn-primary c-food-btn">Add to Cart</a>--}}
                    </div>
                </div>
                @endforeach
                @else
                <p class="empty-items">
                    No specials available at the moment. Please check back later. <br>
                    👉👈
                </p>
                @endif
            </div>
        </div>
    </div>
</div>

<x-go-to-top-button />
@endsection