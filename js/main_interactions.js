document.addEventListener("DOMContentLoaded", function () {
    // 1. SCROLL REVEAL ANIMATION
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                
                // Trigger counter if it's a stat number
                if (entry.target.classList.contains('stat-number')) {
                    animateValue(entry.target);
                }
            }
        });
    }, observerOptions);

    // Target elements with .reveal class
    document.querySelectorAll('.reveal, .stat-number').forEach(el => {
        observer.observe(el);
    });

    // 2. NUMBER COUNTER ANIMATION (For Why Us Section)
    function animateValue(obj) {
        if(obj.dataset.animated) return; // Prevent rerun
        
        let startTimestamp = null;
        const duration = 2000;
        const finalValue = parseInt(obj.getAttribute("data-target"));
        const suffix = obj.getAttribute("data-suffix") || "";

        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * finalValue) + suffix;
            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                obj.dataset.animated = "true";
            }
        };
        window.requestAnimationFrame(step);
    }
});