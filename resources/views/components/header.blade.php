{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-black bg-gradient bg-opacity-50 fixed-top">
    <div class="container">
        {{-- Logo --}}
        <a class="navbar-brand fs-4" href="{{ route('index') }}">
            <img src="{{ asset('images/logo.png') }}" class="rounded-pill" style="width: 60px" alt="PrimeCinemas">
        </a>
        {{-- Toggle Btn --}}
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- SideBar --}}
        <div class="sidebar offcanvas offcanvas-start p-3" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            {{-- Sidebar Header --}}
            <div class="offcanvas-header text-white border-bottom">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" class="rounded-pill" style="width: 60px" alt="PrimeCinemas">
                </a>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            {{-- Sidebar Body --}}
            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
                    <li class="nav-item mx-2">
                        <a class="nav-link header-item text-uppercase {{ request()->is('movies/listing') ? 'active' : '' }}"
                            aria-current="page" 
                            href="{{ route('movies.listing') }}">
                            Movies
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link header-item text-uppercase" href="#about">Cinemas</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link header-item text-uppercase" href="#services">Food & Drinks</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link header-item text-uppercase" href="#contact">Shop</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link header-item text-uppercase" href="#contact">Promotions</a>
                    </li>
                    <li class="nav-item mx-2 dropdown">
                        <a class="nav-link header-item dropdown-toggle text-uppercase" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More &#9660
                        </a>
                        <ul class="dropdown-menu bg-black">
                            <li><a class="dropdown-item text-white text-uppercase" href="#">About Us</a></li>
                            <li><a class="dropdown-item text-white text-uppercase" href="#">Support</a></li>
                        </ul>
                    </li>
                </ul>
                
                {{-- Login/Logout Section --}}
                <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
                    @if(Auth::check())
                        <div class="dropdown login-dropdown">
                            <a class="nav-link dropdown-toggle text-white text-uppercase text-decoration-none px-3 py-1" 
                            href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>&nbsp;<span id="header-username" class="fw-bold">Hi, {{ Auth::user()->username }}</span>
                                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                            </a>
                            <ul class="dropdown-menu bg-black" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href=" {{ route('profile.my_profile') }} ">My Profile</a></li>
                                <li><a class="dropdown-item" href=" {{ route('profile.my_orders') }} ">My Orders</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white fw-bold text-uppercase text-decoration-none px-3 py-1">
                            <i class="fa-solid fa-user"></i> Sign In
                        </a>
                    @endif
                    <a href="https://github.com/KawaiiMoe3/prime_cinemas" target="_blank" class="text-white text-uppercase text-decoration-none px-3 py-1">
                        <i class="fa-brands fa-github fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>