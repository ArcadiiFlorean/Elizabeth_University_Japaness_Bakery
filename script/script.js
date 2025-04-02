
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

