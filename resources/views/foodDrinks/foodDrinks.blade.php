@extends('layouts.index')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/foodDrinks/food-drinks.css') }}">
    <style>

    </style>
@endsection

@section('title', 'PrimeCinemas | Food & Drinks Menu')

@section('content')
    <div class="container food-drinks-container">
        <!-- Tabs and Cart Button -->
        <div class="d-flex justify-content-between align-items-center">
            <ul class="nav m-tabs" id="foodTab" role="tablist">
                <li class="nav-item tab-item" role="presentation">
                    <button class="nav-link btn-tab-item active" id="combos-tab" data-bs-toggle="tab"
                        data-bs-target="#combos-tab-pane" type="button" role="tab" aria-controls="combos-tab-pane"
                        aria-selected="true">
                        Combos
                    </button>
                </li>
                <li class="nav-item tab-item" role="presentation">
                    <button class="nav-link btn-tab-item" id="snacks-tab" data-bs-toggle="tab"
                        data-bs-target="#snacks-tab-pane" type="button" role="tab" aria-controls="snacks-tab-pane"
                        aria-selected="false">
                        Snacks
                    </button>
                </li>
                <li class="nav-item tab-item" role="presentation">
                    <button class="nav-link btn-tab-item" id="beverages-tab" data-bs-toggle="tab"
                        data-bs-target="#beverages-tab-pane" type="button" role="tab"
                        aria-controls="beverages-tab-pane" aria-selected="false">
                        Beverages
                    </button>
                </li>
                <li class="nav-item tab-item" role="presentation">
                    <button class="nav-link btn-tab-item" id="specials-tab" data-bs-toggle="tab"
                        data-bs-target="#specials-tab-pane" type="button" role="tab" aria-controls="specials-tab-pane"
                        aria-selected="false">
                        Specials
                    </button>
                </li>
            </ul>
            <div class="view-all-tab">
                <button class="btn-cart" data-bs-toggle="modal" data-bs-target="#viewCartModal">
                    <i class="fa-solid fa-cart-shopping"></i> View Cart
                    <span id="cart-count" class="cart-count" style="display: none;">0</span>
                </button>
            </div>
        </div>

       <!-- View Cart Modal -->
<div class="modal fade" id="viewCartModal" tabindex="-1" aria-labelledby="viewCartModalLabel" aria-hidden="true"
data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Your Cart</h5>
            <button type="button" class="btn btn-danger btn-sm" id="delete-all-btn" onclick="confirmDeleteAll()">Delete All</button>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <!-- 🛒 Dynamic cart items will appear here -->
            <div id="cart-items"></div>

            <!-- 🛒 Message when cart is empty -->
            <div id="cart-empty" style="display: none; text-align: center; padding: 20px;">
                <p>Your cart is empty. Add some items to get started! 🛒</p>
            </div>

            <!-- 🛒 Cart Total -->
            <div class="cart-total">
                <h6>Total: RM <span id="cart-total">0.00</span></h6>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue Shopping</button>
            <button type="button" class="btn btn-primary" id="checkout-btn" onclick="proceedToCheckout()">Checkout</button>
        </div>
    </div>
</div>
</div>


        <div class="tab-content py-4" id="foodTabContent">
            <!-- Tab: Combos -->
            <div class="tab-pane fade show active" id="combos-tab-pane" role="tabpanel" aria-labelledby="combos-tab"
                tabindex="0">
                <div class="row row-food-items row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                    @if ($combos->isNotEmpty())
                        @foreach ($combos as $item)
                            <div class="card c-food-card" style="cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#comboModal-{{ $item->id }}">
                                <img src="{{ asset('images/popcorn-combo.png') }}" class="card-img-top c-food-img"
                                    alt="{{ $item->name }}" loading="lazy">
                                <div class="card-body c-food-body">
                                    <p class="card-title c-food-title">{{ $item->name }}</p>
                                    <p class="card-text c-food-price">RM {{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>

                            <!-- Modal for Combo Selection -->
                            <div class="modal fade" id="comboModal-{{ $item->id }}" tabindex="-1"
                                aria-labelledby="comboModalLabel-{{ $item->id }}" aria-hidden="true"
                                data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="comboModalLabel-{{ $item->id }}">Personalise
                                                Your Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Food Display Container -->
                                            <div class="food-display-container">
                                                <div class="d-flex align-items-center mb-3">
                                                    @if ($item->name === 'Popcorn Combo')
                                                        <img src="{{ asset('images/popcorn-combo.png') }}"
                                                            alt="{{ $item->name }}"
                                                            style="width: 160px; height: 160px; object-fit: cover; margin-right: 18px;">
                                                    @else
                                                        <img src="{{ asset('images/food/' . $item->image) }}"
                                                            alt="{{ $item->name }}"
                                                            style="width: 160px; height: 160px; object-fit: cover; margin-right: 18px;">
                                                    @endif
                                                    <div>
                                                        <h6>{{ $item->name }}</h6>
                                                        <p>RM {{ number_format($item->price, 2) }}</p>
                                                        <div class="d-flex align-items-center">
                                                            <button class="btn btn-outline-secondary btn-sm"
                                                                onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                                            <span id="quantity-{{ $item->id }}"
                                                                class="mx-2">1</span>
                                                            <button class="btn btn-outline-secondary btn-sm"
                                                                onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h6 class="options-prompt">Please Select Your Options</h6>

                                            <!-- Popcorn and Hot Food Section -->
                                            <div class="options-section">
                                                <h6>Popcorn and Hot Food</h6>
                                                <div class="options-container"
                                                    id="options-container-food-{{ $item->id }}">
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Royale Popcorn')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-royale-{{ $item->id }}" value="Royale Popcorn"
                                                            style="display: none;">
                                                        <span>Royale Popcorn</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Signature Large Popcorn')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-signature-{{ $item->id }}"
                                                            value="Signature Large Popcorn" style="display: none;">
                                                        <span>Signature Large Popcorn</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Golden Stars')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-golden-stars-{{ $item->id }}"
                                                            value="Golden Stars" style="display: none;">
                                                        <span>Golden Stars</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Chicken Minis')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-chicken-minis-{{ $item->id }}"
                                                            value="Chicken Minis" style="display: none;">
                                                        <span>Chicken Minis</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Chicken Nuggets')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-chicken-nuggets-{{ $item->id }}"
                                                            value="Chicken Nuggets" style="display: none;">
                                                        <span>Chicken Nuggets</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Big Dipper')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-big-dipper-{{ $item->id }}" value="Big Dipper"
                                                            style="display: none;">
                                                        <span>Big Dipper</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Butter Popcorn Large')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-butter-{{ $item->id }}"
                                                            value="Butter Popcorn Large" style="display: none;">
                                                        <span>Butter Popcorn Large</span>
                                                    </div>
                                                    <div class="option-item sold-out"
                                                        onclick="alert('This item is sold out!')">
                                                        <span>Seafood Tofu ALC</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Golden Seaweed Chip')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-seaweed-chip-{{ $item->id }}"
                                                            value="Golden Seaweed Chip" style="display: none;">
                                                        <span>Golden Seaweed Chip</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'BBQ Popcorn')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-bbq-{{ $item->id }}" value="BBQ Popcorn"
                                                            style="display: none;">
                                                        <span>BBQ Popcorn</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Caramel Popcorn')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-caramel-{{ $item->id }}" value="Caramel Popcorn"
                                                            style="display: none;">
                                                        <span>Caramel Popcorn</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Cheese Popcorn')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-cheese-{{ $item->id }}" value="Cheese Popcorn"
                                                            style="display: none;">
                                                        <span>Cheese Popcorn</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('food', {{ $item->id }}, 'Spicy Popcorn')">
                                                        <input type="radio" name="food-{{ $item->id }}"
                                                            id="food-spicy-{{ $item->id }}" value="Spicy Popcorn"
                                                            style="display: none;">
                                                        <span>Spicy Popcorn</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Drink Option Section -->
                                            <div class="options-section mt-4">
                                                <h6>Drink Option</h6>
                                                <div class="options-container"
                                                    id="options-container-drink-{{ $item->id }}">
                                                    <div class="option-item"
                                                        onclick="selectOption('drink', {{ $item->id }}, 'Mineral Water')">
                                                        <input type="radio" name="drink-{{ $item->id }}"
                                                            id="drink-mineral-water-{{ $item->id }}"
                                                            value="Mineral Water" style="display: none;">
                                                        <span>Mineral Water</span>
                                                    </div>
                                                    <div class="option-item sold-out"
                                                        onclick="alert('This item is sold out!')">
                                                        <span>Coke Bottle</span>
                                                    </div>
                                                    <div class="option-item sold-out"
                                                        onclick="alert('This item is sold out!')">
                                                        <span>Coke No Sugar Bottle</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('drink', {{ $item->id }}, 'Coke')">
                                                        <input type="radio" name="drink-{{ $item->id }}"
                                                            id="drink-coke-{{ $item->id }}" value="Coke"
                                                            style="display: none;">
                                                        <span>Coke</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('drink', {{ $item->id }}, 'Sprite')">
                                                        <input type="radio" name="drink-{{ $item->id }}"
                                                            id="drink-sprite-{{ $item->id }}" value="Sprite"
                                                            style="display: none;">
                                                        <span>Sprite</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('drink', {{ $item->id }}, 'Coke No Sugar')">
                                                        <input type="radio" name="drink-{{ $item->id }}"
                                                            id="drink-coke-no-sugar-{{ $item->id }}"
                                                            value="Coke No Sugar" style="display: none;">
                                                        <span>Coke No Sugar</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('drink', {{ $item->id }}, 'Lemon Tea')">
                                                        <input type="radio" name="drink-{{ $item->id }}"
                                                            id="drink-lemon-{{ $item->id }}" value="Lemon Tea"
                                                            style="display: none;">
                                                        <span>Lemon Tea</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('drink', {{ $item->id }}, 'Orange Juice')">
                                                        <input type="radio" name="drink-{{ $item->id }}"
                                                            id="drink-orange-{{ $item->id }}" value="Orange Juice"
                                                            style="display: none;">
                                                        <span>Orange Juice</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('drink', {{ $item->id }}, 'Iced Coffee')">
                                                        <input type="radio" name="drink-{{ $item->id }}"
                                                            id="drink-coffee-{{ $item->id }}" value="Iced Coffee"
                                                            style="display: none;">
                                                        <span>Iced Coffee</span>
                                                    </div>
                                                    <div class="option-item"
                                                        onclick="selectOption('drink', {{ $item->id }}, 'Pepsi')">
                                                        <input type="radio" name="drink-{{ $item->id }}"
                                                            id="drink-pepsi-{{ $item->id }}" value="Pepsi"
                                                            style="display: none;">
                                                        <span>Pepsi</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary"
                                                id="add-to-cart-{{ $item->id }}"
                                                style="opacity: 0.5; pointer-events: none;"
                                                onclick="addToCart({{ $item->id }})">Add to Cart</button>
                                        </div>
                                    </div>
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
            <div class="tab-pane fade" id="snacks-tab-pane" role="tabpanel" aria-labelledby="snacks-tab"
                tabindex="0">
                <div class="row row-food-items row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                    @if ($snacks->isNotEmpty())
                        @foreach ($snacks as $item)
                            <div class="card c-food-card" style="cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#snackModal-{{ $item->id }}">
                                <img src="{{ asset('images/nanchos-and-cheese.png') }}" class="card-img-top c-food-img"
                                    alt="{{ $item->name }}" loading="lazy">
                                <div class="card-body c-food-body">
                                    <p class="card-title c-food-title">{{ $item->name }}</p>
                                    <p class="card-text c-food-price">RM {{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>

                            <!-- Modal for Snack Selection -->
                            <div class="modal fade" id="snackModal-{{ $item->id }}" tabindex="-1"
                                aria-labelledby="snackModalLabel-{{ $item->id }}" aria-hidden="true"
                                data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="snackModalLabel-{{ $item->id }}">Select
                                                Quantity</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Food Display Container -->
                                            <div class="food-display-container">
                                                <div class="d-flex align-items-center mb-3">
                                                    @if ($item->name === 'Nachos & Cheese')
                                                        <img src="{{ asset('images/nanchos-and-cheese.png') }}"
                                                            alt="{{ $item->name }}"
                                                            style="width: 160px; height: 160px; object-fit: cover; margin-right: 18px;">
                                                    @else
                                                        <img src="{{ asset('images/food/' . $item->image) }}"
                                                            alt="{{ $item->name }}"
                                                            style="width: 160px; height: 160px; object-fit: cover; margin-right: 18px;">
                                                    @endif
                                                    <div>
                                                        <h6>{{ $item->name }}</h6>
                                                        <p>RM {{ number_format($item->price, 2) }}</p>
                                                        <div class="d-flex align-items-center">
                                                            <button class="btn btn-outline-secondary btn-sm"
                                                                onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                                            <span id="quantity-{{ $item->id }}"
                                                                class="mx-2">1</span>
                                                            <button class="btn btn-outline-secondary btn-sm"
                                                                onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary-enabled"
                                                id="add-to-cart-{{ $item->id }}"
                                                onclick="addToCart({{ $item->id }})">Add to Cart</button>
                                        </div>
                                    </div>
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
            <div class="tab-pane fade" id="beverages-tab-pane" role="tabpanel" aria-labelledby="beverages-tab"
                tabindex="0">
                <div class="row row-food-items row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                    @if ($beverages->isNotEmpty())
                        @foreach ($beverages as $item)
                            <div class="card c-food-card" style="cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#beverageModal-{{ $item->id }}">
                                <img src="{{ asset('images/cola-drinks.png') }}" class="card-img-top c-food-img"
                                    alt="{{ $item->name }}" loading="lazy">
                                <div class="card-body c-food-body">
                                    <p class="card-title c-food-title">{{ $item->name }}</p>
                                    <p class="card-text c-food-price">RM {{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>

                            <!-- Modal for Beverage Selection -->
                            <div class="modal fade" id="beverageModal-{{ $item->id }}" tabindex="-1"
                                aria-labelledby="beverageModalLabel-{{ $item->id }}" aria-hidden="true"
                                data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="beverageModalLabel-{{ $item->id }}">Select
                                                Quantity</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Food Display Container -->
                                            <div class="food-display-container">
                                                <div class="d-flex align-items-center mb-3">
                                                    @if ($item->name === 'Cola Drink')
                                                        <img src="{{ asset('images/cola-drinks.png') }}"
                                                            alt="{{ $item->name }}"
                                                            style="width: 160px; height: 160px; object-fit: cover; margin-right: 18px;">
                                                    @else
                                                        <img src="{{ asset('images/food/' . $item->image) }}"
                                                            alt="{{ $item->name }}"
                                                            style="width: 160px; height: 160px; object-fit: cover; margin-right: 18px;">
                                                    @endif
                                                    <div>
                                                        <h6>{{ $item->name }}</h6>
                                                        <p>RM {{ number_format($item->price, 2) }}</p>
                                                        <div class="d-flex align-items-center">
                                                            <button class="btn btn-outline-secondary btn-sm"
                                                                onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                                            <span id="quantity-{{ $item->id }}"
                                                                class="mx-2">1</span>
                                                            <button class="btn btn-outline-secondary btn-sm"
                                                                onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary-enabled"
                                                id="add-to-cart-{{ $item->id }}"
                                                onclick="addToCart({{ $item->id }})">Add to Cart</button>
                                        </div>
                                    </div>
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
            <div class="tab-pane fade" id="specials-tab-pane" role="tabpanel" aria-labelledby="specials-tab"
                tabindex="0">
                <div class="row row-food-items row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 py-5">
                    @if ($specials->isNotEmpty())
                        @foreach ($specials as $item)
                            <div class="card c-food-card" style="cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#specialModal-{{ $item->id }}">
                                <img src="{{ asset('images/movie-night-special.png') }}" class="card-img-top c-food-img"
                                    alt="{{ $item->name }}" loading="lazy">
                                <div class="card-body c-food-body">
                                    <p class="card-title c-food-title">{{ $item->name }}</p>
                                    <p class="card-text c-food-price">RM {{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>

                            <!-- Modal for Special Selection -->
                            <div class="modal fade" id="specialModal-{{ $item->id }}" tabindex="-1"
                                aria-labelledby="specialModalLabel-{{ $item->id }}" aria-hidden="true"
                                data-bs-backdrop="static" data-bs-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="specialModalLabel-{{ $item->id }}">Select
                                                Quantity</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Food Display Container -->
                                            <div class="food-display-container">
                                                <div class="d-flex align-items-center mb-3">
                                                    @if ($item->name === 'Movie Night Special')
                                                        <img src="{{ asset('images/movie-night-special.png') }}"
                                                            alt="{{ $item->name }}"
                                                            style="width: 160px; height: 160px; object-fit: cover; margin-right: 18px;">
                                                    @else
                                                        <img src="{{ asset('images/food/' . $item->image) }}"
                                                            alt="{{ $item->name }}"
                                                            style="width: 160px; height: 160px; object-fit: cover; margin-right: 18px;">
                                                    @endif
                                                    <div>
                                                        <h6>{{ $item->name }}</h6>
                                                        <p>RM {{ number_format($item->price, 2) }}</p>
                                                        <div class="d-flex align-items-center">
                                                            <button class="btn btn-outline-secondary btn-sm"
                                                                onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                                            <span id="quantity-{{ $item->id }}"
                                                                class="mx-2">1</span>
                                                            <button class="btn btn-outline-secondary btn-sm"
                                                                onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary-enabled"
                                                id="add-to-cart-{{ $item->id }}"
                                                onclick="addToCart({{ $item->id }})">Add to Cart</button>
                                        </div>
                                    </div>
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

@section('scripts')
    <script>
        window.isLoggedIn = @json(Auth::check());
        window.selections = {};
        window.itemDetails = {};
        @foreach ([$combos, $snacks, $beverages, $specials] as $group)
            @foreach ($group as $item)
                selections[{{ $item->id }}] = { food: null, drink: null };
                itemDetails[{{ $item->id }}] = '{{ $item->name }}';
            @endforeach
        @endforeach

        window.cartRoutes = {
            get: '{{ route('cart.get') }}',
            add: '{{ route('cart.add') }}',
            remove: '{{ route('cart.remove') }}',
            deleteAll: '{{ route('cart.deleteAll') }}',
        };
        window.csrfToken = '{{ csrf_token() }}';
    </script>

    <script src="{{ asset('js/cart.js') }}"></script>
@endsection

