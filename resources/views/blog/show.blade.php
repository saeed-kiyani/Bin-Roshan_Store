@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title . ' | Bin Roshan')

@section('content')

@php
    $image = $post->featured_image;

    if ($image && !str_starts_with($image, 'http')) {
        $image = asset('storage/' . ltrim($image, '/'));
    }
@endphp

{{-- Article Header --}}
<section class="bg-black/80 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">

        {{-- Breadcrumb --}}
        <div class="mb-8">
            <a href="{{ route('blog.index') }}"
               class="text-sm text-gray-400 hover:text-[#BE8B3E] transition">
                ← Back to Blog
            </a>
        </div>

        {{-- Category --}}
        @if($post->category)
            <div class="mb-5">
                <span class="inline-flex items-center px-3 py-1.5 rounded-full
                             bg-[#BE8B3E]/15 text-[#BE8B3E] border border-[#BE8B3E]
                             text-xs sm:text-sm font-semibold">
                    {{ $post->category->name }}
                </span>
            </div>
        @endif

        {{-- Title --}}
        <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl
                   font-bold leading-tight max-w-4xl">
            {{ $post->title }}
        </h1>

        {{-- Date --}}
        @if($post->published_at)
            <div class="mt-6 text-sm text-gray-400">
                Published on {{ $post->published_at->format('d F Y') }}
            </div>
        @endif

    </div>
</section>


{{-- Featured Image --}}
@if($image)
    <section class="bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-1 py-8 sm:py-10">

            <img src="{{ $image }}"
                 alt="{{ $post->title }}"
                 class="w-full max-h-[600px] object-cover rounded-2xl
                        shadow-xl border border-gray-200">

        </div>
    </section>
@endif


{{-- Article --}}
<section class="bg-white py-10 sm:py-14 lg:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Excerpt --}}
        @if($post->excerpt)
            <div class="mb-10 pb-8 border-b border-gray-200">
                <p class="text-lg sm:text-xl text-gray-600 leading-8 font-medium">
                    {{ $post->excerpt }}
                </p>
            </div>
        @endif


        {{-- Article Content --}}
        <article class="blog-content">

            {!! $post->content !!}

        </article>

    </div>
</section>


{{-- Related Posts --}}
@if($relatedPosts->isNotEmpty())
    <section class="bg-gray-50 py-12 sm:py-16 lg:py-20">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-[0.2em]
                          text-[#BE8B3E]">
                    Keep Reading
                </p>

                <h2 class="mt-2 text-2xl sm:text-3xl font-bold text-gray-900">
                    Related Articles
                </h2>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                @foreach($relatedPosts as $relatedPost)

                    @php
                        $relatedImage = $relatedPost->featured_image;

                        if ($relatedImage && !str_starts_with($relatedImage, 'http')) {
                            $relatedImage = asset(
                                'storage/' . ltrim($relatedImage, '/')
                            );
                        }
                    @endphp

                    <article class="group bg-white rounded-2xl overflow-hidden
                                    border border-gray-200 shadow-sm
                                    hover:shadow-xl transition duration-300">

                        <a href="{{ route('blog.show', $relatedPost->slug) }}"
                           class="block overflow-hidden">

                            @if($relatedImage)
                                <img src="{{ $relatedImage }}"
                                     alt="{{ $relatedPost->title }}"
                                     class="w-full h-56 object-cover
                                            group-hover:scale-105
                                            transition duration-500">
                            @else
                                <div class="w-full h-56 bg-gray-100
                                            flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300"
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


                        <div class="p-6">

                            @if($relatedPost->category)
                                <span class="inline-flex items-center px-3 py-1
                                             rounded-full bg-[#BE8B3E]/10
                                             text-[#9A6F2F] text-xs font-semibold">
                                    {{ $relatedPost->category->name }}
                                </span>
                            @endif

                            <h3 class="mt-4 text-xl font-bold text-gray-900
                                       leading-snug group-hover:text-[#9A6F2F]
                                       transition">

                                <a href="{{ route('blog.show', $relatedPost->slug) }}">
                                    {{ $relatedPost->title }}
                                </a>

                            </h3>

                            @if($relatedPost->excerpt)
                                <p class="mt-3 text-sm text-gray-600 leading-7 line-clamp-3">
                                    {{ $relatedPost->excerpt }}
                                </p>
                            @endif

                            <a href="{{ route('blog.show', $relatedPost->slug) }}"
                               class="inline-flex items-center gap-2 mt-5
                                      text-sm font-semibold text-gray-900
                                      hover:text-[#9A6F2F] transition">

                                Read Article

                                <svg class="w-4 h-4"
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

                    </article>

                @endforeach

            </div>

        </div>

    </section>
@endif


{{-- Article Styling --}}
<style>
    .blog-content {
        color: #374151;
        font-size: 1.05rem;
        line-height: 1.9;
    }

    .blog-content h1 {
        font-size: 2.25rem;
        line-height: 1.2;
        font-weight: 700;
        color: #111827;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .blog-content h2 {
        font-size: 1.875rem;
        line-height: 1.3;
        font-weight: 700;
        color: #111827;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .blog-content h3 {
        font-size: 1.5rem;
        line-height: 1.4;
        font-weight: 700;
        color: #111827;
        margin-top: 1.75rem;
        margin-bottom: 0.75rem;
    }

    .blog-content p {
        margin-bottom: 1.25rem;
    }

    .blog-content ul {
        list-style: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.25rem;
    }

    .blog-content ol {
        list-style: decimal;
        padding-left: 1.5rem;
        margin-bottom: 1.25rem;
    }

    .blog-content li {
        margin-bottom: 0.5rem;
    }

    .blog-content blockquote {
        border-left: 4px solid #BE8B3E;
        padding: 1rem 1.25rem;
        margin: 1.5rem 0;
        background: #f9fafb;
        color: #4b5563;
        font-style: italic;
    }

    .blog-content a {
        color: #9A6F2F;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .blog-content a:hover {
        color: #BE8B3E;
    }

    .blog-content strong {
        color: #111827;
        font-weight: 700;
    }

    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
        margin: 1.5rem auto;
    }

    .blog-content pre {
        overflow-x: auto;
        background: #111827;
        color: #f9fafb;
        padding: 1rem;
        border-radius: 0.75rem;
        margin: 1.5rem 0;
    }

    .blog-content code {
        background: #f3f4f6;
        color: #111827;
        padding: 0.15rem 0.35rem;
        border-radius: 0.25rem;
    }

    .blog-content pre code {
        background: transparent;
        color: inherit;
        padding: 0;
    }
</style>

@endsection