import "./bootstrap";
import "preline";

// Smooth scroll for anchor links
document.addEventListener("DOMContentLoaded", function () {
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (href !== "#" && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // Animate on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -100px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = "running";
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document
        .querySelectorAll(
            ".animate-fade-in-up, .animate-fade-in-left, .animate-fade-in-right"
        )
        .forEach((el) => {
            el.style.animationPlayState = "paused";
            observer.observe(el);
        });
});

// Reinitialize Preline on Livewire navigation
if (window.Livewire) {
    Livewire.on("navigated", () => {
        if (window.HSStaticMethods) {
            window.HSStaticMethods.autoInit();
        }
    });
}
