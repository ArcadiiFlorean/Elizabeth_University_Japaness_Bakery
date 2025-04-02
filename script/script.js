
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("menuModal");
    const modalTitle = document.getElementById("modalTitle");
    const modalDescription = document.getElementById("modalDescription");
    const modalPrice = document.getElementById("modalPrice");
    const modalImage = document.getElementById("modalImage");
    const closeModal = document.querySelector(".close");

    document.querySelectorAll(".menu-item").forEach(item => {
        item.addEventListener("click", function() {
            modalTitle.textContent = this.querySelector("h4").textContent;
            modalDescription.textContent = this.querySelector("p:nth-of-type(1)").textContent;
            modalPrice.textContent = this.querySelector("p:nth-of-type(2)").textContent;
            modalImage.src = this.querySelector("img").src;
            modalImage.alt = this.querySelector("h4").textContent;
            
            modal.style.display = "block";
        });
    });

    closeModal.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});

//ceasul
function updateClock() {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();

    // Format the time with leading zeros if necessary
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    const timeString = hours + ':' + minutes + ':' + seconds;

    document.getElementById('clock').textContent = timeString;
}

// Update the clock every 1000 milliseconds (1 second)
setInterval(updateClock, 1000);

// Initialize the clock immediately
updateClock();