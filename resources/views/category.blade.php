@extends('layouts.app')

@section('title', $category->name . ' | Bin Roshan')

@section('description', $category->description)

@section('content')

{{-- =========================================================
     CATEGORY HERO
========================================================= --}}

@php
    $categoryImage = $category->image;

    if ($categoryImage && !str_starts_with($categoryImage, 'http')) {
        $categoryImage = asset('storage/' . ltrim($categoryImage, '/'));
    }

    if (!$categoryImage) {
        $categoryImage = asset('images/placeholder.jpg');
    }
@endphp

<section class="relative h-[55vh] min-h-[450px] overflow-hidden">

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
        src="{{ $categoryImage }}"
        alt="{{ $category->name }}"
        class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/45"></div>

    <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">

        <div>

            <p class="text-xs uppercase tracking-[0.45em] text-white/70">
                Bin Roshan Collection
            </p>

            <h1 class="mt-6 text-5xl sm:text-6xl lg:text-7xl font-light">
                {{ $category->name }}
            </h1>

            <p class="mt-6 max-w-2xl mx-auto text-white/80 leading-7">
                {{ $category->description }}
            </p>

        </div>

    </div>

</section>


{{-- =========================================================
     BREADCRUMB
========================================================= --}}

<div class="border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="py-5 flex items-center gap-2 text-xs text-gray-500">

            <a
                href="{{ route('home') }}"
                class="hover:text-black transition">
                Home
            </a>

            <span>/</span>

            <a
                href="{{ route('categories') }}"
                class="hover:text-black transition">
                Categories
            </a>

            <span>/</span>

            <span class="text-gray-900">
                {{ $category->name }}
            </span>

        </div>

    </div>

</div>


{{-- =========================================================
     PRODUCTS
========================================================= --}}

<section class="py-20 lg:py-28 bg-[#f8f7f4]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Heading --}}

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-12">

            <div>

                <p class="text-xs uppercase tracking-[0.4em] text-[#BE8B3E] font-semibold">
                    {{ $category->name }}
                </p>

                <h2 class="mt-4 text-4xl font-light">
                    Explore the Collection
                </h2>

            </div>

            <p class="text-sm text-gray-500">
                {{ $products->count() }} products
            </p>

        </div>


        {{-- Empty State --}}

        @if($products->isEmpty())

            <div class="py-20 text-center">

                <p class="text-xs uppercase tracking-[0.3em] text-gray-400">
                    {{ $category->name }}
                </p>

                <h3 class="mt-4 text-2xl font-light">
                    No products available yet.
                </h3>

                <a
                    href="{{ route('shop') }}"
                    class="inline-flex mt-8 bg-black text-white px-7 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#a47c15] transition">
                    Continue Shopping
                </a>

            </div>

        @else

            {{-- Product Grid --}}

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-5 gap-y-12">

                @foreach($products as $product)

                    @php
                        $productImage = null;

                        if ($product->primaryImage) {
                            $productImage = $product->primaryImage->image;
                        }

                        if (!$productImage) {
                            $productImage = asset('images/placeholder.jpg');
                        } elseif (!str_starts_with($productImage, 'http')) {
                            $productImage = asset('storage/' . ltrim($productImage, '/'));
                        }
                    @endphp

                    <a
                        href="{{ route('product.show', $product->slug) }}"
                        class="group">

                        {{-- Image --}}

                        <div class="relative aspect-[4/5] bg-gray-100 overflow-hidden rounded-lg">

                            <img
                                src="{{ $productImage }}"
                                alt="{{ $product->name }}"
                                loading="lazy"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-105">

                            {{-- Featured Badge --}}

                            @if($product->is_featured)

                                <span class="absolute top-4 rounded-full left-4 bg-black text-white text-[9px] uppercase tracking-widest px-3 py-2">
                                    Featured
                                </span>

                            @endif


                            {{-- Sale Badge --}}

                            @if($product->sale_price !== null && (float) $product->sale_price < (float) $product->price)

                                <span class="absolute top-4 rounded-full right-4 bg-[#BE8B3E] text-white text-[9px] uppercase tracking-widest px-3 py-2">
                                    Sale
                                </span>

                            @endif


                            {{-- Quick view style overlay --}}

                            <div class="absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 transition duration-300">

                                <div class="bg-[#BE8B3E]/95 py-4 text-white text-center text-xs uppercase tracking-widest font-semibold">
                                    View Product
                                </div>

                            </div>

                        </div>


                        {{-- Product Info --}}

                        <div class="mt-5">

                            <p class="text-[10px] uppercase tracking-[0.25em] text-[#BE8B3E]">
                                {{ $category->name }}
                            </p>

                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                {{ $product->name }}
                            </h3>


                            {{-- Price --}}

                            <div class="mt-2 text-sm">

                                @if($product->sale_price !== null && (float) $product->sale_price < (float) $product->price)

                                    <span class="text-gray-400 line-through mr-2">
                                        PKR {{ number_format((float) $product->price) }}
                                    </span>

                                    <span class="text-black font-medium">
                                        PKR {{ number_format((float) $product->sale_price) }}
                                    </span>

                                @else

                                    <span>
                                        PKR {{ number_format((float) $product->price) }}
                                    </span>

                                @endif

                            </div>

                        </div>

                    </a>

                @endforeach

            </div>

        @endif

    </div>

</section>


{{-- =========================================================
     WHATSAPP CTA
========================================================= --}}

<section class="bg-black/20 py-20">

    <div class="max-w-3xl mx-auto px-4 text-center">

        <p class="text-xs uppercase tracking-[0.4em] text-[#BE8B3E] font-semibold">
            Need assistance?
        </p>

        <h2 class="mt-5 text-4xl font-light">
            Can't find what you're looking for?
        </h2>

        <p class="mt-5 text-white leading-7">
            Send us a message on WhatsApp and our team
            will help you find the right product.
        </p>

        <a
            href="https://wa.me/{{ config('store.whatsapp') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex mt-8 border border-white rounded-full text-white px-8 py-4 text-sm font-semibold uppercase tracking-widest hover:bg-[#BE8B3E] hover:border-[#BE8B3E] hover:text-white transition">
            Contact Us on WhatsApp
        </a>

    </div>

</section>


{{-- =========================================================
     FLOATING WHATSAPP
========================================================= --}}

<a
    href="https://wa.me/{{ config('store.whatsapp') }}"
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
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.198.198-.298.298-.497.1-.198.05-.372-.025-.521-.075-.149-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.077 4.487.709.306 1.262.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.002 5.45-4.438 9.884-9.889 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.304-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.478-8.413"/>
    </svg>

</a>

@endsection