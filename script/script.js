
document.addEventListener("DOMContentLoaded", function() {
    let slides = document.querySelectorAll(".slider-item");
    let currentIndex = 0;

    function showSlide(index) {
        slides.forEach(slide => slide.style.display = "none");
        slides[index].style.display = "block";
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }

    showSlide(currentIndex);
    setInterval(nextSlide, 3000); // Schimbă slide-ul la fiecare 3 secunde
});

