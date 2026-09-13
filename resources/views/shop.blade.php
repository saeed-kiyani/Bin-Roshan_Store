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

                <p class="mt-2 text-sm text-gray-500">
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
                    onchange="this.form.submit()"
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
     PRICE
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
            Up to PKR {{ number_format($priceMax) }}
        </span>

    </div>

    <div class="mt-7">

        <input
            type="range"
            id="price-slider"
            min="{{ $priceMin }}"
            max="{{ $priceMax }}"
            value="{{ request()->filled('max_price') ? request('max_price') : $priceMax }}"
            step="1"
            class="w-full price-range-slider"
        >

    </div>

    <div class="flex items-center justify-between mt-3">

        <span class="text-[10px] uppercase tracking-widest text-gray-400">
            PKR {{ number_format($priceMin) }}
        </span>

        <span class="text-[10px] uppercase tracking-widest text-gray-400">
            PKR {{ number_format($priceMax) }}
        </span>

    </div>

    <input
        type="hidden"
        name="max_price"
        id="max-price-input"
        value="{{ request()->filled('max_price') ? request('max_price') : $priceMax }}"
    >

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
                            class="block text-center mt-4 text-xs uppercase tracking-widest text-gray-500 hover:text-black"
                        >
                            Clear Filters
                        </a>

                    @endif

                </form>

            </aside>


            {{-- =================================================
                 PRODUCT GRID
            ================================================== --}}

            <div>

                @if($products->count())

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 sm:gap-x-6 gap-y-12">

                        @foreach($products as $product)

                            @php

                                $productPrice = $product->sale_price
                                    ?? $product->price;

                                $image = optional(
                                    $product->primaryImage
                                )->image;

                                $imageUrl = $image
                                    ? asset(
                                        'storage/' .
                                        ltrim($image, '/')
                                    )
                                    : asset(
                                        'images/placeholder.jpg'
                                    );

                            @endphp


                            <article
    class="group product-card"
    data-category="{{ strtolower($product->category?->slug ?? '') }}"
    data-price="{{ (float) $productPrice }}"
    data-gender="{{ strtolower($product->gender ?? '') }}"
    data-brand="{{ strtolower($product->brand ?? '') }}"
    data-sizes="{{ implode(',', array_map('strtolower', $product->sizes ?? [])) }}"
    data-lace-category="{{ strtolower($product->lace_category ?? '') }}"
    data-lace-subcategories="{{ implode(',', array_map('strtolower', $product->lace_subcategories ?? [])) }}"
    data-lace-width="{{ implode(',', array_map('strtolower', $product->width ?? [])) }}"
    data-lace-height="{{ implode(',', array_map('strtolower', $product->height ?? [])) }}"
    data-lace-length="{{ implode(',', array_map('strtolower', $product->length ?? [])) }}"
>

                                {{-- IMAGE --}}

                                <div class="relative overflow-hidden bg-gray-100 aspect-[4/5]">

                                    <a
                                        href="{{ route(
                                            'product.show',
                                            $product->slug
                                        ) }}"
                                        class="block w-full h-full"
                                    >

                                        <img
                                            src="{{ $imageUrl }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transition duration-700 group-hover:scale-105"
                                            loading="lazy"
                                            onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';"
                                        >

                                    </a>


                                    {{-- FEATURED --}}

                                    @if($product->is_featured)

                                        <span
                                            class="absolute top-4 left-4 bg-black text-white text-[10px] uppercase tracking-widest px-3 py-2"
                                        >
                                            Featured
                                        </span>

                                    @endif


                                    {{-- SALE --}}

                                    @if(
                                        $product->sale_price &&
                                        $product->price > $product->sale_price
                                    )

                                        <span
                                            class="absolute top-4 right-4 bg-[#b38b2c] text-white text-[10px] uppercase tracking-widest px-3 py-2"
                                        >
                                            Sale
                                        </span>

                                    @endif


                                    {{-- ADD TO BAG --}}

                                    <button
                                        type="button"
                                        onclick='addToCart({
                                            id: {{ $product->id }},
                                            name: @json($product->name),
                                            price: {{ (float) $productPrice }},
                                            image: @json($imageUrl)
                                        })'
                                        class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur text-black py-3 text-xs font-semibold uppercase tracking-widest opacity-0 translate-y-3 group-hover:opacity-100 group-hover:translate-y-0 transition duration-300"
                                    >
                                        Add to Bag
                                    </button>

                                </div>


                                {{-- DETAILS --}}

                                <div class="pt-5">

                                    <p class="text-[10px] uppercase tracking-widest text-gray-400">
                                        {{ $product->category?->name ?? 'Product' }}
                                    </p>

                                    <h3 class="mt-2 text-sm font-medium text-gray-900">
                                        <a
                                            href="{{ route(
                                                'product.show',
                                                $product->slug
                                            ) }}"
                                            class="hover:opacity-60 transition"
                                        >
                                            {{ $product->name }}
                                        </a>
                                    </h3>


                                    <div class="mt-2">

                                        @if(
                                            $product->sale_price &&
                                            $product->price > $product->sale_price
                                        )

                                            <span class="text-sm text-black">
                                                PKR {{ number_format($product->sale_price) }}
                                            </span>

                                            <span class="ml-2 text-xs text-gray-400 line-through">
                                                PKR {{ number_format($product->price) }}
                                            </span>

                                        @else

                                            <span class="text-sm text-gray-600">
                                                PKR {{ number_format($product->price) }}
                                            </span>

                                        @endif

                                    </div>


                                    {{-- WHATSAPP --}}

                                    <button
                                        type="button"
                                        onclick="orderOnWhatsApp(@json($product->name))"
                                        class="mt-4 text-[10px] uppercase tracking-widest text-gray-400 hover:text-black transition"
                                    >
                                        Order on WhatsApp
                                    </button>

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    {{-- =================================================
                         NO PRODUCTS
                    ================================================== --}}

                    <div class="py-24 text-center">

                        <div class="mx-auto w-16 h-16 border border-gray-300 rounded-full flex items-center justify-center">

                            <svg
                                class="w-6 h-6 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    cx="11"
                                    cy="11"
                                    r="7"
                                    stroke-width="1.5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-width="1.5"
                                    d="m20 20-4-4"
                                />

                            </svg>

                        </div>

                        <h3 class="mt-6 text-xl font-light">
                            No products found
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Try changing or clearing your filters.
                        </p>

                        <a
                            href="{{ $selectedCategory
                                ? route('shop', ['category' => $selectedCategory->slug])
                                : route('shop') }}"
                            class="inline-flex mt-7 border border-black px-6 py-3 text-xs uppercase tracking-widest hover:bg-black hover:text-white transition"
                        >
                            Clear Filters
                        </a>

                    </div>

                @endif

            </div>

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

<script>

/*
|--------------------------------------------------------------------------
| BIN ISMAIL SHOP - INSTANT FILTERING
|--------------------------------------------------------------------------
| - No page reload when filters are changed
| - Single price slider
| - Clothing filters
| - Lace filters
| - URL updates without reload
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | FILTER FORM
    |--------------------------------------------------------------------------
    */

    const filterForm = document.querySelector(
        'aside form[action="{{ route('shop') }}"]'
    );

    if (!filterForm) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | PRODUCT CARDS
    |--------------------------------------------------------------------------
    */

    const productCards = Array.from(
        document.querySelectorAll('.product-card')
    );


    /*
    |--------------------------------------------------------------------------
    | PRODUCT COUNT
    |--------------------------------------------------------------------------
    */

    const productCountText =
        document.querySelector(
            'p.mt-2.text-sm.text-gray-500'
        );


    /*
    |--------------------------------------------------------------------------
    | PRICE SLIDER
    |--------------------------------------------------------------------------
    */

    const priceSlider =
        document.getElementById('price-slider');

    const maxPriceInput =
        document.getElementById('max-price-input');

    const priceLabel =
        document.getElementById('price-range-label');


    /*
    |--------------------------------------------------------------------------
    | LACE CATEGORY
    |--------------------------------------------------------------------------
    */

    const laceCategory =
        document.getElementById('lace_category');

    const laceGroups =
        document.querySelectorAll(
            '.lace-subcategory-group'
        );


    /*
    |--------------------------------------------------------------------------
    | CURRENT CATEGORY TYPE
    |--------------------------------------------------------------------------
    */

    const currentCategoryType =
        @json($categoryType);


    /*
    |--------------------------------------------------------------------------
    | GET CHECKED VALUES
    |--------------------------------------------------------------------------
    */

    function getCheckedValues(name) {

        return Array.from(
            filterForm.querySelectorAll(
                'input[name="' + name + '[]"]:checked'
            )
        ).map(function (input) {

            return String(input.value)
                .trim()
                .toLowerCase();

        });

    }


    /*
    |--------------------------------------------------------------------------
    | NORMALIZE PRODUCT ARRAY
    |--------------------------------------------------------------------------
    */

    function normalizeArray(value) {

        if (!value) {
            return [];
        }

        if (Array.isArray(value)) {

            return value
                .map(function (item) {

                    return String(item)
                        .trim()
                        .toLowerCase();

                })
                .filter(Boolean);

        }

        return String(value)
            .split(',')
            .map(function (item) {

                return item
                    .trim()
                    .toLowerCase();

            })
            .filter(Boolean);

    }


    /*
    |--------------------------------------------------------------------------
    | ARRAY MATCH
    |--------------------------------------------------------------------------
    */

    function arrayMatches(
        productValues,
        selectedValues
    ) {

        /*
        |--------------------------------------------------------------------------
        | No filter selected
        |--------------------------------------------------------------------------
        */

        if (!selectedValues.length) {
            return true;
        }


        /*
        |--------------------------------------------------------------------------
        | Product has no value
        |--------------------------------------------------------------------------
        */

        if (!productValues.length) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | ANY selected value can match
        |--------------------------------------------------------------------------
        */

        return selectedValues.some(function (value) {

            return productValues.includes(
                String(value)
                    .trim()
                    .toLowerCase()
            );

        });

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE LACE SUBCATEGORY VISIBILITY
    |--------------------------------------------------------------------------
    */

    function updateLaceSubcategories() {

        if (!laceCategory) {
            return;
        }


        const selected =
            laceCategory.value;


        /*
        |--------------------------------------------------------------------------
        | Hide all groups
        |--------------------------------------------------------------------------
        */

        laceGroups.forEach(function (group) {

            group.classList.add('hidden');

        });


        /*
        |--------------------------------------------------------------------------
        | Show selected group
        |--------------------------------------------------------------------------
        */

        if (selected) {

            const activeGroup =
                document.querySelector(
                    '[data-lace-group="' +
                    CSS.escape(selected) +
                    '"]'
                );


            if (activeGroup) {

                activeGroup.classList.remove(
                    'hidden'
                );

            }

        }

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PRICE LABEL
    |--------------------------------------------------------------------------
    */

    function updatePriceLabel() {

        if (!priceSlider) {
            return;
        }


        const value =
            Number(priceSlider.value);


        if (priceLabel) {

            priceLabel.textContent =
                'Up to PKR ' +
                value.toLocaleString();

        }


        if (maxPriceInput) {

            maxPriceInput.value =
                value;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE URL WITHOUT RELOAD
    |--------------------------------------------------------------------------
    */

    function updateFilterUrl() {

        const params =
            new URLSearchParams();


        /*
        |--------------------------------------------------------------------------
        | CATEGORY
        |--------------------------------------------------------------------------
        */

        @if($selectedCategory)

        params.set(
            'category',
            @json($selectedCategory->slug)
        );

        @endif


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        @if(request('search'))

        params.set(
            'search',
            @json(request('search'))
        );

        @endif


        /*
        |--------------------------------------------------------------------------
        | PRICE
        |--------------------------------------------------------------------------
        */

        if (
            priceSlider &&
            Number(priceSlider.value) <
                Number(priceSlider.max)
        ) {

            params.set(
                'max_price',
                priceSlider.value
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CHECKBOX FILTERS
        |--------------------------------------------------------------------------
        */

        const filterNames = [
            'gender',
            'brand',
            'sizes',
            'lace_subcategories',
            'width',
            'height',
            'length'
        ];


        filterNames.forEach(function (name) {

            getCheckedValues(name).forEach(
                function (value) {

                    params.append(
                        name + '[]',
                        value
                    );

                }
            );

        });


        /*
        |--------------------------------------------------------------------------
        | LACE CATEGORY
        |--------------------------------------------------------------------------
        */

        if (
            laceCategory &&
            laceCategory.value
        ) {

            params.set(
                'lace_category',
                laceCategory.value
            );

        }


        /*
        |--------------------------------------------------------------------------
        | SORT
        |--------------------------------------------------------------------------
        */

        const sortSelect =
            document.querySelector(
                'select[name="sort"]'
            );


        if (
            sortSelect &&
            sortSelect.value
        ) {

            params.set(
                'sort',
                sortSelect.value
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CHANGE URL ONLY
        |--------------------------------------------------------------------------
        |
        | replaceState DOES NOT reload the page.
        |
        |--------------------------------------------------------------------------
        */

        const query =
            params.toString();


        const newUrl =
            query
                ? window.location.pathname +
                  '?' +
                  query
                : window.location.pathname;


        window.history.replaceState(
            {},
            '',
            newUrl
        );

    }


    /*
    |--------------------------------------------------------------------------
    | MAIN FILTER FUNCTION
    |--------------------------------------------------------------------------
    */

    function filterProducts() {

        /*
        |--------------------------------------------------------------------------
        | CLOTHING FILTERS
        |--------------------------------------------------------------------------
        */

        const selectedGenders =
            getCheckedValues('gender');


        const selectedBrands =
            getCheckedValues('brand');


        const selectedSizes =
            getCheckedValues('sizes');


        /*
        |--------------------------------------------------------------------------
        | LACE FILTERS
        |--------------------------------------------------------------------------
        */

        const selectedSubcategories =
            getCheckedValues(
                'lace_subcategories'
            );


        const selectedWidths =
            getCheckedValues('width');


        const selectedHeights =
            getCheckedValues('height');


        const selectedLengths =
            getCheckedValues('length');


        const selectedLaceCategory =
            laceCategory
                ? laceCategory.value
                    .trim()
                    .toLowerCase()
                : '';


        /*
        |--------------------------------------------------------------------------
        | PRICE
        |--------------------------------------------------------------------------
        */

        const selectedMaxPrice =
            priceSlider
                ? Number(priceSlider.value)
                : Infinity;


        let visibleCount = 0;


        /*
        |--------------------------------------------------------------------------
        | CHECK EVERY PRODUCT
        |--------------------------------------------------------------------------
        */

        productCards.forEach(function (card) {

            /*
            |--------------------------------------------------------------------------
            | PRICE
            |--------------------------------------------------------------------------
            */

            const price =
                Number(
                    card.dataset.price || 0
                );


            /*
            |--------------------------------------------------------------------------
            | CLOTHING DATA
            |--------------------------------------------------------------------------
            */

            const gender =
                String(
                    card.dataset.gender || ''
                )
                .trim()
                .toLowerCase();


            const brand =
                String(
                    card.dataset.brand || ''
                )
                .trim()
                .toLowerCase();


            const sizes =
                normalizeArray(
                    card.dataset.sizes
                );


            /*
            |--------------------------------------------------------------------------
            | LACE DATA
            |--------------------------------------------------------------------------
            */

            const productLaceCategory =
                String(
                    card.dataset.laceCategory || ''
                )
                .trim()
                .toLowerCase();


            const laceSubcategories =
                normalizeArray(
                    card.dataset.laceSubcategories
                );


            const widths =
                normalizeArray(
                    card.dataset.laceWidth
                );


            const heights =
                normalizeArray(
                    card.dataset.laceHeight
                );


            const lengths =
                normalizeArray(
                    card.dataset.laceLength
                );


            /*
            |--------------------------------------------------------------------------
            | PRICE MATCH
            |--------------------------------------------------------------------------
            */

            const priceMatches =
                price <= selectedMaxPrice;


            let matches =
                priceMatches;


            /*
            |--------------------------------------------------------------------------
            | CLOTHING
            |--------------------------------------------------------------------------
            */

            if (
                currentCategoryType ===
                'clothing'
            ) {

                const genderMatches =
                    arrayMatches(
                        [gender],
                        selectedGenders
                    );


                const brandMatches =
                    arrayMatches(
                        [brand],
                        selectedBrands
                    );


                const sizeMatches =
                    arrayMatches(
                        sizes,
                        selectedSizes
                    );


                matches =
                    matches &&
                    genderMatches &&
                    brandMatches &&
                    sizeMatches;

            }


            /*
            |--------------------------------------------------------------------------
            | LACE
            |--------------------------------------------------------------------------
            */

            if (
                currentCategoryType ===
                'lace'
            ) {

                const laceCategoryMatches =
                    !selectedLaceCategory ||
                    productLaceCategory ===
                        selectedLaceCategory;


                const laceSubcategoryMatches =
                    arrayMatches(
                        laceSubcategories,
                        selectedSubcategories
                    );


                const widthMatches =
                    arrayMatches(
                        widths,
                        selectedWidths
                    );


                const heightMatches =
                    arrayMatches(
                        heights,
                        selectedHeights
                    );


                const lengthMatches =
                    arrayMatches(
                        lengths,
                        selectedLengths
                    );


                matches =
                    matches &&
                    laceCategoryMatches &&
                    laceSubcategoryMatches &&
                    widthMatches &&
                    heightMatches &&
                    lengthMatches;

            }


            /*
            |--------------------------------------------------------------------------
            | SHOW / HIDE
            |--------------------------------------------------------------------------
            */

            if (matches) {

                card.classList.remove(
                    'hidden'
                );

                visibleCount++;

            } else {

                card.classList.add(
                    'hidden'
                );

            }

        });


        /*
        |--------------------------------------------------------------------------
        | UPDATE PRODUCT COUNT
        |--------------------------------------------------------------------------
        */

        if (productCountText) {

            productCountText.textContent =
                'Showing ' +
                visibleCount +
                ' products';

        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE URL
        |--------------------------------------------------------------------------
        */

        updateFilterUrl();

    }


    /*
    |--------------------------------------------------------------------------
    | VERY IMPORTANT:
    | PREVENT FORM RELOAD
    |--------------------------------------------------------------------------
    */

    filterForm.addEventListener(
        'submit',
        function (event) {

            /*
            |--------------------------------------------------------------------------
            | STOP NORMAL GET FORM SUBMISSION
            |--------------------------------------------------------------------------
            */

            event.preventDefault();

            /*
            |--------------------------------------------------------------------------
            | FILTER USING JAVASCRIPT
            |--------------------------------------------------------------------------
            */

            filterProducts();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CHECKBOX FILTERS
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    | There is NO form.submit() here.
    |
    |--------------------------------------------------------------------------
    */

    filterForm
        .querySelectorAll(
            'input[type="checkbox"]'
        )
        .forEach(function (input) {

            input.addEventListener(
                'change',
                function () {

                    filterProducts();

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | LACE CATEGORY
    |--------------------------------------------------------------------------
    */

    if (laceCategory) {

        laceCategory.addEventListener(
            'change',
            function () {

                /*
                |--------------------------------------------------------------------------
                | Uncheck old lace subcategories
                |--------------------------------------------------------------------------
                */

                laceGroups.forEach(
                    function (group) {

                        group
                            .querySelectorAll(
                                'input[type="checkbox"]'
                            )
                            .forEach(
                                function (checkbox) {

                                    checkbox.checked =
                                        false;

                                }
                            );

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Show correct subcategory group
                |--------------------------------------------------------------------------
                */

                updateLaceSubcategories();


                /*
                |--------------------------------------------------------------------------
                | Filter immediately
                |--------------------------------------------------------------------------
                */

                filterProducts();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | SINGLE PRICE SLIDER
    |--------------------------------------------------------------------------
    */

    if (priceSlider) {

        priceSlider.addEventListener(
            'input',
            function () {

                updatePriceLabel();

                filterProducts();

            }
        );


        priceSlider.addEventListener(
            'change',
            function () {

                updatePriceLabel();

                filterProducts();

            }
        );


        updatePriceLabel();

    }


    /*
    |--------------------------------------------------------------------------
    | CLEAR FILTERS
    |--------------------------------------------------------------------------
    */

    const clearFilterElements =
        document.querySelectorAll(
            '[data-clear-filters], .clear-filters'
        );


    clearFilterElements.forEach(
        function (element) {

            element.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();


                    /*
                    |--------------------------------------------------------------------------
                    | Uncheck all checkboxes
                    |--------------------------------------------------------------------------
                    */

                    filterForm
                        .querySelectorAll(
                            'input[type="checkbox"]'
                        )
                        .forEach(
                            function (checkbox) {

                                checkbox.checked =
                                    false;

                            }
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | Reset lace category
                    |--------------------------------------------------------------------------
                    */

                    if (laceCategory) {

                        laceCategory.value = '';

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Hide lace subcategories
                    |--------------------------------------------------------------------------
                    */

                    laceGroups.forEach(
                        function (group) {

                            group.classList.add(
                                'hidden'
                            );

                        }
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Reset price
                    |--------------------------------------------------------------------------
                    */

                    if (priceSlider) {

                        priceSlider.value =
                            priceSlider.max;

                        updatePriceLabel();

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Filter immediately
                    |--------------------------------------------------------------------------
                    */

                    filterProducts();

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    updateLaceSubcategories();

    updatePriceLabel();

    filterProducts();

});

</script>

<style>

.price-range-slider {
    appearance: none;
    width: 100%;
    height: 4px;
    border-radius: 999px;
    background: #e5e7eb;
    outline: none;
    cursor: pointer;
}

.price-range-slider::-webkit-slider-thumb {
    appearance: none;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #000;
    border: 2px solid #fff;
    box-shadow: 0 0 0 1px #000;
    cursor: pointer;
}

.price-range-slider::-moz-range-thumb {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #000;
    border: 2px solid #fff;
    box-shadow: 0 0 0 1px #000;
    cursor: pointer;
}

</style>

@endsection