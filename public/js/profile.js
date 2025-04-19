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
const stateDistrictData = {
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
    const stateSelect = document.getElementById("state-input");
    const districtSelect = document.getElementById("district-input");

    if (!stateSelect || !districtSelect) return;

    districtSelect.innerHTML = '<option value="">Select District</option>';
    const selectedState = stateSelect.value;

    if (stateDistrictData[selectedState]) {
        stateDistrictData[selectedState].forEach(district => {
            districtSelect.innerHTML += `<option value="${district}">${district}</option>`;
        });
    } else {
        console.warn(`No districts found for state: ${selectedState}`);
        districtSelect.innerHTML = '<option value="">No districts available</option>';
    }

    if (districtSelect.dataset.selected) {
        districtSelect.value = districtSelect.dataset.selected;
    }
}

function initProfileEdit() {
    const container = document.getElementById("profile-info");
    if (!container) return;

    const editButton = document.querySelector(".edit-btn");
    const saveButton = container.querySelector("#save-btn");
    const cancelButton = container.querySelector("#cancel-btn");

    let initialValues = {};

    if (editButton) editButton.addEventListener("click", toggleEdit);
    if (saveButton) saveButton.addEventListener("click", saveProfile);
    if (cancelButton) cancelButton.addEventListener("click", cancelEdit);

    function toggleEdit(event) {
        event.preventDefault();
        initialValues = getCurrentValues();
        toggleFields(true);
        populateEditFields();
    }

    function populateEditFields() {
        const usernameDisplay = container.querySelector("#name-value").textContent.trim();
        const dobDisplay = container.querySelector("#dob-value").textContent.trim();
        const stateDisplay = container.querySelector("#state-value").dataset.selected;
        const districtDisplay = container.querySelector("#district-value").dataset.selected;
        const genderDisplay = container.querySelector("#gender-value").textContent.trim();

        container.querySelector("#name-input").value = usernameDisplay !== 'N/A' ? usernameDisplay : '';
        container.querySelector("#dob-input").value = dobDisplay !== 'N/A' ? dobDisplay : '';
        container.querySelector("#state-input").value = stateDisplay || '';

        updateDistrictOptions();
        container.querySelector("#district-input").value = districtDisplay || '';

        container.querySelectorAll(".gender-btn").forEach(btn => {
            btn.classList.remove("selected-gender");
            if (btn.textContent.trim() === (genderDisplay || 'N/A')) {
                btn.classList.add("selected-gender");
            }
        });
    }

    function cancelEdit() {
        toggleFields(false);
    }

    function saveProfile() {
        const updatedValues = getCurrentValues();
        updateDisplayedText(updatedValues);
        toggleFields(false);
        saveToDatabase(updatedValues);
    }

    function toggleFields(isEditing) {
        container.querySelectorAll('.profile-contact__block-content-value').forEach(value => 
            value.classList.toggle('d-none', isEditing)
        );

        container.querySelectorAll('.profile-edit-field, .profile-edit-gender-field').forEach(field => 
            field.classList.toggle('d-none', !isEditing)
        );

        editButton.classList.toggle('d-none', isEditing);
        saveButton.classList.toggle('d-none', !isEditing);
        cancelButton.classList.toggle('d-none', !isEditing);
    }

    function getCurrentValues() {
        return {
            username: container.querySelector("#name-input").value.trim(),
            dob: container.querySelector("#dob-input").value.trim(),
            state: container.querySelector("#state-input").value,
            district: container.querySelector("#district-input").value,
            gender: container.querySelector(".gender-btn.selected-gender")?.dataset.gender || "N/A"
        };
    }

    function updateDisplayedText(values) {
        container.querySelector("#name-value").textContent = values.username || "N/A";
        container.querySelector("#dob-value").textContent = values.dob || "N/A";
        container.querySelector("#state-value").textContent = values.state || "N/A";
        container.querySelector("#district-value").textContent = values.district || "N/A";
        container.querySelector("#gender-value").textContent = values.gender;
        
        const greetingSpan = document.getElementById("greeting-username");
        if(greetingSpan) {
            greetingSpan.textContent = values.username || "Guest";
        }

        const headerSpan = document.getElementById("header-username");
        if (headerSpan) {
          headerSpan.textContent = "Hi, " + (values.username || "Guest");
        }
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
        .then(data => {
            if (data.success) {
                console.log("Profile updated successfully!");
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Failed to update profile. Please try again.",
                    icon: "error",
                    background: "#454545",
                    customClass: {
                        popup: 'custom-swal-popup',
                        confirmButton: 'custom-confirm-button'
                    },
                    confirmButtonText: "OK"
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

function initProfileContent() {
    function populateStates() {
        const stateSelect = document.getElementById("state-input");
        if (!stateSelect) return;

        stateSelect.innerHTML = '<option value="">Select State</option>';
        Object.keys(stateDistrictData).forEach(state => {
            stateSelect.innerHTML += `<option value="${state}">${state}</option>`;
        });

        if (stateSelect.dataset.selected) {
            stateSelect.value = stateSelect.dataset.selected;
        } else {
            console.warn("No selected state found in dataset.");
        }
    }

    const stateSelect = document.getElementById("state-input");
    if (stateSelect) {
        stateSelect.addEventListener("change", updateDistrictOptions);
    }

    populateStates();

    document.querySelectorAll(".gender-btn").forEach(button => {
        button.addEventListener("click", function () {
            document.querySelectorAll(".gender-btn").forEach(btn => btn.classList.remove("selected-gender"));
            this.classList.add("selected-gender");
        });
    });

    const dobInput = document.getElementById("dob-input");
    if (dobInput && dobInput.dataset.value) {
        const dateValue = dobInput.dataset.value.split(" ")[0];
        if (dateValue) {
            dobInput.value = dateValue;
        } else {
            console.warn("Invalid date value in dataset.");
        }
    }
}