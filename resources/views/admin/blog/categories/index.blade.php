@extends('layouts.admin')

@section('title', 'Blog Categories | Bin Roshan')

@section('content')

<div class="min-h-screen bg-[#f8f7f4]">

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-8">

            <div>
                <p class="text-[10px] uppercase tracking-[0.4em] text-[#a47c15] font-semibold">
                    Blog
                </p>

                <h1 class="mt-3 text-3xl sm:text-4xl font-light text-gray-900">
                    Blog Categories
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Organize your blog posts into categories.
                </p>
            </div>

            <a
                href="{{ route('admin.blog.categories.create') }}"
                class="inline-flex items-center justify-center bg-[#BE8B3E] rounded-full text-white px-6 py-3 text-xs uppercase tracking-widest font-semibold hover:bg-transparent border border-[#BE8B3E] hover:text-[#BE8B3E] transition">
                + Add Blog Category
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))

            <div class="mb-6 border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700 rounded-lg">
                {{ session('success') }}
            </div>

        @endif


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


        {{-- TABLE --}}
        <div class="bg-white border border-[#BE8B3E] rounded-lg overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full min-w-[850px]">

                    <thead class="border-b border-[#BE8B3E] bg-black">

                        <tr>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Image
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Category
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Slug
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Status
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Sort
                            </th>

                            <th class="text-right px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#BE8B3E]/50">

                        @forelse($categories as $category)

                            @php

                                $image = $category->image;

                                if ($image && !str_starts_with($image, 'http')) {
                                    $image = asset('storage/' . ltrim($image, '/'));
                                }

                            @endphp


                            <tr class="hover:bg-gray-50 transition">

                                {{-- IMAGE --}}
                                <td class="px-6 py-5">

                                    @if($image)

                                        <img
                                            src="{{ $image }}"
                                            alt="{{ $category->name }}"
                                            class="w-14 h-14 object-cover rounded border border-gray-200">

                                    @else

                                        <div class="w-14 h-14 bg-gray-100 border border-gray-200 rounded flex items-center justify-center text-gray-300">
                                            —
                                        </div>

                                    @endif

                                </td>


                                {{-- CATEGORY --}}
                                <td class="px-6 py-5">

                                    <div>

                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $category->name }}
                                        </p>

                                        @if($category->description)

                                            <p class="mt-1 text-xs text-gray-400 max-w-sm truncate">
                                                {{ $category->description }}
                                            </p>

                                        @endif

                                    </div>

                                </td>


                                {{-- SLUG --}}
                                <td class="px-6 py-5">

                                    <span class="text-xs text-gray-500">
                                        {{ $category->slug }}
                                    </span>

                                </td>


                                {{-- STATUS --}}
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


                                {{-- SORT --}}
                                <td class="px-6 py-5">

                                    <span class="text-xs text-gray-600">
                                        {{ $category->sort_order }}
                                    </span>

                                </td>


                                {{-- ACTIONS --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-3">

                                        <a
                                            href="{{ route('admin.blog.categories.edit', $category) }}"
                                            class="inline-flex items-center border border-gray-300 px-4 py-2 text-[10px] uppercase tracking-widest font-semibold text-gray-700 hover:border-[#BE8B3E] hover:text-[#BE8B3E] transition">
                                            Edit
                                        </a>


                                        <form
                                            action="{{ route('admin.blog.categories.destroy', $category) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this blog category?');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center border border-red-200 px-4 py-2 text-[10px] uppercase tracking-widest font-semibold text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition">
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center">

                                    <div class="max-w-md mx-auto">

                                        <p class="text-lg font-light text-gray-900">
                                            No blog categories found.
                                        </p>

                                        <p class="mt-2 text-sm text-gray-400">
                                            Create your first blog category to organize your posts.
                                        </p>

                                        <a
                                            href="{{ route('admin.blog.categories.create') }}"
                                            class="inline-flex mt-6 bg-black text-white px-6 py-3 text-[10px] uppercase tracking-widest font-semibold hover:bg-[#BE8B3E] transition">
                                            Create First Category
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

@endsection