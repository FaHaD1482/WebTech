document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.review-box');
    const prevBtn = document.getElementById('prev-btn'); 
    const nextBtn = document.getElementById('next-btn'); 
    let currentSlide = 0; 

    // Show the slide based on the index
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active'); 
            if (i === index) {
                slide.classList.add('active'); 
            }
        });
    }

    prevBtn.addEventListener('click', () => {
        currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides.length - 1;
        showSlide(currentSlide);
    });

    nextBtn.addEventListener('click', () => {
        currentSlide = (currentSlide < slides.length - 1) ? currentSlide + 1 : 0;
        showSlide(currentSlide);
    });

    showSlide(currentSlide);
});
