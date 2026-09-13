@extends('layouts.admin')

@section('title', 'Edit Category | Bin Ismail')

@section('content')

@php
    $currentImage = $category->image;

    if ($currentImage && !str_starts_with($currentImage, 'http')) {
        $currentImage = asset('storage/' . ltrim($currentImage, '/'));
    }
@endphp

<div class="min-h-screen bg-gray-50 py-12">

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}

        <div class="mb-10">

            <a
                href="{{ route('admin.categories.index') }}"
                class="text-xs uppercase tracking-widest text-gray-500 hover:text-black transition"
            >
                ← Back to Categories
            </a>

            <p class="mt-8 text-xs uppercase tracking-[0.35em] text-[#a47c15] font-semibold">
                Admin Panel
            </p>

            <h1 class="mt-3 text-4xl font-light">
                Edit Category
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


        {{-- FORM --}}

        <form
            action="{{ route('admin.categories.update', $category) }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white border border-gray-200 p-6 sm:p-10"
        >

            @csrf

            @method('PUT')


            {{-- CURRENT IMAGE --}}

            @if($currentImage)

                <div class="mb-8">

                    <p class="text-xs uppercase tracking-widest font-semibold text-gray-700 mb-3">
                        Current Image
                    </p>

                    <img
                        src="{{ $currentImage }}"
                        alt="{{ $category->name }}"
                        class="w-40 h-48 object-cover bg-gray-100"
                    >

                </div>

            @endif


            {{-- NAME --}}

            <div>

                <label
                    for="name"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Category Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $category->name) }}"
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
                    value="{{ old('slug', $category->slug) }}"
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

            </div>


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
                    rows="5"
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >{{ old('description', $category->description) }}</textarea>

            </div>


            {{-- NEW IMAGE --}}

            <div class="mt-7">

                <label
                    for="image"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Replace Image
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white"
                >

                <p class="mt-2 text-xs text-gray-400">
                    Leave empty to keep the current image.
                    JPG, JPEG, PNG or WEBP. Maximum 4MB.
                </p>

            </div>


            {{-- SORT ORDER --}}

            <div class="mt-7">

                <label
                    for="sort_order"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Sort Order
                </label>

                <input
                    type="number"
                    id="sort_order"
                    name="sort_order"
                    value="{{ old('sort_order', $category->sort_order) }}"
                    min="0"
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

            </div>


            {{-- ACTIVE --}}

            <div class="mt-7">

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                        class="w-4 h-4"
                    >

                    <span class="text-sm text-gray-700">
                        Active category
                    </span>

                </label>

            </div>


            {{-- BUTTONS --}}

            <div class="mt-10 flex flex-col sm:flex-row gap-3">

                <button
                    type="submit"
                    class="bg-black text-white px-7 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#a47c15] transition"
                >
                    Update Category
                </button>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="border border-gray-300 px-7 py-4 text-xs uppercase tracking-widest font-semibold text-center hover:bg-gray-100 transition"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection