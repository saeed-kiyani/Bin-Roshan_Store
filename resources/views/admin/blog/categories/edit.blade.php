@extends('layouts.admin')

@section('title', 'Edit Blog Category | Bin Roshan')

@section('content')

<div class="min-h-screen bg-[#f8f7f4]">

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- BACK --}}
        <a
            href="{{ route('admin.blog.categories.index') }}"
            class="inline-flex items-center text-[10px] uppercase tracking-widest font-semibold text-gray-500 hover:text-[#BE8B3E] transition">
            ← Back to Blog Categories
        </a>


        {{-- HEADER --}}
        <div class="mt-8 mb-8">

            <p class="text-[10px] uppercase tracking-[0.4em] text-[#a47c15] font-semibold">
                Blog
            </p>

            <h1 class="mt-3 text-3xl sm:text-4xl font-light text-gray-900">
                Edit Blog Category
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Update your blog category information.
            </p>

        </div>


        {{-- VALIDATION ERRORS --}}
        @if($errors->any())

            <div class="mb-6 border border-red-200 bg-red-50 px-5 py-4 rounded-lg">

                <ul class="space-y-1 text-sm text-red-600">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- FORM --}}
        <form
            action="{{ route('admin.blog.categories.update', $blogCategory) }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white border border-[#BE8B3E] rounded-lg p-6 sm:p-8">

            @csrf
            @method('PUT')


            {{-- NAME --}}
            <div>

                <label
                    for="name"
                    class="block text-[10px] uppercase tracking-widest font-semibold text-gray-700">
                    Category Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $blogCategory->name) }}"
                    required
                    class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]">

            </div>


            {{-- SLUG --}}
            <div class="mt-6">

                <label
                    for="slug"
                    class="block text-[10px] uppercase tracking-widest font-semibold text-gray-700">
                    Slug
                </label>

                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug', $blogCategory->slug) }}"
                    class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]">

                <p class="mt-2 text-xs text-gray-400">
                    Used in the blog category URL.
                </p>

            </div>


            {{-- DESCRIPTION --}}
            <div class="mt-6">

                <label
                    for="description"
                    class="block text-[10px] uppercase tracking-widest font-semibold text-gray-700">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                    placeholder="Write a short description for this blog category...">{{ old('description', $blogCategory->description) }}</textarea>

            </div>


            {{-- CURRENT IMAGE --}}
            @php

                $currentImage = $blogCategory->image;

                if ($currentImage && !str_starts_with($currentImage, 'http')) {
                    $currentImage = asset('storage/' . ltrim($currentImage, '/'));
                }

            @endphp


            @if($currentImage)

                <div class="mt-6">

                    <label class="block text-[10px] uppercase tracking-widest font-semibold text-gray-700">
                        Current Image
                    </label>

                    <div class="mt-3">

                        <img
                            src="{{ $currentImage }}"
                            alt="{{ $blogCategory->name }}"
                            class="w-32 h-32 object-cover rounded-lg border border-gray-200">

                    </div>

                </div>

            @endif


            {{-- REPLACE IMAGE --}}
            <div class="mt-6">

                <label
                    for="image"
                    class="block text-[10px] uppercase tracking-widest font-semibold text-gray-700">
                    Replace Image
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="mt-2 block w-full border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-600 bg-white file:mr-4 file:border-0 file:bg-black file:text-white file:px-4 file:py-2 file:text-xs file:uppercase file:tracking-widest file:font-semibold hover:file:bg-[#BE8B3E] transition">

                <p class="mt-2 text-xs text-gray-400">
                    JPG, JPEG, PNG or WEBP. Maximum size: 4MB. Leave empty to keep the current image.
                </p>

            </div>


            {{-- SORT ORDER --}}
            <div class="mt-6">

                <label
                    for="sort_order"
                    class="block text-[10px] uppercase tracking-widest font-semibold text-gray-700">
                    Sort Order
                </label>

                <input
                    type="number"
                    id="sort_order"
                    name="sort_order"
                    value="{{ old('sort_order', $blogCategory->sort_order) }}"
                    min="0"
                    class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]">

                <p class="mt-2 text-xs text-gray-400">
                    Lower numbers appear first.
                </p>

            </div>


            {{-- ACTIVE --}}
            <div class="mt-6">

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $blogCategory->is_active) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-300 text-[#BE8B3E] focus:ring-[#BE8B3E]">

                    <span class="text-sm text-gray-700">
                        Active category
                    </span>

                </label>

                <p class="mt-2 ml-7 text-xs text-gray-400">
                    Active categories can be used for published blog posts.
                </p>

            </div>


            {{-- ACTIONS --}}
            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row gap-3">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center bg-black text-white px-6 py-3 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-[#BE8B3E] transition">
                    Update Blog Category
                </button>

                <a
                    href="{{ route('admin.blog.categories.index') }}"
                    class="inline-flex items-center justify-center border border-gray-300 text-gray-700 px-6 py-3 rounded-lg text-xs uppercase tracking-widest font-semibold hover:border-black transition">
                    Cancel
                </a>

            </div>

        </form>

    </main>

</div>

@endsection