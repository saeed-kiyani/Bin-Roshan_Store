@extends('layouts.admin')

@section('title', 'Admin Dashboard | Bin Ismail')

@section('content')

<div class="min-h-screen bg-[#f8f7f4]">

    {{-- =====================================================
        DASHBOARD HEADER
    ====================================================== --}}

    <section class="border-b border-gray-200 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <div>

                    <p class="text-[10px] uppercase tracking-[0.4em] text-[#a47c15] font-semibold">
                        Bin Ismail
                    </p>

                    <h1 class="mt-3 text-3xl sm:text-4xl font-light text-gray-900">
                        Admin Dashboard
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Manage your store, products and inventory.
                    </p>

                </div>


                <div class="flex flex-wrap gap-3">

                    <a
                        href="{{ route('admin.products.create') }}"
                        class="inline-flex items-center justify-center bg-black text-white px-6 py-3 text-xs uppercase tracking-widest font-semibold hover:bg-[#a47c15] transition"
                    >
                        + Add Product
                    </a>

                    <a
                        href="{{ route('admin.categories.create') }}"
                        class="inline-flex items-center justify-center border border-gray-300 bg-white text-gray-900 px-6 py-3 text-xs uppercase tracking-widest font-semibold hover:border-black transition"
                    >
                        + Add Category
                    </a>

                </div>

            </div>

        </div>

    </section>



    {{-- =====================================================
        MAIN CONTENT
    ====================================================== --}}

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">


        {{-- =================================================
            STATISTICS
        ================================================== --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">


            {{-- TOTAL PRODUCTS --}}

            <div class="bg-white border border-gray-200 p-6 hover:border-gray-400 transition">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-[10px] uppercase tracking-[0.25em] text-gray-400 font-semibold">
                            Total Products
                        </p>

                        <p class="mt-4 text-3xl font-light text-gray-900">
                            {{ $totalProducts }}
                        </p>

                    </div>

                    <div class="w-10 h-10 border border-gray-200 flex items-center justify-center text-gray-700">
                        <span class="text-lg">□</span>
                    </div>

                </div>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="inline-block mt-6 text-[10px] uppercase tracking-widest font-semibold text-[#a47c15] hover:text-black transition"
                >
                    Manage Products →
                </a>

            </div>



            {{-- CATEGORIES --}}

            <div class="bg-white border border-gray-200 p-6 hover:border-gray-400 transition">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-[10px] uppercase tracking-[0.25em] text-gray-400 font-semibold">
                            Categories
                        </p>

                        <p class="mt-4 text-3xl font-light text-gray-900">
                            {{ $totalCategories }}
                        </p>

                    </div>

                    <div class="w-10 h-10 border border-gray-200 flex items-center justify-center text-gray-700">
                        <span class="text-lg">◇</span>
                    </div>

                </div>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="inline-block mt-6 text-[10px] uppercase tracking-widest font-semibold text-[#a47c15] hover:text-black transition"
                >
                    Manage Categories →
                </a>

            </div>



            {{-- ACTIVE PRODUCTS --}}

            <div class="bg-white border border-gray-200 p-6 hover:border-gray-400 transition">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-[10px] uppercase tracking-[0.25em] text-gray-400 font-semibold">
                            Active Products
                        </p>

                        <p class="mt-4 text-3xl font-light text-gray-900">
                            {{ $activeProducts }}
                        </p>

                    </div>

                    <div class="w-10 h-10 border border-green-200 bg-green-50 flex items-center justify-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                    </div>

                </div>

                <p class="mt-6 text-[10px] uppercase tracking-widest text-green-600 font-semibold">
                    Currently visible
                </p>

            </div>



            {{-- FEATURED --}}

            <div class="bg-white border border-gray-200 p-6 hover:border-gray-400 transition">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-[10px] uppercase tracking-[0.25em] text-gray-400 font-semibold">
                            Featured
                        </p>

                        <p class="mt-4 text-3xl font-light text-gray-900">
                            {{ $featuredProducts }}
                        </p>

                    </div>

                    <div class="w-10 h-10 border border-[#a47c15]/30 bg-[#a47c15]/5 flex items-center justify-center">
                        <span class="text-[#a47c15] text-lg">★</span>
                    </div>

                </div>

                <p class="mt-6 text-[10px] uppercase tracking-widest text-[#a47c15] font-semibold">
                    Featured products
                </p>

            </div>

        </div>



        {{-- =================================================
            STOCK ALERTS
        ================================================== --}}

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-5">


            {{-- LOW STOCK --}}

            <div class="bg-white border border-gray-200 p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] uppercase tracking-[0.25em] text-gray-400 font-semibold">
                            Inventory Alert
                        </p>

                        <h2 class="mt-3 text-xl font-light text-gray-900">
                            Low Stock Products
                        </h2>

                    </div>

                    <div class="w-11 h-11 border border-amber-200 bg-amber-50 flex items-center justify-center">
                        <span class="text-amber-600">!</span>
                    </div>

                </div>


                <div class="mt-6 flex items-end justify-between">

                    <div>

                        <span class="text-4xl font-light text-gray-900">
                            {{ $lowStockProducts }}
                        </span>

                        <span class="ml-2 text-xs text-gray-400">
                            products
                        </span>

                    </div>

                    <span class="text-[10px] uppercase tracking-widest text-gray-400">
                        Stock ≤ 5
                    </span>

                </div>

            </div>



            {{-- OUT OF STOCK --}}

            <div class="bg-white border border-gray-200 p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[10px] uppercase tracking-[0.25em] text-gray-400 font-semibold">
                            Inventory Alert
                        </p>

                        <h2 class="mt-3 text-xl font-light text-gray-900">
                            Out of Stock
                        </h2>

                    </div>

                    <div class="w-11 h-11 border border-red-200 bg-red-50 flex items-center justify-center">
                        <span class="text-red-600">×</span>
                    </div>

                </div>


                <div class="mt-6 flex items-end justify-between">

                    <div>

                        <span class="text-4xl font-light text-gray-900">
                            {{ $outOfStockProducts }}
                        </span>

                        <span class="ml-2 text-xs text-gray-400">
                            products
                        </span>

                    </div>

                    <span class="text-[10px] uppercase tracking-widest text-red-500">
                        Stock = 0
                    </span>

                </div>

            </div>

        </div>



        {{-- =================================================
            QUICK ACTIONS
        ================================================== --}}

        <section class="mt-10">

            <div class="flex items-end justify-between mb-5">

                <div>

                    <p class="text-[10px] uppercase tracking-[0.3em] text-[#a47c15] font-semibold">
                        Shortcuts
                    </p>

                    <h2 class="mt-2 text-2xl font-light text-gray-900">
                        Quick Actions
                    </h2>

                </div>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">


                <a
                    href="{{ route('admin.products.create') }}"
                    class="group bg-black text-white p-6 hover:bg-[#a47c15] transition"
                >

                    <div class="text-2xl font-light">
                        +
                    </div>

                    <p class="mt-5 text-xs uppercase tracking-widest font-semibold">
                        Add Product
                    </p>

                    <p class="mt-2 text-xs text-gray-400 group-hover:text-white/80">
                        Create a new product
                    </p>

                </a>



                <a
                    href="{{ route('admin.products.index') }}"
                    class="group bg-white border border-gray-200 p-6 hover:border-black transition"
                >

                    <div class="text-2xl font-light">
                        →
                    </div>

                    <p class="mt-5 text-xs uppercase tracking-widest font-semibold text-gray-900">
                        Manage Products
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Edit products and images
                    </p>

                </a>



                <a
                    href="{{ route('admin.categories.create') }}"
                    class="group bg-white border border-gray-200 p-6 hover:border-black transition"
                >

                    <div class="text-2xl font-light">
                        +
                    </div>

                    <p class="mt-5 text-xs uppercase tracking-widest font-semibold text-gray-900">
                        Add Category
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Create a new category
                    </p>

                </a>



                <a
                    href="{{ route('admin.categories.index') }}"
                    class="group bg-white border border-gray-200 p-6 hover:border-black transition"
                >

                    <div class="text-2xl font-light">
                        ◇
                    </div>

                    <p class="mt-5 text-xs uppercase tracking-widest font-semibold text-gray-900">
                        Manage Categories
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        Edit your categories
                    </p>

                </a>

            </div>

        </section>



        {{-- =================================================
            RECENT PRODUCTS
        ================================================== --}}

        <section class="mt-12">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-5">

                <div>

                    <p class="text-[10px] uppercase tracking-[0.3em] text-[#a47c15] font-semibold">
                        Inventory
                    </p>

                    <h2 class="mt-2 text-2xl font-light text-gray-900">
                        Recent Products
                    </h2>

                </div>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="text-[10px] uppercase tracking-widest font-semibold text-gray-500 hover:text-black transition"
                >
                    View All →
                </a>

            </div>


            <div class="bg-white border border-gray-200 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[800px]">

                        <thead class="border-b border-gray-200 bg-gray-50">

                            <tr>

                                <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Product
                                </th>

                                <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    SKU
                                </th>

                                <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Category
                                </th>

                                <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Price
                                </th>

                                <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Stock
                                </th>

                                <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse($recentProducts as $product)

                                @php

                                    $image = optional($product->primaryImage)->image;

                                    if ($image && !str_starts_with($image, 'http')) {
                                        $image = asset('storage/' . ltrim($image, '/'));
                                    }

                                @endphp


                                <tr class="hover:bg-gray-50 transition">


                                    {{-- PRODUCT --}}

                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-4">

                                            @if($image)

                                                <img
                                                    src="{{ $image }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-12 h-14 object-cover bg-gray-100"
                                                >

                                            @else

                                                <div class="w-12 h-14 bg-gray-100 flex items-center justify-center text-gray-300">
                                                    —
                                                </div>

                                            @endif


                                            <div>

                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $product->name }}
                                                </p>

                                                @if($product->is_featured)

                                                    <span class="inline-block mt-1 text-[9px] uppercase tracking-widest text-[#a47c15]">
                                                        ★ Featured
                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </td>



                                    {{-- SKU --}}

                                    <td class="px-6 py-5">

                                        <span class="text-xs text-gray-500">
                                            {{ $product->sku }}
                                        </span>

                                    </td>



                                    {{-- CATEGORY --}}

                                    <td class="px-6 py-5">

                                        <span class="text-xs text-gray-600">
                                            {{ $product->category?->name ?? 'No Category' }}
                                        </span>

                                    </td>



                                    {{-- PRICE --}}

                                    <td class="px-6 py-5">

                                        @if($product->sale_price !== null)

                                            <p class="text-sm font-semibold text-gray-900">
                                                Rs. {{ number_format($product->sale_price, 2) }}
                                            </p>

                                            <p class="text-[10px] text-gray-400 line-through">
                                                Rs. {{ number_format($product->price, 2) }}
                                            </p>

                                        @else

                                            <p class="text-sm font-semibold text-gray-900">
                                                Rs. {{ number_format($product->price, 2) }}
                                            </p>

                                        @endif

                                    </td>



                                    {{-- STOCK --}}

                                    <td class="px-6 py-5">

                                        @if($product->stock == 0)

                                            <span class="text-[10px] uppercase tracking-widest text-red-600 font-semibold">
                                                Out of Stock
                                            </span>

                                        @elseif($product->stock <= 5)

                                            <span class="text-[10px] uppercase tracking-widest text-amber-600 font-semibold">
                                                {{ $product->stock }} Left
                                            </span>

                                        @else

                                            <span class="text-xs text-gray-600">
                                                {{ $product->stock }}
                                            </span>

                                        @endif

                                    </td>



                                    {{-- STATUS --}}

                                    <td class="px-6 py-5">

                                        @if($product->is_active)

                                            <span class="inline-flex items-center gap-2 bg-green-50 text-green-700 px-3 py-1 text-[9px] uppercase tracking-widest font-semibold">

                                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>

                                                Active

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-500 px-3 py-1 text-[9px] uppercase tracking-widest font-semibold">

                                                <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>

                                                Inactive

                                            </span>

                                        @endif

                                    </td>


                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="px-6 py-16 text-center"
                                    >

                                        <p class="text-sm text-gray-400">
                                            No products found.
                                        </p>

                                        <a
                                            href="{{ route('admin.products.create') }}"
                                            class="inline-flex mt-5 bg-black text-white px-6 py-3 text-[10px] uppercase tracking-widest font-semibold"
                                        >
                                            Add First Product
                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </section>



        {{-- =================================================
            RECENT CATEGORIES
        ================================================== --}}

        <section class="mt-12 pb-12">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-5">

                <div>

                    <p class="text-[10px] uppercase tracking-[0.3em] text-[#a47c15] font-semibold">
                        Organization
                    </p>

                    <h2 class="mt-2 text-2xl font-light text-gray-900">
                        Recent Categories
                    </h2>

                </div>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="text-[10px] uppercase tracking-widest font-semibold text-gray-500 hover:text-black transition"
                >
                    View All →
                </a>

            </div>


            <div class="bg-white border border-gray-200 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="border-b border-gray-200 bg-gray-50">

                            <tr>

                                <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Category
                                </th>

                                <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Slug
                                </th>

                                <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse($recentCategories as $category)

                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-6 py-5">

                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $category->name }}
                                        </span>

                                    </td>


                                    <td class="px-6 py-5">

                                        <span class="text-xs text-gray-500">
                                            {{ $category->slug }}
                                        </span>

                                    </td>


                                    <td class="px-6 py-5">

                                        @if($category->is_active)

                                            <span class="inline-flex items-center gap-2 bg-green-50 text-green-700 px-3 py-1 text-[9px] uppercase tracking-widest font-semibold">

                                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>

                                                Active

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-500 px-3 py-1 text-[9px] uppercase tracking-widest font-semibold">

                                                <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>

                                                Inactive

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="3"
                                        class="px-6 py-12 text-center text-sm text-gray-400"
                                    >
                                        No categories found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </section>


    </main>

</div>

@endsection