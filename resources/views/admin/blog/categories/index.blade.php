@extends('layouts.admin')

@section('title', 'Blog Categories | Bin Roshan')

@section('content')

<div class="min-h-screen bg-[#f8f7f4]">

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-8">

            <div>
                <p class="text-[10px] uppercase tracking-[0.4em] text-[#BE8B3E] font-semibold">
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

            <div id="success-message" class="mb-6 border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700 rounded-lg">
                {{ session('success') }}
            </div>

        @endif

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div id="error-message" class="mb-6 border border-red-200 bg-red-50 px-5 py-4 rounded-lg">

                <ul class="space-y-1 text-sm text-red-600">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- TABLE --}}
        <div class="border border-[#BE8B3E] rounded-lg overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full min-w-[850px]">

                    <thead class="border-b border-[#BE8B3E]">

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

                            <tr>

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
                                            class="inline-flex items-center rounded-full border border-gray-300 px-4 py-2 text-[10px] uppercase tracking-widest font-semibold text-gray-700 hover:border-[#BE8B3E] hover:text-[#BE8B3E] transition">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.blog.categories.destroy', $category) }}"
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
                                            class="inline-flex mt-5 bg-[#BE8B3E] border border-[#BE8B3E] rounded-full text-white hover:bg-transparent hover:text-[#BE8B3E] px-6 py-3 text-[10px] uppercase tracking-widest font-semibold">
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

{{-- DELETE CONFIRMATION MODAL --}}
<div id="deleteModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm px-4">

    <div class="w-full max-w-md rounded-2xl bg-[#f8f7f4] p-6 shadow-2xl">

        {{-- Icon --}}
        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-red-50">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-7 w-7 text-red-500"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="1.8">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 9v3.75m0 3.75h.008v.008H12v-.008z" />
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M10.29 3.86 1.82 18a2 2 0 0 0 1.72 3h16.92a2 2 0 0 0 1.72-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
            </svg>
        </div>

        {{-- Title --}}
        <h3 class="text-center text-lg font-semibold text-gray-900">
            Delete Blog Category?
        </h3>

        {{-- Message --}}
        <p class="mt-2 text-center text-sm leading-6 text-gray-500">
            Are you sure you want to delete this blog category?
            This action cannot be undone.
        </p>

        {{-- Buttons --}}
        <div class="mt-6 flex justify-center gap-3">

            <button
                type="button"
                id="cancelDelete"
                class="rounded-full cursor-pointer border border-gray-200 px-5 py-2.5 text-xs font-semibold uppercase tracking-widest text-gray-600 transition hover:bg-gray-100">
                Cancel
            </button>

            <button
                type="button"
                id="confirmDelete"
                class="rounded-full cursor-pointer bg-red-500 px-5 py-2.5 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-red-600">
                Delete
            </button>

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