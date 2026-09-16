@extends('layouts.admin')

@section('title', 'Edit Product | Bin Ismail')

@section('content')

@php

    $primaryImageId = optional($product->primaryImage)->id;

    /*
    |--------------------------------------------------------------------------
    | Lace Categories
    |--------------------------------------------------------------------------
    */

    $laceCategories = [

        'basic_everyday' => [
            'label' => 'Basic & Everyday Laces',
            'subcategories' => [
                'cotton' => 'Cotton Laces',
                'plain' => 'Plain Laces',
                'printed' => 'Printed Laces',
                'thread' => 'Thread Laces',
            ],
        ],

        'embroidered' => [
            'label' => 'Embroidered Laces',
            'subcategories' => [
                'embroidery' => 'Embroidery Laces',
                'organza' => 'Organza Laces',
                'chiffon' => 'Chiffon Laces',
                'net' => 'Net Laces',
                'cutwork' => 'Cutwork Laces',
                'applique' => 'Appliqué Laces',
            ],
        ],

        'fancy' => [
            'label' => 'Fancy Laces',
            'subcategories' => [
                'sequin' => 'Sequin Laces',
                'stone' => 'Stone Laces',
                'crystal' => 'Crystal Laces',
                'pearl' => 'Pearl Laces',
                'moti' => 'Moti Laces',
                'mirror_work' => 'Mirror Work Laces',
                'shimmer' => 'Shimmer Laces',
                'fancy_designer' => 'Fancy Designer Laces',
            ],
        ],

        'traditional' => [
            'label' => 'Traditional Laces',
            'subcategories' => [
                'gota' => 'Gota Laces',
                'gota_patti' => 'Gota Patti Laces',
                'dori' => 'Dori Laces',
                'zari' => 'Zari Laces',
                'tilla' => 'Tilla Laces',
                'resham' => 'Resham Laces',
                'traditional_border' => 'Traditional Border Laces',
            ],
        ],

        'suit_specific' => [
            'label' => 'Suit-Specific Laces',
            'subcategories' => [
                'daman' => 'Daman Laces',
                'neckline' => 'Neckline Laces',
                'sleeve' => 'Sleeve Laces',
                'trouser' => 'Trouser Laces',
                'dupatta' => 'Dupatta Laces',
                'shirt_border' => 'Shirt Border Laces',
                'side_border' => 'Side Border Laces',
            ],
        ],

        'premium_bridal' => [
            'label' => 'Premium / Bridal',
            'subcategories' => [
                'bridal' => 'Bridal Laces',
                'heavy_bridal' => 'Heavy Bridal Laces',
                'premium_designer' => 'Premium Designer Laces',
            ],
        ],

    ];


    /*
    |--------------------------------------------------------------------------
    | Existing Lace Values
    |--------------------------------------------------------------------------
    */

    $selectedLaceSubcategories = old(
        'lace_subcategories',
        $product->lace_subcategories ?? []
    );

    $selectedWidth = old(
        'width',
        $product->width ?? []
    );

    $selectedHeight = old(
        'height',
        $product->height ?? []
    );

    $selectedLength = old(
        'length',
        $product->length ?? []
    );


    
    $cosmeticBrands = [
        'Maybelline' => 'Maybelline',
        "L'Oréal Paris" => "L'Oréal Paris",
        'MAC' => 'MAC',
        'Huda Beauty' => 'Huda Beauty',
        'NYX Professional Makeup' => 'NYX Professional Makeup',
        'The Ordinary' => 'The Ordinary',
        'CeraVe' => 'CeraVe',
        'NARS' => 'NARS',
        'Revlon' => 'Revlon',
        'Wet n Wild' => 'Wet n Wild',
        'Essence' => 'Essence',
        'Garnier' => 'Garnier',
        'Neutrogena' => 'Neutrogena',
        'Lakmé' => 'Lakmé',
        'Fenty Beauty' => 'Fenty Beauty',
        'Rare Beauty' => 'Rare Beauty',
        'e.l.f. Cosmetics' => 'e.l.f. Cosmetics',
        'Makeup Revolution' => 'Makeup Revolution',
        'Dove' => 'Dove',
        'Other' => 'Other',
    ];

    $cosmeticProductTypes = [
        'makeup' => 'Makeup',
        'skincare' => 'Skincare',
        'haircare' => 'Haircare',
        'fragrance' => 'Fragrance',
        'body_care' => 'Body Care',
        'nail_care' => 'Nail Care',
    ];

    $cosmeticSkinTypes = [
        'all_skin_types' => 'All Skin Types',
        'oily' => 'Oily',
        'dry' => 'Dry',
        'combination' => 'Combination',
        'sensitive' => 'Sensitive',
    ];

    $cosmeticConcerns = [
        'hydration' => 'Hydration',
        'brightening' => 'Brightening',
        'acne_blemishes' => 'Acne & Blemishes',
        'oil_control' => 'Oil Control',
        'anti_aging' => 'Anti-Aging',
        'sun_protection' => 'Sun Protection',
        'hair_fall' => 'Hair Fall',
        'frizz_control' => 'Frizz Control',
    ];

    $cosmeticProductForms = [
        'cream' => 'Cream',
        'gel' => 'Gel',
        'serum' => 'Serum',
        'lotion' => 'Lotion',
        'powder' => 'Powder',
        'liquid' => 'Liquid',
        'spray' => 'Spray',
        'stick' => 'Stick',
    ];

@endphp


<div class="min-h-screen bg-gray-50 py-12">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10">

            <a
                href="{{ route('admin.products.index') }}"
                class="text-xs uppercase tracking-widest text-gray-500 hover:text-black transition"
            >
                ← Back to Products
            </a>

            <p class="mt-8 text-xs uppercase tracking-[0.35em] text-[#a47c15] font-semibold">
                Admin Panel
            </p>

            <h1 class="mt-3 text-4xl font-light">
                Edit Product
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                {{ $product->name }}
            </p>

        </div>


        {{-- SUCCESS --}}

        @if(session('success'))

            <div class="mb-8 bg-green-50 border border-green-200 text-green-800 px-5 py-4 text-sm">
                {{ session('success') }}
            </div>

        @endif


        {{-- ERRORS --}}

        @if($errors->any())

            <div class="mb-8 bg-red-50 border border-red-200 text-red-800 px-5 py-4">

                <ul class="text-sm space-y-1">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- EXISTING IMAGES --}}

        <div class="bg-white border border-gray-200 p-6 sm:p-10 mb-8">

            <div class="flex items-center justify-between mb-7">

                <div>

                    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
                        Product Images
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Click "Make Primary" to change the main product image.
                    </p>

                </div>

            </div>


            @if($product->images->count())

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">

                    @foreach($product->images as $image)

                        @php

                            $imageUrl = $image->image;

                            if ($imageUrl && !str_starts_with($imageUrl, 'http')) {
                                $imageUrl = asset('storage/' . ltrim($imageUrl, '/'));
                            }

                        @endphp


                        <div class="border border-gray-200 p-3">

                            <div class="relative">

                                <img
                                    src="{{ $imageUrl }}"
                                    alt="{{ $product->name }}"
                                    class="w-full aspect-[4/5] object-cover bg-gray-100"
                                >


                                @if($image->is_primary)

                                    <span class="absolute top-2 left-2 bg-black text-white px-3 py-1 text-[9px] uppercase tracking-widest font-semibold">
                                        Primary
                                    </span>

                                @endif

                            </div>


                            <div class="mt-3 space-y-2">


                                @if(!$image->is_primary)

                                    <form
                                        action="{{ route('admin.products.images.primary', $image) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="w-full border border-gray-300 px-3 py-2 text-[10px] uppercase tracking-widest hover:bg-black hover:text-white hover:border-black transition"
                                        >
                                            Make Primary
                                        </button>

                                    </form>

                                @endif


                                <form
                                    action="{{ route('admin.products.images.destroy', $image) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this image?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="w-full border border-red-200 text-red-600 px-3 py-2 text-[10px] uppercase tracking-widest hover:bg-red-600 hover:text-white hover:border-red-600 transition"
                                    >
                                        Delete Image
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="border border-dashed border-gray-300 px-6 py-12 text-center">

                    <p class="text-sm text-gray-400">
                        No product images uploaded yet.
                    </p>

                </div>

            @endif

        </div>


        {{-- PRODUCT FORM --}}

        <form
            action="{{ route('admin.products.update', $product) }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white border border-gray-200 p-6 sm:p-10"
        >

            @csrf
            @method('PUT')


            {{-- CATEGORY --}}

<div>

    <label
        for="category_id"
        class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
    >
        Category
    </label>

    <select
        id="category_id"
        name="category_id"
        required
        class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
    >

        @foreach($categories as $category)

            @php
                $categoryId = is_array($category)
                    ? ($category['id'] ?? null)
                    : ($category->id ?? null);

                $categoryName = is_array($category)
                    ? ($category['name'] ?? '')
                    : ($category->name ?? '');

                $categorySlug = is_array($category)
                    ? ($category['slug'] ?? '')
                    : ($category->slug ?? '');
            @endphp

            <option
                value="{{ $categoryId }}"
                data-slug="{{ $categorySlug }}"
                {{ old('category_id', $product->category_id) == $categoryId ? 'selected' : '' }}
            >
                {{ $categoryName }}
            </option>

        @endforeach

    </select>

</div>


            {{-- NAME --}}

            <div class="mt-7">

                <label
                    for="name"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Product Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $product->name) }}"
                    required
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

            </div>


            {{-- SLUG --}}

            <div class="mt-7">

                <label
                    for="slug"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Slug
                </label>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug', $product->slug) }}"
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

            </div>


            {{-- SKU --}}

            <div class="mt-7">

                <label
                    for="sku"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    SKU
                </label>

                <input
                    type="text"
                    id="sku"
                    name="sku"
                    value="{{ old('sku', $product->sku) }}"
                    required
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

            </div>

{{-- =========================================================
     CLOTHING INFORMATION
========================================================= --}}
<div
    id="clothing-filter"
    data-filter-section="clothing"
    class="mt-7 border-t border-gray-200 pt-7">

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Clothing Information
    </p>


    {{-- GENDER --}}

    <div>

        <label
            for="gender"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Gender
        </label>

        <select
            id="gender"
            name="gender"
            class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
        >

            <option value="">
                Select Gender
            </option>

            <option value="men"
                {{ old('gender', $product->gender) === 'men' ? 'selected' : '' }}>
                Men
            </option>

            <option value="women"
                {{ old('gender', $product->gender) === 'women' ? 'selected' : '' }}>
                Women
            </option>

            <option value="kids"
                {{ old('gender', $product->gender) === 'kids' ? 'selected' : '' }}>
                Kids
            </option>

        </select>

    </div>


    {{-- BRAND --}}

    <div class="mt-7">

        <label
            for="brand"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Brand
        </label>

        <select
            id="brand"
            name="brand"
            class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
        >

            <option value="">
                Select Brand
            </option>

            <option value="Bin Ismail"
                {{ old('brand', $product->brand) === 'Bin Ismail' ? 'selected' : '' }}>
                Bin Ismail
            </option>

            <option value="J."
                {{ old('brand', $product->brand) === 'J.' ? 'selected' : '' }}>
                J.
            </option>

            <option value="Gul Ahmed"
                {{ old('brand', $product->brand) === 'Gul Ahmed' ? 'selected' : '' }}>
                Gul Ahmed
            </option>

            <option value="Khaadi"
                {{ old('brand', $product->brand) === 'Khaadi' ? 'selected' : '' }}>
                Khaadi
            </option>

            <option value="Other"
                {{ old('brand', $product->brand) === 'Other' ? 'selected' : '' }}>
                Other
            </option>

        </select>

    </div>


    {{-- SIZE --}}

    <div class="mt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Available Sizes
        </label>

        @php
            $selectedSizes = old('sizes', $product->sizes ?? []);
        @endphp

        <div class="mt-4 flex flex-wrap gap-6">

            @foreach(['S', 'M', 'L'] as $size)

                <label class="flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        name="sizes[]"
                        value="{{ $size }}"
                        {{ in_array($size, $selectedSizes) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        {{ $size }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>

</div>
{{-- END CLOTHING INFORMATION --}}

        {{-- =========================================================
     LACE INFORMATION
========================================================= --}}

<div
    id="lace-filter"
    data-filter-section="laces"
    class="mt-7 border-t border-gray-200 pt-7">

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Lace Information
    </p>


    {{-- LACE CATEGORY --}}

    <div>

        <select
            id="lace_category"
            name="lace_category"
            class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
        >

            <option value="">
                Select Lace Category
            </option>

            @foreach($laceCategories as $value => $category)

                <option
                    value="{{ $value }}"
                    {{ old('lace_category', $product->lace_category) === $value ? 'selected' : '' }}
                >
                    {{ $category['label'] }}
                </option>

            @endforeach

        </select>

    </div>


    {{-- LACE SUBCATEGORIES --}}

<div
    id="lace-subcategories-container"
    class="mt-7 hidden"
>

    <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
        Lace Subcategories
    </label>

    <p class="mt-2 text-xs text-gray-400">
        Select all subcategories that apply to this lace.
    </p>

    <div
        id="lace-subcategories"
        class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4"
    ></div>

</div>


    {{-- WIDTH --}}

    <div class="mt-7 border-t border-gray-200 pt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Width
        </label>

        <div class="mt-5 grid grid-cols-2 sm:grid-cols-3 gap-4">

            @foreach([
                '1 inch',
                '1.5 inch',
                '2 inch',
                '2.5 inch',
                '3 inch',
                '4 inch',
                '5 inch',
                '6 inch'
            ] as $widthOption)

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="width[]"
                        value="{{ $widthOption }}"
                        {{ in_array($widthOption, $selectedWidth) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-600">
                        {{ $widthOption }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>


    {{-- HEIGHT --}}

    <div class="mt-7 border-t border-gray-200 pt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Height
        </label>

        <div class="mt-5 grid grid-cols-2 sm:grid-cols-3 gap-4">

            @foreach([
                '1 inch',
                '1.5 inch',
                '2 inch',
                '2.5 inch',
                '3 inch',
                '4 inch',
                '5 inch',
                '6 inch'
            ] as $heightOption)

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="height[]"
                        value="{{ $heightOption }}"
                        {{ in_array($heightOption, $selectedHeight) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-600">
                        {{ $heightOption }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>


    {{-- LENGTH --}}

    <div class="mt-7 border-t border-gray-200 pt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Length
        </label>

        <div class="mt-5 grid grid-cols-2 sm:grid-cols-3 gap-4">

            @foreach([
                '1 yard',
                '2 yards',
                '3 yards',
                '5 yards',
                '10 yards',
                '20 yards',
                '25 yards',
                '50 yards'
            ] as $lengthOption)

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="length[]"
                        value="{{ $lengthOption }}"
                        {{ in_array($lengthOption, $selectedLength) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-600">
                        {{ $lengthOption }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>

</div>
{{-- END LACE INFORMATION --}}

{{-- =========================================================
     JEWELRY INFORMATION
========================================================= --}}
<div
    id="jewelry-filter"
    data-filter-section="jewelry"
    class="hidden mt-7 border-t border-gray-200 pt-7"
>
    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Jewelry Information
    </p>

    {{-- GENDER --}}
    <div>
        <p class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Gender
        </p>
        <div class="mt-4 flex flex-wrap gap-6">
            @php
                $selectedJewelryGender = old('jewelry_gender', $product->jewelry_gender ?? []);
                if (is_string($selectedJewelryGender)) {
                    $selectedJewelryGender = json_decode($selectedJewelryGender, true) ?? [];
                }
            @endphp

            @foreach(['men' => 'Men', 'women' => 'Women'] as $value => $label)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="checkbox"
                        name="jewelry_gender[]"
                        value="{{ $value }}"
                        {{ in_array($value, $selectedJewelryGender) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >
                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- JEWELRY TYPE --}}
    <div class="mt-7">
        <label
            for="jewelry_type"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Jewelry Type
        </label>

        <select
            id="jewelry_type"
            name="jewelry_type"
            class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
        >
            <option value="">Select Jewelry Type</option>
            <option value="earrings" {{ old('jewelry_type', $product->jewelry_type ?? '') === 'earrings' ? 'selected' : '' }}>Earrings</option>
            <option value="necklaces" {{ old('jewelry_type', $product->jewelry_type ?? '') === 'necklaces' ? 'selected' : '' }}>Necklaces</option>
            <option value="rings" {{ old('jewelry_type', $product->jewelry_type ?? '') === 'rings' ? 'selected' : '' }}>Rings</option>
            <option value="bracelets" {{ old('jewelry_type', $product->jewelry_type ?? '') === 'bracelets' ? 'selected' : '' }}>Bracelets</option>
        </select>
    </div>

    {{-- DYNAMIC SUBCATEGORIES --}}
    <div id="jewelry-subcategories-container" class="mt-7 hidden">
        <p class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Subcategories
        </p>
        <p class="mt-2 text-xs text-gray-400">
            Select all subcategories that apply to this jewelry type.
        </p>
        <div
            id="jewelry-subcategories"
            class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4"
        ></div>
    </div>

    {{-- QUALITY --}}
    <div class="mt-7 border-t border-gray-200 pt-7">
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Product Type / Quality
        </p>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
            @php
                $selectedJewelryQuality = old('jewelry_quality', $product->jewelry_quality ?? []);
                if (is_string($selectedJewelryQuality)) {
                    $selectedJewelryQuality = json_decode($selectedJewelryQuality, true) ?? [];
                }
            @endphp

            @foreach([
                'fine' => 'Fine Jewelry (Real Gold / Diamonds)',
                'demi_fine' => 'Demi-Fine (Gold-plated / Silver)',
                'fashion' => 'Fashion / Artificial Jewelry'
            ] as $value => $label)
                <label class="flex items-start gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="jewelry_quality[]"
                        value="{{ $value }}"
                        {{ in_array($value, $selectedJewelryQuality) ? 'checked' : '' }}
                        class="w-4 h-4 mt-0.5"
                    >
                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- RING SIZE --}}
    <div class="mt-7 border-t border-gray-200 pt-7 jewelry-size-group" data-jewelry-size="rings">
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Ring Size
        </p>
        <p class="mt-2 text-xs text-gray-400">Select the available Pakistani ring sizes.</p>
        @php
            $selectedRingSizes = old('ring_sizes', $product->ring_sizes ?? []);
            if (is_string($selectedRingSizes)) {
                $selectedRingSizes = json_decode($selectedRingSizes, true) ?? [];
            }
        @endphp
        <div class="mt-5 grid grid-cols-3 sm:grid-cols-6 gap-4">
            @foreach(range(4, 30) as $size)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="checkbox"
                        name="ring_sizes[]"
                        value="{{ $size }}"
                        {{ in_array((string)$size, array_map('strval', $selectedRingSizes)) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >
                    <span class="text-sm text-gray-700">{{ $size }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- NECKLACE LENGTH --}}
    <div class="mt-7 border-t border-gray-200 pt-7 jewelry-size-group" data-jewelry-size="necklaces">
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Chain / Necklace Length
        </p>
        @php
            $selectedNecklaceLengths = old('necklace_lengths', $product->necklace_lengths ?? []);
            if (is_string($selectedNecklaceLengths)) {
                $selectedNecklaceLengths = json_decode($selectedNecklaceLengths, true) ?? [];
            }
        @endphp
        <div class="mt-5 grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach(['14 inch (Choker)', '16 inch', '18 inch', '20 inch', '22 inch', '24 inch', '26 inch', '28 inch'] as $length)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="necklace_lengths[]"
                        value="{{ $length }}"
                        {{ in_array($length, $selectedNecklaceLengths) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >
                    <span class="text-sm text-gray-700">{{ $length }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- BRACELET / BANGLE SIZE --}}
    <div class="mt-7 border-t border-gray-200 pt-7 jewelry-size-group" data-jewelry-size="bracelets">
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Bracelet / Bangle Size
        </p>
        @php
            $selectedBraceletSizes = old('bracelet_sizes', $product->bracelet_sizes ?? []);
            if (is_string($selectedBraceletSizes)) {
                $selectedBraceletSizes = json_decode($selectedBraceletSizes, true) ?? [];
            }
        @endphp
        <div class="mt-5 grid grid-cols-2 sm:grid-cols-3 gap-4">
            @foreach(['Small', 'Medium', 'Large', '2.4 inch', '2.6 inch', '2.8 inch', '3.0 inch'] as $size)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="bracelet_sizes[]"
                        value="{{ $size }}"
                        {{ in_array($size, $selectedBraceletSizes) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >
                    <span class="text-sm text-gray-700">{{ $size }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>


{{-- =========================================================
     WATCHES INFORMATION
========================================================= --}}
<div
    id="watches-filter"
    data-filter-section="watches"
    class="hidden mt-7 border-t border-gray-200 pt-7"
>
    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Watches Information
    </p>

    @php
        $selectedWatchGender = old('watch_gender', $product->watch_gender ?? []);
        if (is_string($selectedWatchGender)) {
            $selectedWatchGender = json_decode($selectedWatchGender, true) ?? [];
        }
    @endphp

    {{-- GENDER --}}
    <div>
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Gender
        </p>
        <div class="mt-4 flex flex-wrap gap-6">
            @foreach(['men' => 'Men', 'women' => 'Women', 'kids' => 'Kids'] as $value => $label)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="watch_gender[]"
                        value="{{ $value }}"
                        {{ in_array($value, $selectedWatchGender) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >
                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- STRAP MATERIAL --}}
    <div class="mt-7">
        <label
            for="strap_material"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Strap Material
        </label>
        <select
            id="strap_material"
            name="strap_material"
            class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
        >
            <option value="">Select Strap Material</option>
            <option value="stainless_steel" {{ old('strap_material', $product->strap_material ?? '') === 'stainless_steel' ? 'selected' : '' }}>Stainless Steel</option>
            <option value="leather" {{ old('strap_material', $product->strap_material ?? '') === 'leather' ? 'selected' : '' }}>Leather (Patty)</option>
            <option value="silicone_rubber" {{ old('strap_material', $product->strap_material ?? '') === 'silicone_rubber' ? 'selected' : '' }}>Silicone / Rubber</option>
        </select>
    </div>

    {{-- WATCH TYPE --}}
    <div class="mt-7">
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Watch Type
        </p>
        <div class="mt-4 space-y-3">
            @foreach(['analog' => 'Analog', 'digital' => 'Digital', 'smartwatch' => 'Smartwatch', 'chronograph' => 'Chronograph'] as $value => $label)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="radio"
                        name="watch_type"
                        value="{{ $value }}"
                        {{ old('watch_type', $product->watch_type ?? '') === $value ? 'checked' : '' }}
                        class="w-4 h-4"
                    >
                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>

{{-- =========================================================
     COSMETICS INFORMATION
========================================================= --}}

<div
    id="cosmetics-filter"
    data-filter-section="cosmetics"
    class="mt-7 border-t border-gray-200 pt-7 hidden"
>

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Cosmetics Information
    </p>


    {{-- BRAND --}}

    <div>

        <label
            for="cosmetic_brand"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Brand
        </label>

        <select
            id="cosmetic_brand"
            name="brand"
            class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
        >

            <option value="">
                Select Brand
            </option>

            @foreach($cosmeticBrands as $value => $label)

                <option
                    value="{{ $value }}"
                    {{ old('brand', $product->brand ?? '') === $value ? 'selected' : '' }}
                >
                    {{ $label }}
                </option>

            @endforeach

        </select>

    </div>


    {{-- PRODUCT TYPE --}}

    <div class="mt-7">

        <label
            for="cosmetic_product_type"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
        >
            Product Type
        </label>

        <select
            id="cosmetic_product_type"
            name="cosmetic_product_type"
            class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white focus:outline-none focus:border-black"
        >

            <option value="">
                Select Product Type
            </option>

            @foreach($cosmeticProductTypes as $value => $label)

                <option
                    value="{{ $value }}"
                    {{ old('cosmetic_product_type', $product->cosmetic_product_type ?? '') === $value ? 'selected' : '' }}
                >
                    {{ $label }}
                </option>

            @endforeach

        </select>

    </div>


    {{-- SKIN TYPE --}}

    @php
        $selectedSkinTypes = old(
            'skin_types',
            $product->skin_types ?? []
        );

        if (is_string($selectedSkinTypes)) {
            $selectedSkinTypes = json_decode($selectedSkinTypes, true) ?? [];
        }
    @endphp

    <div class="mt-7 border-t border-gray-200 pt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Skin Type
        </label>

        <p class="mt-2 text-xs text-gray-400">
            Select all skin types that apply.
        </p>

        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">

            @foreach($cosmeticSkinTypes as $value => $label)

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="skin_types[]"
                        value="{{ $value }}"
                        {{ in_array($value, $selectedSkinTypes) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-600">
                        {{ $label }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>


    {{-- CONCERN / BENEFIT --}}

    @php
        $selectedConcerns = old(
            'concerns',
            $product->concerns ?? []
        );

        if (is_string($selectedConcerns)) {
            $selectedConcerns = json_decode($selectedConcerns, true) ?? [];
        }
    @endphp

    <div class="mt-7 border-t border-gray-200 pt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Concern / Benefit
        </label>

        <p class="mt-2 text-xs text-gray-400">
            Select all benefits that apply to this product.
        </p>

        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">

            @foreach($cosmeticConcerns as $value => $label)

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="concerns[]"
                        value="{{ $value }}"
                        {{ in_array($value, $selectedConcerns) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-600">
                        {{ $label }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>


    {{-- PRODUCT FORM --}}

    @php
        $selectedProductForms = old(
            'product_forms',
            $product->product_forms ?? []
        );

        if (is_string($selectedProductForms)) {
            $selectedProductForms = json_decode($selectedProductForms, true) ?? [];
        }
    @endphp

    <div class="mt-7 border-t border-gray-200 pt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Product Form
        </label>

        <p class="mt-2 text-xs text-gray-400">
            Select all forms that apply to this product.
        </p>

        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">

            @foreach($cosmeticProductForms as $value => $label)

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="product_forms[]"
                        value="{{ $value }}"
                        {{ in_array($value, $selectedProductForms) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-600">
                        {{ $label }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>

</div>

{{-- END COSMETICS INFORMATION --}}

            {{-- DESCRIPTION --}}

            <div class="mt-7">

                <label
                    for="description"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >{{ old('description', $product->description) }}</textarea>

            </div>


            {{-- PRICES --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-7">

                <div>

                    <label
                        for="price"
                        class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                    >
                        Regular Price
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        min="0"
                        step="0.01"
                        required
                        class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                    >

                </div>


                <div>

                    <label
                        for="sale_price"
                        class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                    >
                        Sale Price
                    </label>

                    <input
                        type="number"
                        id="sale_price"
                        name="sale_price"
                        value="{{ old('sale_price', $product->sale_price) }}"
                        min="0"
                        step="0.01"
                        placeholder="Optional"
                        class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                    >

                </div>

            </div>


            {{-- STOCK --}}

            <div class="mt-7">

                <label
                    for="stock"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Stock
                </label>

                <input
                    type="number"
                    id="stock"
                    name="stock"
                    value="{{ old('stock', $product->stock) }}"
                    min="0"
                    required
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

            </div>


            {{-- ADD IMAGES --}}

            <div class="mt-7">

                <label
                    for="images"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Add More Images
                </label>

                <input
                    type="file"
                    id="images"
                    name="images[]"
                    accept=".jpg,.jpeg,.png,.webp"
                    multiple
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white"
                >

                <p class="mt-2 text-xs text-gray-400">
                    Select multiple images to add them to this product.
                    Existing images will remain.
                </p>

            </div>


            {{-- OPTIONS --}}

            <div class="mt-7 space-y-4">

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        Featured product
                    </span>

                </label>


                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        Active product
                    </span>

                </label>

            </div>


            {{-- BUTTONS --}}

            <div class="mt-10 flex flex-col sm:flex-row gap-3">

                <button
                    type="submit"
                    class="bg-black text-white px-7 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#a47c15] transition"
                >
                    Update Product
                </button>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="border border-gray-300 px-7 py-4 text-xs uppercase tracking-widest font-semibold text-center hover:bg-gray-100 transition"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const categorySelect = document.getElementById('category_id');

    if (!categorySelect) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | MAIN FILTER SECTIONS
    |--------------------------------------------------------------------------
    */

    const filterSections = document.querySelectorAll(
        '[data-filter-section]'
    );


    /*
    |--------------------------------------------------------------------------
    | LACE ELEMENTS
    |--------------------------------------------------------------------------
    */

    const laceFilter =
        document.getElementById('lace-filter');

    const laceCategorySelect =
        document.getElementById('lace_category');

    const laceSubcategoryContainer =
        document.getElementById('lace-subcategories-container');

    const laceSubcategoryWrapper =
        document.getElementById('lace-subcategories');


    /*
    |--------------------------------------------------------------------------
    | EXISTING SAVED LACE SUBCATEGORIES
    |
    | These are loaded from the Edit Product.
    |--------------------------------------------------------------------------
    */

    const existingLaceSubcategories = @json($selectedLaceSubcategories);


    /*
    |--------------------------------------------------------------------------
    | LACE CATEGORY → SUBCATEGORIES
    |--------------------------------------------------------------------------
    */

    const laceSubcategories = {

        basic_everyday: {
            cotton: 'Cotton Laces',
            plain: 'Plain Laces',
            printed: 'Printed Laces',
            thread: 'Thread Laces'
        },

        embroidered: {
            embroidery: 'Embroidery Laces',
            organza: 'Organza Laces',
            chiffon: 'Chiffon Laces',
            net: 'Net Laces',
            cutwork: 'Cutwork Laces',
            applique: 'Appliqué Laces'
        },

        fancy: {
            sequin: 'Sequin Laces',
            stone: 'Stone Laces',
            crystal: 'Crystal Laces',
            pearl: 'Pearl Laces',
            moti: 'Moti Laces',
            mirror_work: 'Mirror Work Laces',
            shimmer: 'Shimmer Laces',
            fancy_designer: 'Fancy Designer Laces'
        },

        traditional: {
            gota: 'Gota Laces',
            gota_patti: 'Gota Patti Laces',
            dori: 'Dori Laces',
            zari: 'Zari Laces',
            tilla: 'Tilla Laces',
            resham: 'Resham Laces',
            traditional_border: 'Traditional Border Laces'
        },

        suit_specific: {
            daman: 'Daman Laces',
            neckline: 'Neckline Laces',
            sleeve: 'Sleeve Laces',
            trouser: 'Trouser Laces',
            dupatta: 'Dupatta Laces',
            shirt_border: 'Shirt Border Laces',
            side_border: 'Side Border Laces'
        },

        premium_bridal: {
            bridal: 'Bridal Laces',
            heavy_bridal: 'Heavy Bridal Laces',
            premium_designer: 'Premium Designer Laces'
        }

    };


    /*
    |--------------------------------------------------------------------------
    | CATEGORY → FILTER TYPE
    |--------------------------------------------------------------------------
    */

    function getFilterType(slug) {

        slug = (slug || '').toLowerCase().trim();


        /*
        |--------------------------------------------------------------------------
        | CLOTHING
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'clothing' ||
            slug === 'ladies-clothing' ||
            slug === 'mens-clothing' ||
            slug === 'men-clothing' ||
            slug === 'womens-clothing' ||
            slug === 'women-clothing' ||
            slug === 'kids-clothing'
        ) {
            return 'clothing';
        }


        /*
        |--------------------------------------------------------------------------
        | LACES
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'laces' ||
            slug === 'lace' ||
            slug === 'ladies-laces' ||
            slug === 'ladies-suit-laces' ||
            slug.includes('lace')
        ) {
            return 'laces';
        }


        /*
        |--------------------------------------------------------------------------
        | JEWELRY
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'jewelry' ||
            slug === 'jewellery'
        ) {
            return 'jewelry';
        }


        /*
        |--------------------------------------------------------------------------
        | COSMETICS
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'cosmetics' ||
            slug === 'cosmetic'
        ) {
            return 'cosmetics';
        }


        /*
        |--------------------------------------------------------------------------
        | WATCHES
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'watches' ||
            slug === 'watch'
        ) {
            return 'watches';
        }


        /*
        |--------------------------------------------------------------------------
        | TAILOR ACCESSORIES
        |--------------------------------------------------------------------------
        */

        if (
            slug === 'tailor-accessories' ||
            slug === 'tailor-accessory' ||
            slug === 'tailoring-accessories'
        ) {
            return 'tailor_accessories';
        }


        return null;
    }


    /*
    |--------------------------------------------------------------------------
    | ENABLE / DISABLE SECTION INPUTS
    |--------------------------------------------------------------------------
    */

    function setSectionEnabled(section, enabled) {

        const fields = section.querySelectorAll(
            'input, select, textarea'
        );

        fields.forEach(function (field) {

            field.disabled = !enabled;

        });

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE LACE SUBCATEGORIES
    |--------------------------------------------------------------------------
    */

    function updateLaceSubcategories() {

        /*
        | If Lace elements don't exist, stop.
        */

        if (
            !laceCategorySelect ||
            !laceSubcategoryContainer ||
            !laceSubcategoryWrapper
        ) {
            return;
        }


        const selectedCategory =
            laceCategorySelect.value;


        /*
        |--------------------------------------------------------------------------
        | CLEAR OLD SUBCATEGORIES
        |--------------------------------------------------------------------------
        */

        laceSubcategoryWrapper.innerHTML = '';


        /*
        |--------------------------------------------------------------------------
        | NO LACE CATEGORY SELECTED
        |
        | Hide:
        | - Lace Subcategories
        | - Select all subcategories text
        | - Checkboxes
        |--------------------------------------------------------------------------
        */

        if (
            !selectedCategory ||
            !laceSubcategories[selectedCategory]
        ) {

            laceSubcategoryContainer.classList.add('hidden');

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | SHOW SUBCATEGORY CONTAINER
        |--------------------------------------------------------------------------
        */

        laceSubcategoryContainer.classList.remove('hidden');


        /*
        |--------------------------------------------------------------------------
        | CREATE SUBCATEGORY CHECKBOXES
        |--------------------------------------------------------------------------
        */

        Object.entries(
            laceSubcategories[selectedCategory]
        ).forEach(function ([value, labelText]) {


            const label =
                document.createElement('label');

            label.className =
                'flex items-center gap-3 cursor-pointer';


            const checkbox =
                document.createElement('input');

            checkbox.type = 'checkbox';

            checkbox.name =
                'lace_subcategories[]';

            checkbox.value =
                value;

            checkbox.className =
                'w-4 h-4';


            /*
            |--------------------------------------------------------------------------
            | EDIT PAGE:
            | CHECK SAVED SUBCATEGORY
            |--------------------------------------------------------------------------
            */

            if (
                Array.isArray(existingLaceSubcategories) &&
                existingLaceSubcategories.includes(value)
            ) {

                checkbox.checked = true;

            }


            const text =
                document.createElement('span');

            text.className =
                'text-sm text-gray-600';

            text.textContent =
                labelText;


            label.appendChild(checkbox);

            label.appendChild(text);

            laceSubcategoryWrapper.appendChild(label);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE MAIN FILTER SECTIONS
    |--------------------------------------------------------------------------
    */

    function updateFilterSections() {

        const selectedOption =
            categorySelect.options[
                categorySelect.selectedIndex
            ];


        /*
        |--------------------------------------------------------------------------
        | CATEGORY IS AN ARRAY
        |
        | Therefore the option contains:
        |
        | data-slug="{{ $category['slug'] ?? '' }}"
        |--------------------------------------------------------------------------
        */

        const slug =
            selectedOption
                ? (
                    selectedOption.dataset.slug ||
                    selectedOption.dataset.categorySlug ||
                    ''
                )
                : '';


        const filterType =
            getFilterType(slug);


        /*
        |--------------------------------------------------------------------------
        | SHOW / HIDE FILTER SECTIONS
        |--------------------------------------------------------------------------
        */

        filterSections.forEach(function (section) {

            const sectionType =
                section.dataset.filterSection;


            const shouldShow =
                sectionType === filterType;


            if (shouldShow) {

                section.classList.remove('hidden');

                setSectionEnabled(
                    section,
                    true
                );

            } else {

                section.classList.add('hidden');

                setSectionEnabled(
                    section,
                    false
                );

            }

        });


        /*
        |--------------------------------------------------------------------------
        | LACE FILTER
        |--------------------------------------------------------------------------
        */

        if (filterType === 'laces') {

            /*
             * Show Lace Information
             */

            if (laceFilter) {

                laceFilter.classList.remove('hidden');

            }


            /*
             * Update Lace Subcategories
             */

            updateLaceSubcategories();

        } else {

            /*
             * If category is NOT Laces,
             * hide Lace Subcategories completely.
             */

            if (laceSubcategoryContainer) {

                laceSubcategoryContainer.classList.add('hidden');

            }

        }

    }


    /*
    |--------------------------------------------------------------------------
    | CATEGORY CHANGE
    |--------------------------------------------------------------------------
    */

    categorySelect.addEventListener(
        'change',
        function () {

            updateFilterSections();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | LACE CATEGORY CHANGE
    |--------------------------------------------------------------------------
    */

    if (laceCategorySelect) {

        laceCategorySelect.addEventListener(
            'change',
            function () {

                /*
                 * When admin changes Lace Category,
                 * regenerate the correct subcategories.
                 */

                updateLaceSubcategories();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | INITIAL PAGE LOAD
    |
    | VERY IMPORTANT FOR EDIT PAGE
    |--------------------------------------------------------------------------
    */

    updateFilterSections();


    /*
    |--------------------------------------------------------------------------
    | INITIAL LACE SUBCATEGORY LOAD
    |--------------------------------------------------------------------------
    */

    updateLaceSubcategories();

});
</script>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jewelryType = document.getElementById('jewelry_type');
    const jewelryContainer = document.getElementById('jewelry-subcategories-container');
    const jewelrySubcategories = document.getElementById('jewelry-subcategories');
    if (!jewelryType || !jewelryContainer || !jewelrySubcategories) return;

    const jewelryMap = {
        earrings: [['hoops','Hoops'],['studs','Studs'],['drop','Drop Earrings'],['dangle','Dangle Earrings'],['chandelier','Chandelier Earrings'],['huggies','Huggies'],['jhumka','Jhumka']],
        necklaces: [['chokers','Chokers'],['pendants','Pendant Necklaces'],['chains','Chains'],['layered','Layered Necklaces'],['statement','Statement Necklaces'],['pearl','Pearl Necklaces']],
        rings: [['bands','Bands'],['solitaire','Solitaire Rings'],['cocktail','Cocktail Rings'],['stackable','Stackable Rings'],['signet','Signet Rings'],['adjustable','Adjustable Rings']],
        bracelets: [['chain','Chain Bracelets'],['cuff','Cuff Bracelets'],['bangles','Bangles'],['charm','Charm Bracelets'],['tennis','Tennis Bracelets'],['kada','Kada']]
    };

    const existing = @json(old('jewelry_subcategories', $product->jewelry_subcategories ?? []));
    let selected = Array.isArray(existing) ? existing : [];

    function render() {
        const type = jewelryType.value;
        jewelrySubcategories.innerHTML = '';
        if (!type || !jewelryMap[type]) { jewelryContainer.classList.add('hidden'); return; }
        jewelryContainer.classList.remove('hidden');
        jewelryMap[type].forEach(([value,label]) => {
            const wrapper = document.createElement('label');
            wrapper.className = 'flex items-center gap-3 cursor-pointer';
            wrapper.innerHTML = `<input type="checkbox" name="jewelry_subcategories[]" value="${value}" class="w-4 h-4" ${selected.includes(value) ? 'checked' : ''}> <span class="text-sm text-gray-700">${label}</span>`;
            jewelrySubcategories.appendChild(wrapper);
        });
    }

    function sizing() {
        document.querySelectorAll('.jewelry-size-group').forEach(group => {
            group.classList.toggle('hidden', group.dataset.jewelrySize !== jewelryType.value);
        });
    }

    jewelryType.addEventListener('change', () => { selected = []; render(); sizing(); });
    render(); sizing();
});
</script>
