
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('jewelry_type');
    const container = document.getElementById('shop-jewelry-subcategories');
    const list = document.getElementById('shop-jewelry-subcategory-list');

    if (!typeSelect || !container || !list) return;

    const map = {
        earrings: {
            hoops: 'Hoops',
            studs: 'Studs',
            drop: 'Drop Earrings',
            dangle: 'Dangle Earrings',
            chandelier: 'Chandelier Earrings',
            huggies: 'Huggies',
            jhumka: 'Jhumka'
        },

        necklaces: {
            chokers: 'Chokers',
            pendants: 'Pendant Necklaces',
            chains: 'Chains',
            layered: 'Layered Necklaces',
            statement: 'Statement Necklaces',
            pearl: 'Pearl Necklaces'
        },

        rings: {
            bands: 'Bands',
            solitaire: 'Solitaire Rings',
            cocktail: 'Cocktail Rings',
            stackable: 'Stackable Rings',
            signet: 'Signet Rings',
            adjustable: 'Adjustable Rings'
        },

        bracelets: {
            chain: 'Chain Bracelets',
            cuff: 'Cuff Bracelets',
            bangles: 'Bangles',
            charm: 'Charm Bracelets',
            tennis: 'Tennis Bracelets',
            kada: 'Kada'
        }
    };

    const selectedData = container.dataset.selectedSubcategories || '[]';
    let selected = [];

    try {
        selected = JSON.parse(selectedData);
    } catch (error) {
        selected = [];
    }

    function renderJewelrySubcategories() {
        const type = typeSelect.value;

        list.innerHTML = '';

        if (!type || !map[type]) {
            container.classList.add('hidden');
            return;
        }

        container.classList.remove('hidden');

        Object.entries(map[type]).forEach(function ([value, label]) {

            const wrapper = document.createElement('label');

            wrapper.className =
                'flex items-start gap-3 cursor-pointer';

            wrapper.innerHTML = `
                <input
                    type="checkbox"
                    name="jewelry_subcategories[]"
                    value="${value}"
                    class="w-4 h-4 shrink-0"
                    ${selected.includes(value) ? 'checked' : ''}>

                <span class="text-sm text-gray-700 min-w-0 break-words">
                    ${label}
                </span>
            `;

            list.appendChild(wrapper);

        });
    }

    function updateJewelrySizes() {

        document
            .querySelectorAll('[data-shop-jewelry-size]')
            .forEach(function (group) {

                group.classList.toggle(
                    'hidden',
                    group.dataset.shopJewelrySize !== typeSelect.value
                );

            });
    }

    typeSelect.addEventListener('change', function () {

        selected.length = 0;

        renderJewelrySubcategories();
        updateJewelrySizes();

    });

    renderJewelrySubcategories();
    updateJewelrySizes();

});




document.addEventListener('DOMContentLoaded', function () {

    const filterForm = document.querySelector(
        'aside form'
    );

    const laceCategory =
        document.getElementById('lace_category');

    const laceGroups =
        document.querySelectorAll(
            '.lace-subcategory-group'
        );


    if (!laceCategory) {
        return;
    }


    function updateLaceSubcategories() {

        const selected = laceCategory.value;


        /*
        |--------------------------------------------------------------------------
        | HIDE ALL GROUPS
        |--------------------------------------------------------------------------
        */

        laceGroups.forEach(function (group) {

            group.classList.add('hidden');

        });


        /*
        |--------------------------------------------------------------------------
        | SHOW SELECTED GROUP
        |--------------------------------------------------------------------------
        */

        if (selected) {

            const activeGroup = document.querySelector(
                '[data-lace-group="' + selected + '"]'
            );

            if (activeGroup) {

                activeGroup.classList.remove('hidden');

            }

        }

    }


    laceCategory.addEventListener('change', function () {

        laceGroups.forEach(function (group) {

            group
                .querySelectorAll('input[type="checkbox"]')
                .forEach(function (checkbox) {

                    checkbox.checked = false;

                });

        });

        updateLaceSubcategories();

        if (
            filterForm &&
            typeof window.submitShopFiltersAjax === 'function'
        ) {

            window.submitShopFiltersAjax(filterForm);

        }

    });


    /*
    |--------------------------------------------------------------------------
    | INITIAL LOAD
    |--------------------------------------------------------------------------
    */

    updateLaceSubcategories();

});


/*
|--------------------------------------------------------------------------
| AJAX FILTERING + PRICE SLIDER + PRIORITY FILTERS
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {

    const filterForm = document.querySelector(
        'aside form'
    );

    const sortForm = document.querySelector(
        'form select[name="sort"]'
    )?.closest('form');

    const productsContent =
        document.getElementById('shop-products-content');

    const productsCount =
        document.getElementById('shop-products-count');


    if (!filterForm || !productsContent) {
        return;
    }


    let activeController = null;
    let requestSequence = 0;
    let selectedPriorityCategory = null;
    let selectedHighlight = null;


    function getProductGrid() {

        return productsContent.querySelector('.grid');

    }


    function getProductCards() {

        const grid = getProductGrid();

        return grid
            ? Array.from(
                grid.querySelectorAll('.product-card')
            )
            : [];

    }


    function rememberOriginalOrder() {

        getProductCards().forEach(function (card, index) {

            if (
                typeof card.dataset.originalIndex ===
                'undefined'
            ) {

                card.dataset.originalIndex =
                    String(index);

            }

        });

    }


    function applyClientSideFilters() {

        const grid = getProductGrid();

        if (!grid) {

            if (productsCount) {
                productsCount.textContent = '0';
            }

            return;
        }


        rememberOriginalOrder();


        const cards = getProductCards();

        const slider =
            document.getElementById('price-slider');

        const maxPrice =
            slider
                ? Number(slider.value)
                : Infinity;


        cards.forEach(function (card) {

            const price =
                Number(card.dataset.price || 0);

            const withinPrice =
                !Number.isFinite(maxPrice) ||
                price <= maxPrice;

            card.style.display =
                withinPrice
                    ? ''
                    : 'none';

        });


        cards.sort(function (a, b) {

            const aCategory =
                selectedPriorityCategory &&
                a.dataset.categorySlug ===
                selectedPriorityCategory
                    ? 1
                    : 0;

            const bCategory =
                selectedPriorityCategory &&
                b.dataset.categorySlug ===
                selectedPriorityCategory
                    ? 1
                    : 0;


            if (aCategory !== bCategory) {

                return bCategory - aCategory;

            }


            const aHighlight =
                selectedHighlight === 'featured'
                    ? a.dataset.featured === '1'
                    : selectedHighlight === 'sale'
                        ? a.dataset.sale === '1'
                        : false;

            const bHighlight =
                selectedHighlight === 'featured'
                    ? b.dataset.featured === '1'
                    : selectedHighlight === 'sale'
                        ? b.dataset.sale === '1'
                        : false;


            if (aHighlight !== bHighlight) {

                return Number(bHighlight) -
                    Number(aHighlight);

            }


            return Number(a.dataset.originalIndex) -
                Number(b.dataset.originalIndex);

        });


        cards.forEach(function (card) {

            grid.appendChild(card);

        });


        if (productsCount) {

            const visibleCount =
                cards.filter(function (card) {

                    return card.style.display !== 'none';

                }).length;

            productsCount.textContent =
                String(visibleCount);

        }

    }


    function setLoading(isLoading) {

        productsContent.setAttribute(
            'aria-busy',
            isLoading ? 'true' : 'false'
        );

        productsContent.classList.toggle(
            'opacity-50',
            isLoading
        );

        productsContent.classList.toggle(
            'pointer-events-none',
            isLoading
        );

    }


    function buildQueryString(form) {

        const formData =
            new FormData(form);

        const params =
            new URLSearchParams();


        for (const [key, value] of formData.entries()) {

            if (value !== '') {

                params.append(key, value);

            }

        }

        return params.toString();

    }


    async function submitShopFiltersAjax(
        form,
        options = {}
    ) {

        if (!form) {
            return;
        }


        const queryString =
            buildQueryString(form);

        const shopUrl = form.getAttribute('action') || window.location.pathname;

        const targetUrl =
            queryString
                ? shopUrl + '?' + queryString
                : shopUrl;


        if (activeController) {

            activeController.abort();

        }


        activeController =
            new AbortController();

        const currentSequence =
            ++requestSequence;


        setLoading(true);


        try {

            const response =
                await fetch(targetUrl, {

                    method: 'GET',

                    headers: {
                        'X-Requested-With':
                            'XMLHttpRequest',

                        'Accept':
                            'application/json',
                    },

                    signal:
                        activeController.signal,

                    credentials:
                        'same-origin',

                });


            if (!response.ok) {

                throw new Error(
                    'Filter request failed with status ' +
                    response.status
                );

            }


            const data =
                await response.json();


            if (
                currentSequence !==
                requestSequence
            ) {

                return;

            }


            const parsed =
                new DOMParser()
                    .parseFromString(
                        data.html,
                        'text/html'
                    );


            const nextProducts =
                parsed.getElementById(
                    'shop-products-content'
                );


            if (!nextProducts) {

                throw new Error(
                    'Product section was not found in the server response.'
                );

            }


            productsContent.innerHTML =
                nextProducts.innerHTML;


            applyClientSideFilters();


            if (!options.skipUrlUpdate) {

                window.history.pushState(
                    {
                        shopFilters: true
                    },
                    '',
                    targetUrl
                );

            }


            setLoading(false);

            return data;


        } catch (error) {

            if (
                error.name ===
                'AbortError'
            ) {

                return;

            }


            console.error(
                'Bin Ismail shop filter error:',
                error
            );

            setLoading(false);

        }

    }


    window.submitShopFiltersAjax =
        submitShopFiltersAjax;


    /*
    |--------------------------------------------------------------------------
    | CATEGORY PRIORITY FILTER
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '.shop-category-filter'
        )
        .forEach(function (checkbox) {

            checkbox.addEventListener(
                'change',
                function () {

                    if (checkbox.checked) {

                        document
                            .querySelectorAll(
                                '.shop-category-filter'
                            )
                            .forEach(
                                function (other) {

                                    if (
                                        other !==
                                        checkbox
                                    ) {

                                        other.checked =
                                            false;

                                    }

                                }
                            );

                        selectedPriorityCategory =
                            checkbox.dataset.categorySlug ||
                            null;

                    } else {

                        selectedPriorityCategory =
                            null;

                    }


                    applyClientSideFilters();

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | FEATURED / SALE PRIORITY FILTER
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '.shop-highlight-filter'
        )
        .forEach(function (radio) {

            radio.addEventListener(
                'change',
                function () {

                    selectedHighlight =
                        radio.checked
                            ? radio.value
                            : null;

                    applyClientSideFilters();

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | CHECKBOXES / DYNAMIC CHECKBOXES
    |--------------------------------------------------------------------------
    */

    filterForm.addEventListener(
        'change',
        function (event) {

            const target =
                event.target;


            if (
                !(target instanceof HTMLInputElement) &&
                !(target instanceof HTMLSelectElement)
            ) {

                return;

            }


            if (
                target.classList.contains(
                    'shop-category-filter'
                ) ||
                target.classList.contains(
                    'shop-highlight-filter'
                )
            ) {

                return;

            }


            if (
                target.id ===
                'lace_category'
            ) {

                return;

            }


            submitShopFiltersAjax(
                filterForm
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | FILTER FORM SUBMIT
    |--------------------------------------------------------------------------
    */

    filterForm.addEventListener(
        'submit',
        function (event) {

            event.preventDefault();

            submitShopFiltersAjax(
                filterForm
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | SORT WITHOUT RELOAD
    |--------------------------------------------------------------------------
    */

    if (sortForm) {

        sortForm.addEventListener(
            'submit',
            function (event) {

                event.preventDefault();

                submitShopFiltersAjax(
                    sortForm
                );

            }
        );


        const sortSelect =
            sortForm.querySelector(
                'select[name="sort"]'
            );


        if (sortSelect) {

            sortSelect.addEventListener(
                'change',
                function () {

                    submitShopFiltersAjax(
                        sortForm
                    );

                }
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | CLEAR FILTERS WITHOUT RELOAD
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {

            const clearLink =
                event.target.closest(
                    '.js-ajax-clear-filters'
                );


            if (!clearLink) {

                return;

            }


            event.preventDefault();


            const clearUrl =
                clearLink.getAttribute('href') ||
                window.location.pathname;


            filterForm.reset();


            selectedPriorityCategory =
                null;

            selectedHighlight =
                null;


            const priceSlider =
                document.getElementById(
                    'price-slider'
                );

            const maxInput =
                document.getElementById(
                    'max-price-input'
                );


            if (priceSlider) {

                priceSlider.value =
                    priceSlider.max;

            }


            if (
                maxInput &&
                priceSlider
            ) {

                maxInput.value =
                    priceSlider.max;

            }


            updatePriceSliderIfAvailable();


            const clearForm =
                document.createElement(
                    'form'
                );


            clearForm.method =
                'GET';

            clearForm.action =
                clearUrl;


            const url =
                new URL(
                    clearUrl,
                    window.location.origin
                );


            url.searchParams.forEach(
                function (value, key) {

                    const input =
                        document.createElement(
                            'input'
                        );

                    input.type =
                        'hidden';

                    input.name =
                        key;

                    input.value =
                        value;

                    clearForm.appendChild(
                        input
                    );

                }
            );


            document.body.appendChild(
                clearForm
            );


            submitShopFiltersAjax(
                clearForm
            );


            clearForm.remove();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | PRICE SLIDER
    |--------------------------------------------------------------------------
    */

    const priceSlider =
        document.getElementById(
            'price-slider'
        );

    const maxInput =
        document.getElementById(
            'max-price-input'
        );

    const rangeLabel =
        document.getElementById(
            'price-range-label'
        );

    const activeTrack =
        document.getElementById(
            'price-active-track'
        );


    if (
        priceSlider &&
        maxInput
    ) {

        function updatePriceSlider() {

            const min =
                Number(
                    priceSlider.min
                );

            const max =
                Number(
                    priceSlider.max
                );

            const value =
                Number(
                    priceSlider.value
                );


            maxInput.value =
                value;


            if (rangeLabel) {

                rangeLabel.textContent =
                    'Up to PKR ' +
                    value.toLocaleString();

            }


            if (
                activeTrack &&
                max > min
            ) {

                activeTrack.style.width =
                    (
                        (
                            (value - min) /
                            (max - min)
                        ) *
                        100
                    ) +
                    '%';

            }


            applyClientSideFilters();

        }


        priceSlider.addEventListener(
            'input',
            updatePriceSlider
        );

        priceSlider.addEventListener(
            'change',
            updatePriceSlider
        );

    }


    function updatePriceSliderIfAvailable() {

        const slider =
            document.getElementById(
                'price-slider'
            );

        const input =
            document.getElementById(
                'max-price-input'
            );

        const label =
            document.getElementById(
                'price-range-label'
            );

        const track =
            document.getElementById(
                'price-active-track'
            );


        if (
            !slider ||
            !input
        ) {

            return;

        }


        const min =
            Number(slider.min);

        const max =
            Number(slider.max);

        const value =
            Number(slider.value);


        input.value =
            value;


        if (label) {

            label.textContent =
                'Up to PKR ' +
                value.toLocaleString();

        }


        if (
            track &&
            max > min
        ) {

            track.style.width =
                (
                    (
                        (value - min) /
                        (max - min)
                    ) *
                    100
                ) +
                '%';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | BACK / FORWARD BUTTONS
    |--------------------------------------------------------------------------
    */

    window.addEventListener(
        'popstate',
        function () {

            const url =
                new URL(
                    window.location.href
                );

            const params =
                url.searchParams;


            filterForm
                .querySelectorAll(
                    '[data-ajax-generated-state="true"]'
                )
                .forEach(function (input) {

                    input.remove();

                });


            filterForm
                .querySelectorAll(
                    'input[type="checkbox"]'
                )
                .forEach(function (checkbox) {

                    const key =
                        checkbox.name.replace(
                            /\[\]$/,
                            ''
                        );

                    checkbox.checked =
                        params
                            .getAll(key)
                            .includes(
                                checkbox.value
                            );

                });


            filterForm
                .querySelectorAll(
                    'select'
                )
                .forEach(function (select) {

                    const value =
                        params.get(
                            select.name
                        );

                    if (
                        value !== null
                    ) {

                        select.value =
                            value;

                    }

                });


            filterForm
                .querySelectorAll(
                    'input[type="radio"]'
                )
                .forEach(function (radio) {

                    const value =
                        params.get(
                            radio.name
                        );

                    radio.checked =
                        value !== null &&
                        value ===
                            radio.value;

                });


            if (
                priceSlider &&
                params.get(
                    'max_price'
                ) !== null
            ) {

                priceSlider.value =
                    params.get(
                        'max_price'
                    );

                updatePriceSliderIfAvailable();

            }


            submitShopFiltersAjax(
                filterForm,
                {
                    skipUrlUpdate: true
                }
            );

        }
    );


    updatePriceSliderIfAvailable();

    rememberOriginalOrder();

    applyClientSideFilters();

});




function orderOnWhatsApp(productName) {

    const productsContent = document.getElementById('shop-products-content');
    const phone = productsContent?.dataset.whatsapp || '';

    if (!phone) {
        return;
    }


    const message =
        "Hello Bin Ismail! I am interested in: " +
        productName +
        ". Please share more details and availability.";


    const url =
        "https://wa.me/" +
        phone +
        "?text=" +
        encodeURIComponent(message);


    window.open(
        url,
        '_blank'
    );

}

