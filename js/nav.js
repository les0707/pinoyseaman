document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.querySelector(".burger");
    const menu = document.querySelector("nav ul");

    menuToggle.addEventListener("click", () => {
        menu.classList.toggle("show");
    });
});