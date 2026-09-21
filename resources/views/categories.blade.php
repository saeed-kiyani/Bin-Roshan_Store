@extends('layouts.app')

@section('title', 'Categories | Bin Roshan')

@section('description', 'Explore clothing, jewelry, laces, watches and accessories at Bin Roshan.')

@section('content')

{{-- =========================================================
     CATEGORY HERO
========================================================= --}}

<section class="relative h-[55vh] min-h-[460px] sm:min-h-[500px] w-full overflow-hidden text-white">

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

            <p class="text-xs uppercase tracking-[0.45em] text-white/70">
                Carefully Sorted
            </p>

            <h1 class="text-4xl sm:text-6xl lg:text-8xl font-light tracking-tight leading-tight">
                Unveil the <span class="text-[#BE8B3E] font-serif italic">Essentials</span>
            </h1>

            <p class="mt-5 sm:mt-8 max-w-3xl mx-auto text-sm sm:text-base lg:text-lg leading-7 sm:leading-8 text-white/90 px-2">
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

<section class="py-16 sm:py-20 lg:py-28 bg-[#f8f7f4]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">

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
                    class="group relative overflow-hidden bg-gray-100 aspect-[4/5] rounded-lg">

                    <img
                        src="{{ $categoryImage }}"
                        alt="{{ $category->name }}"
                        class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105">

                    {{-- Overlay --}}

                    <div class="absolute inset-0 bg-black/70 hover:bg-black/65 transition duration-500">
                    </div>


                    {{-- Content --}}

                    <div class="absolute inset-x-0 bottom-0 p-5 sm:p-7 lg:p-9 text-white">

                        <p class="text-[10px] uppercase tracking-[0.3em] sm:tracking-[0.35em] opacity-80 font-extrabold text-[#BE8B3E]">
                            Collection
                        </p>

                        <h2 class="mt-2 text-2xl sm:text-3xl font-bold font-serif italic leading-tight">
                            {{ $category->name }}
                        </h2>

                        <p class="mt-3 text-xs sm:text-sm text-grey leading-5 sm:leading-6 max-w-sm">
                            {{ $category->description }}
                        </p>

                        <div class="mt-4 sm:mt-6 inline-flex items-center gap-2 sm:gap-3 text-[10px] sm:text-xs uppercase tracking-widest font-semibold text-[#BE8B3E]">

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

<section class="bg-black text-white py-16 sm:py-24">

    <div class="max-w-4xl mx-auto px-4 text-center">

        <p class="text-xs uppercase tracking-[0.35em] sm:tracking-[0.4em] text-[#BE8B3E]">
            Bin Roshan
        </p>

        <h2 class="mt-4 sm:mt-5 text-3xl sm:text-5xl font-light leading-tight">
            Looking For <span class="font-mono italic text-[#BE8B3E]">Something Special?</span>
        </h2>

        <p class="mt-5 sm:mt-6 text-sm sm:text-base text-gray-400 leading-6 sm:leading-7">
            Contact our team directly through WhatsApp and
            we'll help you find the right product.
        </p>

        <a
            href="https://wa.me/{{ config('store.whatsapp') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex w-full sm:w-auto justify-center border border-[#BE8B3E] mt-8 sm:mt-9 text-[#BE8B3E] px-6 sm:px-8 py-4 text-sm font-semibold uppercase tracking-widest hover:bg-[#BE8B3E] hover:text-white rounded-full transition">
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

    <svg
        viewBox="0 0 24 24"
        fill="currentColor"
        class="w-6 h-6 sm:w-7 sm:h-7">

        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.1-.198.05-.372-.025-.521-.075-.149-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.002 5.45-4.438 9.884-9.889 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.304-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.478-8.413"/>

    </svg>

</a>

@endsection