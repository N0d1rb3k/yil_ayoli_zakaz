import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// 🌸 Simple interactivity
document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll("nav a");

    // Highlight current page
    navLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.style.fontWeight = "700";
            link.style.color = "#b31f6f";
        }
    });

    // Smooth scroll for internal anchors
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute("href"))?.scrollIntoView({
                behavior: "smooth"
            });
        });
    });
});
