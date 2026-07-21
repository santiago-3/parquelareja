document.addEventListener('DOMContentLoaded', () => {
    setInterval(nextPicture, 5000);
});

function nextPicture() {
    console.log('next picture');

    // 1. Find the currently visible image
    // Note: This assumes "visible" means it doesn't have a hidden style/class
    const current = document.querySelector('.home-gallery img:not([style*="display: none"])');
    if (!current) return;

    // 2. Determine the next image
    let next = current.nextElementSibling;
    
    // If there is no next sibling, wrap back to the first image
    if (!next) {
        next = document.querySelector('.home-gallery').firstElementChild;
    }

    // 3. Handle the Fade Transition
    // We use the Web Animations API to mimic jQuery's .fadeOut() / .fadeIn()
    const fadeOut = current.animate([{ opacity: 1 }, { opacity: 0 }], {
        duration: 450,
        fill: 'forwards'
    });

    fadeOut.onfinish = () => {
        current.style.display = 'none'; // Hide the old one completely
        
        if (next) {
            next.style.display = 'block'; // Ensure the next one is ready to be seen
            next.animate([{ opacity: 0 }, { opacity: 1 }], {
                duration: 450,
                fill: 'forwards'
            });
        }
    };
}
