@extends('layouts.admin')

@section('title', 'Manage Categories | Bin Ismail')

@section('content')

<div class="min-h-screen bg-gray-50 py-12">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 mb-10">

            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-[#a47c15] font-semibold">
                    Admin Panel
                </p>

                <h1 class="mt-3 text-4xl font-light">
                    Categories
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Manage your store categories and images.
                </p>
            </div>

            <a
                href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center justify-center bg-black text-white px-6 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#a47c15] transition"
            >
                + Add Category
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="mb-8 bg-green-50 border border-green-200 text-green-800 px-5 py-4 text-sm">
                {{ session('success') }}
            </div>

        @endif


        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="mb-8 bg-red-50 border border-red-200 text-red-800 px-5 py-4">

                <ul class="text-sm space-y-1">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- CATEGORY TABLE --}}

        <div class="bg-white border border-gray-200 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50 border-b border-gray-200">

                        <tr>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-500">
                                Image
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-500">
                                Category
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-500">
                                Slug
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-500">
                                Status
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-gray-500">
                                Sort
                            </th>

                            <th class="text-right px-6 py-4 text-[10px] uppercase tracking-widest text-gray-500">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse($categories as $category)

                            @php
                                $image = $category->image;

                                if ($image && !str_starts_with($image, 'http')) {
                                    $image = asset('storage/' . ltrim($image, '/'));
                                }

                                if (!$image) {
                                    $image = asset('images/placeholder.jpg');
                                }
                            @endphp

                            <tr class="hover:bg-gray-50 transition">

                                {{-- IMAGE --}}

                                <td class="px-6 py-5">

                                    <img
                                        src="{{ $image }}"
                                        alt="{{ $category->name }}"
                                        class="w-16 h-20 object-cover bg-gray-100"
                                    >

                                </td>


                                {{-- NAME --}}

                                <td class="px-6 py-5">

                                    <div class="font-medium text-gray-900">
                                        {{ $category->name }}
                                    </div>

                                    @if($category->description)

                                        <div class="mt-1 text-xs text-gray-400 max-w-xs truncate">
                                            {{ $category->description }}
                                        </div>

                                    @endif

                                </td>


                                {{-- SLUG --}}

                                <td class="px-6 py-5">

                                    <span class="text-sm text-gray-500">
                                        {{ $category->slug }}
                                    </span>

                                </td>


                                {{-- STATUS --}}

                                <td class="px-6 py-5">

                                    @if($category->is_active)

                                        <span class="inline-flex bg-green-50 text-green-700 px-3 py-1 text-[10px] uppercase tracking-widest font-semibold">
                                            Active
                                        </span>

                                    @else

                                        <span class="inline-flex bg-gray-100 text-gray-500 px-3 py-1 text-[10px] uppercase tracking-widest font-semibold">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                {{-- SORT --}}

                                <td class="px-6 py-5">

                                    <span class="text-sm text-gray-600">
                                        {{ $category->sort_order }}
                                    </span>

                                </td>


                                {{-- ACTIONS --}}

                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-3">

                                        <a
                                            href="{{ route('admin.categories.edit', $category) }}"
                                            class="px-4 py-2 border border-gray-300 text-xs uppercase tracking-widest hover:bg-black hover:text-white hover:border-black transition"
                                        >
                                            Edit
                                        </a>


                                        <form
                                            action="{{ route('admin.categories.destroy', $category) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="px-4 py-2 border border-red-200 text-red-600 text-xs uppercase tracking-widest hover:bg-red-600 hover:text-white hover:border-red-600 transition"
                                            >
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
                                    class="px-6 py-20 text-center"
                                >

                                    <p class="text-gray-400 text-sm">
                                        No categories found.
                                    </p>

                                    <a
                                        href="{{ route('admin.categories.create') }}"
                                        class="inline-flex mt-5 bg-black text-white px-6 py-3 text-xs uppercase tracking-widest"
                                    >
                                        Create First Category
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

@endsection