document.addEventListener("DOMContentLoaded", function () {
    initMobileUpdate();
    initEmailUpdate();
    initTooltips();
    initProfileEdit();
    initProfileContent();
    initPinUpdate();
    initAccountDeletion();
});

/* --------------------Mobile Function-------------------- */
function initMobileUpdate() {
    let updateMobileBtn = document.getElementById("updateMobileBtn");
    if (updateMobileBtn) {
        updateMobileBtn.addEventListener("click", function () {
            Swal.fire({
                title: "<span style='color: white; font-size: 22px;'>Update your mobile number?</span>",
                text: "All future sign-ins and SMS notifications will be sent to your new mobile number.",
                imageUrl: "/images/confirm-mobile.png",
                imageWidth: 150,
                imageHeight: 150,
                background: "#454545",
                customClass: { popup: 'custom-swal-popup' },
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: "red",
                cancelButtonColor: "transparent",
                cancelButtonText: "CANCEL",
                confirmButtonText: "CONFIRM"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "<span class='swal-title'>Enter Your New Mobile Number</span>",
                        imageUrl: "/images/confirm-mobile.png",
                        html: `<input type="text" id="newMobile" class="swal-input-custom" placeholder="New Mobile Number">`,
                        background: "linear-gradient(176deg, #121212 200px, #330004 800px, #630000 1240px, #290608 1600px, #170F10 2070px)",
                        customClass: { popup: 'swal-popup-custom' },
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: "red",
                        cancelButtonColor: "transparent",
                        cancelButtonText: "<span class='swal-cancel-text'>CANCEL</span>",
                        confirmButtonText: "<span class='swal-confirm-text'>SAVE</span>",
                        preConfirm: () => {
                            const newMobile = document.getElementById("newMobile").value;
                            if (!newMobile) {
                                Swal.showValidationMessage("<span class='swal-error-text'>Please enter a valid mobile number</span>");
                            }
                            return newMobile;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            updateMobileNumber(result.value);
                        }
                    });
                }
            });
        });
    }

    function updateMobileNumber(phone) {
        fetch("/update-mobile", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ phone: phone })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: "<span style='color: white; text-transform: uppercase'>Updated!</span>",
                    text: "Your mobile number has been updated.",
                    icon: "success",
                    background: "#454545",
                    customClass: {
                        popup: 'custom-swal-popup',
                        confirmButton: 'custom-confirm-button'
                    },
                    confirmButtonText: "CONFIRM"
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong. Try again.",
                    icon: "error",
                    background: "#454545",
                    customClass: {
                        popup: 'custom-swal-popup',
                        confirmButton: 'custom-confirm-button'
                    },
                    confirmButtonText: "CONFIRM"
                });
            }
        })
        .catch(() => {
            Swal.fire({
                title: "Error!",
                text: "Something went wrong. Try again.",
                icon: "error",
                background: "#454545",
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-confirm-button'
                },
                confirmButtonText: "CONFIRM"
            });
        });
    }
}

/* --------------------Email Function-------------------- */
function initEmailUpdate() {
    let updateEmailBtn = document.getElementById("updateEmailBtn");
    if (updateEmailBtn) {
        updateEmailBtn.addEventListener("click", function () {
            Swal.fire({
                title: "<span style='color: white; font-size: 22px;'>Update your email address?</span>",
                text: "All future sign-ins and email notifications will be sent to your new email address.",
                imageUrl: "/images/confirm-email.png",
                imageWidth: 150,
                imageHeight: 150,
                background: "#454545",
                customClass: { popup: 'custom-swal-popup' },
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: "red",
                cancelButtonColor: "transparent",
                cancelButtonText: "CANCEL",
                confirmButtonText: "CONFIRM"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "<span class='swal-title'>Enter Your New Email Address</span>",
                        imageUrl: "/images/confirm-email.png",
                        html: `<input type="email" id="newEmail" class="swal-input-custom" placeholder="New Email Address">`,
                        background: "linear-gradient(176deg, #121212 200px, #330004 800px, #630000 1240px, #290608 1600px, #170F10 2070px)",
                        customClass: { popup: 'swal-popup-custom' },
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: "red",
                        cancelButtonColor: "transparent",
                        cancelButtonText: "<span class='swal-cancel-text'>CANCEL</span>",
                        confirmButtonText: "<span class='swal-confirm-text'>SAVE</span>",
                        preConfirm: () => {
                            const newEmail = document.getElementById("newEmail").value;
                            if (!newEmail || !/\S+@\S+\.\S+/.test(newEmail)) {
                                Swal.showValidationMessage("<span class='swal-error-text'>Please enter a valid email address</span>");
                            }
                            return newEmail;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            updateEmailAddress(result.value);
                        }
                    });
                }
            });
        });
    }

    function updateEmailAddress(email) {
        fetch("/update-email", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: "<span style='color: white; text-transform: uppercase'>Updated!</span>",
                    text: "Your Email Address has been updated.",
                    icon: "success",
                    background: "#454545",
                    customClass: {
                        popup: 'custom-swal-popup',
                        confirmButton: 'custom-confirm-button'
                    },
                    confirmButtonText: "CONFIRM"
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong. Try again.",
                    icon: "error",
                    background: "#454545",
                    customClass: {
                        popup: 'custom-swal-popup',
                        confirmButton: 'custom-confirm-button'
                    },
                    confirmButtonText: "CONFIRM"
                });
            }
        })
        .catch(() => {
            Swal.fire({
                title: "Error!",
                text: "Something went wrong. Try again.",
                icon: "error",
                background: "#454545",
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-confirm-button'
                },
                confirmButtonText: "CONFIRM"
            });
        });
    }
}

/* --------------------Tooltips-------------------- */
function initTooltips() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el, { offset: [0, 8], boundary: 'window' }));
}

/* --------------------Profile Edit & Content-------------------- */
function initProfileEdit() {
    const editButton = document.querySelector(".edit-btn");
    const saveButton = document.getElementById("save-btn");
    const cancelButton = document.getElementById("cancel-btn");
    let initialValues = {};

    if (editButton) editButton.addEventListener("click", toggleEdit);
    if (saveButton) saveButton.addEventListener("click", saveProfile);
    if (cancelButton) cancelButton.addEventListener("click", cancelEdit);

    function toggleEdit(event) {
        event.preventDefault();
        initialValues = getCurrentValues();
        toggleFields(true);
        populateFields();
    }

    function populateFields() {
        const nameValue = document.getElementById("name-value").textContent.trim();
        const dobValue = document.getElementById("dob-value").textContent.trim();
        const stateValue = document.getElementById("state-value").dataset.selected;
        const districtValue = document.getElementById("district-value").dataset.selected;
        const genderValue = document.getElementById("gender-value").textContent.trim();
    
        document.getElementById("name-input").value = nameValue !== 'N/A' ? nameValue : '';
        document.getElementById("dob-input").value = dobValue !== 'N/A' ? dobValue : '';
        
        document.getElementById("state-input").value = stateValue || '';
        document.getElementById("district-input").value = districtValue || '';
    
        document.querySelectorAll(".gender-btn").forEach(btn => {
            btn.classList.remove("selected-gender");
            if (btn.textContent.trim() === (genderValue || 'N/A')) {
                btn.classList.add("selected-gender");
            }
        });
    }

    function cancelEdit() {
        restoreValues(initialValues);
        toggleFields(false);
    }

    function saveProfile() {
        const updatedValues = getCurrentValues();
        updateDisplayedText(updatedValues);
        toggleFields(false);
        saveToDatabase(updatedValues);
    }

    function getCurrentValues() {
        return {
            name: document.getElementById("name-input").value.trim(),
            dob: document.getElementById("dob-input").value.trim(),
            state: document.getElementById("state-input").value,
            district: document.getElementById("district-input").value,
            gender: document.querySelector(".gender-btn.selected-gender")?.textContent || "N/A"
        };
    }

    function restoreValues(values) {
        document.getElementById("name-input").value = values.name || '';
        document.getElementById("dob-input").value = values.dob || '';
    
        document.getElementById("state-input").value = values.state || '';
    
        if (values.state) {
            updateDistrictOptions();
            setTimeout(() => { 
                document.getElementById("district-input").value = values.district || '';
            }, 50);
        } else {
            document.getElementById("district-input").innerHTML = '<option value="">Select District</option>';
        }
    
        document.querySelectorAll(".gender-btn").forEach(btn => {
            btn.classList.remove("selected-gender");
            if (btn.textContent === (values.gender || 'N/A')) {
                btn.classList.add("selected-gender");
            }
        });
    }

    function toggleFields(isEditing) {
        document.querySelectorAll('.profile-contact__block-content-value').forEach(value => 
            value.classList.toggle('d-none', isEditing)
        );
        document.querySelectorAll('.profile-edit-field, .profile-edit-gender-field').forEach(field => 
            field.classList.toggle('d-none', !isEditing)
        );
    
        editButton.classList.toggle('d-none', isEditing);
        saveButton.classList.toggle('d-none', !isEditing);
        cancelButton.classList.toggle('d-none', !isEditing);
    }

    function updateDisplayedText(values) {
        document.getElementById("name-value").textContent = values.name || "N/A";
        document.getElementById("dob-value").textContent = values.dob || "N/A";
        document.getElementById("state-value").textContent = values.state || "N/A";
        document.getElementById("district-value").textContent = values.district || "N/A";
        document.getElementById("gender-value").textContent = values.gender;
    }

    function saveToDatabase(data) {
        fetch('/update-profile', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => console.log(data.success ? "Profile updated successfully!" : "Failed to update profile."))
        .catch(error => console.error("Error:", error));
    }
}

function initProfileContent() {
    const states = {
        "Kuala Lumpur": ["Kepong", "Batu", "Cheras"],
        "Johor": ["Johor Bahru", "Muar", "Batu Pahat"],
        "Kedah": ["Alor Setar", "Sungai Petani", "Kulim"],
        "Kelantan": ["Kota Bharu", "Pasir Mas", "Tumpat"],
        "Melaka": ["Melaka Tengah", "Alor Gajah", "Jasin"],
        "Negeri Sembilan": ["Seremban", "Port Dickson", "Tampin"],
        "Pahang": ["Kuantan", "Temerloh", "Bentong"],
        "Penang": ["George Town", "Seberang Perai", "Bayan Lepas"],
        "Perak": ["Ipoh", "Taiping", "Batu Gajah"],
        "Perlis": ["Kangar", "Arau", "Padang Besar"],
        "Sabah": ["Kota Kinabalu", "Sandakan", "Tawau"],
        "Sarawak": ["Kuching", "Miri", "Sibu"],
        "Selangor": ["Shah Alam", "Petaling Jaya", "Klang"],
        "Terengganu": ["Kuala Terengganu", "Dungun", "Kemaman"]
    };

    const stateSelect = document.getElementById("state-input");
    const districtSelect = document.getElementById("district-input");

    function populateStates() {
        stateSelect.innerHTML = '<option value="">Select State</option>';
        Object.keys(states).forEach(state => {
            let option = document.createElement("option");
            option.value = state;
            option.textContent = state;
            stateSelect.appendChild(option);
        });

        if (stateSelect.dataset.selected) {
            stateSelect.value = stateSelect.dataset.selected;
            updateDistrictOptions();
        }
    }

    const districtData = {
        "Kuala Lumpur": ["Kepong", "Batu", "Cheras"],
        "Johor": ["Johor Bahru", "Muar", "Batu Pahat"],
        "Kedah": ["Alor Setar", "Sungai Petani", "Kulim"],
        "Kelantan": ["Kota Bharu", "Pasir Mas", "Tumpat"],
        "Melaka": ["Melaka Tengah", "Alor Gajah", "Jasin"],
        "Negeri Sembilan": ["Seremban", "Port Dickson", "Tampin"],
        "Pahang": ["Kuantan", "Temerloh", "Bentong"],
        "Penang": ["George Town", "Seberang Perai", "Bayan Lepas"],
        "Perak": ["Ipoh", "Taiping", "Batu Gajah"],
        "Perlis": ["Kangar", "Arau", "Padang Besar"],
        "Sabah": ["Kota Kinabalu", "Sandakan", "Tawau"],
        "Sarawak": ["Kuching", "Miri", "Sibu"],
        "Selangor": ["Shah Alam", "Petaling Jaya", "Klang"],
        "Terengganu": ["Kuala Terengganu", "Dungun", "Kemaman"]
    };
    
    function updateDistrictOptions() {
        const stateInput = document.getElementById("state-input");
        const districtInput = document.getElementById("district-input");
    
        if (!stateInput || !districtInput) return;
    
        const selectedState = stateInput.value;
        districtInput.innerHTML = '<option value="">Select District</option>';
    
        if (districtData[selectedState]) {
            districtData[selectedState].forEach(district => {
                districtInput.innerHTML += `<option value="${district}">${district}</option>`;
            });
        }
    }

    document.querySelectorAll(".gender-btn").forEach(button => {
        button.addEventListener("click", function () {
            document.querySelectorAll(".gender-btn").forEach(btn => btn.classList.remove("selected-gender"));
            this.classList.add("selected-gender");
        });
    });

    stateSelect.addEventListener("change", updateDistrictOptions);
    populateStates();

    const dobInput = document.getElementById("dob-input");
    if (dobInput && dobInput.dataset.value) {
        dobInput.value = dobInput.dataset.value.split(" ")[0]; // Removes time
    }
}

// -------------------- PIN UPDATE FUNCTION --------------------
function initPinUpdate() {
    let updatePinBtn = document.querySelector("[data-action='pin']");
    if (!updatePinBtn) return;
    updatePinBtn.addEventListener("click", function (e) {
        e.preventDefault();
        fetch("/check-pin-status")
            .then(response => response.json())
            .then(status => {
                if (status.hasPin) {
                    Swal.fire({
                        title: "<span style='color: white;'>Verify your current PIN</span>",
                        input: "password",
                        inputAttributes: {
                            maxlength: 6,
                            autocapitalize: "off",
                            autocorrect: "off"
                        },
                        inputPlaceholder: "Enter current 6-digit PIN",
                        background: "#454545",
                        showCancelButton: true,
                        confirmButtonText: "NEXT",
                        customClass: {
                            popup: 'custom-swal-popup',
                            confirmButton: 'custom-confirm-button'
                        },
                        preConfirm: (inputPin) => {
                            if (!inputPin || inputPin.length !== 6 || !/^\d+$/.test(inputPin)) {
                                Swal.showValidationMessage("Invalid PIN format");
                            }
                            return inputPin;
                        }
                    }).then(result => {
                        if (result.isConfirmed) {
                            showNewPinPrompt(result.value);
                        }
                    });
                } else {
                    showNewPinPrompt();
                }
            });
    });
}

function showNewPinPrompt(existingPin = null) {
    Swal.fire({
        title: "<span class='swal-title'>Enter Your New 6-Digit PIN</span>",
        imageUrl: "/images/confirm-pin.png",
        imageWidth: 80,
        imageHeight: 80,
        html: `
            <div class="swal-pin-container">
                <input type="text" id="pin1" class="swal-pin-input" maxlength="1" autofocus>
                <input type="text" id="pin2" class="swal-pin-input" maxlength="1">
                <input type="text" id="pin3" class="swal-pin-input" maxlength="1">
                <input type="text" id="pin4" class="swal-pin-input" maxlength="1">
                <input type="text" id="pin5" class="swal-pin-input" maxlength="1">
                <input type="text" id="pin6" class="swal-pin-input" maxlength="1">
            </div>
        `,
        background: "#121212",
        customClass: {
            popup: 'swal-popup-custom',
            confirmButton: 'swal-btn-confirm',
            cancelButton: 'swal-btn-cancel'
        },
        showCancelButton: true,
        confirmButtonText: "<span class='swal-confirm-text'>SAVE</span>",
        cancelButtonText: "<span class='swal-cancel-text'>CANCEL</span>",
        reverseButtons: true,
        didOpen: () => {
            const inputs = document.querySelectorAll(".swal-pin-input");
            inputs.forEach((input, index) => {
                input.addEventListener("input", (e) => {
                    if (e.target.value.length === 1 && index < 5) {
                        inputs[index + 1].focus();
                    }
                });
                input.addEventListener("keydown", (e) => {
                    if (e.key === "Backspace" && index > 0 && e.target.value.length === 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
        },
        preConfirm: () => {
            const pin = Array.from(document.querySelectorAll(".swal-pin-input"))
                .map(input => input.value)
                .join("");
            if (pin.length !== 6 || !/^\d{6}$/.test(pin)) {
                Swal.showValidationMessage("Please enter a valid 6-digit PIN");
            }
            return pin;
        }
    }).then(result => {
        if (result.isConfirmed) {
            updatePin(result.value, existingPin);
        }
    });
}

function updatePin(newPin, existingPin = null) {
    fetch("/update-pin", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ pin: newPin, oldPin: existingPin })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: "<span style='color: white;'>Updated!</span>",
                text: "Your PIN has been updated.",
                icon: "success",
                background: "#454545",
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-confirm-button'
                },
                confirmButtonText: "CONFIRM"
            }).then(() => location.reload());
        } else {
            Swal.fire({
                title: "Error!",
                text: data.message || "Update failed.",
                icon: "error",
                background: "#454545",
                customClass: {
                    popup: 'custom-swal-popup',
                    confirmButton: 'custom-confirm-button'
                },
                confirmButtonText: "CONFIRM"
            });
        }
    })
    .catch(() => {
        Swal.fire({
            title: "Error!",
            text: "Something went wrong. Try again.",
            icon: "error",
            background: "#454545",
            customClass: {
                popup: 'custom-swal-popup',
                confirmButton: 'custom-confirm-button'
            },
            confirmButtonText: "CONFIRM"
        });
    });
}

// -------------------- ACCOUNT DELETION FUNCTION --------------------
function initAccountDeletion() {
    let deleteAccountBtn = document.querySelector("[data-action='account']");
    if (deleteAccountBtn) {
        deleteAccountBtn.addEventListener("click", function () {
            Swal.fire({
                title: "<span style='color: white; font-size: 22px;'>Delete your account?</span>",
                text: "All data will be permanently erased. You will be logged out immediately.",
                imageUrl: "/images/confirm-account.png",
                imageWidth: 150,
                imageHeight: 150,
                background: "#454545",
                customClass: { popup: 'custom-swal-popup' },
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: "red",
                cancelButtonColor: "transparent",
                cancelButtonText: "<span class='swal-cancel-text'>CANCEL</span>",
                confirmButtonText: "<span class='swal-confirm-text'>DELETE</span>"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("/delete-account", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: "<span style='color: white;'>Account Deleted</span>",
                                text: "Your account has been permanently removed.",
                                icon: "success",
                                background: "#454545",
                                customClass: {
                                    popup: 'custom-swal-popup',
                                    confirmButton: 'custom-confirm-button'
                                },
                            }).then(() => {
                                window.location.href = "/logout";
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong. Try again.",
                                icon: "error",
                                background: "#454545",
                                customClass: {
                                    popup: 'custom-swal-popup',
                                    confirmButton: 'custom-confirm-button'
                                },
                                confirmButtonText: "CONFIRM"
                            });
                        }
                    });
                }
            });
        });
    }
}

