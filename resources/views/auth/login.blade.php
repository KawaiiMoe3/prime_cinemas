@extends('layouts.index')

@section('title', 'Sign In | PrimeCinemas')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let usernameForm = document.querySelector("#username-login");
        let emailForm = document.querySelector("#email-login");

        if (usernameForm) {
            let username = usernameForm.querySelector("#username-input");
            let password1 = usernameForm.querySelector("#password1");

            if (username) {
                username.addEventListener("input", function () {
                    if (/\s/.test(username.value)) {
                        showError(username, "Username cannot contain spaces.");
                    } else {
                        clearError(username);
                    }
                });
            }

            if (password1) {
                password1.addEventListener("input", function () {
                    validatePassword(password1);
                });
            }
        }

        if (emailForm) {
            let email = emailForm.querySelector("#email-input");
            let password2 = emailForm.querySelector("#password2");

            if (email) {
                email.addEventListener("input", function () {
                    if (!/^[a-zA-Z0-9._%+-]+@(gmail\.com|mail\.com)$/.test(email.value)) {
                        showError(email, "Email must be in format example@mail.com or example@gmail.com.");
                    } else {
                        clearError(email);
                    }
                });
            }

            if (password2) {
                password2.addEventListener("input", function () {
                    validatePassword(password2);
                });
            }
        }

        function validatePassword(passwordField) {
            if (
                passwordField &&
                !/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(passwordField.value)
            ) {
                showError(
                    passwordField,
                    "Password must have 1 Uppercase, 1 Digit, 1 Special Character and at least 6 characters."
                );
            } else {
                clearError(passwordField);
            }
        }

        function showError(input, message) {
            let error = input.nextElementSibling;
            if (!error || !error.classList.contains("error-message")) {
                error = document.createElement("div");
                error.classList.add("error-message");
                error.style.color = "red";
                input.parentNode.appendChild(error);
            }
            error.textContent = message;
        }

        function clearError(input) {
            let error = input.nextElementSibling;
            if (error && error.classList.contains("error-message")) {
                error.remove();
            }
        }
    });
</script>

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
                <div class="tab-pane fade show active" id="username-login" role="tabpanel">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        @if ($errors->has('login'))
                            <div class="alert alert-danger">
                                {{ $errors->first('login') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username-input" name="username" placeholder="Enter username">
                        </div>
                        <div class="mb-3">
                            <label for="password1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password1" name="password" placeholder="Enter password">
                        </div>
                        
                        <button type="submit" class="btn btn-danger text-uppercase">Sign In</button>
                    </form>
                    <p class="text-left mt-3">New User? <a href="{{ route('register') }}" class="text-white fw-bold">Sign Up</a></p>
                </div>

                <div class="tab-pane fade email-form" id="email-login" role="tabpanel">
                    <form action="{{ route('login') }}" method="POST" class="email-login-form">
                        @csrf
                        @if ($errors->has('login'))
                            <div class="alert alert-danger">
                                {{ $errors->first('login') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="email" class="form-label email-label">Email</label>
                            <input type="email" class="form-control" id="email-input" name="email" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label email-label">Password</label>
                            <input type="password" class="form-control" id="password2" name="password" placeholder="Enter password">
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
