$(document).ready(function () {
    moreLessInfoButton();
    watchTrailerButton();
    customDropdown();
    loadMovieShowtimeDates();
});

// More or Less Info Button
function moreLessInfoButton() {
    const $toggleButton = $("#toggleButton");
    const $btnMoreLessInfo = $toggleButton.find(".btn-more-less-info");
    const $btnIcon = $toggleButton.find("i");
    const $collapseMovieSynopsis = $("#collapseMovieSynopsis");

    $collapseMovieSynopsis.on("show.bs.collapse", function () {
        $btnMoreLessInfo.text("Less Info");
        $btnIcon.removeClass("fa-caret-down").addClass("fa-caret-up");
    });

    $collapseMovieSynopsis.on("hide.bs.collapse", function () {
        $btnMoreLessInfo.text("More Info");
        $btnIcon.removeClass("fa-caret-up").addClass("fa-caret-down");
    });
}

// Watch Trailer Button
function watchTrailerButton() {
    const $trailerModal = $("#trailerModal");
    const $youtubePlayer = $("#youtubePlayer");

    $trailerModal.on("hide.bs.modal", function () {
        $youtubePlayer.attr("src", $youtubePlayer.attr("src")); // Reset the iframe src to stop the video
    });
}

// Custom Select Options Dropdown
function customDropdown() {
    const $dropdown = $(".custom-dropdown");
    const $selectedOption = $dropdown.find(".selected-option");
    const $selectedText = $("#selected-text");
    const $optionsList = $dropdown.find(".dropdown-options");
    const $hiddenInput = $("#region-select");

    // Toggle dropdown on click
    $selectedOption.on("click", function () {
        $optionsList.fadeToggle(150); // Smooth animation
    });

    // Select an option
    $optionsList.on("click", "li", function () {
        $selectedText.text($(this).text());
        $hiddenInput.val($(this).data("value"));

        $optionsList.find("li").removeClass("active");
        $(this).addClass("active");

        $optionsList.fadeOut(150);
    });

    // Close dropdown when clicking outside
    $(document).on("click", function (e) {
        if (!$dropdown.is(e.target) && $dropdown.has(e.target).length === 0) {
            $optionsList.fadeOut(150);
        }
    });
}

// Load Movie Showtime Dates from API
function loadMovieShowtimeDates() {
    $.ajax({
        url: "/dates",
        type: "GET",
        dataType: "json",
        success: function (dates) {
            if (!Array.isArray(dates) || dates.length === 0) {
                console.warn("No dates available.");
                $("#movieShowtimeDateTab").html("<li class='nav-item'><span>No showtimes available.</span></li>");
                return;
            }

            let html = dates.map((date, index) => `
                <li class="nav-item tab-item" role="presentation">
                    <button class="nav-link btn-tab-item ${index === 0 ? 'active' : ''}" 
                            id="movie-showing-time${index + 1}-tab"
                            data-bs-toggle="tab" 
                            data-bs-target="#movie-showing-time${index + 1}-tab-pane"
                            type="button" 
                            role="tab" 
                            aria-controls="movie-showing-time${index + 1}-tab-pane" 
                            aria-selected="${index === 0 ? 'true' : 'false'}">
                        ${date.is_today ? "Today" : date.day} <br> ${date.date} ${date.month}
                    </button>
                </li>
            `).join("");

            $("#movieShowtimeDateTab").html(html);
        },
        error: function (xhr, status, error) {
            console.error("Failed to load dates:", status, error);
            $("#movieShowtimeDateTab").html("<li class='nav-item'><span>Error loading showtimes.</span></li>");
        }
    });
}
