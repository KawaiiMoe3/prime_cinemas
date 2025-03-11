document.addEventListener("DOMContentLoaded", function () {
    const goToTopBtn = document.getElementById("goToTopBtn");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 300) {
            goToTopBtn.style.display = "flex";
        } else {
            goToTopBtn.style.display = "none";
        }
    });

    goToTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
});
