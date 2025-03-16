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

document.addEventListener('DOMContentLoaded', function () {
    let trailerModal = document.getElementById('trailerModal');
    let youtubePlayer = document.getElementById('youtubePlayer');
    
    trailerModal.addEventListener('hide.bs.modal', function () {
        youtubePlayer.src = youtubePlayer.src; // Reset the iframe src to stop the video
    });
});