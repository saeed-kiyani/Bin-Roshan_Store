document.addEventListener('DOMContentLoaded', function () {

    const viewport = document.getElementById('aboutCategoryViewport');
    const track = document.getElementById('aboutCategoryTrack');
    const nextButton = document.getElementById('aboutCategoryNext');

    if (!viewport || !track || !nextButton) {
        return;
    }

    const cards = Array.from(
        track.querySelectorAll('.about-category-card')
    );

    if (cards.length <= 5) {
        nextButton.style.display = 'none';
        return;
    }

    let currentIndex = 0;

    function getVisibleCards() {

        if (window.innerWidth < 640) {
            return 2;
        }

        if (window.innerWidth < 1024) {
            return 3;
        }

        return 5;
    }

    function updateCarousel() {

        const visibleCards = getVisibleCards();

        const maxIndex = Math.max(
            0,
            cards.length - visibleCards
        );

        if (currentIndex > maxIndex) {
            currentIndex = maxIndex;
        }

        const cardWidth = cards[0].getBoundingClientRect().width;

        const gap = parseFloat(
            window.getComputedStyle(track).columnGap ||
            window.getComputedStyle(track).gap ||
            0
        );

        const moveAmount = (cardWidth + gap) * currentIndex;

        track.style.transform =
            `translateX(-${moveAmount}px)`;

    }

    nextButton.addEventListener('click', function () {

        const visibleCards = getVisibleCards();

        const maxIndex = Math.max(
            0,
            cards.length - visibleCards
        );

        if (currentIndex < maxIndex) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }

        updateCarousel();

    });

    window.addEventListener('resize', function () {
        updateCarousel();
    });

    updateCarousel();

});
