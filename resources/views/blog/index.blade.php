@extends('layouts.app')

@section('title', 'Blog | Bin Roshan')

@section('content')

{{-- Hero --}}
<section class="relative overflow-hidden bg-black text-white">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#BE8B3E] blur-3xl"></div>
        <div class="absolute -bottom-32 -left-24 w-96 h-96 rounded-full bg-[#BE8B3E] blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">
        <div class="max-w-3xl">
            <p class="text-sm sm:text-base font-semibold tracking-[0.25em] uppercase text-[#BE8B3E] mb-4">
                Bin Roshan Journal
            </p>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight">
                Our Blog
            </h1>

            <p class="mt-5 text-base sm:text-lg text-gray-300 leading-8 max-w-2xl">
                Discover helpful guides, thoughtful insights and stories from Bin Roshan.
            </p>
        </div>
    </div>
</section>


{{-- Blog Content --}}
<section class="bg-gray-50 py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Categories --}}
        @if($categories->isNotEmpty())
    <div class="mb-10">
        <div class="flex flex-wrap items-center gap-3">

            <a href="{{ route('blog.index') }}"
               class="inline-flex items-center px-4 py-2 rounded-full
                      text-sm font-semibold transition
                      {{ !$currentCategory
                          ? 'bg-black text-white'
                          : 'bg-white text-gray-700 border border-gray-200 hover:border-[#BE8B3E] hover:text-[#BE8B3E]' }}">
                All Posts
            </a>

            @foreach($categories as $category)
                <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                   class="inline-flex items-center px-4 py-2 rounded-full
                          text-sm font-semibold transition
                          {{ $currentCategory && $currentCategory->id === $category->id
                              ? 'bg-black text-white'
                              : 'bg-white text-gray-700 border border-gray-200 hover:border-[#BE8B3E] hover:text-[#BE8B3E]' }}">
                    {{ $category->name }}
                </a>
            @endforeach

        </div>
    </div>
@endif


        {{-- Posts --}}
        @if($posts->isNotEmpty())

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                @foreach($posts as $post)

                    @php
                        $image = $post->featured_image;

                        if ($image && !str_starts_with($image, 'http')) {
                            $image = asset('storage/' . ltrim($image, '/'));
                        }
                    @endphp

                    <article class="group bg-white rounded-2xl overflow-hidden
                                    border border-gray-200 shadow-sm
                                    hover:shadow-xl transition duration-300">

                        {{-- Image --}}
                        <a href="{{ url('/blog/' . $post->slug) }}"
                           class="block overflow-hidden">

                            @if($image)
                                <img src="{{ $image }}"
                                     alt="{{ $post->title }}"
                                     class="w-full h-60 sm:h-64 object-cover
                                            group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-60 sm:h-64 bg-gray-100
                                            flex items-center justify-center">
                                    <svg class="w-14 h-14 text-gray-300"
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

                        </a>


                        {{-- Content --}}
                        <div class="p-6">

                            {{-- Category / Date --}}
                            <div class="flex flex-wrap items-center gap-2 mb-4">

                                @if($post->category)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full
                                                 bg-[#BE8B3E]/10 text-[#9A6F2F]
                                                 text-xs font-semibold">
                                        {{ $post->category->name }}
                                    </span>
                                @endif

                                @if($post->published_at)
                                    <span class="text-xs text-gray-400">
                                        {{ $post->published_at->format('d M Y') }}
                                    </span>
                                @endif

                            </div>


                            {{-- Title --}}
                            <h2 class="text-xl font-bold text-gray-900 leading-snug
                                       group-hover:text-[#9A6F2F] transition">

                                <a href="{{ url('/blog/' . $post->slug) }}">
                                    {{ $post->title }}
                                </a>

                            </h2>


                            {{-- Excerpt --}}
                            @if($post->excerpt)
                                <p class="mt-3 text-sm sm:text-base text-gray-600
                                          leading-7 line-clamp-3">
                                    {{ $post->excerpt }}
                                </p>
                            @else
                                <p class="mt-3 text-sm sm:text-base text-gray-600
                                          leading-7 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 150) }}
                                </p>
                            @endif


                            {{-- Read More --}}
                            <div class="mt-6">

                                <a href="{{ url('/blog/' . $post->slug) }}"
                                   class="inline-flex items-center gap-2 text-sm
                                          font-semibold text-gray-900
                                          hover:text-[#9A6F2F] transition">

                                    Read Article

                                    <svg class="w-4 h-4 transition-transform
                                                group-hover:translate-x-1"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M9 5l7 7-7 7"/>
                                    </svg>

                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            {{-- Empty State --}}
            <div class="bg-white rounded-2xl border border-gray-200
                        px-6 py-16 sm:py-20 text-center">

                <div class="w-20 h-20 mx-auto rounded-full bg-gray-100
                            flex items-center justify-center">

                    <svg class="w-10 h-10 text-gray-400"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.5"
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-1m-4 13H9m4-13V4m0 0L11 6m2-2l2 2"/>
                    </svg>

                </div>

                <h2 class="mt-5 text-2xl font-bold text-gray-900">
                    No Blog Posts Yet
                </h2>

                <p class="mt-2 text-gray-500 max-w-md mx-auto">
                    We are preparing some interesting articles for you.
                    Please check back soon.
                </p>

            </div>

        @endif

    </div>
</section>

@endsection