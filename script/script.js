function updateClock() {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();

    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    const timeString = `${hours}:${minutes}:${seconds}`;

    // Doar actualizează ceasul dacă există în DOM
    const clockElement = document.getElementById("clock");
    if (clockElement) {
        clockElement.textContent = timeString;
    }
}

// În loc de `setInterval`, folosește `requestAnimationFrame`
function startClock() {
    updateClock();
    requestAnimationFrame(startClock); // Înlocuiește `setInterval` cu asta
}

startClock();

// Functii pentru modal window
console.log("script.js loaded successfully!"); // Verificare încărcare

const modal = document.getElementById("myModal");
const modalTitle = document.getElementById("modal-title");
const modalImage = document.getElementById("modal-image");
const modalDescription = document.getElementById("modal-description");
const modalPrice = document.getElementById("modal-price");
const closeModal = document.querySelector(".close");

function openModal(name, description, price, imageSrc) {
    modal.style.display = "block";
    setTimeout(() => {
        modal.classList.add("show");
        document.querySelector(".modal-content").classList.add("show");
    }, 10);

    modalTitle.textContent = name;
    modalDescription.textContent = description;
    modalPrice.textContent = `Preț: ${price} Lei`;
    modalImage.src = imageSrc;
}

closeModal.onclick = function() {
    modal.classList.remove("show");
    document.querySelector(".modal-content").classList.remove("show");
    setTimeout(() => {
        modal.style.display = "none";
    }, 300);
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.classList.remove("show");
        document.querySelector(".modal-content").classList.remove("show");
        setTimeout(() => {
            modal.style.display = "none";
        }, 300);
    }
}

document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function() {
        const name = this.querySelector('h4').textContent;
        const description = this.querySelectorAll('p')[0].textContent;
        const price = this.querySelectorAll('p')[1].textContent.split(' ')[1];
        const imageSrc = this.querySelector('img').src;

        openModal(name, description, price, imageSrc);
    });
});
