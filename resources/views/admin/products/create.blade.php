@extends('layouts.admin')

@section('title', 'Add Product | Bin Roshan')

@section('content')

@php
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

<div class="min-h-screen py-12">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10">

            <a
                href="{{ route('admin.products.index') }}"
                class="text-xs uppercase tracking-widest text-gray-500 hover:text-[#BE8B3E] transition">
                ← Back to Products
            </a>

            <p class="mt-8 text-xs uppercase tracking-[0.35em] text-[#BE8B3E] font-semibold">
                Admin Panel
            </p>

            <h1 class="mt-3 text-4xl font-light">
                Add Product
            </h1>

        </div>

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

        <div
            id="product-form-config"
            data-mode="create"
            data-existing-lace-subcategories='@json([])'
            data-existing-jewelry-subcategories='@json(old('jewelry_subcategories', []))'
            aria-hidden="true"
            class="hidden"
        ></div>

        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="rounded-lg border border-[#BE8B3E] p-6 sm:p-10">

            @csrf

            {{-- CATEGORY --}}

            <div>

                <label
                    for="category_id"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
                    Category
                </label>

                <select
                    id="category_id"
                    name="category_id"
                    required
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

                <option value="">Select Category</option>

    @foreach($categories as $category)

        <option
            value="{{ $category->id }}"
            data-category-slug="{{ $category->slug }}"
            {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>

    @endforeach
        </select>

            </div>

            {{-- NAME --}}

            <div class="mt-7">

                <label
                    for="name"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
                    Product Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. Premium Cotton Shirt"
                    required
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            </div>

            {{-- SLUG --}}

            <div class="mt-7">

                <label
                    for="slug"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
                    Slug
                </label>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug') }}"
                    placeholder="Automatically generated from product name"
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

                <p class="mt-2 text-xs text-gray-400">
                    The slug is automatically generated from the product name.
                    You can edit it manually if needed.
                </p>

            </div>

            {{-- SKU --}}

            <div class="mt-7">

                <label
                    for="sku"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
                    SKU
                </label>

                <input
                    type="text"
                    id="sku"
                    name="sku"
                    value="{{ old('sku') }}"
                    placeholder="e.g. BIS-SHIRT-001"
                    required
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            </div>

{{-- =========================================================
     CLOTHING INFORMATION
========================================================= --}}
<div
    id="clothing-filter"
    data-filter-section="clothing"
    class="mt-7 border-t border-gray-200 pt-7">

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Clothing Filtration
    </p>

    {{-- GENDER --}}

    <div>

        <label
            for="gender"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Gender
        </label>

        <select
            id="gender"
            name="gender"
            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            <option value="">
                Select Gender
            </option>

            <option value="men" {{ old('gender') === 'men' ? 'selected' : '' }}>
                Men
            </option>

            <option value="women" {{ old('gender') === 'women' ? 'selected' : '' }}>
                Women
            </option>

            <option value="kids" {{ old('gender') === 'kids' ? 'selected' : '' }}>
                Kids
            </option>

        </select>

    </div>

    {{-- BRAND --}}

    <div class="mt-7">

        <label
            for="brand"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Brand
        </label>

        <select
            id="brand"
            name="brand"
            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            <option value="">
                Select Brand
            </option>

            <option value="Bin Ismail" {{ old('brand') === 'Bin Ismail' ? 'selected' : '' }}>
                Bin Ismail
            </option>

            <option value="J." {{ old('brand') === 'J.' ? 'selected' : '' }}>
                J.
            </option>

            <option value="Gul Ahmed" {{ old('brand') === 'Gul Ahmed' ? 'selected' : '' }}>
                Gul Ahmed
            </option>

            <option value="Khaadi" {{ old('brand') === 'Khaadi' ? 'selected' : '' }}>
                Khaadi
            </option>

            <option value="Other" {{ old('brand') === 'Other' ? 'selected' : '' }}>
                Other
            </option>

        </select>

    </div>

    {{-- SIZE --}}

    <div class="mt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Available Sizes
        </label>

        <div class="mt-4 flex flex-wrap gap-6">

            @foreach(['S', 'M', 'L'] as $size)

                <label class="flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        name="sizes[]"
                        value="{{ $size }}"
                        {{ in_array($size, old('sizes', [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                    <span class="text-sm text-gray-700">
                        {{ $size }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>

</div>
{{-- =========================================================
     END CLOTHING INFORMATION
========================================================= --}}

{{-- =========================================================
     LACE INFORMATION
========================================================= --}}
<div
    id="lace-filter"
    data-filter-section="laces"
    class="mt-7 border-t border-gray-200 pt-7">

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Laces Filtration
    </p>

    {{-- LACE CATEGORY --}}

    <div>

        <select
    name="lace_category"
    id="lace_category"
    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

    <option value="">Select Lace Category</option>

    <option value="basic_everyday">
        Basic & Everyday Laces
    </option>

    <option value="embroidered">
        Embroidered Laces
    </option>

    <option value="fancy">
        Fancy Laces
    </option>

    <option value="traditional">
        Traditional Laces
    </option>

    <option value="suit_specific">
        Suit Specific Laces
    </option>

    <option value="premium_bridal">
        Premium & Bridal Laces
    </option>
</select>

    </div>

    {{-- LACE SUBCATEGORIES --}}

    <div id="lace-subcategories-container" class="mt-6 hidden">

    <p class="text-xs text-gray-400 mb-4">
        Select all subcategories that apply to this lace.
    </p>

    <div
        id="lace-subcategories"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
    </div>

</div>

    {{-- WIDTH --}}

    <div class="mt-7">

        <label class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Wide
        </label>

        <div class="mt-4 flex flex-wrap gap-6">

            @foreach([
                '1 inch',
                '2 inch',
                '3 inch',
                '4 inch',
                '5 inch',
                '6 inch'
            ] as $width)

                <label class="flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        name="width[]"
                        value="{{ $width }}"
                        {{ in_array($width, old('width', [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                    <span class="text-sm text-gray-700">
                        {{ $width }}
                    </span>

                </label>

            @endforeach

        </div>

    </div>

</div>
{{-- =========================================================
     END LACE INFORMATION
========================================================= --}}

{{-- =========================================================
     JEWELRY INFORMATION
========================================================= --}}
<div
    id="jewelry-filter"
    data-filter-section="jewelry"
    class="hidden mt-7 border-t border-gray-200 pt-7">

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Jewelry Filtration
    </p>

    {{-- GENDER --}}
    <div>
        <p class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Gender
        </p>
        <div class="mt-4 flex flex-wrap gap-6">
            @php
                $selectedJewelryGender = old('jewelry_gender', []);
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
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">
                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- JEWELRY TYPE --}}
    <div class="mt-7">
        <label
            for="jewelry_type"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Jewelry Type
        </label>

        <select
            id="jewelry_type"
            name="jewelry_type"
            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            <option value="">Select Jewelry Type</option>
            <option value="earrings" {{ old('jewelry_type', '') === 'earrings' ? 'selected' : '' }}>Earrings</option>
            <option value="necklaces" {{ old('jewelry_type', '') === 'necklaces' ? 'selected' : '' }}>Necklaces</option>
            <option value="rings" {{ old('jewelry_type', '') === 'rings' ? 'selected' : '' }}>Rings</option>
            <option value="bracelets" {{ old('jewelry_type', '') === 'bracelets' ? 'selected' : '' }}>Bracelets</option>
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
                $selectedJewelryQuality = old('jewelry_quality', []);
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
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0"
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
            $selectedRingSizes = old('ring_sizes', []);
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
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0"
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
            $selectedNecklaceLengths = old('necklace_lengths', []);
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
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0"
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
            $selectedBraceletSizes = old('bracelet_sizes', []);
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
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0"
                    >
                    <span class="text-sm text-gray-700">{{ $size }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>
{{-- =========================================================
     END JEWELRY INFORMATION
========================================================= --}}

{{-- =========================================================
     COSMETICS INFORMATION
========================================================= --}}
<div
    id="cosmetics-filter"
    data-filter-section="cosmetics"
    class="hidden mt-7 border-t border-gray-200 pt-7">

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Cosmetics Filtration
    </p>

    {{-- COSMETICS BRAND --}}
    <div>
        <label
            for="cosmetic_brand"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Brand
        </label>

        <select
            id="cosmetic_brand"
            name="brand"
            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            <option value="">Select Cosmetic Brand</option>

            @foreach($cosmeticBrands as $value => $label)
                <option
                    value="{{ $value }}"
                    {{ old('brand') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- PRODUCT TYPE --}}
    <div class="mt-7">
        <label
            for="cosmetic_product_type"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Product Type
        </label>

        <select
            id="cosmetic_product_type"
            name="cosmetic_product_type"
            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            <option value="">Select Product Type</option>

            @foreach($cosmeticProductTypes as $value => $label)
                <option
                    value="{{ $value }}"
                    {{ old('cosmetic_product_type') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- SKIN TYPE --}}
    <div class="mt-7">
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Skin Type
        </p>

        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($cosmeticSkinTypes as $value => $label)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="skin_types[]"
                        value="{{ $value }}"
                        {{ in_array($value, old('skin_types', [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- CONCERN / BENEFIT --}}
    <div class="mt-7">
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Concern / Benefit
        </p>

        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($cosmeticConcerns as $value => $label)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="concerns[]"
                        value="{{ $value }}"
                        {{ in_array($value, old('concerns', [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- PRODUCT FORM --}}
    <div class="mt-7">
        <p class="text-xs uppercase tracking-widest font-semibold text-gray-700">
            Product Form
        </p>

        <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach($cosmeticProductForms as $value => $label)
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="product_forms[]"
                        value="{{ $value }}"
                        {{ in_array($value, old('product_forms', [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>
{{-- =========================================================
     END COSMETICS INFORMATION
========================================================= --}}

{{-- =========================================================
     WATCHES INFORMATION
========================================================= --}}
<div
    id="watches-filter"
    data-filter-section="watches"
    class="hidden mt-7 border-t border-gray-200 pt-7">

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Watches Filtration
    </p>

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
                        {{ in_array($value, old('watch_gender', [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- STRAP MATERIAL --}}
    <div class="mt-7">
        <label
            for="strap_material"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Strap Material
        </label>

        <select
            id="strap_material"
            name="strap_material"
            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            <option value="">Select Strap Material</option>
            <option value="stainless_steel" {{ old('strap_material') === 'stainless_steel' ? 'selected' : '' }}>Stainless Steel</option>
            <option value="leather" {{ old('strap_material') === 'leather' ? 'selected' : '' }}>Leather (Patty)</option>
            <option value="silicone_rubber" {{ old('strap_material') === 'silicone_rubber' ? 'selected' : '' }}>Silicone / Rubber</option>
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
                        {{ old('watch_type') === $value ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                    <span class="text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>
{{-- =========================================================
     END WATCHES INFORMATION
========================================================= --}}

{{-- =========================================================
     OTHER ACCESSORIES INFORMATION
========================================================= --}}
<div
    id="other-accessories-filter"
    data-filter-section="other_accessories"
    class="hidden mt-7 border-t border-gray-200 pt-7">

    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-6">
        Other Accessories Filtration
    </p>

    {{-- BUTTONS --}}
    <div>
        <label
            for="buttons"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Buttons
        </label>

        <select
            id="buttons"
            name="buttons"
            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">
            <option value="">
                Select Buttons
            </option>

            <option
                value="fancy_buttons"
                {{ old('buttons') === 'fancy_buttons' ? 'selected' : '' }}>
                Fancy Buttons
            </option>

            <option
                value="simple_buttons"
                {{ old('buttons') === 'simple_buttons' ? 'selected' : '' }}>
                Simple Buttons
            </option>

            <option
                value="pearls_buttons"
                {{ old('buttons') === 'pearls_buttons' ? 'selected' : '' }}>
                Pearls Buttons
            </option>

            <option
                value="pearls_clothes_buttons"
                {{ old('buttons') === 'pearls_clothes_buttons' ? 'selected' : '' }}>
                Pearls Clothes Buttons
            </option>

            <option
                value="button_patti"
                {{ old('buttons') === 'button_patti' ? 'selected' : '' }}>
                Button Patti
            </option>
        </select>
    </div>

    {{-- PIPING CLOTHES --}}
    <div class="mt-7">
        <label
            for="piping_clothes"
            class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Piping Clothes
        </label>

        <select
            id="piping_clothes"
            name="piping_clothes"
            class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            <option value="">
                Select Piping Clothes
            </option>

            <option
                value="aparna_shamooz_silk_piping"
                {{ old('piping_clothes') === 'aparna_shamooz_silk_piping' ? 'selected' : '' }}>
                Aparna / Shamooz Silk Piping
            </option>

            <option
                value="katan_silk_dori_piping"
                {{ old('piping_clothes') === 'katan_silk_dori_piping' ? 'selected' : '' }}>
                Katan Silk / Dori Piping
            </option>

            <option
                value="cotton_lawn_piping"
                {{ old('piping_clothes') === 'cotton_lawn_piping' ? 'selected' : '' }}>
                Cotton / Lawn Piping
            </option>

            <option
                value="velvet_piping"
                {{ old('piping_clothes') === 'velvet_piping' ? 'selected' : '' }}>
                Velvet Piping
            </option>

            <option
                value="metallic_zari_piping"
                {{ old('piping_clothes') === 'metallic_zari_piping' ? 'selected' : '' }}>
                Metallic / Zari Piping
            </option>
        </select>
    </div>

    {{-- ACCESSORY TYPE --}}
    <div class="mt-7">
        <p class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
            Accessory Type
        </p>

        <div class="mt-4 space-y-3">

            <label class="flex items-center gap-3 cursor-pointer">
                <input
                    type="radio"
                    name="accessory_type"
                    value="tailor_accessories"
                    {{ old('accessory_type') === 'tailor_accessories' ? 'checked' : '' }}
                    class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                <span class="text-sm text-gray-700">
                    Tailor Accessories
                </span>
            </label>


            <label class="flex items-center gap-3 cursor-pointer">
                <input
                    type="radio"
                    name="accessory_type"
                    value="other_accessories"
                    {{ old('accessory_type') === 'other_accessories' ? 'checked' : '' }}
                    class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                <span class="text-sm text-gray-700">
                    Other Accessories
                </span>
            </label>

        </div>
    </div>

</div>
{{-- =========================================================
     END OTHER ACCESSORIES INFORMATION
========================================================= --}}

            {{-- DESCRIPTION --}}

            <div class="mt-7">

                <label
                    for="description"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    placeholder="Describe this product..."
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">{{ old('description') }}</textarea>

            </div>

            {{-- PRICES --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-7">

                <div>

                    <label
                        for="price"
                        class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
                        Regular Price
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        min="0"
                        step="0.01"
                        required
                        placeholder="0.00"
                        class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

                </div>

                <div>

                    <label
                        for="sale_price"
                        class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
                        Sale Price
                    </label>

                    <input
                        type="number"
                        id="sale_price"
                        name="sale_price"
                        value="{{ old('sale_price') }}"
                        min="0"
                        step="0.01"
                        placeholder="Optional"
                        class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

                </div>

            </div>

            {{-- STOCK --}}

            <div class="mt-7">

                <label
                    for="stock"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
                    Stock
                </label>

                <input
                    type="number"
                    id="stock"
                    name="stock"
                    value="{{ old('stock', 0) }}"
                    min="0"
                    required
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#BE8B3E]">

            </div>

            {{-- IMAGES --}}

            <div class="mt-7">

                <label
                    for="images"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700">
                    Product Images
                </label>

                <input
                    type="file"
                    id="images"
                    name="images[]"
                    accept=".jpg,.jpeg,.png,.webp"
                    multiple
                    class="block w-full cursor-pointer text-sm text-gray-600
                              file:mr-4 file:py-2.5 file:px-4
                              file:rounded-lg file:border file:border-[#BE8B3E]
                              file:text-sm file:cursor-pointer file:font-semibold
                              file:bg-[#BE8B3E] file:text-white
                              hover:file:bg-transparent hover:file:text-[#BE8B3E]">

                <p class="mt-2 text-xs text-gray-400">
                    You can select multiple images. The first image will become the primary image.
                    JPG, JPEG, PNG or WEBP. Maximum 4MB each.
                </p>

            </div>

            {{-- OPTIONS --}}

            <div class="mt-7 space-y-4">

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        {{ old('is_featured') ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                    <span class="text-sm text-gray-700">
                        Featured product
                    </span>

                </label>


                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

                    <span class="text-sm text-gray-700">
                        Active product
                    </span>

                </label>

            </div>

            {{-- BUTTONS --}}

            <div class="mt-10 flex flex-col sm:flex-row gap-3">

                <button
                    type="submit"
                    class="bg-[#BE8B3E] rounded-full cursor-pointer border border-[#BE8B3E] hover:bg-transparent hover:text-[#BE8B3E] text-white px-7 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#a47c15] transition">
                    Create Product
                </button>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="border border-gray-300 rounded-full px-7 py-4 text-xs uppercase tracking-widest font-semibold text-center hover:bg-gray-300 hover:text-white transition">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>




@endsection