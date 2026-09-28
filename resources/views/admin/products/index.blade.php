@extends('layouts.admin')

@section('title', 'Manage Products | Bin Roshan')

@section('content')

<div class="min-h-screen py-12">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 mb-10">

            <div>

                <p class="text-xs uppercase tracking-[0.35em] text-[#BE8B3E] font-semibold">
                    Admin Panel
                </p>

                <h1 class="mt-3 text-4xl font-light">
                    Products
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Manage products, prices, stock and images.
                </p>

            </div>

            <a
                href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center border border-[#BE8B3E] rounded-full text-[#BE8B3E] px-6 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#BE8B3E] hover:text-white transition">
                + Add Product
            </a>

        </div>

        {{-- SUCCESS --}}

        @if(session('success'))

            <div id="success-message" class="mb-8 bg-green-50 border border-green-200 text-green-800 px-5 py-4 text-sm">
                {{ session('success') }}
            </div>

        @endif

        {{-- TABLE --}}

        <div class="border border-[#BE8B3E] rounded-lg overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="border-b border-[#BE8B3E]">

                        <tr>

                            <th class="text-center px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E]">
                                Image
                            </th>

                            <th class="text-center px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E]">
                                Product
                            </th>

                            <th class="text-center px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E]">
                                Category
                            </th>

                            <th class="text-center px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E]">
                                Price
                            </th>

                            <th class="text-center px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E]">
                                Stock
                            </th>

                            <th class="text-center px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E]">
                                Status
                            </th>

                            <th class="text-center px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E]">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($products as $product)

                            @php

                                $image = optional($product->primaryImage)->image;

                                if ($image && !str_starts_with($image, 'http')) {
                                    $image = asset('storage/' . ltrim($image, '/'));
                                }

                                if (!$image) {
                                    $image = asset('images/placeholder.jpg');
                                }

                            @endphp

                            <tr>

                                {{-- IMAGE --}}

                                <td class="px-6 py-5">

                                    <img
                                        src="{{ $image }}"
                                        alt="{{ $product->name }}"
                                        class="w-16 h-20 object-cover bg-gray-100">

                                </td>

                                {{-- PRODUCT --}}

                                <td class="px-6 py-5">

                                    <div class="font-medium text-gray-900">
                                        {{ $product->name }}
                                    </div>

                                    <div class="mt-1 text-xs text-gray-400">
                                        SKU: {{ $product->sku }}
                                    </div>

                                </td>

                                {{-- CATEGORY --}}

                                <td class="px-6 py-5">

                                    <span class="text-sm text-gray-600">
                                        {{ $product->category?->name ?? 'No Category' }}
                                    </span>

                                </td>

                                {{-- PRICE --}}

                                <td class="px-6 py-5">

                                    @if($product->sale_price !== null)

                                        <div class="text-sm font-semibold text-gray-900">
                                            Rs. {{ number_format($product->sale_price, 2) }}
                                        </div>

                                        <div class="text-xs text-gray-400 line-through">
                                            Rs. {{ number_format($product->price, 2) }}
                                        </div>

                                    @else

                                        <div class="text-sm font-semibold text-gray-900">
                                            Rs. {{ number_format($product->price, 2) }}
                                        </div>

                                    @endif

                                </td>

                                {{-- STOCK --}}

                                <td class="px-6 py-5">

                                    @if($product->stock > 0)

                                        <span class="text-sm text-gray-600">
                                            {{ $product->stock }}
                                        </span>

                                    @else

                                        <span class="text-xs uppercase tracking-widest text-red-600 font-semibold">
                                            Out of Stock
                                        </span>

                                    @endif

                                </td>

                                {{-- STATUS --}}

                                <td class="px-6 py-5">

                                    <div class="flex flex-col gap-2">

                                        @if($product->is_active)

                                            <span class="inline-flex w-fit bg-green-50 text-green-700 px-3 py-1 text-[10px] uppercase tracking-widest font-semibold">
                                                Active
                                            </span>

                                        @else

                                            <span class="inline-flex w-fit bg-gray-100 text-gray-500 px-3 py-1 text-[10px] uppercase tracking-widest font-semibold">
                                                Inactive
                                            </span>

                                        @endif

                                        @if($product->is_featured)

                                            <span class="inline-flex w-fit bg-[#a47c15]/10 text-[#a47c15] px-3 py-1 text-[10px] uppercase tracking-widest font-semibold">
                                                Featured
                                            </span>

                                        @endif

                                    </div>

                                </td>

                                {{-- ACTIONS --}}

                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-3">

                                        <a
                                            href="{{ route('product.show', $product->slug) }}"
                                            target="_blank"
                                            class="px-4 py-2 border rounded-full bg-[#BE8B3E] border-[#BE8B3E] text-xs text-white uppercase tracking-widest hover:bg-transparent hover:text-[#BE8B3E] transition">
                                            View
                                        </a>

                                        <a
                                            href="{{ route('admin.products.edit', $product) }}"
                                            class="inline-flex items-center rounded-full border border-gray-300 px-4 py-2 text-[10px] uppercase tracking-widest font-semibold text-gray-700 hover:border-[#BE8B3E] hover:text-[#BE8B3E] transition">
                                            Edit
                                        </a>

                                        <form
                                            action="{{route('admin.products.destroy', $product)}}"
                                            method="POST"
                                            class="delete-category-form">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center rounded-full border border-red-200 px-4 py-2 text-[10px] uppercase tracking-widest font-semibold text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-20 text-center">

                                    <p class="text-gray-400 text-sm">
                                        No products found.
                                    </p>

                                    <a
                                        href="{{ route('admin.products.create') }}"
                                        class="inline-flex mt-5 bg-[#BE8B3E] border border-[#BE8B3E] rounded-full text-white hover:bg-transparent hover:text-[#BE8B3E] px-6 py-3 text-[10px] uppercase tracking-widest font-semibold">
                                        Create First Product
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const deleteModal = document.getElementById('deleteModal');
        const cancelDelete = document.getElementById('cancelDelete');
        const confirmDelete = document.getElementById('confirmDelete');

        let deleteForm = null;

        // Open modal
        document.querySelectorAll('.delete-category-form').forEach(function (form) {

            form.addEventListener('submit', function (event) {

                event.preventDefault();

                deleteForm = form;

                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');

            });

        });

        // Cancel
        cancelDelete.addEventListener('click', function () {

            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');

            deleteForm = null;

        });

        // Confirm delete
        confirmDelete.addEventListener('click', function () {

            if (deleteForm) {
                deleteForm.submit();
            }

        });

        // Close when clicking outside modal
        deleteModal.addEventListener('click', function (event) {

            if (event.target === deleteModal) {

                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');

                deleteForm = null;

            }

        });

    });
</script>

{{-- AUTO HIDE MESSAGES AFTER 3 SECONDS --}} 

<script> 
setTimeout(() => { 
    const successMessage = document.getElementById('success-message'); 
    const errorMessage = document.getElementById('error-message'); 
    
    if (successMessage) {
        successMessage.style.display = 'none'; 
    } 
    if (errorMessage) { 
        errorMessage.style.display = 'none'; } 
    }, 2000); 
    
</script>

@endsection