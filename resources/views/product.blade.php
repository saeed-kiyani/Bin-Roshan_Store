@extends('layouts.app')

@section('title', $product->name . ' | Bin Ismail')

@section('description', $product->description ?? '')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | PRODUCT DATA
    |--------------------------------------------------------------------------
    */

    $price = $product->sale_price ?? $product->price;

    // Primary image, otherwise first product image
    $primaryImage = $product->primaryImage ?? $product->images->first();

    // Placeholder
    $fallbackImage = asset('images/placeholder.jpg');

    // Main image URL
    $mainImage = $fallbackImage;

    if ($primaryImage && $primaryImage->image) {
        $imagePath = $primaryImage->image;

        $mainImage = str_starts_with($imagePath, 'http')
            ? $imagePath
            : asset('storage/' . ltrim($imagePath, '/'));
    }
@endphp


{{-- =========================================================
BREADCRUMB
========================================================= --}}

<section class="bg-[#f7f5f0] border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="py-5 flex items-center gap-2 text-xs text-gray-500">

            <a
                href="{{ url('/') }}"
                class="hover:text-black transition"
            >
                Home
            </a>

            <span>/</span>

            <a
                href="{{ route('shop') }}"
                class="hover:text-black transition"
            >
                Shop
            </a>

            @if($product->category)

                <span>/</span>

                <span class="text-gray-700">
                    {{ $product->category->name }}
                </span>

            @endif

            <span>/</span>

            <span class="text-gray-900">
                {{ $product->name }}
            </span>

        </div>

    </div>

</section>


{{-- =========================================================
PRODUCT DETAILS
========================================================= --}}

<section class="py-16 lg:py-24 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20">


            {{-- =================================================
                 PRODUCT GALLERY
            ================================================= --}}

            <div>

                {{-- MAIN IMAGE --}}

                <div class="relative bg-gray-100 aspect-[4/5] overflow-hidden">

                    <img
                        id="main-product-image"
                        src="{{ $mainImage }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover"
                    >

                </div>


                {{-- THUMBNAILS --}}

                @if($product->images->count() > 0)

                    <div class="grid grid-cols-4 gap-3 mt-4">

                        @foreach($product->images as $index => $image)

                            @php
                                $imagePath = $image->image;

                                $imageUrl = $imagePath
                                    ? (
                                        str_starts_with($imagePath, 'http')
                                            ? $imagePath
                                            : asset('storage/' . ltrim($imagePath, '/'))
                                    )
                                    : $fallbackImage;
                            @endphp

                            <button
                                type="button"
                                onclick="changeProductImage(@js($imageUrl), this)"
                                class="product-thumbnail aspect-square overflow-hidden bg-gray-100 border-2 {{ $imageUrl === $mainImage ? 'border-black' : 'border-transparent' }}"
                                aria-label="View product image {{ $index + 1 }}"
                            >

                                <img
                                    src="{{ $imageUrl }}"
                                    alt="{{ $product->name }} - Image {{ $index + 1 }}"
                                    class="w-full h-full object-cover"
                                >

                            </button>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- =================================================
                 PRODUCT INFORMATION
            ================================================= --}}

            <div class="lg:py-6">

                {{-- CATEGORY --}}

                @if($product->category)

                    <p class="text-xs uppercase tracking-[0.35em] text-[#a47c15] font-semibold">
                        {{ $product->category->name }}
                    </p>

                @endif


                {{-- PRODUCT NAME --}}

                <h1 class="mt-5 text-4xl sm:text-5xl font-light leading-tight text-gray-950">
                    {{ $product->name }}
                </h1>


                {{-- SKU --}}

                @if($product->sku)

                    <p class="mt-3 text-xs uppercase tracking-widest text-gray-400">
                        SKU: {{ $product->sku }}
                    </p>

                @endif


                {{-- PRICE --}}

                <div class="mt-6 flex flex-wrap items-center gap-5">

                    <p class="text-2xl font-medium text-gray-950">
                        PKR {{ number_format((float) $price) }}
                    </p>

                    @if(
                        $product->sale_price !== null &&
                        (float) $product->price > (float) $product->sale_price
                    )

                        <p class="text-lg text-gray-400 line-through">
                            PKR {{ number_format((float) $product->price) }}
                        </p>

                    @endif


                    <span class="h-5 w-px bg-gray-300"></span>


                    {{-- STOCK STATUS --}}

                    @if($product->stock > 0)

                        <p class="text-xs uppercase tracking-widest text-green-600">
                            In Stock
                        </p>

                    @else

                        <p class="text-xs uppercase tracking-widest text-red-600">
                            Out of Stock
                        </p>

                    @endif

                </div>


                <div class="mt-8 h-px bg-gray-200"></div>


                {{-- =================================================
                     DESCRIPTION
                ================================================= --}}

                @if($product->description)

                    <div class="mt-8">

                        <h2 class="text-sm font-semibold uppercase tracking-widest">
                            Description
                        </h2>

                        <p class="mt-4 text-gray-600 leading-8 whitespace-pre-line">
                            {{ $product->description }}
                        </p>

                    </div>

                @endif


                {{-- =================================================
                     QUANTITY
                ================================================= --}}

                @if($product->stock > 0)

                    <div class="mt-9">

                        <h2 class="text-sm font-semibold uppercase tracking-widest">
                            Quantity
                        </h2>

                        <div class="mt-4 inline-flex items-center border border-gray-300">

                            <button
                                type="button"
                                onclick="decreaseQuantity()"
                                class="w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition"
                                aria-label="Decrease quantity"
                            >
                                −
                            </button>

                            <span
                                id="quantity"
                                class="w-12 text-center"
                            >
                                1
                            </span>

                            <button
                                type="button"
                                onclick="increaseQuantity()"
                                class="w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition"
                                aria-label="Increase quantity"
                            >
                                +
                            </button>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     ACTION BUTTONS
                ================================================= --}}

                <div class="mt-10 space-y-3">

                    @if($product->stock > 0)

                        <button
                            type="button"
                            onclick="addProductToCart()"
                            class="w-full bg-black text-white py-5 text-sm font-semibold uppercase tracking-widest hover:bg-[#a47c15] transition duration-300"
                        >
                            Add to Bag
                        </button>

                    @else

                        <button
                            type="button"
                            disabled
                            class="w-full bg-gray-300 text-gray-600 py-5 text-sm font-semibold uppercase tracking-widest cursor-not-allowed"
                        >
                            Out of Stock
                        </button>

                    @endif


                    <button
                        type="button"
                        onclick="orderProduct()"
                        class="w-full border border-gray-900 py-5 text-sm font-semibold uppercase tracking-widest hover:bg-gray-50 transition"
                    >
                        Order on WhatsApp
                    </button>


                    <a
                        href="{{ route('shop') }}"
                        class="w-full border border-gray-900 py-5 text-sm font-semibold uppercase tracking-widest flex items-center justify-center hover:bg-gray-50 transition"
                    >
                        Continue Shopping
                    </a>

                </div>


                {{-- =================================================
                     DELIVERY / SUPPORT
                ================================================= --}}

                <div class="mt-10 border-t border-gray-200">


                    {{-- EASY ORDERING --}}

                    <div class="py-5 border-b border-gray-200 flex gap-4">

                        <svg
                            class="w-5 h-5 flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M5 12h14m-7-7 7 7-7 7"
                            />
                        </svg>

                        <div>

                            <h3 class="text-sm font-medium">
                                Easy Ordering
                            </h3>

                            <p class="mt-1 text-xs text-gray-500">
                                Order directly through WhatsApp.
                            </p>

                        </div>

                    </div>


                    {{-- CUSTOMER SUPPORT --}}

                    <div class="py-5 border-b border-gray-200 flex gap-4">

                        <svg
                            class="w-5 h-5 flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0c0-4.97 4.03-9 9-9s9 4.03 9 9Z"
                            />
                        </svg>

                        <div>

                            <h3 class="text-sm font-medium">
                                Customer Support
                            </h3>

                            <p class="mt-1 text-xs text-gray-500">
                                Contact us for product details and availability.
                            </p>

                        </div>

                    </div>


                    {{-- SECURE & SIMPLE --}}

                    <div class="py-5 flex gap-4">

                        <svg
                            class="w-5 h-5 flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M3 10h18M5 6h14a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2Z"
                            />
                        </svg>

                        <div>

                            <h3 class="text-sm font-medium">
                                Secure & Simple
                            </h3>

                            <p class="mt-1 text-xs text-gray-500">
                                Confirm your order directly with our team.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
RELATED PRODUCTS
========================================================= --}}

@if(isset($relatedProducts) && $relatedProducts->count() > 0)

<section class="py-24 bg-[#f7f5f0]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">

            <p class="text-xs uppercase tracking-[0.4em] text-[#a47c15] font-semibold">
                You may also like
            </p>

            <h2 class="mt-4 text-4xl font-light">
                More from Bin Ismail
            </h2>

        </div>


        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

            @foreach($relatedProducts as $related)

                @php
                    $relatedImage = $related->primaryImage ?? $related->images->first();

                    $relatedImageUrl = $fallbackImage;

                    if ($relatedImage && $relatedImage->image) {
                        $relatedImagePath = $relatedImage->image;

                        $relatedImageUrl = str_starts_with($relatedImagePath, 'http')
                            ? $relatedImagePath
                            : asset('storage/' . ltrim($relatedImagePath, '/'));
                    }

                    $relatedPrice = $related->sale_price ?? $related->price;
                @endphp


                <a
                    href="{{ route('product.show', $related->slug) }}"
                    class="group"
                >

                    <div class="aspect-[4/5] overflow-hidden bg-white">

                        <img
                            src="{{ $relatedImageUrl }}"
                            alt="{{ $related->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                        >

                    </div>


                    @if($related->category)

                        <p class="mt-4 text-xs uppercase tracking-widest text-gray-400">
                            {{ $related->category->name }}
                        </p>

                    @endif


                    <h3 class="mt-2 text-sm">
                        {{ $related->name }}
                    </h3>


                    <p class="mt-2 text-sm font-medium">
                        PKR {{ number_format((float) $relatedPrice) }}
                    </p>

                </a>

            @endforeach

        </div>

    </div>

</section>

@endif


{{-- =========================================================
WHATSAPP FLOATING BUTTON
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
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.1-.198.05-.372-.025-.521-.075-.149-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.077 4.487.709.306 1.262.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.002 5.45-4.438 9.884-9.889 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.304-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.478-8.413"/>
    </svg>

</a>


{{-- =========================================================
JAVASCRIPT
========================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | PRODUCT STATE
    |--------------------------------------------------------------------------
    */

    let quantity = 1;

    const maxStock = Number(@js($product->stock));


    /*
    |--------------------------------------------------------------------------
    | CHANGE MAIN PRODUCT IMAGE
    |--------------------------------------------------------------------------
    */

    function changeProductImage(image, button) {

        const mainImage = document.getElementById('main-product-image');

        if (mainImage) {
            mainImage.src = image;
        }

        document
            .querySelectorAll('.product-thumbnail')
            .forEach(item => {

                item.classList.remove('border-black');

                item.classList.add('border-transparent');

            });


        if (button) {

            button.classList.remove('border-transparent');

            button.classList.add('border-black');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | QUANTITY
    |--------------------------------------------------------------------------
    */

    function increaseQuantity() {

        if (quantity < maxStock) {

            quantity++;

        }

        updateQuantityDisplay();

    }


    function decreaseQuantity() {

        if (quantity > 1) {

            quantity--;

        }

        updateQuantityDisplay();

    }


    function updateQuantityDisplay() {

        const quantityElement =
            document.getElementById('quantity');

        if (quantityElement) {

            quantityElement.textContent = quantity;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | ADD PRODUCT TO CART
    |--------------------------------------------------------------------------
    */

    function addProductToCart() {

        if (maxStock <= 0) {

            alert('This product is currently out of stock.');

            return;

        }


        const product = {

            id: @js($product->id),

            name: @js($product->name),

            price: Number(@js($price)),

            image: @js($mainImage),

            quantity: quantity

        };


        if (typeof addToCart === 'function') {

            addToCart(product);

        } else {

            console.error(
                'addToCart() function is not available.'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | ORDER ON WHATSAPP
    |--------------------------------------------------------------------------
    */

    function orderProduct() {

        const productName =
            @js($product->name);

        const productPrice =
            Number(@js($price));


        let message =
            "Hello Bin Ismail!\n\n" +

            "I am interested in ordering:\n" +

            "Product: " +
            productName +
            "\n" +

            "Price: PKR " +
            productPrice.toLocaleString() +
            "\n" +

            "Quantity: " +
            quantity;


        message +=
            "\n\nPlease share availability and ordering details.";


        const phone =
            @js(config('store.whatsapp'));


        if (!phone) {

            console.error(
                'WhatsApp number is not configured.'
            );

            return;

        }


        const url =
            "https://wa.me/" +
            phone +
            "?text=" +
            encodeURIComponent(message);


        window.open(url, '_blank');

    }

</script>

@endsection