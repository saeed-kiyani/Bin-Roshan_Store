@extends('layouts.app')

@section('title', 'Shop | Bin Ismail')

@section(
    'description',
    'Explore clothing, jewelry, laces, watches and accessories at Bin Ismail.'
)

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | CURRENT FILTER VALUES
    |--------------------------------------------------------------------------
    */

    $selectedGenders = request()->input('gender', []);
    $selectedBrands = request()->input('brand', []);
    $selectedSizes = request()->input('sizes', []);

    $selectedCosmeticProductType = request()->input('cosmetic_product_type', '');
    $selectedSkinTypes = request()->input('skin_types', []);
    $selectedConcerns = request()->input('concerns', []);
    $selectedProductForms = request()->input('product_forms', []);

    $selectedLaceSubcategories = request()->input(
        'lace_subcategories',
        []
    );

    $selectedWidths = request()->input('width', []);
    $selectedHeights = request()->input('height', []);
    $selectedLengths = request()->input('length', []);

    if (!is_array($selectedGenders)) {
        $selectedGenders = [$selectedGenders];
    }

    if (!is_array($selectedBrands)) {
        $selectedBrands = [$selectedBrands];
    }

    if (!is_array($selectedSizes)) {
        $selectedSizes = [$selectedSizes];
    }

    if (!is_array($selectedSkinTypes)) {
        $selectedSkinTypes = [$selectedSkinTypes];
    }

    if (!is_array($selectedConcerns)) {
        $selectedConcerns = [$selectedConcerns];
    }

    if (!is_array($selectedProductForms)) {
        $selectedProductForms = [$selectedProductForms];
    }

    if (!is_array($selectedLaceSubcategories)) {
        $selectedLaceSubcategories = [$selectedLaceSubcategories];
    }

    if (!is_array($selectedWidths)) {
        $selectedWidths = [$selectedWidths];
    }

    if (!is_array($selectedHeights)) {
        $selectedHeights = [$selectedHeights];
    }

    if (!is_array($selectedLengths)) {
        $selectedLengths = [$selectedLengths];
    }
@endphp


{{-- =========================================================
     SHOP HERO
========================================================= --}}

<section class="relative h-[55vh] min-h-[500px] w-full overflow-hidden text-white">

    {{-- VIDEO --}}
    <video
        class="absolute inset-0 w-full h-full object-cover"
        autoplay
        muted
        loop
        playsinline
        preload="auto"
    >
        <source
            src="{{ asset('videos/shop.mp4') }}"
            type="video/mp4"
        >
    </video>

    {{-- OVERLAY --}}
    <div class="absolute inset-0 bg-black/40"></div>

    {{-- =====================================================
         NAVIGATION
    ====================================================== --}}

    <header class="absolute top-0 left-0 right-0 z-40">

        <div class="max-w-[1500px] mx-auto px-6 lg:px-12">

            <nav class="h-24 flex items-center justify-between">

                {{-- LEFT --}}
                <div class="hidden lg:flex items-center gap-10 flex-1">

                    <a
                        href="{{ route('home') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:opacity-60 transition"
                    >
                        Home
                    </a>

                    <a
                        href="{{ route('shop') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:opacity-60 transition"
                    >
                        Shop
                    </a>

                    <a
                        href="{{ route('categories') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:opacity-60 transition"
                    >
                        Categories
                    </a>

                </div>


                {{-- CENTER LOGO --}}

                <a
                    href="{{ route('home') }}"
                    class="absolute left-1/2 -translate-x-1/2 top-5"
                >
                    <img
                        src="{{ asset('images/logo/logo.png') }}"
                        alt="Bin Ismail"
                        class="h-14 lg:h-16 w-auto object-contain"
                    >
                </a>


                {{-- RIGHT --}}

                <div class="hidden lg:flex items-center justify-end gap-10 flex-1">

                    <a
                        href="{{ route('about') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:opacity-60 transition"
                    >
                        About
                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:opacity-60 transition"
                    >
                        Contact
                    </a>

                    {{-- SEARCH --}}

                    <button
                        type="button"
                        onclick="openSearch()"
                        aria-label="Search"
                        class="text-white hover:opacity-60 transition"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                                stroke-width="1.7"
                            />

                            <path
                                d="m20 20-4-4"
                                stroke-width="1.7"
                                stroke-linecap="round"
                            />
                        </svg>
                    </button>


                    {{-- CART --}}

                    <button
                        type="button"
                        onclick="openCart()"
                        aria-label="Shopping bag"
                        class="relative text-white hover:opacity-60 transition"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M6 8h12l1 13H5L6 8Z"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M9 8V6a3 3 0 0 1 6 0v2"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />
                        </svg>

                        <span
                            id="cart-count"
                            class="absolute -top-2 -right-3 min-w-[17px] h-[17px] px-1 rounded-full bg-white text-black text-[9px] flex items-center justify-center font-semibold"
                        >
                            0
                        </span>
                    </button>

                </div>


                {{-- MOBILE MENU --}}

                <button
                    type="button"
                    onclick="openMobileMenu()"
                    class="lg:hidden text-white"
                    aria-label="Open menu"
                >
                    <svg
                        class="w-7 h-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M4 7h16M4 12h16M4 17h16"
                            stroke-width="1.5"
                            stroke-linecap="round"
                        />
                    </svg>
                </button>


                {{-- MOBILE CART --}}

                <button
                    type="button"
                    onclick="openCart()"
                    class="lg:hidden relative text-white"
                    aria-label="Shopping bag"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M6 8h12l1 13H5L6 8Z"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M9 8V6a3 3 0 0 1 6 0v2"
                            stroke-width="1.5"
                            stroke-linecap="round"
                        />
                    </svg>

                    <span
                        id="cart-count-mobile"
                        class="absolute -top-2 -right-3 min-w-[17px] h-[17px] px-1 rounded-full bg-white text-black text-[9px] flex items-center justify-center font-semibold"
                    >
                        0
                    </span>
                </button>

            </nav>

        </div>

    </header>


    {{-- =====================================================
         HERO CONTENT
    ====================================================== --}}

    <div class="relative z-20 h-full flex items-center justify-center px-6">

        <div class="text-center max-w-4xl">

            <p class="text-xs sm:text-sm uppercase tracking-[0.45em] font-medium mb-6">
                The Collection
            </p>

            <h1 class="text-6xl sm:text-7xl lg:text-8xl font-light tracking-tight">
                Shop
            </h1>

            <p class="mt-8 max-w-3xl mx-auto text-sm sm:text-base lg:text-lg leading-8 text-white/90">
                Explore our collection of clothing, jewelry, laces, watches
                and accessories — carefully selected for timeless style.
            </p>

        </div>

    </div>

</section>


{{-- =========================================================
     CATEGORY NAVIGATION
========================================================= --}}

<section class="bg-white border-b border-gray-200 sticky top-0 z-30">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-center gap-2 sm:gap-8 overflow-x-auto py-5">

            {{-- ALL --}}

            <a
                href="{{ route('shop') }}"
                class="whitespace-nowrap px-4 py-2 text-xs uppercase tracking-widest font-semibold
                {{ !$selectedCategory
                    ? 'text-black border-b-2 border-black'
                    : 'text-gray-500 hover:text-black' }}"
            >
                All
            </a>


            {{-- DATABASE CATEGORIES --}}

            @foreach($categories as $category)

                <a
                    href="{{ route('shop', ['category' => $category->slug]) }}"
                    class="whitespace-nowrap px-4 py-2 text-xs uppercase tracking-widest
                    {{ $selectedCategory?->id === $category->id
                        ? 'text-black font-semibold border-b-2 border-black'
                        : 'text-gray-500 hover:text-black' }}"
                >
                    {{ $category->name }}
                </a>

            @endforeach

        </div>

    </div>

</section>


{{-- =========================================================
     SHOP AREA
========================================================= --}}

<section class="py-16 sm:py-20 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        {{-- =====================================================
             TOP BAR
        ====================================================== --}}

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">

            <div>

                <p class="text-xs uppercase tracking-[0.35em] text-[#a47c15] font-semibold">
                    {{ $selectedCategory?->name ?? 'All Collection' }}
                </p>

                <h2 class="mt-3 text-3xl sm:text-4xl font-light">
                    Shop Products
                </h2>

                <p
                    id="shop-product-count"
                    class="mt-2 text-sm text-gray-500"
                >
                    Showing {{ $products->count() }} products
                </p>

            </div>


            {{-- SORT --}}

            <form
                method="GET"
                action="{{ route('shop') }}"
                class="flex items-center gap-3"
            >

                @if(request('category'))
                    <input
                        type="hidden"
                        name="category"
                        value="{{ request('category') }}"
                    >
                @endif

                @if(request('search'))
                    <input
                        type="hidden"
                        name="search"
                        value="{{ request('search') }}"
                    >
                @endif

                @foreach(request()->except(['sort', 'page', 'category', 'search']) as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $item)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                        @endforeach
                    @elseif($value !== null && $value !== '')
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach

                <select
                    name="sort"
                    onchange="this.form.requestSubmit()"
                    class="border border-gray-300 bg-white px-5 py-3 text-sm focus:outline-none focus:border-black"
                >

                    <option
                        value=""
                        {{ !request('sort') ? 'selected' : '' }}
                    >
                        Sort: Latest
                    </option>

                    <option
                        value="featured"
                        {{ request('sort') === 'featured' ? 'selected' : '' }}
                    >
                        Sort: Featured
                    </option>

                    <option
                        value="price_low"
                        {{ in_array(request('sort'), ['price_low', 'low']) ? 'selected' : '' }}
                    >
                        Price: Low to High
                    </option>

                    <option
                        value="price_high"
                        {{ in_array(request('sort'), ['price_high', 'high']) ? 'selected' : '' }}
                    >
                        Price: High to Low
                    </option>

                    <option
                        value="name"
                        {{ request('sort') === 'name' ? 'selected' : '' }}
                    >
                        Name: A-Z
                    </option>

                </select>

            </form>

        </div>


        {{-- =====================================================
             FILTER + PRODUCTS
        ====================================================== --}}

        <div class="grid grid-cols-1 lg:grid-cols-[270px_1fr] gap-10">


            {{-- =================================================
                 FILTER SIDEBAR
            ================================================== --}}

            <aside>

                <form
                    method="GET"
                    action="{{ route('shop') }}"
                    class="border border-gray-200 p-6 bg-white sticky top-28"
                >

                    {{-- KEEP CATEGORY --}}

                    @if($selectedCategory)

                        <input
                            type="hidden"
                            name="category"
                            value="{{ $selectedCategory->slug }}"
                        >

                    @endif


                    {{-- KEEP SEARCH --}}

                    @if(request('search'))

                        <input
                            type="hidden"
                            name="search"
                            value="{{ request('search') }}"
                        >

                    @endif


                                        @if(request('sort'))

                        <input
                            type="hidden"
                            name="sort"
                            value="{{ request('sort') }}"
                        >

                    @endif

{{-- FILTER TITLE --}}

                    <div class="flex items-center justify-between mb-7">

                        <div>

                            <p class="text-xs uppercase tracking-[0.3em] text-gray-400">
                                Refine
                            </p>

                            <h3 class="mt-2 text-lg font-medium">
                                Filters
                            </h3>

                        </div>

                    </div>


                    {{-- =================================================
     PRICE RANGE
================================================== --}}

<div class="border-t border-gray-200 pt-6">
    <div class="flex items-center justify-between">
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Price
        </p>

        <span
            id="price-range-label"
            class="text-xs text-gray-500"
        >
            Up to PKR {{ number_format($selectedMaxPrice) }}
        </span>
    </div>

    {{-- SINGLE PRICE SLIDER --}}
    <div class="relative mt-7 h-5">
        <div
            class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -translate-y-1/2 rounded-full"
        ></div>

        <div
            id="price-active-track"
            class="absolute top-1/2 left-0 h-1 bg-black -translate-y-1/2 rounded-full"
        ></div>

        <input
            type="range"
            id="price-slider"
            min="{{ $priceMin }}"
            max="{{ $priceMax }}"
            value="{{ $selectedMaxPrice }}"
            step="1"
            class="price-slider absolute inset-0 w-full appearance-none bg-transparent"
        >
    </div>

    <input
        type="hidden"
        name="max_price"
        id="max-price-input"
        value="{{ $selectedMaxPrice }}"
    >

    <div class="flex items-center justify-between mt-3">
        <span class="text-[10px] uppercase tracking-widest text-gray-400">
            PKR {{ number_format($priceMin) }}
        </span>

        <span class="text-[10px] uppercase tracking-widest text-gray-400">
            PKR {{ number_format($priceMax) }}
        </span>
    </div>
</div>


                    {{-- =================================================
                         CLOTHING FILTERS
                    ================================================== --}}

                    @if($categoryType === 'clothing')

                        <div class="mt-7 border-t border-gray-200 pt-7">

                            <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-5">
                                Gender
                            </p>

                            <div class="space-y-3">

                                @foreach([
                                    'men' => 'Men',
                                    'women' => 'Women',
                                    'kids' => 'Kids'
                                ] as $value => $label)

                                    <label class="flex items-center gap-3 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="gender[]"
                                            value="{{ $value }}"
                                            {{ in_array($value, $selectedGenders) ? 'checked' : '' }}
                                            class="w-4 h-4"
                                        >

                                        <span class="text-sm text-gray-700">
                                            {{ $label }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>


                        {{-- BRAND --}}

                        <div class="mt-7 border-t border-gray-200 pt-7">

                            <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-5">
                                Brand
                            </p>

                            <div class="space-y-3">

                                @forelse($clothingBrands as $brand)

                                    <label class="flex items-center gap-3 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="brand[]"
                                            value="{{ $brand }}"
                                            {{ in_array($brand, $selectedBrands) ? 'checked' : '' }}
                                            class="w-4 h-4"
                                        >

                                        <span class="text-sm text-gray-700">
                                            {{ $brand }}
                                        </span>

                                    </label>

                                @empty

                                    <p class="text-sm text-gray-400">
                                        No brands available.
                                    </p>

                                @endforelse

                            </div>

                        </div>


                        {{-- SIZE --}}

                        <div class="mt-7 border-t border-gray-200 pt-7">

                            <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-5">
                                Size
                            </p>

                            <div class="flex flex-wrap gap-2">

                                @foreach(['S', 'M', 'L'] as $size)

                                    <label class="cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="sizes[]"
                                            value="{{ $size }}"
                                            {{ in_array($size, $selectedSizes) ? 'checked' : '' }}
                                            class="peer sr-only"
                                        >

                                        <span
                                            class="inline-flex min-w-[45px] justify-center border border-gray-300 px-4 py-2 text-xs
                                            peer-checked:bg-black peer-checked:text-white peer-checked:border-black"
                                        >
                                            {{ $size }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         COSMETICS FILTERS
                    ================================================== --}}
                    @if($categoryType === 'cosmetics')

                        <div class="mt-7 border-t border-gray-200 pt-7">
                            <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-5">Product Type</p>
                            <select name="cosmetic_product_type" class="w-full border border-gray-200 bg-white px-3 py-3 text-sm focus:outline-none focus:border-black">
                                <option value="">All Product Types</option>
                                @foreach([
                                    'makeup' => 'Makeup',
                                    'skincare' => 'Skincare',
                                    'haircare' => 'Haircare',
                                    'fragrance' => 'Fragrance',
                                    'body_care' => 'Body Care',
                                    'nail_care' => 'Nail Care'
                                ] as $value => $label)
                                    <option value="{{ $value }}" {{ $selectedCosmeticProductType === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-7 border-t border-gray-200 pt-7">
                            <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-5">Brand</p>
                            <div class="space-y-3">
                                @forelse($cosmeticBrands as $brand)
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" name="brand[]" value="{{ $brand }}" {{ in_array($brand, $selectedBrands) ? 'checked' : '' }} class="w-4 h-4">
                                        <span class="text-sm text-gray-700">{{ $brand }}</span>
                                    </label>
                                @empty
                                    <p class="text-sm text-gray-400">No brands available.</p>
                                @endforelse
                            </div>
                        </div>

                        @foreach([
                            'skin_types' => ['title' => 'Skin Type', 'options' => [
                                'all_skin_types' => 'All Skin Types', 'oily' => 'Oily', 'dry' => 'Dry', 'combination' => 'Combination', 'sensitive' => 'Sensitive'
                            ], 'selected' => $selectedSkinTypes],
                            'concerns' => ['title' => 'Concern / Benefit', 'options' => [
                                'hydration' => 'Hydration', 'brightening' => 'Brightening', 'acne_blemishes' => 'Acne & Blemishes', 'oil_control' => 'Oil Control', 'anti_aging' => 'Anti-Aging', 'sun_protection' => 'Sun Protection', 'hair_fall' => 'Hair Fall', 'frizz_control' => 'Frizz Control'
                            ], 'selected' => $selectedConcerns],
                            'product_forms' => ['title' => 'Product Form', 'options' => [
                                'cream' => 'Cream', 'gel' => 'Gel', 'serum' => 'Serum', 'lotion' => 'Lotion', 'powder' => 'Powder', 'liquid' => 'Liquid', 'spray' => 'Spray', 'stick' => 'Stick'
                            ], 'selected' => $selectedProductForms]
                        ] as $field => $data)
                            <div class="mt-7 border-t border-gray-200 pt-7">
                                <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-5">{{ $data['title'] }}</p>
                                <div class="space-y-3">
                                    @foreach($data['options'] as $value => $label)
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" name="{{ $field }}[]" value="{{ $value }}" {{ in_array($value, $data['selected']) ? 'checked' : '' }} class="w-4 h-4">
                                            <span class="text-sm text-gray-700">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    @endif

                    {{-- =================================================
                         LACE FILTERS
                    ================================================== --}}

                    @if($categoryType === 'lace')

                        <div class="mt-7 border-t border-gray-200 pt-7">

                            <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-5">
                                Lace Information
                            </p>


                            {{-- =================================================
                                 LACE CATEGORY DROPDOWN
                            ================================================== --}}

                            <label
                                for="lace_category"
                                class="block text-xs text-gray-500 mb-2"
                            >
                                Lace Category
                            </label>

                            <select
                                name="lace_category"
                                id="lace_category"
                                class="w-full border border-gray-200 bg-white px-3 py-3 text-sm focus:outline-none focus:border-black"
                            >

                                <option value="">
                                    Select Lace Category
                                </option>

                                <option
                                    value="basic_everyday"
                                    {{ request('lace_category') === 'basic_everyday' ? 'selected' : '' }}
                                >
                                    Basic & Everyday Laces
                                </option>

                                <option
                                    value="embroidered"
                                    {{ request('lace_category') === 'embroidered' ? 'selected' : '' }}
                                >
                                    Embroidered Laces
                                </option>

                                <option
                                    value="fancy"
                                    {{ request('lace_category') === 'fancy' ? 'selected' : '' }}
                                >
                                    Fancy Laces
                                </option>

                                <option
                                    value="traditional"
                                    {{ request('lace_category') === 'traditional' ? 'selected' : '' }}
                                >
                                    Traditional Laces
                                </option>

                                <option
                                    value="suit_specific"
                                    {{ request('lace_category') === 'suit_specific' ? 'selected' : '' }}
                                >
                                    Suit-Specific Laces
                                </option>

                                <option
                                    value="premium_bridal"
                                    {{ request('lace_category') === 'premium_bridal' ? 'selected' : '' }}
                                >
                                    Premium / Bridal
                                </option>

                            </select>


                            {{-- =================================================
                                 SUBCATEGORIES
                            ================================================== --}}

                            <div
                                id="lace-subcategories-container"
                                class="mt-6"
                            >

                                <p class="text-xs text-gray-400 mb-4">
                                    Select subcategories
                                </p>


                                {{-- BASIC --}}
                                <div
                                    data-lace-group="basic_everyday"
                                    class="lace-subcategory-group hidden"
                                >

                                    @foreach([
                                        'cotton' => 'Cotton',
                                        'plain' => 'Plain',
                                        'printed' => 'Printed',
                                        'thread' => 'Thread'
                                    ] as $value => $label)

                                        <label class="flex items-center gap-3 mb-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="lace_subcategories[]"
                                                value="{{ $value }}"
                                                {{ in_array($value, $selectedLaceSubcategories) ? 'checked' : '' }}
                                                class="w-4 h-4"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- EMBROIDERED --}}
                                <div
                                    data-lace-group="embroidered"
                                    class="lace-subcategory-group hidden"
                                >

                                    @foreach([
                                        'embroidery' => 'Embroidery',
                                        'organza' => 'Organza',
                                        'chiffon' => 'Chiffon',
                                        'net' => 'Net',
                                        'cutwork' => 'Cutwork',
                                        'applique' => 'Appliqué'
                                    ] as $value => $label)

                                        <label class="flex items-center gap-3 mb-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="lace_subcategories[]"
                                                value="{{ $value }}"
                                                {{ in_array($value, $selectedLaceSubcategories) ? 'checked' : '' }}
                                                class="w-4 h-4"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- FANCY --}}
                                <div
                                    data-lace-group="fancy"
                                    class="lace-subcategory-group hidden"
                                >

                                    @foreach([
                                        'sequin' => 'Sequin',
                                        'stone' => 'Stone',
                                        'crystal' => 'Crystal',
                                        'pearl' => 'Pearl',
                                        'moti' => 'Moti',
                                        'mirror_work' => 'Mirror Work',
                                        'shimmer' => 'Shimmer',
                                        'fancy_designer' => 'Fancy Designer'
                                    ] as $value => $label)

                                        <label class="flex items-center gap-3 mb-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="lace_subcategories[]"
                                                value="{{ $value }}"
                                                {{ in_array($value, $selectedLaceSubcategories) ? 'checked' : '' }}
                                                class="w-4 h-4"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- TRADITIONAL --}}
                                <div
                                    data-lace-group="traditional"
                                    class="lace-subcategory-group hidden"
                                >

                                    @foreach([
                                        'gota' => 'Gota',
                                        'gota_patti' => 'Gota Patti',
                                        'dori' => 'Dori',
                                        'zari' => 'Zari',
                                        'tilla' => 'Tilla',
                                        'resham' => 'Resham',
                                        'traditional_border' => 'Traditional Border'
                                    ] as $value => $label)

                                        <label class="flex items-center gap-3 mb-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="lace_subcategories[]"
                                                value="{{ $value }}"
                                                {{ in_array($value, $selectedLaceSubcategories) ? 'checked' : '' }}
                                                class="w-4 h-4"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- SUIT SPECIFIC --}}
                                <div
                                    data-lace-group="suit_specific"
                                    class="lace-subcategory-group hidden"
                                >

                                    @foreach([
                                        'daman' => 'Daman',
                                        'neckline' => 'Neckline',
                                        'sleeve' => 'Sleeve',
                                        'trouser' => 'Trouser',
                                        'dupatta' => 'Dupatta',
                                        'shirt_border' => 'Shirt Border',
                                        'side_border' => 'Side Border'
                                    ] as $value => $label)

                                        <label class="flex items-center gap-3 mb-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="lace_subcategories[]"
                                                value="{{ $value }}"
                                                {{ in_array($value, $selectedLaceSubcategories) ? 'checked' : '' }}
                                                class="w-4 h-4"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- PREMIUM / BRIDAL --}}
                                <div
                                    data-lace-group="premium_bridal"
                                    class="lace-subcategory-group hidden"
                                >

                                    @foreach([
                                        'bridal' => 'Bridal',
                                        'heavy_bridal' => 'Heavy Bridal',
                                        'premium_designer' => 'Premium Designer'
                                    ] as $value => $label)

                                        <label class="flex items-center gap-3 mb-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="lace_subcategories[]"
                                                value="{{ $value }}"
                                                {{ in_array($value, $selectedLaceSubcategories) ? 'checked' : '' }}
                                                class="w-4 h-4"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </div>


                            {{-- =================================================
                                 WIDTH
                            ================================================== --}}

                            <div class="mt-7">

                                <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4">
                                    Width
                                </p>

                                <div class="space-y-3">

                                    @forelse($laceWidths as $width)

                                        <label class="flex items-center gap-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="width[]"
                                                value="{{ $width }}"
                                                {{ in_array($width, $selectedWidths) ? 'checked' : '' }}
                                                class="w-4 h-4"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $width }}
                                            </span>

                                        </label>

                                    @empty

                                        <p class="text-sm text-gray-400">
                                            No width options available.
                                        </p>

                                    @endforelse

                                </div>

                            </div>


                            {{-- =================================================
                                 HEIGHT
                            ================================================== --}}

                            <div class="mt-7">

                                <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4">
                                    Height
                                </p>

                                <div class="space-y-3">

                                    @forelse($laceHeights as $height)

                                        <label class="flex items-center gap-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="height[]"
                                                value="{{ $height }}"
                                                {{ in_array($height, $selectedHeights) ? 'checked' : '' }}
                                                class="w-4 h-4"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $height }}
                                            </span>

                                        </label>

                                    @empty

                                        <p class="text-sm text-gray-400">
                                            No height options available.
                                        </p>

                                    @endforelse

                                </div>

                            </div>


                            {{-- =================================================
                                 LENGTH
                            ================================================== --}}

                            <div class="mt-7">

                                <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4">
                                    Length
                                </p>

                                <div class="space-y-3">

                                    @forelse($laceLengths as $length)

                                        <label class="flex items-center gap-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="length[]"
                                                value="{{ $length }}"
                                                {{ in_array($length, $selectedLengths) ? 'checked' : '' }}
                                                class="w-4 h-4"
                                            >

                                            <span class="text-sm text-gray-700">
                                                {{ $length }}
                                            </span>

                                        </label>

                                    @empty

                                        <p class="text-sm text-gray-400">
                                            No length options available.
                                        </p>

                                    @endforelse

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         APPLY BUTTON
                    ================================================== --}}

                    @if(
                        $categoryType !== 'other'
                        || request('min_price')
                        || request('max_price')
                    )


                    @endif


                    {{-- CLEAR --}}

                    @if(
                        request()->hasAny([
                            'min_price',
                            'max_price',
                            'gender',
                            'brand',
                            'sizes',
                            'cosmetic_product_type',
                            'skin_types',
                            'concerns',
                            'product_forms',
                            'lace_category',
                            'lace_subcategories',
                            'width',
                            'height',
                            'length',
                            'sort'
                        ])
                    )

                        <a
                            href="{{ $selectedCategory
                                ? route('shop', ['category' => $selectedCategory->slug])
                                : route('shop') }}"
                            class="block text-center mt-4 text-xs uppercase tracking-widest text-gray-500 hover:text-black shop-clear-filters"
                        >
                            Clear Filters
                        </a>

                    @endif

                </form>

            </aside>


            {{-- =================================================
                 PRODUCT GRID
            ================================================== --}}

            <div id="product-results">

                @include('partials.shop-product-results')

        </div>

    </div>

</section>


{{-- =========================================================
     WHATSAPP CTA
========================================================= --}}

<section class="bg-[#f7f5f0]">

    <div class="max-w-5xl mx-auto px-6 py-20 text-center">

        <p class="text-xs uppercase tracking-[0.45em] text-[#a47c15] font-semibold">
            Need help choosing?
        </p>

        <h2 class="mt-5 text-3xl sm:text-4xl font-light">
            Shop With Us on WhatsApp
        </h2>

        <p class="mt-5 max-w-xl mx-auto text-gray-600 leading-7">
            Ask about product availability, sizes, prices or anything else.
            Our team is ready to help.
        </p>

        <a
            href="https://wa.me/{{ config('store.whatsapp') }}?text={{ urlencode('Hello Bin Ismail, I need help choosing a product.') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex mt-8 bg-black text-white px-8 py-4 text-sm font-semibold uppercase tracking-widest hover:bg-[#a47c15] transition"
        >
            Chat on WhatsApp
        </a>

    </div>

</section>


{{-- =========================================================
     FLOATING WHATSAPP
========================================================= --}}

<a
    href="https://wa.me/{{ config('store.whatsapp') }}?text={{ urlencode('Hello Bin Ismail, I would like to know more about your products.') }}"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Chat with Bin Ismail on WhatsApp"
    class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-[#25D366] text-white rounded-full shadow-xl flex items-center justify-center hover:scale-110 transition duration-300"
>

    <svg
        viewBox="0 0 24 24"
        fill="currentColor"
        class="w-7 h-7"
    >
        <path
            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.1-.198.05-.372-.025-.521-.075-.149-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.077 4.487.709.306 1.262.489 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"
        />
    </svg>

</a>


{{-- =========================================================
     LACE CATEGORY JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const filterForm = document.querySelector(
        'aside form[action="{{ route('shop') }}"]'
    );

    const laceCategory = document.getElementById('lace_category');

    const laceGroups = document.querySelectorAll(
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
            group.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
                checkbox.checked = false;
            });
        });

        updateLaceSubcategories();

        if (filterForm && typeof window.applyShopFilters === 'function') {
            window.applyShopFilters();
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
| AJAX FILTERING + PRICE SLIDER
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {

    const filterForm = document.querySelector(
        'aside form[action="{{ route('shop') }}"]'
    );

    const sortForm = document.querySelector(
        'form[action="{{ route('shop') }}"] select[name="sort"]'
    )?.closest('form');

    const resultsContainer = document.getElementById('product-results');
    const productCount = document.getElementById('shop-product-count');

    if (!filterForm || !resultsContainer) {
        return;
    }

    let requestController = null;

    function buildUrl(form) {
        const formData = new FormData(form);
        const params = new URLSearchParams();

        for (const [key, value] of formData.entries()) {
            if (value !== '') {
                params.append(key, value);
            }
        }

        return '{{ route('shop') }}' + (params.toString() ? '?' + params.toString() : '');
    }

    async function loadShopResults(form, updateHistory = true) {

        const url = buildUrl(form);

        if (requestController) {
            requestController.abort();
        }

        requestController = new AbortController();

        resultsContainer.style.opacity = '0.55';
        resultsContainer.style.pointerEvents = 'none';

        try {
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                },
                signal: requestController.signal
            });

            if (!response.ok) {
                throw new Error('Filter request failed.');
            }

            const data = await response.json();

            if (!data.html) {
                throw new Error('Product results were not returned.');
            }

            resultsContainer.innerHTML = data.html;

            if (productCount) {
                productCount.textContent =
                    'Showing ' + Number(data.count || 0).toLocaleString() + ' products';
            }

            if (updateHistory) {
                window.history.pushState({}, '', url);
            }

            window.scrollTo({
                top: document.querySelector('#product-results')?.getBoundingClientRect().top + window.scrollY - 120 || window.scrollY,
                behavior: 'smooth'
            });

        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error(error);
            }
        } finally {
            resultsContainer.style.opacity = '';
            resultsContainer.style.pointerEvents = '';
        }
    }

    window.applyShopFilters = function () {
        loadShopResults(filterForm, true);
    };

    filterForm.querySelectorAll('input[type="checkbox"]').forEach(function (input) {
        input.addEventListener('change', function () {
            window.applyShopFilters();
        });
    });

    filterForm.querySelectorAll('select').forEach(function (select) {
        if (select.id === 'lace_category') {
            return;
        }

        select.addEventListener('change', function () {
            window.applyShopFilters();
        });
    });

    if (sortForm) {
        sortForm.addEventListener('submit', function (event) {
            event.preventDefault();
            loadShopResults(sortForm, true);
        });
    }

    const priceSlider = document.getElementById('price-slider');
    const maxInput = document.getElementById('max-price-input');
    const rangeLabel = document.getElementById('price-range-label');
    const activeTrack = document.getElementById('price-active-track');

    if (priceSlider && maxInput) {

        const absoluteMin = Number(priceSlider.min);
        const absoluteMax = Number(priceSlider.max);
        let priceSubmitTimer = null;

        function updatePriceSlider() {
            const maxValue = Number(priceSlider.value);

            maxInput.value = maxValue;

            if (rangeLabel) {
                rangeLabel.textContent =
                    'Up to PKR ' + maxValue.toLocaleString();
            }

            const range = absoluteMax - absoluteMin;

            if (activeTrack && range > 0) {
                const maxPercent = ((maxValue - absoluteMin) / range) * 100;
                activeTrack.style.width = maxPercent + '%';
            }
        }

        priceSlider.addEventListener('input', updatePriceSlider);

        priceSlider.addEventListener('change', function () {
            clearTimeout(priceSubmitTimer);

            priceSubmitTimer = setTimeout(function () {
                window.applyShopFilters();
            }, 100);
        });

        updatePriceSlider();
    }

    const clearFiltersLink = document.querySelector('.shop-clear-filters');

    if (clearFiltersLink) {
        clearFiltersLink.addEventListener('click', function (event) {
            event.preventDefault();

            const url = this.href;

            window.history.pushState({}, '', url);

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Could not clear filters.');
                }
                return response.json();
            })
            .then(function (data) {
                if (data.html) {
                    resultsContainer.innerHTML = data.html;
                }

                if (productCount) {
                    productCount.textContent =
                        'Showing ' + Number(data.count || 0).toLocaleString() + ' products';
                }
            })
            .catch(function (error) {
                console.error(error);
            });
        });
    }

    window.addEventListener('popstate', function () {
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Could not restore filters.');
            }
            return response.json();
        })
        .then(function (data) {
            if (data.html) {
                resultsContainer.innerHTML = data.html;
            }

            if (productCount) {
                productCount.textContent =
                    'Showing ' + Number(data.count || 0).toLocaleString() + ' products';
            }
        })
        .catch(function (error) {
            console.error(error);
        });
    });
});


/*
|--------------------------------------------------------------------------
| PRICE SLIDER STYLES
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| WHATSAPP ORDER
|--------------------------------------------------------------------------
*/

function orderOnWhatsApp(productName) {

    const phone = "{{ config('store.whatsapp') }}";

    const message =
        "Hello Bin Ismail! I am interested in: " +
        productName +
        ". Please share more details and availability.";

    const url =
        "https://wa.me/" +
        phone +
        "?text=" +
        encodeURIComponent(message);

    window.open(url, '_blank');

}

</script>

<style>
    .price-slider {
        height: 20px;
    }

    .price-slider::-webkit-slider-thumb {
        appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 9999px;
        background: #000;
        cursor: pointer;
        pointer-events: auto;
        border: 2px solid #fff;
        box-shadow: 0 0 0 1px #000;
    }

    .price-slider::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border-radius: 9999px;
        background: #000;
        cursor: pointer;
        pointer-events: auto;
        border: 2px solid #fff;
        box-shadow: 0 0 0 1px #000;
    }
</style>

@endsection