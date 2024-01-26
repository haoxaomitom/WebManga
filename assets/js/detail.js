// Khi tài liệu đã tải xong
document.addEventListener("DOMContentLoaded", function() {
    var backToTopButton = document.getElementById("back-to-top-button");

    // Khi cuộn trang
    window.addEventListener("scroll", function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add("visible");
        } else {
            backToTopButton.classList.remove("visible");
        }
    });

    // Khi nút được nhấn
    backToTopButton.addEventListener("click", function() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var darkModeButton = document.getElementById("dark-mode-button");
    var darkModeContainer = document.querySelector(".container-down");

    darkModeButton.addEventListener("click", function() {
        darkModeContainer.classList.toggle("active");
    });
});

