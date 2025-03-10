@extends('layouts.index')

@section('title', 'Register | PrimeCinemas')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

@extends('layouts.index')

@section('title', 'Register | PrimeCinemas')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="register-container">
    <div class="register-box">
        <h2 class="text-uppercase fw-bold">Sign Up</h2>
        <h6 class="text fw-bold">Create an account to enjoy our services</h6>

        <form class="register-form">
            <div class="mb-3">
                <label for="register-firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="register-firstname" placeholder="Enter First name" pattern="[A-Za-z]+" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="register-lastname" placeholder="Enter Last name" pattern="[A-Za-z]+" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-username" class="form-label">Username</label>
                <input type="text" class="form-control" id="register-username" placeholder="Enter username" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="register-email" placeholder="Enter email" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-password1" class="form-label">Password</label>
                <input type="password" class="form-control" id="register-password1" placeholder="Enter password" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-password2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="register-password2" placeholder="Confirm password" required>
                <div class="error-message"></div>
            </div>
            <button type="submit" class="btn btn-register text-uppercase">Sign Up</button>
        </form>

        <p class="text-left mt-3">Already have an account? <a href="{{ route('login') }}" class="text-white fw-bold">Sign In</a></p>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".register-form");
    const inputs = form.querySelectorAll("input");

    function validateInput(input, condition, message) {
        let errorDiv = input.nextElementSibling;
        if (condition) {
            errorDiv.textContent = message;
            errorDiv.classList.add("text-danger", "fw-bold");
        } else {
            errorDiv.textContent = "";
        }
    }

    inputs.forEach(input => {
        input.addEventListener("input", () => {
            switch (input.id) {
                case "register-firstname":
                case "register-lastname":
                    validateInput(input, !/^[A-Za-z]+$/.test(input.value), "Only letters are allowed.");
                    break;
                case "register-username":
                    validateInput(input, /\s/.test(input.value), "Username cannot contain spaces.");
                    break;
                case "register-email":
                    validateInput(input, !/^[a-zA-Z0-9._%+-]+@(gmail\.com|mail\.com)$/.test(input.value), "Email must be @gmail.com or @mail.com.");
                    break;
                case "register-password1":
                    validateInput(input, !/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(input.value), 
                        "Password must have 1 Uppercase, 1 Digit, 1 Special Character and at least 6 characters.");
                    break;
                case "register-password2":
                    validateInput(input, input.value !== document.getElementById("register-password1").value, "Passwords do not match.");
                    break;
            }
        });
    });

    form.addEventListener("submit", function(event) {
        let errors = form.querySelectorAll(".text-danger");
        if (errors.length > 0 && errors[0].textContent !== "") {
            event.preventDefault();
        }
    });
});
</script>
@endpush


<div class="register-container">
    <div class="register-box">
        <h2 class="text-uppercase fw-bold">Sign Up</h2>
        <h6 class="text fw-bold">Create an account to enjoy our services</h6>

        <form class="register-form">
            <div class="mb-3">
                <label for="register-firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="register-firstname" placeholder="Enter First name" pattern="[A-Za-z]+" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="register-lastname" placeholder="Enter Last name" pattern="[A-Za-z]+" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-username" class="form-label">Username</label>
                <input type="text" class="form-control" id="register-username" placeholder="Enter username" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="register-email" placeholder="Enter email" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-password1" class="form-label">Password</label>
                <input type="password" class="form-control" id="register-password1" placeholder="Enter password" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-password2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="register-password2" placeholder="Confirm password" required>
                <div class="error-message"></div>
            </div>
            <button type="submit" class="btn btn-register text-uppercase">Sign Up</button>
        </form>

        <p class="text-left mt-3">Already have an account? <a href="{{ route('login') }}" class="text-white fw-bold">Sign In</a></p>
    </div>
</div>

@endsection
