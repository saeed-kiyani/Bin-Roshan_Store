@extends('layouts.admin')

@section('title', 'Blog Posts | Bin Roshan')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    Blog Posts
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Manage all your blog posts from here.
                </p>
            </div>

            <a href="{{ route('admin.blog.posts.create') }}"
               class="inline-flex items-center justify-center px-5 py-3 rounded-lg
                      bg-black text-white text-sm font-semibold
                      hover:bg-gray-800 transition">
                + Add New Post
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50
                        px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50
                        px-4 py-3 text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Posts Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            {{-- Desktop Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider">
                                Post
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider">
                                Category
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider">
                                Published
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold
                                       text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">

                        @forelse($posts as $post)

                            @php
                                $image = $post->featured_image;

                                if ($image && !str_starts_with($image, 'http')) {
                                    $image = asset('storage/' . ltrim($image, '/'));
                                }
                            @endphp

                            <tr class="hover:bg-gray-50 transition">

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
                                           class="inline-flex items-center px-3 py-2 rounded-lg
                                                  border border-gray-300 text-sm font-medium
                                                  text-gray-700 hover:bg-gray-100 transition">
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.blog.posts.destroy', $post) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="inline-flex items-center px-3 py-2
                                                           rounded-lg border border-red-200
                                                           text-sm font-medium text-red-600
                                                           hover:bg-red-50 transition">
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

                                        <div class="w-16 h-16 rounded-full bg-gray-100
                                                    flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400"
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
                                           class="mt-5 inline-flex items-center px-5 py-2.5
                                                  rounded-lg bg-black text-white text-sm
                                                  font-semibold hover:bg-gray-800 transition">
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
@endsection