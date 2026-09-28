@extends('layouts.admin')

@section('title', 'Blog Posts | Bin Roshan')

@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-[#BE8B3E] font-semibold">
                    Admin Panel
                </p>

                <h1 class="mt-3 text-4xl font-light">
                    Blog Posts
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Manage all your blog posts from here.
                </p>
            </div>

            <a href="{{ route('admin.blog.posts.create') }}"
               class="inline-flex items-center justify-center border border-[#BE8B3E] rounded-full text-[#BE8B3E] px-6 py-4 text-xs uppercase tracking-widest font-semibold hover:bg-[#BE8B3E] hover:text-white transition">
                + Add New Post
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div id="success-message" class="mb-6 rounded-lg border border-green-200 bg-green-50
                        px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div id="error-message" class="mb-6 rounded-lg border border-red-200 bg-red-50
                        px-4 py-3 text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Posts Table --}}
        <div class="border border-[#BE8B3E] rounded-lg overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full min-w-[850px]">

                    <thead class="border-b border-[#BE8B3E]">

                        <tr>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Post
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Category
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Status
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Published
                            </th>

                            <th class="text-left px-6 py-4 text-[10px] uppercase tracking-widest text-[#BE8B3E] font-semibold">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($posts as $post)

                            @php
                                $image = $post->featured_image;

                                if ($image && !str_starts_with($image, 'http')) {
                                    $image = asset('storage/' . ltrim($image, '/'));
                                }
                            @endphp

                            <tr>

                                {{-- Post --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">

                                        {{-- Featured Image --}}
                                        <div class="flex-shrink-0">
                                            @if($image)
                                                <img src="{{ $image }}"
                                                     alt="{{ $post->title }}"
                                                     class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                                            @else
                                                <div class="w-16 h-16 rounded-lg bg-gray-100
                                                            border border-gray-200 flex items-center
                                                            justify-center">
                                                    <svg class="w-7 h-7 text-gray-400"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="1.5"
                                                              d="M4 16l4.586-4.586a2 2 0 016.828 0L20 16m-2-2l-1.586-1.586a2 2 0 00-2.828 0L9 18m-5 2h16a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="min-w-0">
                                            <div class="font-semibold text-gray-900 truncate max-w-xs">
                                                {{ $post->title }}
                                            </div>

                                            <div class="text-xs text-gray-500 mt-1">
                                                /blog/{{ $post->slug }}
                                            </div>

                                            @if($post->excerpt)
                                                <div class="text-sm text-gray-500 mt-1 line-clamp-2 max-w-md">
                                                    {{ $post->excerpt }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Category --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($post->category)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full
                                                     text-xs font-medium bg-gray-100 text-gray-700">
                                            {{ $post->category->name }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">
                                            No Category
                                        </span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($post->is_published)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1
                                                     rounded-full text-xs font-semibold
                                                     bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1
                                                     rounded-full text-xs font-semibold
                                                     bg-yellow-100 text-yellow-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                {{-- Published --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($post->published_at)
                                        {{ $post->published_at->format('d M Y') }}
                                    @else
                                        —
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.blog.posts.edit', $post) }}"
                                           class="inline-flex items-center rounded-full border border-gray-300 px-4 py-2 text-[10px] uppercase tracking-widest font-semibold text-gray-700 hover:border-[#BE8B3E] hover:text-[#BE8B3E] transition">
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.blog.posts.destroy', $post) }}"
                                              method="POST"
                                              class="delete-category-form">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="inline-flex items-center rounded-full border border-red-200 px-4 py-2 text-[10px] uppercase tracking-widest font-semibold text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center justify-center">

                                        <div class="w-16 h-16 rounded-full bg-gray-100 border border-[#BE8B3E]
                                                    flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-[#BE8B3E]"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="1.5"
                                                      d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-1m-4 13H9m4-13V4m0 0L11 6m2-2l2 2"/>
                                            </svg>
                                        </div>

                                        <h3 class="text-lg font-semibold text-gray-900">
                                            No Blog Posts Yet
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-500">
                                            Create your first blog post to get started.
                                        </p>

                                        <a href="{{ route('admin.blog.posts.create') }}"
                                           class="inline-flex mt-5 bg-[#BE8B3E] border border-[#BE8B3E] rounded-full text-white hover:bg-transparent hover:text-[#BE8B3E] px-6 py-3 text-[10px] uppercase tracking-widest font-semibold">
                                            + Create First Post
                                        </a>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>

    </div>

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