$(document).ready(function () {
    moreLessInfoButton();
    watchTrailerButton();
    regionFilterDropdown();
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

// Regions Filter Dropdown
function regionFilterDropdown() {
    const $dropdown = $(".region-dropdown");
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
        const selectedRegion = $(this).data("value");
    
        $selectedText.text($(this).text());
        $hiddenInput.val(selectedRegion);
    
        $optionsList.find("li").removeClass("active");
        $(this).addClass("active");
    
        $optionsList.fadeOut(150);
    
        // Re-fetch showtimes with region filtering
        const selectedDate = $(".btn-tab-item.active").data("date");
        const movieId = $("#movieShowtimeWrapper").data("movie-id");
        loadShowtimesForDate(movieId, selectedDate, selectedRegion);
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
    const movieId = $("#movieShowtimeWrapper").data("movie-id");

    if (!movieId) {
        console.warn("Movie ID is missing");
        return;
    }

    $.ajax({
        url: `/dates?movie_id=${movieId}`,
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
                            data-date="${date.full_date}"
                            type="button">
                        ${date.is_today ? "Today" : date.day} <br> ${date.date} ${date.month}
                    </button>
                </li>
            `).join("");

            $("#movieShowtimeDateTab").html(html);

            // Load first tab's showtimes
            const selectedRegion = $("#region-select").val();
            loadShowtimesForDate(movieId, dates[0].full_date, selectedRegion);

            // Handle tab click
            $(".btn-tab-item").click(function () {
                $(".btn-tab-item").removeClass("active");
                $(this).addClass("active");

                const selectedDate = $(this).data("date");
                const selectedRegion = $("#region-select").val();
                loadShowtimesForDate(movieId, selectedDate, selectedRegion);
            });
        },
        error: function (xhr, status, error) {
            console.error("Failed to load dates:", status, error);
            $("#movieShowtimeDateTab").html("<li class='nav-item'><span>Error loading showtimes.</span></li>");
        }
    });
}

// Load showtimes based on selected date
function loadShowtimesForDate(movieId, date, region = "all") {
    $.ajax({
        url: `/api/showtimes?movie_id=${movieId}&date=${date}`,
        type: "GET",
        dataType: "json",
        success: function (showtimes) {
            const filteredShowtimes = showtimes.filter(st => {
                const matchDate = st.show_date === date;
                const matchRegion = region === "all" || st.area.toLowerCase() === region.toLowerCase(); // Display all regions showtimes or filtered by selected regions
                return matchDate && matchRegion;
            });
        
            if (!filteredShowtimes.length) {
                const emptyHtml = `
                    <div class="empty-movies text-center">
                        <img src="/images/movie-unavailable.svg" alt="No Movies" style="max-width: 250px; margin: 20px auto;">
                        <p class="empty-movies-content text-white">
                            Showtimes not available <br>
                            Please wait for further announcements. Thank you. <br>
                            👉👈
                        </p>
                    </div>
                `;
                $("#accordionShowtimesPanels").html(emptyHtml);
                return;
            }
        
            // Sort showtimes by cinema (city-cinema) and then show_time
            const sortedShowtimes = filteredShowtimes.sort((a, b) => {
                const cinemaA = `${a.city} - ${a.cinema}`.toLowerCase();
                const cinemaB = `${b.city} - ${b.cinema}`.toLowerCase();

                if (cinemaA < cinemaB) return -1;
                if (cinemaA > cinemaB) return 1;

                // If same cinema, sort by show_time
                return a.show_time.localeCompare(b.show_time);
            });

            // Group showtimes by city - cinema
            const groupedByCinema = {};
            sortedShowtimes.forEach(st => {
                const key = `${st.city} - ${st.cinema}`;
                if (!groupedByCinema[key]) {
                    groupedByCinema[key] = [];
                }
                groupedByCinema[key].push(st);
            });

            // Create accordion HTML
            let accordion = '';
            Object.entries(groupedByCinema).forEach(([groupKey, groupShowtimes], index) => {
                const collapseId = `collapse${index}`;
                accordion += `
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#${collapseId}" aria-expanded="true" aria-controls="${collapseId}">
                                ${groupKey}
                            </button>
                        </h2>
                        <div id="${collapseId}" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-3 showtime-container">
                                    ${groupShowtimes.map(st => `
                                        <div class="col">
                                            <a href="#" class="showtime-card text-decoration-none">
                                                <div>${formatTime(st.show_time)}</div>
                                                <hr class="showtime-card-line">
                                                <div class="text-uppercase">${st.hall_type}</div>
                                            </a>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            $("#accordionShowtimesPanels").html(accordion);
        },
        error: function () {
            $("#accordionShowtimesPanels").html("<p>Error loading showtimes.</p>");
        }
    });
}

function formatTime(timeStr) {
    const [hour, minute] = timeStr.split(":");
    let h = parseInt(hour);
    const ampm = h >= 12 ? " PM" : " AM";
    h = h % 12 || 12;
    return `${h}:${minute}${ampm}`;
}
