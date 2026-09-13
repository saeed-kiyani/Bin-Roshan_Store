@extends('layouts.app')

@section('title', $product->name . ' | Bin Ismail')

@section('description', Str::limit(strip_tags($product->description), 160))

@section('content')

{{-- =========================================================
     PRODUCT DETAIL
========================================================= --}}

<section class="bg-white">

    {{-- Breadcrumb --}}
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-5">

            <div class="flex items-center gap-2 text-xs text-gray-500">

                <a href="{{ url('/') }}"
                   class="hover:text-black transition">
                    Home
                </a>

                <span>/</span>

                <a href="{{ route('category.show', $product->category->slug) }}"
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

                    <div class="bg-gray-50 overflow-hidden">

                        <img
                            src="{{ Storage::url($product->primaryImage->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full aspect-square object-contain"
                        >

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

                            <div class="bg-gray-50 overflow-hidden">

                                <img
                                    src="{{ Storage::url($image->image) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full aspect-square object-contain"
                                >

                            </div>

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

                    <span class="text-[10px] tracking-[0.35em] uppercase text-[#b08a3c]">
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
        class="mt-8 w-full bg-black text-white py-4 px-6 text-center text-xs font-semibold tracking-widest uppercase hover:bg-gray-800 transition"
    >

        Order on WhatsApp

    </a>

@endif


                {{-- Back to Shop --}}
                <div class="mt-7">

                    <a
                        href="{{ route('shop') }}"
                        class="inline-flex items-center gap-2 text-sm text-gray-700 border-b border-gray-700 pb-1 hover:text-black hover:border-black transition"
                    >

                        ← Back to Shop

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection