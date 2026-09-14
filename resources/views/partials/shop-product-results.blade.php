                @if($products->count())

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 sm:gap-x-6 gap-y-12">

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
                                $productSkinTypes = is_array($product->skin_types) ? $product->skin_types : [];
                                $productConcerns = is_array($product->concerns) ? $product->concerns : [];
                                $productForms = is_array($product->product_forms) ? $product->product_forms : [];
                            @endphp

                            <article
                                class="group product-card"
                                data-cosmetic-product-type="{{ $product->cosmetic_product_type ?? '' }}"
                                data-cosmetic-skin-types="{{ implode(',', $productSkinTypes) }}"
                                data-cosmetic-concerns="{{ implode(',', $productConcerns) }}"
                                data-cosmetic-product-forms="{{ implode(',', $productForms) }}"
                                data-brand="{{ $product->brand ?? '' }}"
                            >

                                {{-- IMAGE --}}

                                <div class="relative overflow-hidden bg-gray-100 aspect-[4/5]">

                                    <a
                                        href="{{ route(
                                            'product.show',
                                            $product->slug
                                        ) }}"
                                        class="block w-full h-full"
                                    >

                                        <img
                                            src="{{ $imageUrl }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transition duration-700 group-hover:scale-105"
                                            loading="lazy"
                                            onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';"
                                        >

                                    </a>


                                    {{-- FEATURED --}}

                                    @if($product->is_featured)

                                        <span
                                            class="absolute top-4 left-4 bg-black text-white text-[10px] uppercase tracking-widest px-3 py-2"
                                        >
                                            Featured
                                        </span>

                                    @endif


                                    {{-- SALE --}}

                                    @if(
                                        $product->sale_price &&
                                        $product->price > $product->sale_price
                                    )

                                        <span
                                            class="absolute top-4 right-4 bg-[#b38b2c] text-white text-[10px] uppercase tracking-widest px-3 py-2"
                                        >
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
                                        class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur text-black py-3 text-xs font-semibold uppercase tracking-widest opacity-0 translate-y-3 group-hover:opacity-100 group-hover:translate-y-0 transition duration-300"
                                    >
                                        Add to Bag
                                    </button>

                                </div>


                                {{-- DETAILS --}}

                                <div class="pt-5">

                                    <p class="text-[10px] uppercase tracking-widest text-gray-400">
                                        {{ $product->category?->name ?? 'Product' }}
                                    </p>

                                    <h3 class="mt-2 text-sm font-medium text-gray-900">
                                        <a
                                            href="{{ route(
                                                'product.show',
                                                $product->slug
                                            ) }}"
                                            class="hover:opacity-60 transition"
                                        >
                                            {{ $product->name }}
                                        </a>
                                    </h3>


                                    <div class="mt-2">

                                        @if(
                                            $product->sale_price &&
                                            $product->price > $product->sale_price
                                        )

                                            <span class="text-sm text-black">
                                                PKR {{ number_format($product->sale_price) }}
                                            </span>

                                            <span class="ml-2 text-xs text-gray-400 line-through">
                                                PKR {{ number_format($product->price) }}
                                            </span>

                                        @else

                                            <span class="text-sm text-gray-600">
                                                PKR {{ number_format($product->price) }}
                                            </span>

                                        @endif

                                    </div>


                                    {{-- WHATSAPP --}}

                                    <button
                                        type="button"
                                        onclick="orderOnWhatsApp(@json($product->name))"
                                        class="mt-4 text-[10px] uppercase tracking-widest text-gray-400 hover:text-black transition"
                                    >
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

                    <div class="py-24 text-center">

                        <div class="mx-auto w-16 h-16 border border-gray-300 rounded-full flex items-center justify-center">

                            <svg
                                class="w-6 h-6 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    cx="11"
                                    cy="11"
                                    r="7"
                                    stroke-width="1.5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-width="1.5"
                                    d="m20 20-4-4"
                                />

                            </svg>

                        </div>

                        <h3 class="mt-6 text-xl font-light">
                            No products found
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Try changing or clearing your filters.
                        </p>

                        <a
                            href="{{ $selectedCategory
                                ? route('shop', ['category' => $selectedCategory->slug])
                                : route('shop') }}"
                            class="inline-flex mt-7 border border-black px-6 py-3 text-xs uppercase tracking-widest hover:bg-black hover:text-white transition"
                        >
                            Clear Filters
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>