@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('title', 'About Us | Bin Roshan')

@section('description', 'Discover the story behind Bin Roshan — fashion, jewelry, laces, watches and accessories.')

@section('content')

{{-- =========================================================
     HERO
========================================================= --}}

<section class="relative h-[55vh] min-h-[420px] sm:min-h-[500px] w-full overflow-hidden text-white">

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

    <img
        src="{{ asset('images/banners/about.jpeg') }}"
        alt="Bin Roshan about image"
        class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/55"></div>

    <div class="relative z-20 h-full flex items-center justify-center px-4 sm:px-6">

    <div class="text-center max-w-4xl w-full">

        <p class="text-xs uppercase tracking-[0.45em] text-white/70">
                The Heritage
            </p>

        <h1 class="text-4xl sm:text-6xl lg:text-8xl font-light tracking-tight leading-tight">
            Our Legacy of <span class="text-[#BE8B3E] font-serif italic">Style</span>
        </h1>

        <p class="mt-5 sm:mt-8 max-w-3xl mx-auto text-sm sm:text-base lg:text-lg leading-7 sm:leading-8 text-white/90 px-2">
            A carefully curated destination for clothing, jewelry,
            laces, watches and accessories — bringing timeless
            style together under one name.
        </p>

        </div>

    </div>

</section>

{{-- =========================================================
     INTRODUCTION
========================================================= --}}

<section class="py-16 sm:py-24 lg:py-32 bg-[#f8f7f4]">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-10 sm:gap-16 lg:gap-24 items-center">

            <div>

                <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
                    About Bin Roshan
                </p>

                <h2 class="mt-5 sm:mt-6 text-3xl sm:text-5xl lg:text-6xl font-light leading-tight">
                    Where <span class="italic font-mono text-[#BE8B3E]">Timeless Style</span> Meets <span class="font-serif font-medium text-[#BE8B3E]">Modern Expression.</span>
                </h2>

            </div>

            <div class="text-gray-600 text-sm sm:text-base leading-7 sm:leading-8 space-y-5 sm:space-y-6">

                <p>
                    <span class="italic text-[#BE8B3E]">Bin Roshan</span> is built around a simple idea:
                    bringing beautiful products together in one
                    refined destination.
                </p>

                <p>
                    From carefully selected clothing and elegant
                    jewelry to decorative laces, sophisticated
                    watches and stylish accessories, every collection
                    is chosen with an eye for quality and design.
                </p>

                <p>
                    Our goal is not simply to offer products,
                    but to make discovering your personal style
                    an enjoyable experience.
                </p>

            </div>

        </div>

    </div>

</section>

{{-- =========================================================
     IMAGE + STORY
========================================================= --}}

<section class="bg-black py-16 sm:py-24 lg:py-32">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-10 sm:gap-12 lg:gap-20 items-center">

            <div class="aspect-[4/5] overflow-hidden">

                <img
                    src="{{ asset('images/about/about.jpeg') }}"
                    alt="Bin Roshan fashion"
                    class="w-full h-full object-cover rounded-full">

            </div>

            <div class="lg:pr-10">

                <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
                    Our Philosophy
                </p>

                <h2 class="mt-5 sm:mt-6 text-3xl sm:text-5xl font-light leading-tight text-white">
                    Designed For People Who Appreciate The Details.
                </h2>

                <div class="mt-6 sm:mt-8 space-y-5 sm:space-y-6 text-gray-600 text-sm sm:text-base leading-7 sm:leading-8">

                    <p>
                        Good style is often found in the details —
                        the texture of a fabric, the finish of a
                        piece of jewelry, the character of a watch,
                        or the subtle elegance of a decorative lace.
                    </p>

                    <p>
                        That's why <span class="italic font-serif text-[#BE8B3E]">Bin Roshan</span> brings together
                        different categories while maintaining one
                        consistent standard of sophistication.
                    </p>

                </div>

                <div class="mt-8 sm:mt-10 grid grid-cols-2 gap-x-6 sm:gap-x-8 gap-y-7 sm:gap-y-8">

                    <div>

                        <p class="text-3xl font-light text-[#BE8B3E]">
                            01
                        </p>

                        <p class="mt-2 text-sm font-medium text-white">
                            Curated Selection
                        </p>

                    </div>

                    <div>

                        <p class="text-3xl font-light text-[#BE8B3E]">
                            02
                        </p>

                        <p class="mt-2 text-sm font-medium text-white">
                            Personal Service
                        </p>

                    </div>

                    <div>

                        <p class="text-3xl font-light text-[#BE8B3E]">
                            03
                        </p>

                        <p class="mt-2 text-sm font-medium text-white">
                            Timeless Style
                        </p>

                    </div>

                    <div>

                        <p class="text-3xl font-light text-[#BE8B3E]">
                            04
                        </p>

                        <p class="mt-2 text-sm font-medium text-white">
                            Customer First
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- =========================================================
     CATEGORIES
========================================================= --}}

<section class="py-16 sm:py-24 lg:py-32 bg-[#f8f7f4]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto">

            <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
                What We Offer
            </p>

            <h2 class="mt-4 sm:mt-5 text-3xl sm:text-5xl font-light leading-tight">
                Something For
                <span class="italic font-serif text-[#BE8B3E]">
                    Every Expression.
                </span>
            </h2>

        </div>

        {{-- =================================================
             CATEGORY CAROUSEL
        ================================================== --}}

        @if($aboutCategories->count())

            <div class="relative mt-10 sm:mt-14">

                <div
                    id="aboutCategoryViewport"
                    class="overflow-hidden">

                    <div
                        id="aboutCategoryTrack"
                        class="flex gap-4 transition-transform duration-700 ease-in-out">

                        @foreach($aboutCategories as $category)

                            <a
                                href="{{ route('category.show', $category->slug) }}"
                                class="about-category-card group relative aspect-[3/4] overflow-hidden flex-shrink-0 rounded-full">

                                {{-- IMAGE --}}

                                @if($category->image)

                                    <img
                                        src="{{ Storage::url($category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105">

                                @else

                                    <div class="absolute inset-0 bg-gray-300"></div>

                                @endif

                                {{-- OVERLAY --}}

                                <div
                                    class="absolute inset-0 bg-black/60 group-hover:bg-black/45 transition duration-500">
                                </div>

                                {{-- CONTENT --}}

                                <div class="absolute inset-x-0 bottom-0 p-4 sm:p-5 text-white text-center">

                                    <h3 class="text-base sm:text-xl font-light leading-tight">
                                        {{ $category->name }}
                                    </h3>

                                    <span
                                        class="block mt-2 text-[9px] sm:text-[10px] uppercase tracking-widest text-[#BE8B3E]">
                                        Explore →
                                    </span>

                                </div>

                            </a>

                        @endforeach

                    </div>

                </div>

                {{-- =================================================
                     CAROUSEL BUTTON
                ================================================== --}}

                @if($aboutCategories->count() > 5)

                    <button
                        type="button"
                        id="aboutCategoryNext"
                        aria-label="Next categories"
                        class="absolute right-0 top-1/2 -translate-y-1/2 z-30
                               w-10 h-10 sm:w-12 sm:h-12
                               bg-black text-white
                               rounded-full cursor-pointer
                               flex items-center justify-center
                               shadow-xl
                               hover:bg-[#BE8B3E]
                               transition duration-300
                               translate-x-1/3 sm:translate-x-1/2">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 sm:w-5 sm:h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M9 5l7 7-7 7"/>

                        </svg>

                    </button>

                @endif

            </div>

        @else

            <p class="mt-10 sm:mt-14 text-center text-gray-500">
                No categories available.
            </p>

        @endif

    </div>

</section>

{{-- =========================================================
     VALUES
========================================================= --}}

<section class="bg-black text-white py-16 sm:py-24 lg:py-32">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid md:grid-cols-3 gap-10 sm:gap-12 text-center">

            <div>

                <div class="mx-auto w-14 h-14 rounded-full border border-[#BE8B3E] flex items-center justify-center text-[#BE8B3E]">
                    01
                </div>

                <h3 class="mt-5 sm:mt-6 text-xl font-light">
                    Quality
                </h3>

                <p class="mt-4 text-sm text-gray-400 leading-7">
                    We focus on products that combine
                    attractive design with dependable quality.
                </p>

            </div>

            <div>

                <div class="mx-auto w-14 h-14 rounded-full border border-[#BE8B3E] flex items-center justify-center text-[#BE8B3E]">
                    02
                </div>

                <h3 class="mt-5 sm:mt-6 text-xl font-light">
                    Elegance
                </h3>

                <p class="mt-4 text-sm text-gray-400 leading-7">
                    Our collections are selected to create
                    a refined and timeless visual identity.
                </p>

            </div>

            <div>

                <div class="mx-auto w-14 h-14 rounded-full border border-white/[#BE8B3E] flex items-center justify-center text-[#BE8B3E]">
                    03
                </div>

                <h3 class="mt-5 sm:mt-6 text-xl font-light">
                    Service
                </h3>

                <p class="mt-4 text-sm text-gray-400 leading-7">
                    We believe great products deserve
                    equally great customer service.
                </p>

            </div>

        </div>

    </div>

</section>

{{-- =========================================================
     WHATSAPP CTA
========================================================= --}}

<section class="py-16 sm:py-24 bg-[#f8f7f4]">

    <div class="max-w-4xl mx-auto px-4 text-center">

        <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
            Let's Connect
        </p>

        <h2 class="mt-4 sm:mt-5 text-3xl sm:text-5xl font-light leading-tight">
            Have a Question?
        </h2>

        <p class="mt-5 sm:mt-6 text-sm sm:text-base text-gray-600 leading-6 sm:leading-7">
            Our team is just a message away.
            Contact Bin Ismail directly through WhatsApp.
        </p>

        <a
            href="https://wa.me/{{ config('store.whatsapp') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex w-full sm:w-auto justify-center mt-8 border border-[#BE8B3E] bg-transparent text-[#BE8B3E] px-6 sm:px-9 py-4 text-sm font-semibold uppercase tracking-widest hover:bg-[#BE8B3E] hover:text-white rounded-full transition">
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

<!-- ABOUT JAVASCRIPT CODE START HERE -->

<script>
    
document.addEventListener('DOMContentLoaded', function () {

    const viewport = document.getElementById('aboutCategoryViewport');
    const track = document.getElementById('aboutCategoryTrack');
    const nextButton = document.getElementById('aboutCategoryNext');

    if (!viewport || !track || !nextButton) {
        return;
    }

    const cards = Array.from(
        track.querySelectorAll('.about-category-card')
    );

    if (cards.length <= 5) {
        nextButton.style.display = 'none';
        return;
    }

    let currentIndex = 0;


    function getVisibleCards() {

        if (window.innerWidth < 640) {
            return 2;
        }

        if (window.innerWidth < 1024) {
            return 3;
        }

        return 5;
    }


    function updateCarousel() {

        const visibleCards = getVisibleCards();

        const maxIndex = Math.max(
            0,
            cards.length - visibleCards
        );

        if (currentIndex > maxIndex) {
            currentIndex = maxIndex;
        }

        const cardWidth = cards[0].getBoundingClientRect().width;

        const gap = parseFloat(
            window.getComputedStyle(track).columnGap ||
            window.getComputedStyle(track).gap ||
            0
        );

        const moveAmount = (cardWidth + gap) * currentIndex;

        track.style.transform =
            `translateX(-${moveAmount}px)`;

    }


    nextButton.addEventListener('click', function () {

        const visibleCards = getVisibleCards();

        const maxIndex = Math.max(
            0,
            cards.length - visibleCards
        );

        if (currentIndex < maxIndex) {

            currentIndex++;

        } else {

            // Start again from first card
            currentIndex = 0;

        }

        updateCarousel();

    });


    window.addEventListener('resize', function () {
        updateCarousel();
    });


    updateCarousel();

});

</script>

<!-- ABOUT JAVASCRIPT CODE END HERE -->

@endsection


<style>

    .about-category-card {
        width: calc(
            (100% - 64px) / 5
        );
    }

    @media (max-width: 1023px) {

        .about-category-card {
            width: calc(
                (100% - 32px) / 3
            );
        }

    }

    @media (max-width: 639px) {

        .about-category-card {
            width: calc(
                (100% - 16px) / 2
            );
        }

    }

</style>