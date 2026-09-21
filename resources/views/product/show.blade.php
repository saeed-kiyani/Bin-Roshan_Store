@extends('layouts.app')

@section('title', $product->name . ' | Bin Roshan')

@section('description', Str::limit(strip_tags($product->description), 160))

@section('content')

{{-- =========================================================
     PRODUCT DETAIL
========================================================= --}}

<section class="bg-[#f8f7f4]">

    {{-- Breadcrumb --}}
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-5">

            <div class="flex items-center gap-2 text-xs text-gray-500">

                <a href="{{ url('/') }}"
                   class="hover:text-black transition">
                    Home
                </a>

                <span>/</span>

                {{-- Categories --}}
                <a href="{{ route('categories') }}"
                    class="hover:text-black transition">
                    Categories
                </a>

                <span>/</span>

                <a href="{{ route('category.show', $product->category->slug) }}"
                   class="hover:text-black transition">
                    {{ $product->category->name }}
                </a>

                <span>/</span>

                <span class="text-gray-800">
                    {{ $product->name }}
                </span>

            </div>

        </div>
    </div>


    {{-- Product --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 lg:py-24">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">


            {{-- =================================================
     LEFT - PRODUCT IMAGE
================================================== --}}

<div>

    @if($product->primaryImage)

        <div
            id="product-image-gallery"
            class="bg-gray-50 overflow-hidden rounded-lg relative">

            {{-- Main Image --}}
            <img
                id="main-product-image"
                src="{{ Storage::url($product->primaryImage->image) }}"
                alt="{{ $product->name }}"
                class="w-full aspect-square object-contain transition-transform duration-300"
                style="transform: scale(1);">

            {{-- LEFT ARROW --}}
            @if($product->images->count() > 1)

                <button
                    type="button"
                    id="prev-image"
                    class="absolute left-3 top-1/2 -translate-y-1/2
                           w-10 h-10
                           flex items-center justify-center
                           bg-[#BE8B3E] border border-[#BE8B3E] hover:bg-white hover:text-[#BE8B3E] cursor-pointer
                           rounded-full
                           shadow-sm
                           text-xl text-white
                           transition
                           z-10"
                    aria-label="Previous image">
                    ‹
                </button>

                {{-- RIGHT ARROW --}}
                <button
                    type="button"
                    id="next-image"
                    class="absolute right-3 top-1/2 -translate-y-1/2
                           w-10 h-10
                           flex items-center justify-center
                           bg-[#BE8B3E] border border-[#BE8B3E] hover:bg-white hover:text-[#BE8B3E] cursor-pointer
                           rounded-full
                           shadow-sm
                           text-xl text-white
                           transition
                           z-10"
                    aria-label="Next image"
                >
                    ›
                </button>

            @endif


            {{-- ZOOM CONTROLS --}}
            <div
                class="absolute bottom-3 right-3
                       flex items-center gap-1
                       bg-white/90
                       rounded-lg
                       shadow-sm
                       overflow-hidden
                       z-10">

                <button
                    type="button"
                    id="zoom-out"
                    class="w-9 h-9 flex items-center justify-center
                           text-lg text-gray-700
                           hover:bg-[#BE8B3E] hover:text-white cursor-pointer transition"
                    aria-label="Zoom out">
                    −
                </button>

                <button
                    type="button"
                    id="zoom-reset"
                    class="w-9 h-9 flex items-center justify-center
                           text-xs text-gray-600
                           hover:bg-[#BE8B3E] hover:text-white cursor-pointer transition"
                    aria-label="Reset zoom">
                    1×
                </button>

                <button
                    type="button"
                    id="zoom-in"
                    class="w-9 h-9 flex items-center justify-center
                           text-lg text-gray-700
                           hover:bg-[#BE8B3E] hover:text-white cursor-pointer transition"
                    aria-label="Zoom in">
                    +
                </button>

            </div>

        </div>

    @else

        <div class="w-full aspect-square bg-gray-100 flex items-center justify-center">

            <span class="text-sm text-gray-400">
                No image available
            </span>

        </div>

    @endif


    {{-- Other Images --}}
    @if($product->images->count() > 1)

        <div class="grid grid-cols-5 gap-3 mt-4">

            @foreach($product->images->sortBy('sort_order') as $image)

                <button
                    type="button"
                    class="product-thumbnail bg-gray-50 overflow-hidden text-left rounded-full cursor-pointer"
                    data-image="{{ Storage::url($image->image) }}">

                    <img
                        src="{{ Storage::url($image->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full aspect-square object-contain">

                </button>

            @endforeach

        </div>

    @endif

</div>

            {{-- =================================================
                 RIGHT - PRODUCT INFORMATION
            ================================================== --}}

            <div class="flex flex-col justify-center">


                {{-- Category --}}
                <div class="mb-5">

                    <span class="text-[10px] tracking-[0.35em] uppercase text-[#BE8B3E]">
                        {{ $product->category->name }}
                    </span>

                </div>


                {{-- Product Name --}}
                <h1 class="text-4xl lg:text-5xl font-light tracking-tight text-gray-900 leading-tight">

                    {{ $product->name }}

                </h1>


                {{-- SKU --}}
                @if($product->sku)

                    <div class="mt-4 text-xs tracking-wide text-gray-400 uppercase">

                        SKU: {{ $product->sku }}

                    </div>

                @endif


                {{-- Price --}}
                <div class="mt-8 pb-8 border-b border-gray-200">

                    @if($product->sale_price)

                        <div class="flex items-center gap-4">

                            <span class="text-2xl font-medium text-gray-900">

                                PKR {{ number_format($product->sale_price) }}

                            </span>

                            <span class="text-sm text-gray-400 line-through">

                                PKR {{ number_format($product->price) }}

                            </span>

                        </div>

                    @else

                        <span class="text-2xl font-medium text-gray-900">

                            PKR {{ number_format($product->price) }}

                        </span>

                    @endif

                </div>


                {{-- Description --}}
                @if($product->description)

                    <div class="mt-8">

                        <h2 class="text-xs font-medium tracking-[0.18em] uppercase text-gray-900 mb-4">

                            Description

                        </h2>

                        <div class="text-sm leading-7 text-gray-500">

                            {!! nl2br(e($product->description)) !!}

                        </div>

                    </div>

                @endif


                {{-- Stock --}}
                <div class="mt-7">

                    @if($product->stock > 0)

                        <span class="text-sm text-green-600">
                            In Stock
                        </span>

                    @else

                        <span class="text-sm text-red-500">
                            Out of Stock
                        </span>

                    @endif

                </div>


                {{-- WhatsApp --}}
@if($product->stock > 0)

    @php

        // Product Image URL
        $productImageUrl = '';

        if ($product->primaryImage) {
            $productImageUrl = Storage::url($product->primaryImage->image);
        }

        // Product Price
        $orderPrice = $product->sale_price
            ? $product->sale_price
            : $product->price;

        // Product Page URL
        $productPageUrl = url('/product/' . $product->slug);

        // WhatsApp Message
        $whatsappMessage =
            "Assalam o Alaikum,\n\n" .
            "I want to order this product:\n\n" .
            "Product: " . $product->name . "\n" .
            "SKU: " . ($product->sku ?? 'N/A') . "\n" .
            "Price: PKR " . number_format($orderPrice) . "\n\n" .
            "Product Image:\n" .
            url($productImageUrl) . "\n\n" .
            "Product Page:\n" .
            $productPageUrl;

    @endphp

    <a
        href="https://wa.me/923121353516?text={{ urlencode($whatsappMessage) }}"
        target="_blank"
        rel="noopener noreferrer"
        class="mt-8 w-full border border-[#BE8B3E] text-[#BE8B3E] rounded-full py-4 px-6 text-center text-xs font-semibold tracking-widest uppercase hover:bg-[#BE8B3E] hover:text-white transition">

        Order on WhatsApp

    </a>

@endif


                {{-- Back to Shop --}}
                <div class="mt-7">

                    <a
                        href="{{ route('shop') }}"
                        class="inline-flex items-center gap-2 text-sm text-gray-700 border-b border-gray-700 pb-1 hover:text-[#BE8B3E] hover:border-[#BE8B3E] transition">

                        ← Back to Shop

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- =================================================
     PRODUCT IMAGE GALLERY SCRIPT
================================================== --}}

@if($product->primaryImage)

<script>
document.addEventListener('DOMContentLoaded', function () {

    const mainImage = document.getElementById('main-product-image');
    const prevButton = document.getElementById('prev-image');
    const nextButton = document.getElementById('next-image');

    const zoomInButton = document.getElementById('zoom-in');
    const zoomOutButton = document.getElementById('zoom-out');
    const zoomResetButton = document.getElementById('zoom-reset');

    const thumbnails = Array.from(
        document.querySelectorAll('.product-thumbnail')
    );

    if (!mainImage) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Images
    |--------------------------------------------------------------------------
    */

    const images = thumbnails.map(function (thumbnail) {
        return thumbnail.dataset.image;
    });

    /*
    |--------------------------------------------------------------------------
    | Find Primary Image
    |--------------------------------------------------------------------------
    */

    let currentIndex = images.indexOf(mainImage.src);

    if (currentIndex === -1) {
        currentIndex = 0;
    }


    /*
    |--------------------------------------------------------------------------
    | Zoom
    |--------------------------------------------------------------------------
    */

    let zoomLevel = 1;

    const minZoom = 1;
    const maxZoom = 3;
    const zoomStep = 0.25;


    function updateZoom() {

    mainImage.style.transform = `scale(${zoomLevel})`;

    if (zoomResetButton) {
        zoomResetButton.textContent = `${zoomLevel}×`;
    }

    }


    function updateImage(index) {

        if (!images.length) {
            return;
        }

        currentIndex = index;

        if (currentIndex < 0) {
            currentIndex = images.length - 1;
        }

        if (currentIndex >= images.length) {
            currentIndex = 0;
        }


        mainImage.src = images[currentIndex];


        /*
        | Reset zoom whenever image changes
        */

        zoomLevel = 1;
        updateZoom();


        /*
        | Highlight current thumbnail
        */

        thumbnails.forEach(function (thumbnail, index) {

            if (index === currentIndex) {

                thumbnail.classList.add('ring-2', 'ring-[#BE8B3E]');

            } else {

                thumbnail.classList.remove('ring-2', 'ring-[#BE8B3E]');

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Previous Image
    |--------------------------------------------------------------------------
    */

    if (prevButton) {

        prevButton.addEventListener('click', function () {

            updateImage(currentIndex - 1);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Next Image
    |--------------------------------------------------------------------------
    */

    if (nextButton) {

        nextButton.addEventListener('click', function () {

            updateImage(currentIndex + 1);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Thumbnail Click
    |--------------------------------------------------------------------------
    */

    thumbnails.forEach(function (thumbnail, index) {

        thumbnail.addEventListener('click', function () {

            updateImage(index);

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Zoom In
    |--------------------------------------------------------------------------
    */

    if (zoomInButton) {

        zoomInButton.addEventListener('click', function () {

            if (zoomLevel < maxZoom) {

                zoomLevel += zoomStep;

                updateZoom();

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Zoom Out
    |--------------------------------------------------------------------------
    */

    if (zoomOutButton) {

        zoomOutButton.addEventListener('click', function () {

            if (zoomLevel > minZoom) {

                zoomLevel -= zoomStep;

                updateZoom();

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Reset Zoom
    |--------------------------------------------------------------------------
    */

    if (zoomResetButton) {

        zoomResetButton.addEventListener('click', function () {

            zoomLevel = 1;

            updateZoom();

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Keyboard Navigation
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function (event) {

        if (event.key === 'ArrowLeft') {

            updateImage(currentIndex - 1);

        }

        if (event.key === 'ArrowRight') {

            updateImage(currentIndex + 1);

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Initial Thumbnail Highlight
    |--------------------------------------------------------------------------
    */

    updateImage(currentIndex);

});
</script>

@endif

@endsection