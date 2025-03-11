@extends('layouts.index')
@section('hideHeader', true)

@section('title', 'Register | PrimeCinemas')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".register-form");
    if (!form) return;

    const inputs = form.querySelectorAll("input, select");

    function showError(input, message) {
        let errorDiv = input.closest('.mb-3').querySelector(".error-message");
        if (!errorDiv) {
            errorDiv = document.createElement("div");
            errorDiv.classList.add("error-message");
            errorDiv.style.color = "red";
            input.closest('.mb-3').appendChild(errorDiv);
        }
        errorDiv.textContent = message;
    }

    function clearError(input) {
        let errorDiv = input.closest('.mb-3').querySelector(".error-message");
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    function validateInput(input) {
        switch (input.id) {
            case "register-username":
                if (/\s/.test(input.value)) {
                    showError(input, "Username cannot contain spaces.");
                } else {
                    clearError(input);
                }
                break;

            case "register-email":
                if (!/^[a-zA-Z0-9._%+-]+@(gmail\.com|mail\.com)$/.test(input.value)) {
                    showError(input, "Email must be @gmail.com or @mail.com.");
                } else {
                    clearError(input);
                }
                break;

            case "register-phone":
                if (!/^\d{8,11}$/.test(input.value)) {
                    showError(input, "Phone number must be 8 to 11 digits.");
                } else {
                    clearError(input);
                }
                break;

            case "register-password1":
            case "register-password2":
                if (!/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(input.value)) {
                    showError(input, "Password must have 1 Uppercase, 1 Digit, 1 Special Character, and at least 6 characters.");
                } else {
                    clearError(input);
                }

                if (input.id === "register-password2") {
                    const pass1 = document.getElementById("register-password1").value;
                    if (input.value !== pass1) {
                        showError(input, "Passwords do not match.");
                    } else {
                        clearError(input);
                    }
                }
                break;
        }
    }

    inputs.forEach(input => {
        input.addEventListener("input", () => validateInput(input));
        input.addEventListener("blur", () => validateInput(input));
    });

    form.addEventListener("submit", function(event) {
        let hasError = false;
        inputs.forEach(input => {
            validateInput(input);
            let errorDiv = input.closest('.mb-3').querySelector(".error-message");
            if (errorDiv) {
                hasError = true;
            }
        });

        if (hasError) {
            event.preventDefault();
        }
    });
});
</script>

<div class="register-container">
    <div class="register-box">
        <h2 class="text-uppercase fw-bold">Sign Up</h2>
        <h6 class="text fw-bold">Create an account to enjoy our services</h6>

        <form class="register-form">
            <div class="mb-3">
                <label for="register-username" class="form-label">Username</label>
                <input type="text" class="form-control" id="register-username" placeholder="Enter username" required>
                <div class="error-message"></div>
            </div>

            <div class="mb-3">
                <label for="register-phone" class="form-label">Phone No.</label>
                <div class="input-group">
                    <select class="form-select country-code" id="country-code">
                        <option value="+60" selected>(+60)</option>
                        <option value="+65">(+65)</option>
                    </select>
                    <input type="text" class="form-control" id="register-phone" placeholder="Enter phone number" required>
                </div>
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
