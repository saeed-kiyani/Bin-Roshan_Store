document.addEventListener('DOMContentLoaded', function () {

    const categorySelect = document.getElementById('category_id');
    const configElement = document.getElementById('product-form-config');

    if (!categorySelect || !configElement) {
        return;
    }

    const formMode = configElement.dataset.mode || 'create';

    function parseArray(value) {
        if (!value) {
            return [];
        }

        try {
            const parsed = JSON.parse(value);
            return Array.isArray(parsed) ? parsed : [];
        } catch (error) {
            return [];
        }
    }

    const existingLaceSubcategories = parseArray(
        configElement.dataset.existingLaceSubcategories
    );

    const existingJewelrySubcategories = parseArray(
        configElement.dataset.existingJewelrySubcategories
    );

    const filterSections = document.querySelectorAll(
        '[data-filter-section]'
    );

    /*
    |--------------------------------------------------------------------------
    | CATEGORY → FILTER TYPE
    |--------------------------------------------------------------------------
    */

    function getFilterType(slug) {

        slug = String(slug || '').toLowerCase().trim();

        if (
            slug === 'clothes' ||
            slug === 'clothing' ||
            slug === 'ladies-clothing' ||
            slug === 'mens-clothing' ||
            slug === 'men-clothing' ||
            slug === 'womens-clothing' ||
            slug === 'women-clothing' ||
            slug === 'kids-clothing'
        ) {
            return 'clothing';
        }

        if (
            slug === 'laces' ||
            slug === 'lace' ||
            slug === 'ladies-laces' ||
            slug === 'ladies-suit-laces' ||
            slug.includes('lace')
        ) {
            return 'laces';
        }

        if (
            slug === 'jewelry' ||
            slug === 'jewellery'
        ) {
            return 'jewelry';
        }

        if (
            slug === 'cosmetics' ||
            slug === 'cosmetic'
        ) {
            return 'cosmetics';
        }

        if (
            slug === 'watches' ||
            slug === 'watch'
        ) {
            return 'watches';
        }

        if (
            slug === 'other-accessories' ||
            slug === 'other-accessory' ||
            slug === 'other_accessories' ||
            slug === 'other_accessory' ||
            (formMode === 'create' && slug === 'tailor-accessories') ||
            (formMode === 'create' && slug === 'tailor-accessory') ||
            (formMode === 'create' && slug === 'tailoring-accessories')
        ) {
            return 'other_accessories';
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | ENABLE / DISABLE SECTION INPUTS
    |--------------------------------------------------------------------------
    */

    function setSectionEnabled(section, enabled) {
        section.querySelectorAll('input, select, textarea').forEach(function (field) {
            field.disabled = !enabled;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | LACE SUBCATEGORIES
    |--------------------------------------------------------------------------
    */

    const laceCategorySelect = document.getElementById('lace_category');
    const laceSubcategoryContainer = document.getElementById(
        'lace-subcategories-container'
    );
    const laceSubcategoryWrapper = document.getElementById(
        'lace-subcategories'
    );

    const createLaceSubcategories = {
        basic_everyday: [
            'Cotton Lace',
            'Simple Border Lace',
            'Plain Lace',
            'Daily Wear Lace',
            'Narrow Lace'
        ],
        embroidered: [
            'Floral Embroidered Lace',
            'Heavy Embroidered Lace',
            'Thread Embroidered Lace',
            'Sequin Embroidered Lace',
            'Pearl Embroidered Lace'
        ],
        fancy: [
            'Golden Fancy Lace',
            'Silver Fancy Lace',
            'Stone Lace',
            'Pearl Lace',
            'Zari Lace'
        ],
        traditional: [
            'Gota Lace',
            'Dori Lace',
            'Kiran Lace',
            'Traditional Border Lace',
            'Ethnic Lace'
        ],
        suit_specific: [
            'Neckline Lace',
            'Sleeve Lace',
            'Daman Lace',
            'Dupatta Lace',
            'Trouser Lace'
        ],
        premium_bridal: [
            'Bridal Embroidered Lace',
            'Heavy Zari Lace',
            'Pearl Bridal Lace',
            'Stone Bridal Lace',
            'Luxury Border Lace'
        ]
    };

    const editLaceSubcategories = {
        basic_everyday: {
            cotton: 'Cotton Laces',
            plain: 'Plain Laces',
            printed: 'Printed Laces',
            thread: 'Thread Laces'
        },
        embroidered: {
            embroidery: 'Embroidery Laces',
            organza: 'Organza Laces',
            chiffon: 'Chiffon Laces',
            net: 'Net Laces',
            cutwork: 'Cutwork Laces',
            applique: 'Appliqué Laces'
        },
        fancy: {
            sequin: 'Sequin Laces',
            stone: 'Stone Laces',
            crystal: 'Crystal Laces',
            pearl: 'Pearl Laces',
            moti: 'Moti Laces',
            mirror_work: 'Mirror Work Laces',
            shimmer: 'Shimmer Laces',
            fancy_designer: 'Fancy Designer Laces'
        },
        traditional: {
            gota: 'Gota Laces',
            gota_patti: 'Gota Patti Laces',
            dori: 'Dori Laces',
            zari: 'Zari Laces',
            tilla: 'Tilla Laces',
            resham: 'Resham Laces',
            traditional_border: 'Traditional Border Laces'
        },
        suit_specific: {
            daman: 'Daman Laces',
            neckline: 'Neckline Laces',
            sleeve: 'Sleeve Laces',
            trouser: 'Trouser Laces',
            dupatta: 'Dupatta Laces',
            shirt_border: 'Shirt Border Laces',
            side_border: 'Side Border Laces'
        },
        premium_bridal: {
            bridal: 'Bridal Laces',
            heavy_bridal: 'Heavy Bridal Laces',
            premium_designer: 'Premium Designer Laces'
        }
    };

    function updateLaceSubcategories() {
        if (!laceCategorySelect || !laceSubcategoryContainer || !laceSubcategoryWrapper) {
            return;
        }

        const selectedCategory = laceCategorySelect.value;
        laceSubcategoryWrapper.innerHTML = '';

        const subcategories = formMode === 'edit'
            ? editLaceSubcategories[selectedCategory]
            : createLaceSubcategories[selectedCategory];

        if (!selectedCategory || !subcategories) {
            laceSubcategoryContainer.classList.add('hidden');
            return;
        }

        laceSubcategoryContainer.classList.remove('hidden');

        if (formMode === 'edit') {
            Object.entries(subcategories).forEach(function ([value, labelText]) {
                const label = document.createElement('label');
                label.className = 'flex items-center gap-3 cursor-pointer';

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'lace_subcategories[]';
                checkbox.value = value;
                checkbox.className = 'w-4 h-4';
                checkbox.checked = existingLaceSubcategories.includes(value);

                const text = document.createElement('span');
                text.className = 'text-sm text-gray-600';
                text.textContent = labelText;

                label.appendChild(checkbox);
                label.appendChild(text);
                laceSubcategoryWrapper.appendChild(label);
            });

            return;
        }

        subcategories.forEach(function (subcategory) {
            const label = document.createElement('label');
            label.className = 'flex items-center gap-2 text-sm text-gray-700';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'lace_subcategories[]';
            checkbox.value = subcategory;
            checkbox.className = 'h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E] focus:ring-[#BE8B3E]/30 focus:ring-offset-0';

            const text = document.createElement('span');
            text.textContent = subcategory;

            label.appendChild(checkbox);
            label.appendChild(text);
            laceSubcategoryWrapper.appendChild(label);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | JEWELRY SUBCATEGORIES + SIZING
    |--------------------------------------------------------------------------
    */

    const jewelryType = document.getElementById('jewelry_type');
    const jewelryContainer = document.getElementById('jewelry-subcategories-container');
    const jewelrySubcategories = document.getElementById('jewelry-subcategories');

    const jewelryMap = {
        earrings: [
            ['hoops', 'Hoops'],
            ['studs', 'Studs'],
            ['drop', 'Drop Earrings'],
            ['dangle', 'Dangle Earrings'],
            ['chandelier', 'Chandelier Earrings'],
            ['huggies', 'Huggies'],
            ['jhumka', 'Jhumka']
        ],
        necklaces: [
            ['chokers', 'Chokers'],
            ['pendants', 'Pendant Necklaces'],
            ['chains', 'Chains'],
            ['layered', 'Layered Necklaces'],
            ['statement', 'Statement Necklaces'],
            ['pearl', 'Pearl Necklaces']
        ],
        rings: [
            ['bands', 'Bands'],
            ['solitaire', 'Solitaire Rings'],
            ['cocktail', 'Cocktail Rings'],
            ['stackable', 'Stackable Rings'],
            ['signet', 'Signet Rings'],
            ['adjustable', 'Adjustable Rings']
        ],
        bracelets: [
            ['chain', 'Chain Bracelets'],
            ['cuff', 'Cuff Bracelets'],
            ['bangles', 'Bangles'],
            ['charm', 'Charm Bracelets'],
            ['tennis', 'Tennis Bracelets'],
            ['kada', 'Kada']
        ]
    };

    let selectedJewelrySubcategories = existingJewelrySubcategories.slice();

    function renderJewelrySubcategories() {
        if (!jewelryType || !jewelryContainer || !jewelrySubcategories) {
            return;
        }

        const type = jewelryType.value;
        jewelrySubcategories.innerHTML = '';

        if (!type || !jewelryMap[type]) {
            jewelryContainer.classList.add('hidden');
            return;
        }

        jewelryContainer.classList.remove('hidden');

        jewelryMap[type].forEach(function ([value, labelText]) {
            const wrapper = document.createElement('label');
            wrapper.className = 'flex items-center gap-3 cursor-pointer';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'jewelry_subcategories[]';
            checkbox.value = value;
            checkbox.className = formMode === 'edit'
                ? 'w-4 h-4'
                : 'h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E] focus:ring-[#BE8B3E]/30 focus:ring-offset-0';
            checkbox.checked = selectedJewelrySubcategories.includes(value);

            const text = document.createElement('span');
            text.className = 'text-sm text-gray-700';
            text.textContent = labelText;

            wrapper.appendChild(checkbox);
            wrapper.appendChild(text);
            jewelrySubcategories.appendChild(wrapper);
        });
    }

    function updateJewelrySizing() {
        if (!jewelryType) {
            return;
        }

        document.querySelectorAll('.jewelry-size-group').forEach(function (group) {
            const active = group.dataset.jewelrySize === jewelryType.value;
            group.classList.toggle('hidden', !active);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | MAIN FILTER SECTIONS
    |--------------------------------------------------------------------------
    */

    function updateFilterSections() {
        const selectedOption = categorySelect.options[categorySelect.selectedIndex];

        let slug = '';

        if (selectedOption) {
            slug = selectedOption.getAttribute('data-slug') ||
                selectedOption.getAttribute('data-category-slug') ||
                '';
        }

        slug = String(slug).toLowerCase().trim();

        const filterType = getFilterType(slug);

        if (formMode === 'edit') {
            console.log('EDIT PRODUCT CATEGORY:', {
                categoryId: categorySelect.value,
                categoryName: selectedOption ? selectedOption.textContent.trim() : '',
                slug: slug,
                filterType: filterType
            });
        }

        filterSections.forEach(function (section) {
            const sectionType = String(
                section.getAttribute('data-filter-section') || ''
            ).toLowerCase().trim();

            const shouldShow = sectionType === filterType;

            if (shouldShow) {
                section.classList.remove('hidden');
                setSectionEnabled(section, true);
            } else {
                section.classList.add('hidden');
                setSectionEnabled(section, false);
            }
        });

        if (filterType === 'laces') {
            updateLaceSubcategories();
        } else if (laceSubcategoryContainer) {
            laceSubcategoryContainer.classList.add('hidden');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCT SLUG
    |--------------------------------------------------------------------------
    */

    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function () {
            const slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            slugInput.value = slug;
        });
    }

    categorySelect.addEventListener('change', updateFilterSections);

    if (laceCategorySelect) {
        laceCategorySelect.addEventListener('change', updateLaceSubcategories);
    }

    if (jewelryType) {
        jewelryType.addEventListener('change', function () {
            selectedJewelrySubcategories = [];
            renderJewelrySubcategories();
            updateJewelrySizing();
        });
    }

    updateFilterSections();
    renderJewelrySubcategories();
    updateJewelrySizing();
});