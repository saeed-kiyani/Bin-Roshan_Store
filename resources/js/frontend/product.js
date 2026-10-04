document.addEventListener('DOMContentLoaded', function () {

    const mainImage = document.getElementById('main-product-image');
    const prevButton = document.getElementById('prev-image');
    const nextButton = document.getElementById('next-image');

    const zoomInButton = document.getElementById('zoom-in');
    const zoomOutButton = document.getElementById('zoom-out');
    const zoomResetButton = document.getElementById('zoom-reset');

    const thumbnails = Array.from(
        document.querySelectorAll('.product-thumbnail')
    );

    if (!mainImage) {
        return;
    }

    const images = thumbnails
        .map(function (thumbnail) {
            return thumbnail.dataset.image;
        })
        .filter(function (image) {
            return image;
        });

    const primaryImageUrl = mainImage.getAttribute('src');

    let currentIndex = images.indexOf(primaryImageUrl);

    if (currentIndex === -1) {
        currentIndex = 0;
    }

    let zoomLevel = 1;

    const minZoom = 1;
    const maxZoom = 3;
    const zoomStep = 0.25;

    function updateZoom() {

        mainImage.style.transform = `scale(${zoomLevel})`;

        if (zoomResetButton) {
            zoomResetButton.textContent = `${zoomLevel}×`;
        }

    }

    function updateImage(index) {

        if (!images.length) {
            return;
        }

        currentIndex = index;

        if (currentIndex < 0) {
            currentIndex = images.length - 1;
        }

        if (currentIndex >= images.length) {
            currentIndex = 0;
        }

        mainImage.src = images[currentIndex];

        zoomLevel = 1;
        updateZoom();

        thumbnails.forEach(function (thumbnail, index) {

            if (index === currentIndex) {

                thumbnail.classList.add(
                    'ring-2',
                    'ring-[#BE8B3E]'
                );

            } else {

                thumbnail.classList.remove(
                    'ring-2',
                    'ring-[#BE8B3E]'
                );

            }

        });

    }

    if (prevButton) {

        prevButton.addEventListener('click', function () {
            updateImage(currentIndex - 1);
        });

    }

    if (nextButton) {

        nextButton.addEventListener('click', function () {
            updateImage(currentIndex + 1);
        });

    }

    thumbnails.forEach(function (thumbnail, index) {

        thumbnail.addEventListener('click', function () {
            updateImage(index);
        });

    });

    if (zoomInButton) {

        zoomInButton.addEventListener('click', function () {

            if (zoomLevel < maxZoom) {
                zoomLevel += zoomStep;
                updateZoom();
            }

        });

    }

    if (zoomOutButton) {

        zoomOutButton.addEventListener('click', function () {

            if (zoomLevel > minZoom) {
                zoomLevel -= zoomStep;
                updateZoom();
            }

        });

    }

    if (zoomResetButton) {

        zoomResetButton.addEventListener('click', function () {

            zoomLevel = 1;
            updateZoom();

        });

    }

    document.addEventListener('keydown', function (event) {

        if (event.key === 'ArrowLeft') {
            updateImage(currentIndex - 1);
        }

        if (event.key === 'ArrowRight') {
            updateImage(currentIndex + 1);
        }

    });

    updateImage(currentIndex);

});
