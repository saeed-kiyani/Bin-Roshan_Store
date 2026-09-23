@extends('layouts.app')

@section('title', 'Bin Roshan | Fashion, Jewelry & Accessories')

@section('description', 'Discover elegant clothing, jewelry, laces, watches and accessories at Bin Ismail.')

@section('content')

{{-- =========================================================
     FULL SCREEN VIDEO HERO
========================================================= --}}

<section class="relative min-h-screen h-screen overflow-hidden bg-black">

    {{-- =====================================================
         BACKGROUND VIDEO
    ====================================================== --}}

    <video
        autoplay
        muted
        loop
        playsinline
        class="absolute inset-0 w-full h-full object-cover">
        <source
            src="{{ asset('videos/hero.mp4') }}"
            type="video/mp4">

        Your browser does not support the video tag.
    </video>


    {{-- =====================================================
         VIDEO OVERLAY
         Keeps text readable while keeping video visible
    ====================================================== --}}

    <div class="absolute inset-0 bg-black/25"></div>

    <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-transparent to-black/20"></div>


    {{-- =====================================================
          TRANSPARENT NAVIGATION
    ====================================================== --}}
    <header class="absolute top-0 left-0 right-0 z-40">

        <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-12">

            <nav class="h-24 flex items-center justify-between">

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
                    class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 -mt-2">

                    <img
                        src="{{ asset('images/logo/logo.png') }}"
                        alt="Bin Ismail"
                        class="h-14 sm:h-16 lg:h-35 max-w-[150px] sm:max-w-none w-auto object-contain">

                </a>


                {{-- RIGHT SIDE --}}

                <div class="hidden lg:flex items-center justify-end gap-10 flex-1">

                    <a
                        href="{{ route('about') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        About
                    </a>

                    <a href="{{ route('blog.index') }}"
                       class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                       Blogs
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
                        class="w-7 h-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            d="M4 7h16M4 12h16M4 17h16"
                            stroke-width="1.5"
                            stroke-linecap="round"/>

                    </svg>

                </button>


                {{-- MOBILE RIGHT ICONS (SEARCH + CART) --}}

                <div class="lg:hidden flex items-center gap-5">

                    {{-- SEARCH --}}

                    <button
                        type="button"
                        onclick="openSearch()"
                        aria-label="Search"
                        class="relative text-white shrink-0">

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

                    {{-- MOBILE CART --}}

                    <button
                        type="button"
                        onclick="openCart()"
                        aria-label="Shopping bag"
                        class="relative text-white shrink-0">

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

                </div>

            </nav>

        </div>

    </header>


    {{-- =====================================================
         HERO CONTENT — BOTTOM LEFT
    ====================================================== --}}

    <div class="absolute inset-x-0 bottom-0 z-20">

        <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-12 pb-8 sm:pb-12 lg:pb-8">

            <div class="max-w-xl text-white min-w-0">

                {{-- SMALL LABEL --}}

                <p class="text-[10px] xs:text-xs sm:text-sm uppercase tracking-[0.25em] sm:tracking-[0.4em] font-medium opacity-90">
                    Welcome to <span class="text-[#BE8B3E] font-bold">Bin Roshan</span>
                </p>


                {{-- MAIN HEADING --}}

                <h1 class="mt-3 sm:mt-4 text-4xl sm:text-6xl lg:text-7xl xl:text-8xl font-light leading-[0.95] tracking-tight">
                    Elegance
                    <br>
                    That <span class="text-[#BE8B3E] font-serif italic">Speaks.</span>
                </h1>


                {{-- DESCRIPTION --}}

                <p class="mt-5 sm:mt-6 max-w-md text-xs sm:text-base leading-6 sm:leading-7 text-white/85">

                    Discover a carefully selected collection of
                    clothing, jewelry, laces, watches and
                    accessories designed to elevate your
                    everyday style.

                </p>


                {{-- BUTTONS --}}

                <div class="mt-6 sm:mt-8 flex flex-col lg:flex-row w-full sm:w-fit overflow-hidden rounded-2xl lg:rounded-full border border-[#BE8B3E]/80">

                    <a
                        href="{{ route('shop') }}"
                        class="flex items-center justify-center
                               w-full lg:min-w-[190px] px-6 sm:px-8 py-3.5 sm:py-4
                               text-white bg-[#BE8B3E]
                               text-[10px] sm:text-xs uppercase tracking-[0.15em] sm:tracking-[0.18em] font-semibold
                               border-b lg:border-b-0 lg:border-r border-[#BE8B3E]/80
                               hover:bg-transparent whitespace-nowrap hover:text-[#BE8B3E]
                               transition-all duration-300">
                        Shop Collection
                    </a>

                    <a
                        href="https://wa.me/{{ config('store.whatsapp') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-center
                               w-full lg:min-w-[170px] px-6 sm:px-8 py-3.5 sm:py-4
                               text-[#BE8B3E]
                               text-[10px] sm:text-xs uppercase tracking-[0.15em] sm:tracking-[0.18em] font-semibold
                               hover:bg-[#BE8B3E] hover:text-white
                               transition-all duration-300">
                        WhatsApp Us
                    </a>

                </div>


                {{-- SMALL FEATURES --}}

                <div class="mt-7 sm:mt-10 flex flex-wrap items-center gap-x-10 gap-y-4 sm:gap-x-12">

                    <div class="min-w-[65px]">

                        <p class="text-[10px] sm:text-xs tracking-widest opacity-60">
                            01
                        </p>

                        <p class="mt-1 text-[10px] sm:text-xs uppercase tracking-widest text-[#BE8B3E]">
                            Quality
                        </p>

                    </div>


                    <div class="min-w-[65px]">

                        <p class="text-[10px] sm:text-xs tracking-widest opacity-60">
                            02
                        </p>

                        <p class="mt-1 text-[10px] sm:text-xs uppercase tracking-widest text-[#BE8B3E]">
                            Elegance
                        </p>

                    </div>


                    <div class="min-w-[65px]">

                        <p class="text-[10px] sm:text-xs tracking-widest opacity-60">
                            03
                        </p>

                        <p class="mt-1 text-[10px] sm:text-xs uppercase tracking-widest text-[#BE8B3E]">
                            Variety
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         SCROLL INDICATOR
    ====================================================== --}}

    <div class="absolute bottom-8 right-8 lg:right-12 z-20 hidden sm:flex flex-col items-center gap-3 text-[#BE8B3E]">

        <span class="text-[9px] uppercase tracking-[0.3em] rotate-90 origin-center">
            Scroll
        </span>

        <div class="w-px h-16 bg-[#BE8B3E]/50"></div>

    </div>

</section>



{{-- =========================================================
     CATEGORY SECTION
========================================================= --}}

<section class="py-20 sm:py-24 bg-black">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="relative mb-12 sm:mb-14">

            {{-- CENTER CONTENT --}}
            <div class="text-center">

                <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
                    Explore
                </p>

                <h2 class="mt-4 text-3xl sm:text-5xl font-light text-white">
                    Shop by Category
                </h2>

                <p class="mt-4 sm:mt-5 text-sm sm:text-base text-gray-500 max-w-xl mx-auto">
                    Find something made for your style.
                </p>

            </div>

            {{-- VIEW ALL - RIGHT SIDE --}}
            <a
                href="{{ route('categories') }}"
                class="mt-7 sm:mt-0 sm:absolute sm:right-0 sm:top-1/2 sm:-translate-y-1/2 inline-flex items-center gap-3 text-sm uppercase tracking-wider border-b border-[#BE8B3E] pb-2 text-[#BE8B3E] hover:text-white hover:border-white transition">
                View All
            </a>

        </div>


        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">

            @forelse($categories as $index => $category)

                @php
                    $image = $category->image;

                    if ($image && !str_starts_with($image, 'http')) {
                        $image = asset('storage/' . ltrim($image, '/'));
                    }

                    if (!$image) {
                        $image = asset('images/placeholder.jpg');
                    }
                @endphp

                <a
                    href="{{ route('category.show', $category->slug) }}"
                    class="group relative overflow-hidden aspect-[3/4] bg-gray-100 rounded-xl hover:shadow-lg hover:shadow-[#BE8B3E]">

                    <div
                        class="absolute inset-0 bg-cover bg-center transition duration-700 group-hover:scale-105"
                        style="background-image: url('{{ $image }}');"></div>

                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 text-white">

                        <p class="text-[9px] sm:text-xs uppercase tracking-[0.2em] sm:tracking-[0.3em] opacity-80">
                            Collection {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </p>

                        <h3 class="mt-1.5 sm:mt-2 text-lg sm:text-2xl font-light break-words">
                            {{ $category->name }}
                        </h3>

                        <span class="inline-block mt-2 sm:mt-3 text-[9px] sm:text-xs uppercase tracking-widest text-[#BE8B3E] font-bold border-b border-[#BE8B3E] pb-1">
                            Explore
                        </span>

                    </div>

                </a>

            @empty

                <div class="col-span-full text-center py-16 text-gray-400">
                    No categories available.
                </div>

            @endforelse

        </div>

    </div>

</section>



{{-- =========================================================
     FEATURED PRODUCTS
========================================================= --}}

<section class="py-20 sm:py-24 bg-[#f8f7f4]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-10 sm:mb-12">

            <div class="min-w-0">

                <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
                    Curated for you
                </p>

                <h2 class="mt-4 text-3xl sm:text-5xl font-light break-words">
                    Featured Collection
                </h2>

            </div>

            <a href="{{ url('/shop') }}"
               class="text-sm uppercase tracking-widest text-[#BE8B3E] hover:text-black border-b border-[#BE8B3E] hover:border-black pb-2 w-fit shrink-0">
                View All
            </a>

        </div>


        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 lg:gap-7">

            @forelse($featuredProducts as $product)

                @php
                    $image = $product->primaryImage?->image;

                    if ($image && !str_starts_with($image, 'http')) {
                        $image = asset('storage/' . ltrim($image, '/'));
                    }

                    if (!$image) {
                        $image = asset('images/placeholder.jpg');
                    }

                    $price = $product->sale_price ?? $product->price;
                @endphp

                <article class="group min-w-0">

                    <a
                        href="{{ route('product.show', $product->slug) }}"
                        class="block overflow-hidden bg-white aspect-[4/5] rounded-xl hover:shadow-lg hover:shadow-[#BE8B3E]">

                        <div
                            class="w-full h-full bg-cover bg-center transition duration-700 group-hover:scale-105"
                            style="background-image: url('{{ $image }}');"></div>

                    </a>

                    <div class="pt-4 sm:pt-5 min-w-0">

                        <p class="text-[9px] sm:text-[10px] uppercase tracking-widest text-[#BE8B3E] truncate">
                            {{ $product->category?->name ?? 'Collection' }}
                        </p>

                        <h3 class="mt-2 text-xs sm:text-sm font-medium break-words">
                            {{ $product->name }}
                        </h3>

                        <p class="mt-2 text-xs sm:text-sm text-gray-600 break-words">

                            @if($product->sale_price)

                                <span class="text-[#BE8B3E]">
                                    PKR {{ number_format($product->sale_price) }}
                                </span>

                                <span class="ml-1 sm:ml-2 text-gray-400 line-through">
                                    PKR {{ number_format($product->price) }}
                                </span>

                            @else

                                PKR {{ number_format($product->price) }}

                            @endif

                        </p>

                    </div>

                </article>

            @empty

                <div class="col-span-full text-center py-16 text-gray-400">
                    No featured products available.
                </div>

            @endforelse

        </div>

    </div>

</section>



{{-- =========================================================
     PROMOTIONAL BANNER
========================================================= --}}

<section class="relative overflow-hidden bg-black">

    <div class="absolute inset-0 opacity-30">

        <div
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&w=1800&q=85');"></div>

    </div>

    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 py-20 sm:py-28 text-center">

        <p class="text-[10px] sm:text-xs uppercase tracking-[0.35em] sm:tracking-[0.5em] text-[#BE8B3E]">
            The Bin Roshan Edit
        </p>

        <h2 class="mt-5 sm:mt-6 text-3xl sm:text-6xl font-light text-white">
            Make Every Detail
            <span class="italic font-serif text-[#BE8B3E]">
                Count.
            </span>
        </h2>

        <p class="mt-5 sm:mt-6 max-w-2xl mx-auto text-sm sm:text-base text-gray-300 leading-7">
            From statement jewelry to timeless watches and beautiful
            fabrics, discover pieces that bring your personal style to life.
        </p>

        <a
            href="{{ url('/shop') }}"
            class="inline-flex mt-8 sm:mt-9 border border-[#BE8B3E] px-6 sm:px-8 py-3.5 sm:py-4 text-xs sm:text-sm uppercase tracking-widest text-[#BE8B3E] hover:bg-[#BE8B3E] hover:text-white rounded-full transition">
            Discover More
        </a>

    </div>

</section>



{{-- =========================================================
     NEW ARRIVALS
========================================================= --}}

<section class="py-20 sm:py-24 bg-[#f8f7f4]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-10 sm:mb-14">

            <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
                Just arrived
            </p>

            <h2 class="mt-4 text-3xl sm:text-5xl font-light">
                New Arrivals
            </h2>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">

            @forelse($newArrivals as $product)

                @php
                    $image = $product->primaryImage?->image;

                    if ($image && !str_starts_with($image, 'http')) {
                        $image = asset('storage/' . ltrim($image, '/'));
                    }

                    if (!$image) {
                        $image = asset('images/placeholder.jpg');
                    }
                @endphp

                <a href="{{ route('product.show', $product->slug) }}" class="group relative overflow-hidden bg-gray-100 aspect-[4/5] rounded-xl hover:shadow-lg hover:shadow-[#BE8B3E]">

                    <div class="absolute inset-0 bg-cover bg-center transition duration-700 group-hover:scale-105" style="background-image: url('{{ $image }}');"></div>

                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 p-5 sm:p-8 text-white">

                        <p class="text-[10px] sm:text-xs uppercase tracking-widest">
                            New
                        </p>

                        <h3 class="mt-2 text-xl sm:text-2xl font-light break-words">
                            {{ $product->name }}
                        </h3>

                        @if($product->category)

                            <p class="mt-2 text-[10px] sm:text-xs uppercase tracking-widest text-[#BE8B3E] font-extrabold">
                                {{ $product->category->name }}
                            </p>

                        @endif

                    </div>

                </a>

            @empty

                <div class="col-span-full text-center py-16 text-gray-400">
                    No new arrivals available.
                </div>

            @endforelse

        </div>

    </div>

</section>



{{-- =========================================================
     WHY BIN ISMAIL
========================================================= --}}

<section class="py-20 sm:py-24 bg-black">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12 sm:mb-16">

            <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
                The Bin Roshan Difference
            </p>

            <h2 class="mt-4 text-3xl sm:text-5xl font-light text-white">
                Why Shop With Us?
            </h2>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 sm:gap-12 text-center">


            <div>

                <div class="mx-auto w-14 h-14 border border-[#b38b2c] rounded-full flex items-center justify-center">

                    <span class="font-serif text-xl text-[#BE8B3E]">
                        I
                    </span>

                </div>

                <h3 class="mt-6 text-lg font-medium text-white">
                    Carefully Selected
                </h3>

                <p class="mt-3 text-sm leading-7 text-gray-500">
                    We focus on pieces that combine style,
                    quality and everyday elegance.
                </p>

            </div>


            <div>

                <div class="mx-auto w-14 h-14 border border-[#b38b2c] rounded-full flex items-center justify-center">

                    <span class="font-serif text-xl text-[#BE8B3E]">
                        II
                    </span>

                </div>

                <h3 class="mt-6 text-lg font-medium text-white">
                    Something for Everyone
                </h3>

                <p class="mt-3 text-sm leading-7 text-gray-500">
                    Explore clothing, jewelry, laces,
                    watches and accessories in one place.
                </p>

            </div>


            <div>

                <div class="mx-auto w-14 h-14 border border-[#b38b2c] rounded-full flex items-center justify-center">

                    <span class="font-serif text-xl text-[#BE8B3E]">
                        III
                    </span>

                </div>

                <h3 class="mt-6 text-lg font-medium text-white">
                    Easy WhatsApp Ordering
                </h3>

                <p class="mt-3 text-sm leading-7 text-gray-500">
                    See something you love? Contact us
                    directly through WhatsApp.
                </p>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     WHATSAPP CTA
========================================================= --}}

<section class="bg-[#f8f7f4] text-white">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-20 sm:py-24 text-center">

        <div class="mx-auto w-16 h-16 border border-[#BE8B3E] rounded-full flex items-center justify-center">

            <svg class="w-7 h-7 text-[#BE8B3E]"
                 fill="currentColor"
                 viewBox="0 0 24 24">

                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.1-.198.05-.372-.025-.521-.075-.149-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.002 5.45-4.438 9.884-9.889 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495.0.16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.304-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.478-8.413"/>

            </svg>

        </div>

        <p class="mt-8 text-xs uppercase tracking-[0.35em] sm:tracking-[0.5em] text-[#BE8B3E]">
            Shop directly with us
        </p>

        <h2 class="mt-5 text-3xl sm:text-5xl font-light text-black">
            Found Something You Love?
        </h2>

        <p class="mt-5 text-sm sm:text-base text-gray-400 max-w-xl mx-auto leading-7">
            Send us a message on WhatsApp and our team will
            help you with product details, availability and ordering.
        </p>

        <a
            href="https://wa.me/{{ config('store.whatsapp') }}?text={{ urlencode('Hello Bin Ismail, I would like to know more about your products.') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex border border-[#BE8B3E] text-[#BE8B3E] hover:bg-[#BE8B3E] hover:text-white rounded-full items-center justify-center mt-9 bg-transparent px-7 sm:px-9 py-3.5 sm:py-4 text-sm font-semibold transition">
            Chat on WhatsApp
        </a>

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

    <svg viewBox="0 0 24 24"
         fill="currentColor"
         class="w-6 h-6 sm:w-7 sm:h-7">

        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.1-.198.05-.372-.025-.521-.075-.149-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.002 5.45-4.438 9.884-9.889 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.304-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.478-8.413"/>

    </svg>

</a>

@endsection