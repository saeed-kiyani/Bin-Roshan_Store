@extends('layouts.app')

@section('title', 'About Us | Bin Ismail')

@section('description', 'Discover the story behind Bin Ismail — fashion, jewelry, laces, watches and accessories.')

@section('content')

{{-- =========================================================
     HERO
========================================================= --}}

<section class="relative min-h-[70vh] flex items-center overflow-hidden">

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
    
    <img
        src="https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&w=1800&q=90"
        alt="Bin Ismail fashion collection"
        class="absolute inset-0 w-full h-full object-cover"
    >

    <div class="absolute inset-0 bg-black/55"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">

        <p class="text-xs uppercase tracking-[0.5em] text-white/70">
            The Bin Ismail Story
        </p>

        <h1 class="mt-7 text-5xl sm:text-6xl lg:text-8xl font-light leading-none">
            Elegance.
            <br>
            Tradition.
            <br>
            <span class="italic">Style.</span>
        </h1>

        <p class="mt-8 max-w-2xl mx-auto text-white/80 leading-8">
            A carefully curated destination for clothing, jewelry,
            laces, watches and accessories — bringing timeless
            style together under one name.
        </p>

    </div>

</section>



{{-- =========================================================
     INTRODUCTION
========================================================= --}}

<section class="py-24 lg:py-32 bg-white">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">

            <div>

                <p class="text-xs uppercase tracking-[0.4em] text-[#a47c15] font-semibold">
                    About Bin Ismail
                </p>

                <h2 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-light leading-tight">
                    Where timeless style meets modern expression.
                </h2>

            </div>


            <div class="text-gray-600 leading-8 space-y-6">

                <p>
                    Bin Ismail is built around a simple idea:
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

<section class="bg-[#f7f5f0] py-24 lg:py-32">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <div class="aspect-[4/5] overflow-hidden">

                <img
                    src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1200&q=90"
                    alt="Bin Ismail fashion"
                    class="w-full h-full object-cover"
                >

            </div>


            <div class="lg:pr-10">

                <p class="text-xs uppercase tracking-[0.4em] text-[#a47c15] font-semibold">
                    Our Philosophy
                </p>

                <h2 class="mt-6 text-4xl sm:text-5xl font-light leading-tight">
                    Designed for people who appreciate the details.
                </h2>

                <div class="mt-8 space-y-6 text-gray-600 leading-8">

                    <p>
                        Good style is often found in the details —
                        the texture of a fabric, the finish of a
                        piece of jewelry, the character of a watch,
                        or the subtle elegance of a decorative lace.
                    </p>

                    <p>
                        That's why Bin Ismail brings together
                        different categories while maintaining one
                        consistent standard of sophistication.
                    </p>

                </div>


                <div class="mt-10 grid grid-cols-2 gap-8">

                    <div>

                        <p class="text-3xl font-light">
                            01
                        </p>

                        <p class="mt-2 text-sm font-medium">
                            Curated Selection
                        </p>

                    </div>


                    <div>

                        <p class="text-3xl font-light">
                            02
                        </p>

                        <p class="mt-2 text-sm font-medium">
                            Personal Service
                        </p>

                    </div>


                    <div>

                        <p class="text-3xl font-light">
                            03
                        </p>

                        <p class="mt-2 text-sm font-medium">
                            Timeless Style
                        </p>

                    </div>


                    <div>

                        <p class="text-3xl font-light">
                            04
                        </p>

                        <p class="mt-2 text-sm font-medium">
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

<section class="py-24 lg:py-32">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto">

            <p class="text-xs uppercase tracking-[0.4em] text-[#a47c15] font-semibold">
                What We Offer
            </p>

            <h2 class="mt-5 text-4xl sm:text-5xl font-light">
                Something for every expression.
            </h2>

        </div>


        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mt-14">

            @php

                $aboutCategories = [

                    [
                        'name' => 'Clothing',
                        'slug' => 'clothing',
                        'image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=700&q=85',
                    ],

                    [
                        'name' => 'Jewelry',
                        'slug' => 'jewelry',
                        'image' => 'https://images.unsplash.com/photo-1611652022419-a9419f74343d?auto=format&fit=crop&w=700&q=85',
                    ],

                    [
                        'name' => 'Laces',
                        'slug' => 'laces',
                        'image' => 'https://images.unsplash.com/photo-1590736704728-f4730bb30770?auto=format&fit=crop&w=700&q=85',
                    ],

                    [
                        'name' => 'Watches',
                        'slug' => 'watches',
                        'image' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=700&q=85',
                    ],

                    [
                        'name' => 'Accessories',
                        'slug' => 'accessories',
                        'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=700&q=85',
                    ],

                ];

            @endphp


            @foreach($aboutCategories as $category)

                <a
                    href="{{ route('category.show', $category['slug']) }}"
                    class="group relative aspect-[3/4] overflow-hidden"
                >

                    <img
                        src="{{ $category['image'] }}"
                        alt="{{ $category['name'] }}"
                        class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105"
                    >

                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/45 transition">
                    </div>

                    <div class="absolute inset-x-0 bottom-0 p-5 text-white">

                        <h3 class="text-xl font-light">
                            {{ $category['name'] }}
                        </h3>

                        <span class="inline-block mt-2 text-[10px] uppercase tracking-widest">
                            Explore →
                        </span>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</section>



{{-- =========================================================
     VALUES
========================================================= --}}

<section class="bg-black text-white py-24 lg:py-32">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid md:grid-cols-3 gap-12 text-center">

            <div>

                <div class="mx-auto w-14 h-14 rounded-full border border-white/20 flex items-center justify-center text-[#c8a64b]">
                    01
                </div>

                <h3 class="mt-6 text-xl font-light">
                    Quality
                </h3>

                <p class="mt-4 text-sm text-gray-400 leading-7">
                    We focus on products that combine
                    attractive design with dependable quality.
                </p>

            </div>


            <div>

                <div class="mx-auto w-14 h-14 rounded-full border border-white/20 flex items-center justify-center text-[#c8a64b]">
                    02
                </div>

                <h3 class="mt-6 text-xl font-light">
                    Elegance
                </h3>

                <p class="mt-4 text-sm text-gray-400 leading-7">
                    Our collections are selected to create
                    a refined and timeless visual identity.
                </p>

            </div>


            <div>

                <div class="mx-auto w-14 h-14 rounded-full border border-white/20 flex items-center justify-center text-[#c8a64b]">
                    03
                </div>

                <h3 class="mt-6 text-xl font-light">
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

<section class="py-24 bg-[#f7f5f0]">

    <div class="max-w-4xl mx-auto px-4 text-center">

        <p class="text-xs uppercase tracking-[0.4em] text-[#a47c15] font-semibold">
            Let's Connect
        </p>

        <h2 class="mt-5 text-4xl sm:text-5xl font-light">
            Have a question?
        </h2>

        <p class="mt-6 text-gray-600 leading-7">
            Our team is just a message away.
            Contact Bin Ismail directly through WhatsApp.
        </p>

        <a
            href="https://wa.me/{{ config('store.whatsapp') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex mt-8 bg-black text-white px-9 py-4 text-sm font-semibold uppercase tracking-widest hover:bg-[#a47c15] transition"
        >
            Chat on WhatsApp
        </a>

    </div>

</section>

@endsection