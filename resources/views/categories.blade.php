@extends('layouts.app')

@section('title', 'Categories | Bin Ismail')

@section('description', 'Explore clothing, jewelry, laces, watches and accessories at Bin Ismail.')

@section('content')

{{-- =========================================================
     CATEGORY HERO
========================================================= --}}

<section class="relative h-[55vh] min-h-[500px] w-full overflow-hidden text-white">

    {{-- VIDEO BACKGROUND --}}
    <video
        class="absolute inset-0 w-full h-full object-cover"
        autoplay
        muted
        loop
        playsinline
        preload="auto"
    >
        <source src="{{ asset('videos/categories.mp4') }}" type="video/mp4">
    </video>

    {{-- DARK OVERLAY --}}
    <div class="absolute inset-0 bg-black/40"></div>

    {{-- =====================================================
         TRANSPARENT NAVIGATION
    ====================================================== --}}

    <header class="absolute top-0 left-0 right-0 z-40">

        <div class="max-w-[1500px] mx-auto px-6 lg:px-12">

            <nav class="h-24 flex items-center justify-between">

                {{-- LEFT SIDE --}}
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

                {{-- RIGHT SIDE --}}
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
                Our Collections
            </p>

            <h1 class="text-6xl sm:text-7xl lg:text-8xl font-light tracking-tight">
                Explore Categories
            </h1>

            <p class="mt-8 max-w-3xl mx-auto text-sm sm:text-base lg:text-lg leading-8 text-white/90">
                Discover carefully selected clothing, jewelry, laces,
                watches and accessories designed to bring elegance
                to every style.
            </p>

        </div>

    </div>

</section>


{{-- =========================================================
     CATEGORY GRID
========================================================= --}}

<section class="py-20 lg:py-28 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($categories as $category)

                @php
                    $categoryImage = $category->image;

                    if ($categoryImage && !str_starts_with($categoryImage, 'http')) {
                        $categoryImage = asset('storage/' . ltrim($categoryImage, '/'));
                    }

                    if (!$categoryImage) {
                        $categoryImage = asset('images/placeholder.jpg');
                    }
                @endphp

                <a
    href="{{ route('category.show', $category->slug) }}"
    class="group relative overflow-hidden bg-gray-100 aspect-[4/5]"
>

                    <img
                        src="{{ $categoryImage }}"
                        alt="{{ $category->name }}"
                        class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105"
                    >

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-black/25 group-hover:bg-black/40 transition duration-500">
                    </div>

                    {{-- Content --}}
                    <div class="absolute inset-x-0 bottom-0 p-7 lg:p-9 text-white">

                        <p class="text-[10px] uppercase tracking-[0.35em] opacity-80">
                            Collection
                        </p>

                        <h2 class="mt-2 text-3xl font-light">
                            {{ $category->name }}
                        </h2>

                        <p class="mt-3 text-sm text-white/80 leading-6 max-w-sm">
                            {{ $category->description }}
                        </p>

                        <div class="mt-6 inline-flex items-center gap-3 text-xs uppercase tracking-widest font-semibold">

                            Explore Collection

                            <span class="transition-transform duration-300 group-hover:translate-x-2">
                                →
                            </span>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</section>


{{-- =========================================================
     CTA
========================================================= --}}

<section class="bg-black text-white py-24">

    <div class="max-w-4xl mx-auto px-4 text-center">

        <p class="text-xs uppercase tracking-[0.4em] text-[#c8a64b]">
            Bin Ismail
        </p>

        <h2 class="mt-5 text-4xl sm:text-5xl font-light">
            Looking for something special?
        </h2>

        <p class="mt-6 text-gray-400 leading-7">
            Contact our team directly through WhatsApp and
            we'll help you find the right product.
        </p>

        <a
            href="https://wa.me/{{ config('store.whatsapp') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex mt-9 bg-white text-black px-8 py-4 text-sm font-semibold uppercase tracking-widest hover:bg-[#c8a64b] transition"
        >
            Chat on WhatsApp
        </a>

    </div>

</section>

@endsection