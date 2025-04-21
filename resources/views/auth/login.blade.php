@extends('layouts.index')

@section('title', 'Sign In | PrimeCinemas')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<script src="{{ asset('js/auth.js') }}"></script>

<div class="login-container">
    <div class="login-box">
        <div class="login-image">
            <img src="{{ asset('images/sign_up_picture.png') }}" alt="Sign Up" class="img-fluid"                                                                                        >
        </div>
        <div class="login-form">
            <h2 class="text-uppercase fw-bold text-left">Sign In</h2>
            <h6 class="text fw-bold text-left">Access your MovieClub benefits and rewards</h6>
            
            <ul class="nav nav-pills mb-3 justify-content-left" id="login-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="username-tab" data-bs-toggle="pill" data-bs-target="#username-login" type="button" role="tab">
                        Username
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="email-tab" data-bs-toggle="pill" data-bs-target="#email-login" type="button" role="tab">
                        Email
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Username Login -->
                <div class="tab-pane fade show active" id="username-login" role="tabpanel">
                    <form action="{{ route('login') }}" method="POST" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control login-username @error('username') is-invalid @enderror" id="username-input" name="username" value="{{ old('username') }}" placeholder="Enter username">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password1" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password1" name="password" placeholder="Enter password">
                                <button type="button" class="btn btn-outline-secondary toggle-password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-danger text-uppercase">Sign In</button>
                    </form>
                    <p class="text-left mt-3">New User? <a href="{{ route('register') }}" class="text-white fw-bold">Sign Up</a></p>
                </div>

                <!-- Email Login -->
                <div class="tab-pane fade email-form" id="email-login" role="tabpanel">
                    <form action="{{ route('login') }}" method="POST" class="email-login-form">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label email-label">Email</label>
                            <input type="email" class="form-control login-email @error('email') is-invalid @enderror" id="email-input" name="email" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password2" name="password" placeholder="Enter password">
                                <button type="button" class="btn btn-outline-secondary toggle-password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger text-uppercase email-signin-btn">Sign In</button>
                    </form>
                    <p class="text-left mt-3">New User? <a href="{{ route('register') }}" class="text-white fw-bold">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
