document.addEventListener('DOMContentLoaded', function () {

    const slides = document.querySelectorAll('.promotion-slide');
    const dots = document.querySelectorAll('.promotion-dot');

    if (!slides.length) {
        return;
    }

    let currentSlide = 0;

    const showSlide = (index) => {

        slides.forEach((slide, slideIndex) => {

            if (slideIndex === index) {

                slide.classList.remove('opacity-0', 'z-0');
                slide.classList.add('opacity-100', 'z-10');

            } else {

                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'z-0');

            }

        });

        dots.forEach((dot, dotIndex) => {

            if (dotIndex === index) {

                dot.classList.remove('w-2', 'bg-white/60');
                dot.classList.add('w-8', 'bg-[#BE8B3E]');

            } else {

                dot.classList.remove('w-8', 'bg-[#BE8B3E]');
                dot.classList.add('w-2', 'bg-white/60');

            }

        });

    };

    const nextSlide = () => {

        currentSlide = (currentSlide + 1) % slides.length;

        showSlide(currentSlide);

    };

    dots.forEach((dot, index) => {

        dot.addEventListener('click', function () {

            currentSlide = index;

            showSlide(currentSlide);

        });

    });

    setInterval(nextSlide, 6000);

});
