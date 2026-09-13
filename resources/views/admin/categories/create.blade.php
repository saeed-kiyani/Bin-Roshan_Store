@extends('layouts.admin')

@section('title', 'Add Category | Bin Ismail')

@section('content')

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
                Add Category
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
            action="{{ route('admin.categories.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white border border-gray-200 p-6 sm:p-10"
        >

            @csrf


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
                    value="{{ old('name') }}"
                    placeholder="e.g. Clothing"
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
                    value="{{ old('slug') }}"
                    placeholder="Leave empty to generate automatically"
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

                <p class="mt-2 text-xs text-gray-400">
                    Example: clothing
                </p>

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
                    placeholder="Describe this category..."
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >{{ old('description') }}</textarea>

            </div>


            {{-- IMAGE --}}

            <div class="mt-7">

                <label
                    for="image"
                    class="block text-xs uppercase tracking-widest font-semibold text-gray-700"
                >
                    Category Image
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm bg-white"
                >

                <p class="mt-2 text-xs text-gray-400">
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
                    value="{{ old('sort_order', 0) }}"
                    min="0"
                    class="mt-3 w-full border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:border-black"
                >

                <p class="mt-2 text-xs text-gray-400">
                    Lower numbers appear first.
                </p>

            </div>


            {{-- ACTIVE --}}

            <div class="mt-7">

                <label class="flex items-center gap-3 cursor-pointer">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
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
                    Create Category
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