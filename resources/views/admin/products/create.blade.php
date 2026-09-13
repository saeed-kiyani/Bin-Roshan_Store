@extends('layouts.admin')

@section('title', 'Add Product | Bin Ismail')

@section('content')

<div class="min-h-screen bg-gray-50 py-12">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10">

            <a
                href="{{ route('admin.products.index') }}"
                class="text-xs uppercase tracking-widest text-gray-500 hover:text-black transition"
            >
                ← Back to Products
            </a>

            <p class="mt-8 text-xs uppercase tracking-[0.35em] text-[#a47c15] font-semibold">
                Admin Panel
            </p>

            <h1 class="mt-3 text-4xl font-light">
                Add Product
            </h1>

        </div>


        {{-- ERRORS --}}

        @if($errors->any())

            <div class="mb-8 bg-red-50 border border-red-200 text-red-800 px-5 py-4">

                <ul class="text-sm space-y-1">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white border border-gray-200 p-6 sm:p-10"
        >

            @csrf


            {{-- CATEGORY --}}

            <div>

                <label
                    for="category_id"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Category
                </label>

                <select
    id="category_id"
    name="category_id"
    required
    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
>
    <option value="">Select Category</option>

    @foreach($categories as $category)

        <option
            value="{{ $category->id }}"
            data-category-slug="{{ $category->slug }}"
            {{ old('category_id') == $category->id ? 'selected' : '' }}
        >
            {{ $category->name }}
        </option>

    @endforeach
</select>

            </div>


            {{-- NAME --}}

            <div class="mt-7">

                <label
                    for="name"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Product Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. Premium Cotton Shirt"
                    required
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

            </div>


            {{-- SLUG --}}

<div class="mt-7">

    <label
        for="slug"
        class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
    >
        Slug
    </label>

    <input
        type="text"
        id="slug"
        name="slug"
        value="{{ old('slug') }}"
        placeholder="Automatically generated from product name"
        class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
    >

    <p class="mt-2 text-xs text-gray-400">
        The slug is automatically generated from the product name.
        You can edit it manually if needed.
    </p>

</div>


            {{-- SKU --}}

            <div class="mt-7">

                <label
                    for="sku"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    SKU
                </label>

                <input
                    type="text"
                    id="sku"
                    name="sku"
                    value="{{ old('sku') }}"
                    placeholder="e.g. BIS-SHIRT-001"
                    required
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

            </div>

{{-- =========================================================
     CLOTHING INFORMATION
========================================================= --}}
<div
    id="clothing-filter"
    data-filter-section="clothing"
    class="mt-7 border-t border-gray-200 pt-7">

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Clothing Filtration
    </p>


    {{-- GENDER --}}

    <div>

        <label
            for="gender"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Gender
        </label>

        <select
            id="gender"
            name="gender"
            class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
        >

            <option value="">
                Select Gender
            </option>

            <option value="men" {{ old('gender') === 'men' ? 'selected' : '' }}>
                Men
            </option>

            <option value="women" {{ old('gender') === 'women' ? 'selected' : '' }}>
                Women
            </option>

            <option value="kids" {{ old('gender') === 'kids' ? 'selected' : '' }}>
                Kids
            </option>

        </select>

    </div>


    {{-- BRAND --}}

    <div class="mt-7">

        <label
            for="brand"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Brand
        </label>

        <select
            id="brand"
            name="brand"
            class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
        >

            <option value="">
                Select Brand
            </option>

            <option value="Bin Ismail" {{ old('brand') === 'Bin Ismail' ? 'selected' : '' }}>
                Bin Ismail
            </option>

            <option value="J." {{ old('brand') === 'J.' ? 'selected' : '' }}>
                J.
            </option>

            <option value="Gul Ahmed" {{ old('brand') === 'Gul Ahmed' ? 'selected' : '' }}>
                Gul Ahmed
            </option>

            <option value="Khaadi" {{ old('brand') === 'Khaadi' ? 'selected' : '' }}>
                Khaadi
            </option>

            <option value="Other" {{ old('brand') === 'Other' ? 'selected' : '' }}>
                Other
            </option>

        </select>

    </div>


    {{-- SIZE --}}

    <div class="mt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Available Sizes
        </label>

        <div class="mt-4 flex flex-wrap gap-6">

            @foreach(['S', 'M', 'L'] as $size)

                <label class="flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        name="sizes[]"
                        value="{{ $size }}"
                        {{ in_array($size, old('sizes', [])) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        {{ $size }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>

</div>
{{-- END CLOTHING INFORMATION --}}

{{-- =========================================================
     LACE INFORMATION
========================================================= --}}
<div
    id="lace-filter"
    data-filter-section="laces"
    class="mt-7 border-t border-gray-200 pt-7"
>

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Laces Filtration
    </p>


    {{-- LACE CATEGORY --}}
    <div>

        <label
            for="lace_category"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Lace Category
        </label>

        <select
            name="lace_category"
            id="lace_category"
            class="mt-3 w-full border border-gray-300 px-4 py-3 bg-white text-sm text-gray-700 focus:outline-none focus:border-black"
        >

            <option value="">
                Select Lace Category
            </option>

            <option
                value="basic_everyday"
                {{ old('lace_category') === 'basic_everyday' ? 'selected' : '' }}
            >
                Basic & Everyday Laces
            </option>

            <option
                value="embroidered"
                {{ old('lace_category') === 'embroidered' ? 'selected' : '' }}
            >
                Embroidered Laces
            </option>

            <option
                value="fancy"
                {{ old('lace_category') === 'fancy' ? 'selected' : '' }}
            >
                Fancy Laces
            </option>

            <option
                value="traditional"
                {{ old('lace_category') === 'traditional' ? 'selected' : '' }}
            >
                Traditional Laces
            </option>

            <option
                value="suit_specific"
                {{ old('lace_category') === 'suit_specific' ? 'selected' : '' }}
            >
                Suit Specific Laces
            </option>

            <option
                value="premium_bridal"
                {{ old('lace_category') === 'premium_bridal' ? 'selected' : '' }}
            >
                Premium & Bridal Laces
            </option>

        </select>

    </div>


    {{-- LACE SUBCATEGORIES --}}
    <div
        id="lace-subcategories-container"
        class="mt-6 hidden"
    >

        <p class="text-xs text-gray-400 mb-4">
            Select all subcategories that apply to this lace.
        </p>

        <div
            id="lace-subcategories"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3"
        >
        </div>

    </div>


    {{-- WIDTH --}}
    <div class="mt-7">

        <label
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Width
        </label>

        <div class="mt-4 flex flex-wrap gap-6">

            @foreach([
                '1 inch',
                '2 inch',
                '3 inch',
                '4 inch',
                '5 inch',
                '6 inch'
            ] as $width)

                <label class="flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        name="width[]"
                        value="{{ $width }}"
                        {{ in_array($width, old('width', [])) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        {{ $width }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>


    {{-- HEIGHT --}}
    <div class="mt-7">

        <label
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Height
        </label>

        <div class="mt-4 flex flex-wrap gap-6">

            @foreach([
                '1 inch',
                '2 inch',
                '3 inch',
                '4 inch',
                '5 inch',
                '6 inch'
            ] as $height)

                <label class="flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        name="height[]"
                        value="{{ $height }}"
                        {{ in_array($height, old('height', [])) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        {{ $height }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>


    {{-- LENGTH --}}
    <div class="mt-7">

        <label
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Length
        </label>

        <div class="mt-4 flex flex-wrap gap-6">

            @foreach([
                '1 meter',
                '2 meters',
                '3 meters',
                '5 meters',
                '10 meters',
                '20 meters'
            ] as $length)

                <label class="flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        name="length[]"
                        value="{{ $length }}"
                        {{ in_array($length, old('length', [])) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        {{ $length }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>

</div>
{{-- END LACE INFORMATION --}}

{{-- =========================================================
     JEWELRY INFORMATION
========================================================= --}}
<div
    id="jewelry-filter"
    data-filter-section="jewelry"
    class="hidden mt-7 border-t border-gray-200 pt-7"
>
    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Jewelry Information
    </p>

    <p class="text-sm text-gray-500">
        Jewelry filters will be added here.
    </p>
</div>

{{-- =========================================================
     COSMETICS INFORMATION
========================================================= --}}
<div
    id="cosmetics-filter"
    data-filter-section="cosmetics"
    class="hidden mt-7 border-t border-gray-200 pt-7"
>
    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Cosmetics Information
    </p>

    <p class="text-sm text-gray-500">
        Cosmetics filters will be added here.
    </p>
</div>

{{-- =========================================================
     WATCHES INFORMATION
========================================================= --}}
<div
    id="watches-filter"
    data-filter-section="watches"
    class="hidden mt-7 border-t border-gray-200 pt-7"
>
    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Watches Information
    </p>

    <p class="text-sm text-gray-500">
        Watch filters will be added here.
    </p>
</div>

{{-- =========================================================
     TAILOR ACCESSORIES INFORMATION
========================================================= --}}
<div
    id="tailor-accessories-filter"
    data-filter-section="tailor_accessories"
    class="hidden mt-7 border-t border-gray-200 pt-7"
>
    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Tailor Accessories Information
    </p>

    <p class="text-sm text-gray-500">
        Tailor accessories filters will be added here.
    </p>
</div>

            {{-- DESCRIPTION --}}

            <div class="mt-7">

                <label
                    for="description"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    placeholder="Describe this product..."
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >{{ old('description') }}</textarea>

            </div>


            {{-- PRICES --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-7">

                <div>

                    <label
                        for="price"
                        class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                    >
                        Regular Price
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        min="0"
                        step="0.01"
                        required
                        placeholder="0.00"
                        class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                    >

                </div>


                <div>

                    <label
                        for="sale_price"
                        class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                    >
                        Sale Price
                    </label>

                    <input
                        type="number"
                        id="sale_price"
                        name="sale_price"
                        value="{{ old('sale_price') }}"
                        min="0"
                        step="0.01"
                        placeholder="Optional"
                        class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                    >

                </div>

            </div>


            {{-- STOCK --}}

            <div class="mt-7">

                <label
                    for="stock"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Stock
                </label>

                <input
                    type="number"
                    id="stock"
                    name="stock"
                    value="{{ old('stock', 0) }}"
                    min="0"
                    required
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

            </div>


            {{-- IMAGES --}}

            <div class="mt-7">

                <label
                    for="images"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Product Images
                </label>

                <input
                    type="file"
                    id="images"
                    name="images[]"
                    accept=".jpg,.jpeg,.png,.webp"
                    multiple
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white"
                >

                <p class="mt-2 text-xs text-gray-400">
                    You can select multiple images. The first image will become the primary image.
                    JPG, JPEG, PNG or WEBP. Maximum 4MB each.
                </p>

            </div>


            {{-- OPTIONS --}}

            <div class="mt-7 space-y-4">

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        {{ old('is_featured') ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        Featured product
                    </span>

                </label>


                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        Active product
                    </span>

                </label>

            </div>


            {{-- BUTTONS --}}

            <div class="mt-10 flex flex-col sm:flex-row gap-3">

                <button
                    type="submit"
                    class="bg-black text-white px-7 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#a47c15] transition"
                >
                    Create Product
                </button>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="border border-gray-300 px-7 py-4 text-xs uppercase tracking-widest font-semibold text-center hover:bg-gray-100 transition"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const categorySelect = document.getElementById('category_id');

    if (!categorySelect) {
        return;
    }

    const filterSections = document.querySelectorAll(
        '[data-filter-section]'
    );


    /*
    |--------------------------------------------------------------------------
    | CATEGORY → FILTER TYPE
    |--------------------------------------------------------------------------
    */

    function getFilterType(slug) {

        slug = (slug || '').toLowerCase().trim();

        /*
        |--------------------------------------------------------------------------
        | CLOTHING
        |--------------------------------------------------------------------------
        */

        if (
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


        /*
        |--------------------------------------------------------------------------
        | LACES
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'laces' ||
            slug === 'lace' ||
            slug === 'ladies-laces' ||
            slug === 'ladies-suit-laces' ||
            slug.includes('lace')
        ) {
            return 'laces';
        }


        /*
        |--------------------------------------------------------------------------
        | JEWELRY
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'jewelry' ||
            slug === 'jewellery'
        ) {
            return 'jewelry';
        }


        /*
        |--------------------------------------------------------------------------
        | COSMETICS
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'cosmetics' ||
            slug === 'cosmetic'
        ) {
            return 'cosmetics';
        }


        /*
        |--------------------------------------------------------------------------
        | WATCHES
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'watches' ||
            slug === 'watch'
        ) {
            return 'watches';
        }


        /*
        |--------------------------------------------------------------------------
        | TAILOR ACCESSORIES
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'tailor-accessories' ||
            slug === 'tailor-accessory' ||
            slug === 'tailoring-accessories'
        ) {
            return 'tailor_accessories';
        }


        /*
        |--------------------------------------------------------------------------
        | DEFAULT
        |--------------------------------------------------------------------------
        */

        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | ENABLE / DISABLE SECTION INPUTS
    |--------------------------------------------------------------------------
    */

    function setSectionEnabled(section, enabled) {

        const fields = section.querySelectorAll(
            'input, select, textarea'
        );

        fields.forEach(function (field) {

            field.disabled = !enabled;

        });
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW / HIDE FILTER SECTION
    |--------------------------------------------------------------------------
    */

    function updateFilterSections() {

        const selectedOption =
            categorySelect.options[
                categorySelect.selectedIndex
            ];

        const slug =
            selectedOption
                ? selectedOption.dataset.categorySlug
                : '';

        const filterType = getFilterType(slug);


        filterSections.forEach(function (section) {

            const sectionType =
                section.dataset.filterSection;

            const shouldShow =
                sectionType === filterType;


            /*
            |--------------------------------------------------------------------------
            | SHOW
            |--------------------------------------------------------------------------
            */

            if (shouldShow) {

                section.classList.remove('hidden');

                setSectionEnabled(section, true);

            }


            /*
            |--------------------------------------------------------------------------
            | HIDE
            |--------------------------------------------------------------------------
            */

            else {

                section.classList.add('hidden');

                setSectionEnabled(section, false);

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CATEGORY CHANGED
    |--------------------------------------------------------------------------
    */

    categorySelect.addEventListener(
        'change',
        updateFilterSections
    );


    /*
    |--------------------------------------------------------------------------
    | INITIAL PAGE LOAD
    |--------------------------------------------------------------------------
    */

    updateFilterSections();

});

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const laceCategory = document.getElementById('lace_category');
    const subcategoryContainer = document.getElementById('lace-subcategories-container');
    const subcategoryWrapper = document.getElementById('lace-subcategories');

    if (!laceCategory || !subcategoryContainer || !subcategoryWrapper) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | LACE SUBCATEGORIES
    |--------------------------------------------------------------------------
    */

    const laceSubcategories = {

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


    /*
    |--------------------------------------------------------------------------
    | OLD VALUES
    |--------------------------------------------------------------------------
    */

    const oldSubcategories = @json(old('lace_subcategories', []));


    /*
    |--------------------------------------------------------------------------
    | UPDATE SUBCATEGORIES
    |--------------------------------------------------------------------------
    */

    function updateLaceSubcategories() {

        const selectedCategory = laceCategory.value;

        subcategoryWrapper.innerHTML = '';


        if (
            !selectedCategory ||
            !laceSubcategories[selectedCategory] ||
            laceSubcategories[selectedCategory].length === 0
        ) {

            subcategoryContainer.classList.add('hidden');

            return;
        }


        subcategoryContainer.classList.remove('hidden');


        laceSubcategories[selectedCategory].forEach(function (subcategory) {

            const label = document.createElement('label');

            label.className =
                'flex items-center gap-2 text-sm text-gray-700 cursor-pointer';


            const checkbox = document.createElement('input');

            checkbox.type = 'checkbox';

            checkbox.name = 'lace_subcategories[]';

            checkbox.value = subcategory;

            checkbox.className = 'w-4 h-4';


            /*
            |--------------------------------------------------------------------------
            | RESTORE OLD VALUE
            |--------------------------------------------------------------------------
            */

            if (oldSubcategories.includes(subcategory)) {
                checkbox.checked = true;
            }


            const text = document.createElement('span');

            text.textContent = subcategory;


            label.appendChild(checkbox);

            label.appendChild(text);

            subcategoryWrapper.appendChild(label);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CATEGORY CHANGE
    |--------------------------------------------------------------------------
    */

    laceCategory.addEventListener(
        'change',
        updateLaceSubcategories
    );


    /*
    |--------------------------------------------------------------------------
    | INITIAL LOAD
    |--------------------------------------------------------------------------
    */

    updateLaceSubcategories();

});
</script>

@endsection