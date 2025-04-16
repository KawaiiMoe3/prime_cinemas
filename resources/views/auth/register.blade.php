@extends('layouts.index')
@section('hideHeader', true)

@section('title', 'Register | PrimeCinemas')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<script src="{{ asset('js/auth.js') }}"></script>

<div class="register-container">
    <div class="register-box">
        <h2 class="text-uppercase fw-bold">Sign Up</h2>
        <h6 class="text fw-bold">Create an account to enjoy our services</h6>

        <form class="register-form" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="register-username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="register-username" placeholder="Enter username" required>
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="register-phone" class="form-label">Phone No.</label>
                <div class="input-group">
                    <select class="form-select country-code" id="country-code" name="country_code">
                        <option value="+60" selected>(+60)</option>
                        <option value="+65">(+65)</option>
                    </select>
                    <input type="text" class="form-control" name="phone" id="register-phone" placeholder="Enter phone number" required>
                </div>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="register-email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="register-email" placeholder="Enter email" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="register-password1" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="register-password1" placeholder="Enter password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="register-password2" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password_confirmation" id="register-password2" placeholder="Confirm password" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-register text-uppercase">Sign Up</button>
        </form>

        <p class="text-left mt-3">Already have an account? <a href="{{ route('login') }}" class="text-white fw-bold">Sign In</a></p>
    </div>
</div>
@endsection
