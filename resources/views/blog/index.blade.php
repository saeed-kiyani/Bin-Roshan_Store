@extends('layouts.app')

@section('title', 'Blog | Bin Roshan')

@section('content')

{{-- =========================================================
     HERO
========================================================= --}}

<section class="relative h-[55vh] min-h-[420px] sm:min-h-[500px] w-full overflow-hidden text-white">

    {{-- =====================================================
         TRANSPARENT NAVIGATION
    ====================================================== --}}
    <header class="absolute top-0 left-0 right-0 z-40">

        <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-12">

            <nav class="h-24 flex items-center justify-between">

                {{-- LEFT SIDE --}}

                <div class="hidden lg:flex items-center gap-10 flex-1">

                    <a
                        href="{{ route('home') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Home
                    </a>

                    <a
                        href="{{ route('shop') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Shop
                    </a>

                    <a
                        href="{{ route('categories') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Categories
                    </a>

                </div>


                {{-- =================================================
                     CENTER LOGO
                ================================================== --}}

                <a
                    href="{{ route('home') }}"
                    class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 -mt-2">

                    <img
                        src="{{ asset('images/logo/logo.png') }}"
                        alt="Bin Ismail"
                        class="h-14 sm:h-16 lg:h-35 max-w-[150px] sm:max-w-none w-auto object-contain">

                </a>


                {{-- RIGHT SIDE --}}

                <div class="hidden lg:flex items-center justify-end gap-10 flex-1">

                    <a
                        href="{{ route('about') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        About
                    </a>

                    <a href="{{ route('blog.index') }}"
                       class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                       Blogs
                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Contact
                    </a>


                    {{-- SEARCH --}}

                    <button
                        type="button"
                        onclick="openSearch()"
                        aria-label="Search"
                        class="text-white hover:text-[#BE8B3E] transition cursor-pointer">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                                stroke-width="1.7"/>

                            <path
                                d="m20 20-4-4"
                                stroke-width="1.7"
                                stroke-linecap="round"/>

                        </svg>

                    </button>


                    {{-- CART --}}

                    <button
                        type="button"
                        onclick="openCart()"
                        aria-label="Shopping bag"
                        class="relative text-white hover:text-[#BE8B3E] transition cursor-pointer">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                d="M6 8h12l1 13H5L6 8Z"
                                stroke-width="1.5"
                                stroke-linejoin="round"/>

                            <path
                                d="M9 8V6a3 3 0 0 1 6 0v2"
                                stroke-width="1.5"
                                stroke-linecap="round"/>

                        </svg>


                        {{-- CART COUNT --}}

                        <span
                            id="cart-count"
                            class="absolute -top-2 -right-3 min-w-[17px] h-[17px] px-1 rounded-full bg-white text-black text-[9px] flex items-center justify-center font-semibold">
                            0
                        </span>

                    </button>

                </div>


                {{-- =================================================
                     MOBILE MENU BUTTON
                ================================================== --}}

                <button
                    type="button"
                    onclick="openMobileMenu()"
                    class="lg:hidden text-white shrink-0"
                    aria-label="Open menu">

                    <svg
                        class="w-7 h-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            d="M4 7h16M4 12h16M4 17h16"
                            stroke-width="1.5"
                            stroke-linecap="round"/>

                    </svg>

                </button>


                {{-- MOBILE CART --}}

                <button
                    type="button"
                    onclick="openCart()"
                    class="lg:hidden relative text-white shrink-0"
                    aria-label="Shopping bag">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            d="M6 8h12l1 13H5L6 8Z"
                            stroke-width="1.5"
                            stroke-linejoin="round"/>

                        <path
                            d="M9 8V6a3 3 0 0 1 6 0v2"
                            stroke-width="1.5"
                            stroke-linecap="round"/>

                    </svg>

                    <span
                        id="cart-count-mobile"
                        class="absolute -top-2 -right-3 min-w-[17px] h-[17px] px-1 rounded-full bg-white text-black text-[9px] flex items-center justify-center font-semibold">
                        0
                    </span>

                </button>

            </nav>

        </div>

    </header>


    <img
        src="{{ asset('images/banners/blogs.jpeg') }}"
        alt="Bin Roshan contact image"
        class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/55"></div>

    <div class="relative z-20 h-full flex items-center justify-center px-4 sm:px-6">

    <div class="text-center max-w-4xl w-full">

            <p class="text-xs uppercase tracking-[0.45em] text-white/70">
                Our Journel
            </p>

        <h1 class="text-4xl sm:text-6xl lg:text-8xl font-light tracking-tight leading-tight">
            Ideas That <span class="text-[#BE8B3E] font-serif italic">Inspire</span>
        </h1>

        <p class="mt-5 sm:mt-8 max-w-3xl mx-auto text-sm sm:text-base lg:text-lg leading-7 sm:leading-8 text-white/90 px-2">
            Explore fashion, beauty, jewellery, tailoring, and trends with inspiring ideas, useful tips, and fresh stories from the world of Bin Roshan.
        </p>

</div>

    </div>

</section>


{{-- Blog Content --}}
<section class="bg-[#f8f7f4] py-12 sm:py-16 lg:py-20">
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

                    <article class="group bg-white rounded-xl overflow-hidden
                                    border border-gray-200
                                    hover:shadow-lg hover:shadow-[#BE8B3E] transition duration-300">

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