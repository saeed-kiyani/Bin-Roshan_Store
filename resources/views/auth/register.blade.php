// {{-- =================================================
// PRODUCT IMAGE GALLERY SCRIPT
// ================================================== --}}

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

    // =================================================
    // ZOOM
    // =================================================

    let zoomLevel = 1;

    const minZoom = 1;
    const maxZoom = 3;
    const zoomStep = 0.25;

    // =================================================
    // IMAGE POSITION / PAN
    // =================================================

    let positionX = 0;
    let positionY = 0;

    let isDragging = false;

    let dragStartX = 0;
    let dragStartY = 0;


    // =================================================
    // UPDATE IMAGE TRANSFORM
    // =================================================

    function updateImageTransform() {

        mainImage.style.transform =
            `translate(${positionX}px, ${positionY}px) scale(${zoomLevel})`;

        /*
        |--------------------------------------------------------------------------
        | Cursor
        |--------------------------------------------------------------------------
        */

        if (zoomLevel > 1) {

            mainImage.style.cursor =
                isDragging ? 'grabbing' : 'grab';

        } else {

            mainImage.style.cursor = 'default';

        }

    }


    // =================================================
    // RESET IMAGE POSITION
    // =================================================

    function resetImagePosition() {

        positionX = 0;
        positionY = 0;

        updateImageTransform();

    }


    // =================================================
    // UPDATE ZOOM
    // =================================================

    function updateZoom() {

        /*
        |--------------------------------------------------------------------------
        | If zoom returns to 1x, reset position
        |--------------------------------------------------------------------------
        */

        if (zoomLevel === 1) {
            resetImagePosition();
        } else {
            updateImageTransform();
        }

        if (zoomResetButton) {

            zoomResetButton.textContent =
                `${zoomLevel}×`;

        }

    }


    // =================================================
    // UPDATE IMAGE
    // =================================================

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

        /*
        |--------------------------------------------------------------------------
        | Reset zoom
        |--------------------------------------------------------------------------
        */

        zoomLevel = 1;

        resetImagePosition();

        if (zoomResetButton) {

            zoomResetButton.textContent = '1×';

        }


        // =================================================
        // ACTIVE THUMBNAIL
        // =================================================

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


    // =================================================
    // PREVIOUS IMAGE
    // =================================================

    if (prevButton) {

        prevButton.addEventListener('click', function () {

            updateImage(currentIndex - 1);

        });

    }


    // =================================================
    // NEXT IMAGE
    // =================================================

    if (nextButton) {

        nextButton.addEventListener('click', function () {

            updateImage(currentIndex + 1);

        });

    }


    // =================================================
    // THUMBNAILS
    // =================================================

    thumbnails.forEach(function (thumbnail, index) {

        thumbnail.addEventListener('click', function () {

            updateImage(index);

        });

    });


    // =================================================
    // ZOOM IN
    // =================================================

    if (zoomInButton) {

        zoomInButton.addEventListener('click', function () {

            if (zoomLevel < maxZoom) {

                zoomLevel = Math.min(
                    zoomLevel + zoomStep,
                    maxZoom
                );

                updateZoom();

            }

        });

    }


    // =================================================
    // ZOOM OUT
    // =================================================

    if (zoomOutButton) {

        zoomOutButton.addEventListener('click', function () {

            if (zoomLevel > minZoom) {

                zoomLevel = Math.max(
                    zoomLevel - zoomStep,
                    minZoom
                );

                updateZoom();

            }

        });

    }


    // =================================================
    // RESET ZOOM
    // =================================================

    if (zoomResetButton) {

        zoomResetButton.addEventListener('click', function () {

            zoomLevel = 1;

            resetImagePosition();

            if (zoomResetButton) {
                zoomResetButton.textContent = '1×';
            }

        });

    }


    // =================================================
    // MOUSE DRAG / PAN
    // =================================================

    mainImage.addEventListener('mousedown', function (event) {

        /*
        |--------------------------------------------------------------------------
        | Only allow dragging when zoomed
        |--------------------------------------------------------------------------
        */

        if (zoomLevel <= 1) {
            return;
        }

        event.preventDefault();

        isDragging = true;

        dragStartX =
            event.clientX - positionX;

        dragStartY =
            event.clientY - positionY;

        mainImage.style.cursor = 'grabbing';

    });


    document.addEventListener('mousemove', function (event) {

        if (!isDragging) {
            return;
        }

        positionX =
            event.clientX - dragStartX;

        positionY =
            event.clientY - dragStartY;

        updateImageTransform();

    });


    document.addEventListener('mouseup', function () {

        if (!isDragging) {
            return;
        }

        isDragging = false;

        updateImageTransform();

    });


    // =================================================
    // MOBILE TOUCH DRAG / PAN
    // =================================================

    mainImage.addEventListener(
        'touchstart',
        function (event) {

            if (zoomLevel <= 1) {
                return;
            }

            const touch = event.touches[0];

            isDragging = true;

            dragStartX =
                touch.clientX - positionX;

            dragStartY =
                touch.clientY - positionY;

        },
        {
            passive: true
        }
    );


    mainImage.addEventListener(
        'touchmove',
        function (event) {

            if (!isDragging || zoomLevel <= 1) {
                return;
            }

            const touch = event.touches[0];

            positionX =
                touch.clientX - dragStartX;

            positionY =
                touch.clientY - dragStartY;

            updateImageTransform();

        },
        {
            passive: true
        }
    );


    mainImage.addEventListener(
        'touchend',
        function () {

            isDragging = false;

            updateImageTransform();

        }
    );


    // =================================================
    // KEYBOARD NAVIGATION
    // =================================================

    document.addEventListener('keydown', function (event) {

        if (event.key === 'ArrowLeft') {

            updateImage(currentIndex - 1);

        }

        if (event.key === 'ArrowRight') {

            updateImage(currentIndex + 1);

        }

    });


    // =================================================
    // INITIAL IMAGE
    // =================================================

    updateImage(currentIndex);

});