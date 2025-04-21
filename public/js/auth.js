document.addEventListener("DOMContentLoaded", function () {

    // Clear Error messages
    function clearFieldError(input) {
        input.classList.remove('is-invalid');
        const fb = input.closest('.mb-3')?.querySelector('.invalid-feedback, .text-danger');
        if (fb) fb.remove();
    }

    document.querySelectorAll('#username-input, #email-input, #password1, #password2').forEach(input =>
        input.addEventListener('input', () => clearFieldError(input))
    );

    function clearLaravelError(input) {
        const err = input.closest('.mb-3').querySelector('.text-danger, .invalid-feedback');
        if (err) err.remove();
      }
      
      document.querySelectorAll('#register-username, #register-email').forEach(input => {
        input.addEventListener('input', () => clearLaravelError(input));
    });

    document.querySelectorAll('#register-username, #register-email').forEach(input => {
        input.addEventListener('input', () => clearLaravelError(input));
    });

    // Password Toggle Function
    function setupPasswordToggle(buttonClass) {
        document.querySelectorAll(buttonClass).forEach(button => {
            button.addEventListener("click", function () {
                let input = this.previousElementSibling;
                if (input.type === "password") {
                    input.type = "text";
                    this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
                } else {
                    input.type = "password";
                    this.innerHTML = '<i class="fa-solid fa-eye"></i>';
                }
            });
        });
    }
    setupPasswordToggle(".toggle-password");

    // ========== LOGIN PASSWORD VALIDATION ==========
    function validateLoginPassword() {
        document.querySelectorAll("input[type='password']").forEach(passwordField => {
            passwordField.addEventListener("input", function () {
                let errorDiv = passwordField.closest(".mb-3").querySelector(".error-message");
                if (!errorDiv) {
                    errorDiv = document.createElement("div");
                    errorDiv.classList.add("error-message");
                    errorDiv.style.color = "red";
                    passwordField.closest(".mb-3").appendChild(errorDiv);
                }

                if (!/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(passwordField.value)) {
                    errorDiv.textContent = "Password must have 1 Uppercase, 1 Digit, 1 Special Character, and at least 6 characters.";
                } else {
                    errorDiv.textContent = "";
                }
            });
        });
    }
    validateLoginPassword();

    // ========== REGISTER VALIDATION ==========
    function setupRegisterValidation() {
        const form = document.querySelector(".register-form");
        if (!form) return;

        const inputs = form.querySelectorAll("input, select");
        const phoneInput = document.getElementById("register-phone");
        const countryCode = document.getElementById("country-code");

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
            if (errorDiv) errorDiv.remove();
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
                    if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/.test(input.value)) {
                        showError(input, "Enter a valid email address.");
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

        function formatPhoneNumber() {
            let phone = phoneInput.value.replace(/\D/g, '');
            let country = countryCode.value;

            if (country === "+60" && !phone.startsWith("0")) {
                phone = "0" + phone;
            }

            phoneInput.value = phone;
        }

        phoneInput.addEventListener("input", formatPhoneNumber);
        countryCode.addEventListener("change", formatPhoneNumber);

        inputs.forEach(input => {
            input.addEventListener("paste", (e) => {
                e.preventDefault();
                let text = (e.clipboardData || window.clipboardData).getData("text");
                input.value = text;
            });

            input.addEventListener("input", () => validateInput(input));
            input.addEventListener("blur", () => validateInput(input));
        });

        form.addEventListener("submit", function(event) {
            let hasError = false;
            inputs.forEach(input => {
                validateInput(input);
                if (input.closest('.mb-3').querySelector(".error-message")) {
                    hasError = true;
                }
            });

            if (hasError) {
                event.preventDefault();
            }
        });
    }
    setupRegisterValidation();
});
