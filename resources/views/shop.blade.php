@extends('layouts.app')

@section('title', 'Shop | Bin Roshan')

@section(
    'description',
    'Explore clothing, jewelry, laces, watches and accessories at Bin Roshan.'
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

    $selectedJewelryGenders = request()->input('jewelry_gender', []);
    $selectedJewelryType = request()->input('jewelry_type', '');
    $selectedJewelrySubcategories = request()->input('jewelry_subcategories', []);
    $selectedJewelryQuality = request()->input('jewelry_quality', []);
    $selectedRingSizes = request()->input('ring_sizes', []);
    $selectedNecklaceLengths = request()->input('necklace_lengths', []);
    $selectedBraceletSizes = request()->input('bracelet_sizes', []);

    $selectedWatchGenders = request()->input('watch_gender', []);
    $selectedStrapMaterial = request()->input('strap_material', '');
    $selectedWatchType = request()->input('watch_type', '');

    $selectedOtherAccessoryButtons = request()->input('buttons', '');
    $selectedOtherAccessoryPipingClothes = request()->input('piping_clothes', '');
    $selectedOtherAccessoryType = request()->input('accessory_type', '');

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

    if (!is_array($selectedJewelryGenders)) {
        $selectedJewelryGenders = [$selectedJewelryGenders];
    }

    if (!is_array($selectedJewelrySubcategories)) {
        $selectedJewelrySubcategories = [$selectedJewelrySubcategories];
    }

    if (!is_array($selectedJewelryQuality)) {
        $selectedJewelryQuality = [$selectedJewelryQuality];
    }

    if (!is_array($selectedRingSizes)) {
        $selectedRingSizes = [$selectedRingSizes];
    }

    if (!is_array($selectedNecklaceLengths)) {
        $selectedNecklaceLengths = [$selectedNecklaceLengths];
    }

    if (!is_array($selectedBraceletSizes)) {
        $selectedBraceletSizes = [$selectedBraceletSizes];
    }

    if (!is_array($selectedWatchGenders)) {
        $selectedWatchGenders = [$selectedWatchGenders];
    }
@endphp


{{-- =========================================================
     SHOP HERO
========================================================= --}}

<section class="relative h-[55vh] min-h-[420px] sm:min-h-[500px] w-full overflow-hidden text-white">

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

        <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-12">

            <nav class="h-20 sm:h-24 flex items-center justify-between">

                {{-- LEFT SIDE --}}

                <div class="hidden lg:flex items-center gap-10 flex-1">

                    <a
                        href="{{ route('home') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Home
                    </a>

                    <a
                        href="{{ route('shop') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Shop
                    </a>

                    <a
                        href="{{ route('categories') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Categories
                    </a>

                </div>


                {{-- =================================================
                     CENTER LOGO
                ================================================== --}}

                <a
                    href="{{ route('home') }}"
                    class="absolute left-1/2 -translate-x-1/2 top-3 sm:top-5 max-w-[145px] sm:max-w-none">

                    <img
                        src="{{ asset('images/logo/logo.png') }}"
                        alt="Bin Ismail"
                        class="h-14 sm:h-16 lg:h-35 w-auto object-contain">

                </a>


                {{-- RIGHT SIDE --}}

                <div class="hidden lg:flex items-center justify-end gap-10 flex-1">

                    <a
                        href="{{ route('about') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        About
                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Contact
                    </a>


                    {{-- SEARCH --}}

                    <button
                        type="button"
                        onclick="openSearch()"
                        aria-label="Search"
                        class="text-white hover:text-[#BE8B3E] transition cursor-pointer">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                                stroke-width="1.7"/>

                            <path
                                d="m20 20-4-4"
                                stroke-width="1.7"
                                stroke-linecap="round"/>

                        </svg>

                    </button>


                    {{-- CART --}}

                    <button
                        type="button"
                        onclick="openCart()"
                        aria-label="Shopping bag"
                        class="relative text-white hover:text-[#BE8B3E] transition cursor-pointer">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                d="M6 8h12l1 13H5L6 8Z"
                                stroke-width="1.5"
                                stroke-linejoin="round"/>

                            <path
                                d="M9 8V6a3 3 0 0 1 6 0v2"
                                stroke-width="1.5"
                                stroke-linecap="round"/>

                        </svg>


                        {{-- CART COUNT --}}

                        <span
                            id="cart-count"
                            class="absolute -top-2 -right-3 min-w-[17px] h-[17px] px-1 rounded-full bg-white text-black text-[9px] flex items-center justify-center font-semibold">
                            0
                        </span>

                    </button>

                </div>


                {{-- =================================================
                     MOBILE MENU BUTTON
                ================================================== --}}

                <button
                    type="button"
                    onclick="openMobileMenu()"
                    class="lg:hidden text-white shrink-0"
                    aria-label="Open menu">

                    <svg
                        class="w-6 h-6 sm:w-7 sm:h-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            d="M4 7h16M4 12h16M4 17h16"
                            stroke-width="1.5"
                            stroke-linecap="round"/>

                    </svg>

                </button>


                {{-- MOBILE CART --}}

                <button
                    type="button"
                    onclick="openCart()"
                    class="lg:hidden relative text-white shrink-0"
                    aria-label="Shopping bag">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            d="M6 8h12l1 13H5L6 8Z"
                            stroke-width="1.5"
                            stroke-linejoin="round"/>

                        <path
                            d="M9 8V6a3 3 0 0 1 6 0v2"
                            stroke-width="1.5"
                            stroke-linecap="round"/>

                    </svg>

                    <span
                        id="cart-count-mobile"
                        class="absolute -top-2 -right-3 min-w-[17px] h-[17px] px-1 rounded-full bg-white text-black text-[9px] flex items-center justify-center font-semibold">
                        0
                    </span>

                </button>

            </nav>

        </div>

    </header>


    {{-- =====================================================
         HERO CONTENT
    ====================================================== --}}

    <div class="relative z-20 h-full flex items-center justify-center px-4 sm:px-6">

        <div class="text-center max-w-4xl w-full">

            <!-- <p class="text-xs sm:text-sm uppercase tracking-[0.45em] font-medium mb-6">
                The Collection
            </p> -->

            <h1 class="text-4xl sm:text-6xl lg:text-8xl font-light tracking-tight leading-tight">
                Shop <span class="text-[#BE8B3E] font-serif italic">Collections</span>
            </h1>

            <p class="mt-5 sm:mt-8 max-w-3xl mx-auto text-sm sm:text-base lg:text-lg leading-7 sm:leading-8 text-white/90 px-2">
                Explore our collection of clothing, jewelry, laces, watches
                and accessories — carefully selected for timeless style.
            </p>

        </div>

    </div>

</section>


{{-- =========================================================
     CATEGORY NAVIGATION
========================================================= --}}

<section class="bg-black border-b border-gray-200 sticky top-0 z-30">

    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">

        <div class="flex items-center justify-start sm:justify-center gap-1 sm:gap-8 overflow-x-auto py-3 sm:py-5 scrollbar-hide">

            {{-- ALL --}}

            <a
                href="{{ route('shop') }}"
                class="whitespace-nowrap shrink-0 px-3 sm:px-4 py-2 text-[10px] sm:text-xs uppercase tracking-widest font-semibold
                {{ !$selectedCategory
                    ? 'text-[#BE8B3E] border-b-2 border-[#BE8B3E]'
                    : 'text-[#BE8B3E] hover:text-white' }}">
                All
            </a>


            {{-- DATABASE CATEGORIES --}}

            @foreach($categories as $category)

                <a
                    href="{{ route('shop', ['category' => $category->slug]) }}"
                    class="whitespace-nowrap shrink-0 px-3 sm:px-4 py-2 text-[10px] sm:text-xs uppercase tracking-widest
                    {{ $selectedCategory?->id === $category->id
                        ? 'text-[#BE8B3E] font-semibold border-b-2 border-[#BE8B3E]'
                        : 'text-[#BE8B3E] hover:text-white' }}">
                    {{ $category->name }}
                </a>

            @endforeach

        </div>

    </div>

</section>


{{-- =========================================================
     SHOP AREA
========================================================= --}}

<section class="py-12 sm:py-16 lg:py-20 bg-[#f8f7f4]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        {{-- =====================================================
             TOP BAR
        ====================================================== --}}

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 sm:gap-6 mb-8 sm:mb-10">

            <div class="min-w-0">

                <p class="text-[10px] sm:text-xs uppercase tracking-[0.3em] sm:tracking-[0.35em] text-[#BE8B3E] font-semibold">
                    {{ $selectedCategory?->name ?? 'All Collection' }}
                </p>

                <h2 class="mt-2 sm:mt-3 text-2xl sm:text-3xl lg:text-4xl font-light">
                    Shop Products
                </h2>

                <p class="mt-2 text-xs sm:text-sm text-gray-500">
                    Showing <span id="shop-products-count">{{ $products->count() }}</span> products
                </p>

            </div>


            {{-- SORT --}}

            <form
                method="GET"
                action="{{ route('shop') }}"
                class="flex items-center gap-3 w-full lg:w-auto">

                @if(request('category'))
                    <input
                        type="hidden"
                        name="category"
                        value="{{ request('category') }}">
                @endif

                @if(request('search'))
                    <input
                        type="hidden"
                        name="search"
                        value="{{ request('search') }}">
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
                    class="w-full lg:w-auto min-w-0 border border-gray-300 bg-white px-4 sm:px-5 py-3 text-sm focus:outline-none focus:border-black rounded-lg">

                    <option
                        value=""
                        {{ !request('sort') ? 'selected' : '' }}>
                        Sort: Latest
                    </option>

                    <option
                        value="featured"
                        {{ request('sort') === 'featured' ? 'selected' : '' }}>
                        Sort: Featured
                    </option>

                    <option
                        value="price_low"
                        {{ in_array(request('sort'), ['price_low', 'low']) ? 'selected' : '' }}>
                        Price: Low to High
                    </option>

                    <option
                        value="price_high"
                        {{ in_array(request('sort'), ['price_high', 'high']) ? 'selected' : '' }}>
                        Price: High to Low
                    </option>

                    <option
                        value="name"
                        {{ request('sort') === 'name' ? 'selected' : '' }}>
                        Name: A-Z
                    </option>

                </select>

            </form>

        </div>


        {{-- =====================================================
             FILTER + PRODUCTS
        ====================================================== --}}

        <div class="grid grid-cols-1 lg:grid-cols-[270px_minmax(0,1fr)] gap-8 sm:gap-10">


            {{-- =================================================
                 FILTER SIDEBAR
            ================================================== --}}

            <aside class="min-w-0">

                <form
                    method="GET"
                    action="{{ route('shop') }}"
                    class="border border-gray-200 p-4 sm:p-6 bg-white lg:sticky lg:top-28 rounded-lg">

                    {{-- KEEP CATEGORY --}}

                    @if($selectedCategory)

                        <input
                            type="hidden"
                            name="category"
                            value="{{ $selectedCategory->slug }}">

                    @endif


                    {{-- KEEP SEARCH --}}

                    @if(request('search'))

                        <input
                            type="hidden"
                            name="search"
                            value="{{ request('search') }}">

                    @endif


                    @if(request('sort'))

                        <input
                            type="hidden"
                            name="sort"
                            value="{{ request('sort') }}">

                    @endif


                    {{-- FILTER TITLE --}}

                    <div class="flex items-center justify-between mb-6 sm:mb-7">

                        <div>

                            <p class="text-[10px] sm:text-xs uppercase tracking-[0.25em] sm:tracking-[0.3em] text-[#BE8B3E]">
                                Refine
                            </p>

                            <h3 class="mt-2 text-base sm:text-lg font-medium">
                                Filters
                            </h3>

                        </div>

                    </div>


                    {{-- =================================================
                         PRICE RANGE
                    ================================================== --}}

                    <div class="border-t border-gray-200 pt-5 sm:pt-6">

                        <div class="flex items-start justify-between gap-3">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700">
                                Price
                            </p>

                            <span
                                id="price-range-label"
                                class="text-[10px] sm:text-xs text-[#BE8B3E] text-right">
                                Up to PKR {{ number_format($selectedMaxPrice) }}
                            </span>

                        </div>

                        {{-- SINGLE PRICE SLIDER --}}

                        <div class="relative mt-6 sm:mt-7 h-5">

                            <div
                                class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -translate-y-1/2 rounded-full">
                            </div>

                            <div
                                id="price-active-track"
                                class="absolute top-1/2 left-0 h-1 bg-[#BE8B3E] -translate-y-1/2 rounded-full">
                            </div>

                            <input
                                type="range"
                                id="price-slider"
                                min="{{ $priceMin }}"
                                max="{{ $priceMax }}"
                                value="{{ $selectedMaxPrice }}"
                                step="1"
                                class="price-slider absolute inset-0 w-full appearance-none bg-transparent">

                        </div>

                        <input
                            type="hidden"
                            name="max_price"
                            id="max-price-input"
                            value="{{ $selectedMaxPrice }}">

                        <div class="flex items-center justify-between mt-3 gap-2">

                            <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-gray-400">
                                PKR {{ number_format($priceMin) }}
                            </span>

                            <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-gray-400 text-right">
                                PKR {{ number_format($priceMax) }}
                            </span>

                        </div>

                    </div>


                    @if(!$selectedCategory)

                    {{-- =================================================
                         CATEGORY PRIORITY FILTERS
                    ================================================== --}}

                    <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                        <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                            Categories
                        </p>

                        <div class="space-y-3">

                            @foreach($categories as $category)

                                <label class="flex items-start gap-3 cursor-pointer">

                                    <input
                                        type="checkbox"
                                        class="shop-category-filter w-4 h-4 shrink-0 gender-checkbox"
                                        data-category-slug="{{ $category->slug }}">

                                    <span class="text-sm text-gray-700 min-w-0 break-words">
                                        {{ $category->name }}
                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>


                    {{-- =================================================
                         FEATURED / SALE FILTERS
                    ================================================== --}}

                    <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                        <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                            Highlights
                        </p>

                        <div class="space-y-3">

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input
                                    type="radio"
                                    name="shop-highlight-filter"
                                    value="featured"
                                    class="shop-highlight-filter w-4 h-4 shrink-0 gender-checkbox">

                                <span class="text-sm text-gray-700">
                                    Featured
                                </span>

                            </label>

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input
                                    type="radio"
                                    name="shop-highlight-filter"
                                    value="sale"
                                    class="shop-highlight-filter w-4 h-4 shrink-0 gender-checkbox">

                                <span class="text-sm text-gray-700">
                                    Sale
                                </span>

                            </label>

                        </div>

                    </div>


                    @endif


                    {{-- =================================================
                         CLOTHING FILTERS
                    ================================================== --}}

                    @if($categoryType === 'clothing')

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
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
                                            class="gender-checkbox w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700">
                                            {{ $label }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>


                        {{-- BRAND --}}

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Brand
                            </p>

                            <div class="space-y-3">

                                @forelse($clothingBrands as $brand)

                                    <label class="flex items-start gap-3 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="brand[]"
                                            value="{{ $brand }}"
                                            {{ in_array($brand, $selectedBrands) ? 'checked' : '' }}
                                            class="gender-checkbox w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700 min-w-0 break-words">
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

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
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
                                            class="peer sr-only">

                                        <span
                                            class="inline-flex min-w-[42px] sm:min-w-[45px] justify-center border border-gray-300 px-3 sm:px-4 py-2 text-xs
                                            peer-checked:bg-[#BE8B3E] peer-checked:text-white peer-checked:border-[#BE8B3E]">
                                            {{ $size }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         JEWELRY FILTERS
                    ================================================== --}}

                    @if($categoryType === 'jewelry')

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Gender
                            </p>

                            <div class="space-y-3">

                                @foreach(['men' => 'Men', 'women' => 'Women'] as $value => $label)

                                    <label class="flex items-center gap-3 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="jewelry_gender[]"
                                            value="{{ $value }}"
                                            {{ in_array($value, $selectedJewelryGenders) ? 'checked' : '' }}
                                            class="gender-checkbox w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700">
                                            {{ $label }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Jewelry Type
                            </p>

                            <select
                                name="jewelry_type"
                                id="jewelry_type"
                                class="w-full min-w-0 border border-gray-200 bg-white px-3 py-3 text-sm focus:outline-none focus:border-black rounded-lg">

                                <option value="">All Jewelry Types</option>

                                <option value="earrings" {{ $selectedJewelryType === 'earrings' ? 'selected' : '' }}>
                                    Earrings
                                </option>

                                <option value="necklaces" {{ $selectedJewelryType === 'necklaces' ? 'selected' : '' }}>
                                    Necklaces
                                </option>

                                <option value="rings" {{ $selectedJewelryType === 'rings' ? 'selected' : '' }}>
                                    Rings
                                </option>

                                <option value="bracelets" {{ $selectedJewelryType === 'bracelets' ? 'selected' : '' }}>
                                    Bracelets
                                </option>

                            </select>

                        </div>

                        <div
                            id="shop-jewelry-subcategories"
                            class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7 {{ $selectedJewelryType ? '' : 'hidden' }}">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Subcategories
                            </p>

                            <div
                                id="shop-jewelry-subcategory-list"
                                class="space-y-3">
                            </div>

                        </div>

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Product Type / Quality
                            </p>

                            <div class="space-y-3">

                                @foreach($jewelryQualities as $value => $label)

                                    <label class="flex items-start gap-3 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="jewelry_quality[]"
                                            value="{{ $value }}"
                                            {{ in_array($value, $selectedJewelryQuality) ? 'checked' : '' }}
                                            class="gender-checkbox w-4 h-4 mt-0.5 shrink-0">

                                        <span class="text-sm text-gray-700 min-w-0 break-words">
                                            {{ $label }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                        <div
                            class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7 {{ $selectedJewelryType === 'rings' ? '' : 'hidden' }}"
                            data-shop-jewelry-size="rings">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Ring Size
                            </p>

                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">

                                @forelse($jewelryRingSizes as $size)

                                    <label class="flex items-center gap-2 cursor-pointer min-w-0">

                                        <input
                                            type="checkbox"
                                            name="ring_sizes[]"
                                            value="{{ $size }}"
                                            {{ in_array($size, $selectedRingSizes) ? 'checked' : '' }}
                                            class="w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700 break-words">
                                            {{ $size }}
                                        </span>

                                    </label>

                                @empty

                                    <p class="text-sm text-gray-400 col-span-2 sm:col-span-3">
                                        No ring sizes available.
                                    </p>

                                @endforelse

                            </div>

                        </div>

                        <div
                            class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7 {{ $selectedJewelryType === 'necklaces' ? '' : 'hidden' }}"
                            data-shop-jewelry-size="necklaces">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Chain / Necklace Length
                            </p>

                            <div class="space-y-3">

                                @forelse($jewelryNecklaceLengths as $length)

                                    <label class="flex items-center gap-3 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="necklace_lengths[]"
                                            value="{{ $length }}"
                                            {{ in_array($length, $selectedNecklaceLengths) ? 'checked' : '' }}
                                            class="w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700">
                                            {{ $length }}
                                        </span>

                                    </label>

                                @empty

                                    <p class="text-sm text-gray-400">
                                        No necklace lengths available.
                                    </p>

                                @endforelse

                            </div>

                        </div>

                        <div
                            class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7 {{ $selectedJewelryType === 'bracelets' ? '' : 'hidden' }}"
                            data-shop-jewelry-size="bracelets">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Bracelet / Bangle Size
                            </p>

                            <div class="space-y-3">

                                @forelse($jewelryBraceletSizes as $size)

                                    <label class="flex items-center gap-3 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="bracelet_sizes[]"
                                            value="{{ $size }}"
                                            {{ in_array($size, $selectedBraceletSizes) ? 'checked' : '' }}
                                            class="w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700">
                                            {{ $size }}
                                        </span>

                                    </label>

                                @empty

                                    <p class="text-sm text-gray-400">
                                        No bracelet/bangle sizes available.
                                    </p>

                                @endforelse

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         WATCH FILTERS
                    ================================================== --}}

                    @if($categoryType === 'watches')

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Gender
                            </p>

                            <div class="space-y-3">

                                @foreach(['men' => 'Men', 'women' => 'Women', 'kids' => 'Kids'] as $value => $label)

                                    <label class="flex items-center gap-3 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="watch_gender[]"
                                            value="{{ $value }}"
                                            {{ in_array($value, $selectedWatchGenders) ? 'checked' : '' }}
                                            class="gender-checkbox w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700">
                                            {{ $label }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Strap Material
                            </p>

                            <select
                                name="strap_material"
                                id="shop-strap-material"
                                class="w-full min-w-0 border border-gray-200 bg-white px-3 py-3 text-sm focus:outline-none focus:border-black">

                                <option value="">
                                    All Strap Materials
                                </option>

                                @foreach($watchStrapMaterials as $value => $label)

                                    <option
                                        value="{{ $value }}"
                                        {{ $selectedStrapMaterial === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Watch Type
                            </p>

                            <div class="space-y-3">

                                @foreach($watchTypes as $value => $label)

                                    <label class="flex items-start gap-3 cursor-pointer">

                                        <input
                                            type="radio"
                                            name="watch_type"
                                            value="{{ $value }}"
                                            {{ $selectedWatchType === $value ? 'checked' : '' }}
                                            class="gender-checkbox w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700 min-w-0 break-words">
                                            {{ $label }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         OTHER ACCESSORIES FILTERS
                    ================================================== --}}

                    @if($categoryType === 'other_accessories')

                        {{-- BUTTONS --}}

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Buttons
                            </p>

                            <select
                                name="buttons"
                                id="shop-buttons"
                                class="w-full min-w-0 border border-gray-200 bg-white px-3 py-3 text-sm focus:outline-none focus:border-black">

                                <option value="">
                                    All Buttons
                                </option>

                                @foreach($otherAccessoryButtons as $value => $label)

                                    <option
                                        value="{{ $value }}"
                                        {{ $selectedOtherAccessoryButtons === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- PIPING CLOTHES --}}

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Piping Clothes
                            </p>

                            <select
                                name="piping_clothes"
                                id="shop-piping-clothes"
                                class="w-full min-w-0 border border-gray-200 bg-white px-3 py-3 text-sm focus:outline-none focus:border-black">

                                <option value="">
                                    All Piping Clothes
                                </option>

                                @foreach($otherAccessoryPipingClothes as $value => $label)

                                    <option
                                        value="{{ $value }}"
                                        {{ $selectedOtherAccessoryPipingClothes === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- ACCESSORY TYPE --}}

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Accessory Type
                            </p>

                            <div class="space-y-3">

                                @foreach($otherAccessoryTypes as $value => $label)

                                    <label class="flex items-start gap-3 cursor-pointer">

                                        <input
                                            type="radio"
                                            name="accessory_type"
                                            value="{{ $value }}"
                                            {{ $selectedOtherAccessoryType === $value ? 'checked' : '' }}
                                            class="gender-checkbox w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700 min-w-0 break-words">
                                            {{ $label }}
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

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Product Type
                            </p>

                            <select
                                name="cosmetic_product_type"
                                class="w-full min-w-0 border border-gray-200 bg-white px-3 py-3 text-sm focus:outline-none focus:border-black">

                                <option value="">All Product Types</option>

                                @foreach([
                                    'makeup' => 'Makeup',
                                    'skincare' => 'Skincare',
                                    'haircare' => 'Haircare',
                                    'fragrance' => 'Fragrance',
                                    'body_care' => 'Body Care',
                                    'nail_care' => 'Nail Care'
                                ] as $value => $label)

                                    <option
                                        value="{{ $value }}"
                                        {{ $selectedCosmeticProductType === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Brand
                            </p>

                            <div class="space-y-3">

                                @forelse($cosmeticBrands as $brand)

                                    <label class="flex items-start gap-3 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="brand[]"
                                            value="{{ $brand }}"
                                            {{ in_array($brand, $selectedBrands) ? 'checked' : '' }}
                                            class="gender-checkbox w-4 h-4 shrink-0">

                                        <span class="text-sm text-gray-700 min-w-0 break-words">
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

                        @foreach([
                            'skin_types' => [
                                'title' => 'Skin Type',
                                'options' => [
                                    'all_skin_types' => 'All Skin Types',
                                    'oily' => 'Oily',
                                    'dry' => 'Dry',
                                    'combination' => 'Combination',
                                    'sensitive' => 'Sensitive'
                                ],
                                'selected' => $selectedSkinTypes
                            ],
                            'concerns' => [
                                'title' => 'Concern / Benefit',
                                'options' => [
                                    'hydration' => 'Hydration',
                                    'brightening' => 'Brightening',
                                    'acne_blemishes' => 'Acne & Blemishes',
                                    'oil_control' => 'Oil Control',
                                    'anti_aging' => 'Anti-Aging',
                                    'sun_protection' => 'Sun Protection',
                                    'hair_fall' => 'Hair Fall',
                                    'frizz_control' => 'Frizz Control'
                                ],
                                'selected' => $selectedConcerns
                            ],
                            'product_forms' => [
                                'title' => 'Product Form',
                                'options' => [
                                    'cream' => 'Cream',
                                    'gel' => 'Gel',
                                    'serum' => 'Serum',
                                    'lotion' => 'Lotion',
                                    'powder' => 'Powder',
                                    'liquid' => 'Liquid',
                                    'spray' => 'Spray',
                                    'stick' => 'Stick'
                                ],
                                'selected' => $selectedProductForms
                            ]
                        ] as $field => $data)

                            <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                                <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                    {{ $data['title'] }}
                                </p>

                                <div class="space-y-3">

                                    @foreach($data['options'] as $value => $label)

                                        <label class="flex items-start gap-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="{{ $field }}[]"
                                                value="{{ $value }}"
                                                {{ in_array($value, $data['selected']) ? 'checked' : '' }}
                                                class="gender-checkbox w-4 h-4 shrink-0">

                                            <span class="text-sm text-gray-700 min-w-0 break-words">
                                                {{ $label }}
                                            </span>

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

                        <div class="mt-6 sm:mt-7 border-t border-gray-200 pt-6 sm:pt-7">

                            <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4 sm:mb-5">
                                Lace Information
                            </p>


                            {{-- LACE CATEGORY DROPDOWN --}}

                            <label
                                for="lace_category"
                                class="block text-xs text-gray-500 mb-2">
                                Lace Category
                            </label>

                            <select
                                name="lace_category"
                                id="lace_category"
                                class="w-full min-w-0 border border-gray-200 bg-white px-3 py-3 text-sm focus:outline-none focus:border-black">

                                <option value="">
                                    Select Lace Category
                                </option>

                                <option
                                    value="basic_everyday"
                                    {{ request('lace_category') === 'basic_everyday' ? 'selected' : '' }}>
                                    Basic & Everyday Laces
                                </option>

                                <option
                                    value="embroidered"
                                    {{ request('lace_category') === 'embroidered' ? 'selected' : '' }}>
                                    Embroidered Laces
                                </option>

                                <option
                                    value="fancy"
                                    {{ request('lace_category') === 'fancy' ? 'selected' : '' }}>
                                    Fancy Laces
                                </option>

                                <option
                                    value="traditional"
                                    {{ request('lace_category') === 'traditional' ? 'selected' : '' }}>
                                    Traditional Laces
                                </option>

                                <option
                                    value="suit_specific"
                                    {{ request('lace_category') === 'suit_specific' ? 'selected' : '' }}>
                                    Suit-Specific Laces
                                </option>

                                <option
                                    value="premium_bridal"
                                    {{ request('lace_category') === 'premium_bridal' ? 'selected' : '' }}>
                                    Premium / Bridal
                                </option>

                            </select>


                            {{-- SUBCATEGORIES --}}

                            <div
                                id="lace-subcategories-container"
                                class="mt-5 sm:mt-6">

                                <p class="text-xs text-gray-400 mb-4">
                                    Select subcategories
                                </p>


                                {{-- BASIC --}}

                                <div
                                    data-lace-group="basic_everyday"
                                    class="lace-subcategory-group hidden">

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
                                                class="w-4 h-4 shrink-0 gender-checkbox">

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- EMBROIDERED --}}

                                <div
                                    data-lace-group="embroidered"
                                    class="lace-subcategory-group hidden">

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
                                                class="w-4 h-4 shrink-0 gender-checkbox">

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- FANCY --}}

                                <div
                                    data-lace-group="fancy"
                                    class="lace-subcategory-group hidden">

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
                                                class="w-4 h-4 shrink-0 gender-checkbox">

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- TRADITIONAL --}}

                                <div
                                    data-lace-group="traditional"
                                    class="lace-subcategory-group hidden">

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
                                                class="w-4 h-4 shrink-0 gender-checkbox">

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- SUIT SPECIFIC --}}

                                <div
                                    data-lace-group="suit_specific"
                                    class="lace-subcategory-group hidden">

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
                                                class="w-4 h-4 shrink-0 gender-checkbox">

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>


                                {{-- PREMIUM / BRIDAL --}}

                                <div
                                    data-lace-group="premium_bridal"
                                    class="lace-subcategory-group hidden">

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
                                                class="w-4 h-4 shrink-0 gender-checkbox">

                                            <span class="text-sm text-gray-700">
                                                {{ $label }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </div>


                            {{-- WIDTH --}}

                            <div class="mt-6 sm:mt-7">

                                <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4">
                                    Width
                                </p>

                                <div class="space-y-3">

                                    @forelse($laceWidths as $width)

                                        <label class="flex items-start gap-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="width[]"
                                                value="{{ $width }}"
                                                {{ in_array($width, $selectedWidths) ? 'checked' : '' }}
                                                class="w-4 h-4 shrink-0 gender-checkbox">

                                            <span class="text-sm text-gray-700 min-w-0 break-words">
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


                            {{-- HEIGHT --}}

                            <div class="mt-6 sm:mt-7">

                                <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4">
                                    Height
                                </p>

                                <div class="space-y-3">

                                    @forelse($laceHeights as $height)

                                        <label class="flex items-start gap-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="height[]"
                                                value="{{ $height }}"
                                                {{ in_array($height, $selectedHeights) ? 'checked' : '' }}
                                                class="w-4 h-4 shrink-0 gender-checkbox">

                                            <span class="text-sm text-gray-700 min-w-0 break-words">
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


                            {{-- LENGTH --}}

                            <div class="mt-6 sm:mt-7">

                                <p class="text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-gray-700 mb-4">
                                    Length
                                </p>

                                <div class="space-y-3">

                                    @forelse($laceLengths as $length)

                                        <label class="flex items-start gap-3 cursor-pointer">

                                            <input
                                                type="checkbox"
                                                name="length[]"
                                                value="{{ $length }}"
                                                {{ in_array($length, $selectedLengths) ? 'checked' : '' }}
                                                class="w-4 h-4 shrink-0 gender-checkbox">

                                            <span class="text-sm text-gray-700 min-w-0 break-words">
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
                         CLEAR
                    ================================================== --}}

                    @if(request()->hasAny([
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
                            'jewelry_gender',
                            'jewelry_type',
                            'jewelry_subcategories',
                            'jewelry_quality',
                            'ring_sizes',
                            'necklace_lengths',
                            'bracelet_sizes',
                            'buttons',
                            'piping_clothes',
                            'accessory_type',
                            'sort'
                        ])
                    )

                        <a
                            href="{{ $selectedCategory
                                ? route('shop', ['category' => $selectedCategory->slug])
                                : route('shop') }}"
                            class="js-ajax-clear-filters block text-center mt-4 text-xs uppercase tracking-widest text-gray-500 hover:text-black">
                            Clear Filters
                        </a>

                    @endif

                </form>

            </aside>


            {{-- =================================================
                 PRODUCT GRID
            ================================================== --}}

            <div
                id="shop-products-content"
                class="relative min-h-[120px] min-w-0 transition-opacity duration-200">

                @if($products->count())

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-x-3 sm:gap-x-6 gap-y-10 sm:gap-y-12">

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


                            @php

                                $productSkinTypes = is_array($product->skin_types)
                                    ? $product->skin_types
                                    : [];

                                $productConcerns = is_array($product->concerns)
                                    ? $product->concerns
                                    : [];

                                $productForms = is_array($product->product_forms)
                                    ? $product->product_forms
                                    : [];

                            @endphp

                            <article
                                class="group product-card min-w-0"
                                data-cosmetic-product-type="{{ $product->cosmetic_product_type ?? '' }}"
                                data-cosmetic-skin-types="{{ implode(',', $productSkinTypes) }}"
                                data-cosmetic-concerns="{{ implode(',', $productConcerns) }}"
                                data-cosmetic-product-forms="{{ implode(',', $productForms) }}"
                                data-brand="{{ $product->brand ?? '' }}"
                                data-category-slug="{{ $product->category?->slug ?? '' }}"
                                data-price="{{ (float) $productPrice }}"
                                data-featured="{{ $product->is_featured ? '1' : '0' }}"
                                data-sale="{{ ($product->sale_price && $product->price > $product->sale_price) ? '1' : '0' }}">

                                {{-- IMAGE --}}

                                <div class="relative overflow-hidden bg-gray-100 aspect-[4/5] rounded-lg">

                                    <a
                                        href="{{ route(
                                            'product.show',
                                            $product->slug
                                        ) }}"
                                        class="block w-full h-full">

                                        <img
                                            src="{{ $imageUrl }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full rounded-xl object-cover transition duration-700 group-hover:scale-105"
                                            loading="lazy"
                                            onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';">

                                    </a>


                                    {{-- FEATURED --}}

                                    @if($product->is_featured)

                                        <span
                                            class="absolute top-2 left-2 sm:top-4 sm:left-4 bg-black text-white text-[8px] sm:text-[10px] uppercase tracking-widest px-2 sm:px-3 py-1.5 sm:py-2">
                                            Featured
                                        </span>

                                    @endif


                                    {{-- SALE --}}

                                    @if(
                                        $product->sale_price &&
                                        $product->price > $product->sale_price
                                    )

                                        <span
                                            class="absolute top-2 right-2 sm:top-4 sm:right-4 bg-[#b38b2c] text-white text-[8px] sm:text-[10px] uppercase tracking-widest px-2 sm:px-3 py-1.5 sm:py-2">
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
                                        class="absolute bottom-2 left-2 right-2 sm:bottom-4 sm:left-4 sm:right-4 border border-[#BE8B3E] backdrop-blur text-[#BE8B3E] hover:bg-[#BE8B3E] hover:text-white cursor-pointer rounded-full py-2.5 sm:py-3 text-[9px] sm:text-xs font-semibold uppercase tracking-widest opacity-100 translate-y-0 sm:opacity-0 sm:translate-y-3 sm:group-hover:opacity-100 sm:group-hover:translate-y-0 transition duration-300">
                                        Add to Bag
                                    </button>

                                </div>


                                {{-- DETAILS --}}

                                <div class="pt-4 sm:pt-5 min-w-0">

                                    <p class="text-[9px] sm:text-[10px] uppercase tracking-widest text-[#BE8B3E] truncate">
                                        {{ $product->category?->name ?? 'Product' }}
                                    </p>

                                    <h3 class="mt-1.5 sm:mt-2 text-xs sm:text-sm font-medium text-gray-900 leading-5 min-w-0">

                                        <a
                                            href="{{ route(
                                                'product.show',
                                                $product->slug
                                            ) }}"
                                            class="hover:opacity-60 transition break-words">
                                            {{ $product->name }}
                                        </a>

                                    </h3>


                                    <div class="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1">

                                        @if(
                                            $product->sale_price &&
                                            $product->price > $product->sale_price
                                        )

                                            <span class="text-xs sm:text-sm text-black">
                                                PKR {{ number_format($product->sale_price) }}
                                            </span>

                                            <span class="text-[10px] sm:text-xs text-gray-400 line-through">
                                                PKR {{ number_format($product->price) }}
                                            </span>

                                        @else

                                            <span class="text-xs sm:text-sm text-gray-600">
                                                PKR {{ number_format($product->price) }}
                                            </span>

                                        @endif

                                    </div>


                                    {{-- WHATSAPP --}}

                                    <button
                                        type="button"
                                        onclick="orderOnWhatsApp(@json($product->name))"
                                        class="mt-3 sm:mt-4 text-[9px] sm:text-[10px] uppercase cursor-pointer tracking-widest text-gray-400 hover:text-[#25D366] transition text-left">
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

                    <div class="py-20 sm:py-24 text-center px-4">

                        <div class="mx-auto w-14 h-14 sm:w-16 sm:h-16 border border-gray-300 rounded-full flex items-center justify-center">

                            <svg
                                class="w-5 h-5 sm:w-6 sm:h-6 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <circle
                                    cx="11"
                                    cy="11"
                                    r="7"
                                    stroke-width="1.5"/>

                                <path
                                    stroke-linecap="round"
                                    stroke-width="1.5"
                                    d="m20 20-4-4"/>

                            </svg>

                        </div>

                        <h3 class="mt-5 sm:mt-6 text-lg sm:text-xl font-light">
                            No products found
                        </h3>

                        <p class="mt-2 text-xs sm:text-sm text-gray-500">
                            Try changing or clearing your filters.
                        </p>

                        <a
                            href="{{ $selectedCategory
                                ? route('shop', ['category' => $selectedCategory->slug])
                                : route('shop') }}"
                            class="js-ajax-clear-filters inline-flex mt-6 sm:mt-7 border border-black px-5 sm:px-6 py-3 text-[10px] sm:text-xs uppercase tracking-widest hover:bg-black hover:text-white transition">
                            Clear Filters
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     FLOATING WHATSAPP BUTTON
========================================================= --}}

<a
    href="https://wa.me/{{ config('store.whatsapp') }}?text={{ urlencode('Hello Bin Roshan, I would like to know more about your products.') }}"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Chat with Bin Roshan on WhatsApp"
    class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 w-12 h-12 sm:w-14 sm:h-14 bg-[#BE8B3E] text-white rounded-full shadow-xl flex items-center justify-center hover:scale-110 transition duration-300">

    <svg
        viewBox="0 0 24 24"
        fill="currentColor"
        class="w-6 h-6 sm:w-7 sm:h-7">

        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.1-.198.05-.372-.025-.521-.075-.149-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.002 5.45-4.438 9.884-9.889 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.304-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.478-8.413"/>

    </svg>

</a>


{{-- =========================================================
     JEWELRY CATEGORY JAVASCRIPT
========================================================= --}}

<script>
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

    const selected = @json($selectedJewelrySubcategories);

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
</script>


{{-- =========================================================
     LACE CATEGORY JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const filterForm = document.querySelector(
        'aside form[action="{{ route('shop') }}"]'
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
        'aside form[action="{{ route('shop') }}"]'
    );

    const sortForm = document.querySelector(
        'form[action="{{ route('shop') }}"] select[name="sort"]'
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

        const targetUrl =
            queryString
                ? '{{ route('shop') }}?' + queryString
                : '{{ route('shop') }}';


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
                '{{ route('shop') }}';


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
</script>


{{-- =========================================================
     WHATSAPP ORDER
========================================================= --}}

<script>

function orderOnWhatsApp(productName) {

    const phone =
        "{{ config('store.whatsapp') }}";


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
        background: #BE8B3E;
        cursor: pointer;
        pointer-events: auto;
        border: 2px solid #fff;
        box-shadow: 0 0 0 1px #BE8B3E;
    }


    .price-slider::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border-radius: 9999px;
        background: #BE8B3E;
        cursor: pointer;
        pointer-events: auto;
        border: 2px solid #fff;
        box-shadow: 0 0 0 1px #BE8B3E;
    }


    .gender-checkbox {
        accent-color: #BE8B3E;
    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE HORIZONTAL SCROLLBAR
    |--------------------------------------------------------------------------
    */

    .scrollbar-hide {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }


    /*
    |--------------------------------------------------------------------------
    | VERY SMALL PHONES
    |--------------------------------------------------------------------------
    */

    @media (max-width: 380px) {

        .price-slider::-webkit-slider-thumb {
            width: 16px;
            height: 16px;
        }

        .price-slider::-moz-range-thumb {
            width: 16px;
            height: 16px;
        }

    }

</style>

@endsection