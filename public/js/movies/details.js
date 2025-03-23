// More or Less info button
document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.getElementById("toggleButton");
    const btnMoreLessInfo = toggleButton.querySelector(".btn-more-less-info");
    const btnIcon = toggleButton.querySelector("i");

    document.getElementById("collapseMovieSynopsis").addEventListener("show.bs.collapse", function () {
        btnMoreLessInfo.textContent = "Less Info";
        btnIcon.classList.replace("fa-caret-down", "fa-caret-up"); // Change to up arrow
    });

    document.getElementById("collapseMovieSynopsis").addEventListener("hide.bs.collapse", function () {
        btnMoreLessInfo.textContent = "More Info";
        btnIcon.classList.replace("fa-caret-up", "fa-caret-down"); // Change to down arrow
    });
});

// Watch Trailer button
document.addEventListener('DOMContentLoaded', function () {
    let trailerModal = document.getElementById('trailerModal');
    let youtubePlayer = document.getElementById('youtubePlayer');
    
    trailerModal.addEventListener('hide.bs.modal', function () {
        youtubePlayer.src = youtubePlayer.src; // Reset the iframe src to stop the video
    });
});

// Custom select options dropdown
document.addEventListener("DOMContentLoaded", function () {
    const dropdown = document.querySelector(".custom-dropdown");
    const selectedOption = dropdown.querySelector(".selected-option");
    const selectedText = dropdown.querySelector("#selected-text");
    const optionsList = dropdown.querySelector(".dropdown-options");
    const hiddenInput = document.getElementById("region-select");

    // Toggle dropdown on click
    selectedOption.addEventListener("click", function () {
        optionsList.style.display = optionsList.style.display === "block" ? "none" : "block";
    });

    // Select an option
    optionsList.querySelectorAll("li").forEach(option => {
        option.addEventListener("click", function () {
            selectedText.textContent = this.textContent;
            hiddenInput.value = this.dataset.value;

            // Remove active class from all and add to selected
            optionsList.querySelectorAll("li").forEach(li => li.classList.remove("active"));
            this.classList.add("active");

            optionsList.style.display = "none";
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (e) {
        if (!dropdown.contains(e.target)) {
            optionsList.style.display = "none";
        }
    });
});
