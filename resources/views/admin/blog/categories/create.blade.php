@extends('layouts.admin')

@section('title', 'Add Blog Category | Bin Roshan')

@section('content')

<div class="min-h-screen bg-[#f8f7f4]">

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- BACK --}}

        <a href="{{ route('admin.blog.categories.index') }}"
           class="inline-flex items-center text-[10px] uppercase tracking-widest font-semibold text-gray-500 hover:text-[#BE8B3E] transition">
            ← Back to Blog Categories
        </a>

        {{-- HEADER --}}

        <div class="mt-8 mb-8">

            <p class="text-[10px] uppercase tracking-[0.4em] text-[#BE8B3E] font-semibold">
                Blog
            </p>

            <h1 class="mt-3 text-3xl sm:text-4xl font-light text-gray-900">
                Add Blog Category
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Create a category for organizing your blog posts.
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

        <form action="{{ route('admin.blog.categories.store') }}" method="POST" enctype="multipart/form-data" class=" border border-[#BE8B3E] rounded-lg p-6 sm:p-8">

            @csrf

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
                    value="{{ old('name') }}"
                    required
                    class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                    placeholder="e.g. Fashion Trends">

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
                    value="{{ old('slug') }}"
                    class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                    placeholder="fashion-trends">

                <p class="mt-2 text-xs text-gray-400">
                    Leave empty to generate automatically from the category name.
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
                    class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                    placeholder="Write a short description for this blog category...">{{ old('description') }}</textarea>

            </div>

            {{-- IMAGE --}}

            <div class="mt-6">

                <label
                    for="image"
                    class="block text-[10px] uppercase tracking-widest font-semibold text-gray-700">
                    Category Image
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="mt-3 w-full rounded-lg border border-gray-300 cursor-pointer px-4 py-3 text-sm">

                <p class="mt-2 text-xs text-gray-400">
                    JPG, JPEG, PNG or WEBP. Maximum size: 4MB.
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
                    value="{{ old('sort_order', 0) }}"
                    min="0"
                    class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:outline-none focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]">

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
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border border-[#BE8B3E] bg-white text-[#BE8B3E] accent-[#BE8B3E]  focus:ring-[#BE8B3E]/30 focus:ring-offset-0">

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
                    class="bg-[#BE8B3E] rounded-full cursor-pointer border border-[#BE8B3E] hover:bg-transparent hover:text-[#BE8B3E] text-white px-7 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#a47c15] transition">
                    Create Blog Category
                </button>

                <a
                    href="{{ route('admin.blog.categories.index') }}"
                    class="border border-gray-300 rounded-full px-7 py-4 text-xs uppercase tracking-widest font-semibold text-center hover:bg-gray-300 hover:text-white transition">
                    Cancel
                </a>

            </div>

        </form>

    </main>

</div>

@endsection