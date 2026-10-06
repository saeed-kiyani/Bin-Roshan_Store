<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- Laravel CSRF --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Bin Roshan')</title>

<link
    rel="icon"
    type="image/x-icon"
    href="{{ asset('images/logo/favicon.ico') }}">

<meta
    name="description"
    content="@yield('description', 'Bin Roshan — Premium fancy laces, clothing, jewelry, watches and accessories.')">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    [x-cloak] {
        display: none !important;
    }

    body {
        background: #faf9f7;
    }

    .drawer-shadow {
        box-shadow: -10px 0 40px rgba(0, 0, 0, .12);
    }
</style>

</head>

<body class="text-neutral-900 antialiased">

<!-- =========================================================
     MOBILE MENU
========================================================== -->

<div
    id="mobile-menu-overlay"
    class="fixed inset-0 z-[70] hidden bg-black/40"
    onclick="closeMobileMenu()">
</div>

<aside
    id="mobile-menu"
    class="fixed left-0 top-0 z-[80] flex h-full w-[85%] max-w-sm -translate-x-full flex-col bg-[#f8f7f4] transition-transform duration-300">

    <div class="flex h-20 items-center justify-between border-b border-neutral-200 px-6">

        <img
            src="{{ asset('images/logo/logo.png') }}"
            alt="Bin Roshan"
            class="h-20 w-auto">

        <button
            type="button"
            onclick="closeMobileMenu()"
            class="flex h-10 w-10 items-center justify-center"
            aria-label="Close menu">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18 18 6M6 6l12 12"/>

            </svg>

        </button>

    </div>

    <nav class="flex flex-col px-6 py-8">

        <a
            href="{{ route('home') }}"
            class="border-b border-neutral-200 py-5 text-lg hover:text-[#BE8B3E]">
            Home
        </a>

        <a
            href="{{ route('shop') }}"
            class="border-b border-neutral-200 py-5 text-lg hover:text-[#BE8B3E]">
            Shop
        </a>

        <a
            href="{{ route('categories') }}"
            class="border-b border-neutral-200 py-5 text-lg hover:text-[#BE8B3E]">
            Categories
        </a>

        <a
            href="{{ route('about') }}"
            class="border-b border-neutral-200 py-5 text-lg hover:text-[#BE8B3E]">
            About
        </a>

        <a
            href="{{ route('blog.index') }}"
            class="border-b border-neutral-200 py-5 text-lg hover:text-[#BE8B3E]">
            Blogs
        </a>

        <a
            href="{{ route('contact') }}"
            class="border-b border-neutral-200 py-5 text-lg hover:text-[#BE8B3E]">
            Contact
        </a>

    </nav>

    <div class="mt-auto border-t border-neutral-200 p-6">

        <p class="text-xs uppercase tracking-[0.2em] text-[#BE8B3E]">
            Need help?
        </p>

        <a
            href="https://wa.me/{{ config('store.whatsapp') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="mt-3 block text-sm">
            Chat with us on WhatsApp →
        </a>

    </div>

</aside>

<!-- =========================================================
     SEARCH OVERLAY
========================================================== -->

<div
    id="search-overlay"
    class="fixed inset-0 z-[99999] hidden bg-black/80"
    onclick="closeSearch()">

    <div
        class="mx-auto mt-20 w-[calc(100%-2rem)] max-w-3xl"
        onclick="event.stopPropagation()">

        <div class="overflow-hidden rounded-xl border border-[#BE8B3E] bg-black/50 shadow-2xl">

            <form
                id="global-search-form"
                method="GET"
                action="{{ route('shop') }}">

                <div class="flex items-center border-b border-[#BE8B3E] px-5">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 cursor-pointer text-[#BE8B3E]"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"/>

                    </svg>

                    <input
                        id="search-input"
                        type="text"
                        name="search"
                        placeholder="Search products..."
                        autocomplete="off"
                        class="h-16 flex-1 bg-transparent px-4 text-base text-white outline-none"
                        oninput="searchProducts(this.value)"
                        onkeydown="handleSearchKeydown(event)">

                    <button
                        type="button"
                        onclick="closeSearch()"
                        class="ml-3 shrink-0 cursor-pointer text-sm font-medium tracking-wider text-[#BE8B3E] transition hover:text-white">
                        ESC
                    </button>

                </div>

            </form>


            <div
                id="search-results"
                class="max-h-[65vh] overflow-y-auto">

                <div class="px-6 py-10 text-center">

                    <p class="text-sm text-neutral-300">
                        Search for products, categories or collections.
                    </p>

                    <p class="mt-2 text-xs text-white">
                        Start typing to see suggestions
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     CART OVERLAY
========================================================== -->

<div
    id="cart-overlay"
    class="fixed inset-0 z-[90] hidden bg-black/40"
    onclick="closeCart()">
</div>


<!-- =========================================================
     CART DRAWER
========================================================== -->

<aside
    id="cart-drawer"
    class="drawer-shadow fixed right-0 top-0 z-[100] flex h-full w-full max-w-md translate-x-full flex-col bg-[#f8f7f4] transition-transform duration-300">

    <div class="flex h-20 items-center justify-between border-b border-neutral-200 px-6">

        <div>

            <p class="text-xs uppercase tracking-[0.2em] text-[#BE8B3E]">
                Your
            </p>

            <h2 class="text-xl font-medium">
                Shopping Bag
            </h2>

        </div>

        <button
            type="button"
            onclick="closeCart()"
            class="flex h-10 w-10 cursor-pointer items-center justify-center text-[#BE8B3E] hover:text-black"
            aria-label="Close cart">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18 18 6M6 6l12 12"/>

            </svg>

        </button>

    </div>


    <div
        id="cart-items"
        class="flex-1 overflow-y-auto px-6 py-6">
    </div>


    <div
        id="cart-footer"
        class="border-t border-neutral-200 p-6">
    </div>

</aside>

<!-- =========================================================
     PAGE CONTENT
========================================================== -->

<main>
    @yield('content')
</main>


<!-- =========================================================
     FOOTER
========================================================== -->

<footer class="bg-neutral-950 text-white">

    <!-- =====================================================
         NEWSLETTER
    ====================================================== -->

    <div class="border-b border-white/10">

        <div class="mx-auto max-w-7xl px-5 py-10 lg:px-8 lg:py-12">

            <div class="grid items-center gap-10 lg:grid-cols-2">

                <div>

                    <p class="mb-4 text-xs font-medium uppercase tracking-[0.35em] text-amber-400">
                        Stay Connected
                    </p>

                    <h2 class="max-w-xl text-3xl font-light tracking-tight sm:text-4xl lg:text-4xl">
                        Stay in the world of
                        <span class="font-bold italic text-[#BE8B3E]">
                            Bin Roshan.
                        </span>
                    </h2>

                    <p class="mt-5 max-w-lg text-sm leading-7 text-neutral-400">
                        Be the first to discover new arrivals, exclusive collections
                        and timeless pieces curated for your style.
                    </p>

                </div>


                <div class="lg:justify-self-end lg:w-full lg:max-w-xl">

                    <form
                        id="newsletter-form"
                        action="{{ route('newsletter.subscribe') }}"
                        method="POST">

                        @csrf

                        <div class="flex border-b border-white/30 pb-3 transition duration-300 focus-within:border-amber-400">

                            <input
                                id="newsletter-email"
                                type="email"
                                name="email"
                                required
                                placeholder="Enter your email address"
                                class="w-full bg-transparent px-0 text-sm text-white placeholder-neutral-500 outline-none">

                            <button
                                id="newsletter-submit"
                                type="submit"
                                class="ml-4 flex shrink-0 cursor-pointer items-center gap-2 text-sm font-medium text-[#BE8B3E] transition duration-300 hover:text-white">

                                <span id="newsletter-button-text">
                                    Subscribe
                                </span>

                                <span class="text-lg transition-transform duration-300 hover:translate-x-1">
                                    →
                                </span>

                            </button>

                        </div>

                        <p class="mt-3 text-[11px] text-[#BE8B3E]">
                            By subscribing, you agree to receive updates from Bin Roshan.
                        </p>

                        <p
                            id="newsletter-message"
                            class="mt-2 hidden text-sm">
                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         MAIN FOOTER
    ====================================================== -->

    <div class="mx-auto max-w-7xl px-5 py-10 lg:px-8 lg:py-12">

        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-12">


            <!-- BRAND -->

            <div class="lg:col-span-4">

                <a
                    href="{{ url('/') }}"
                    class="inline-block">

                    <img
                        src="{{ asset('images/logo/logo.png') }}"
                        alt="Bin Roshan"
                        class="h-25 w-auto brightness-0 invert">

                </a>

                <p class="mt-5 max-w-sm text-sm leading-7 text-neutral-400">
                    Premium fashion, elegant accessories and timeless pieces
                    carefully curated for modern style.
                </p>


                <!-- SOCIAL ICONS -->

                <div class="mt-6 flex items-center gap-3">

                    <!-- Instagram -->

                    <a
                        href="https://www.instagram.com/roshansons13d/"
                        target="_blank"
                        aria-label="Instagram"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-[#BE8B3E] text-[#BE8B3E] transition duration-300 hover:bg-[#BE8B3E] hover:text-white">

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24">

                            <rect
                                x="3"
                                y="3"
                                width="18"
                                height="18"
                                rx="5"/>

                            <circle
                                cx="12"
                                cy="12"
                                r="4"/>

                            <circle
                                cx="17.5"
                                cy="6.5"
                                r="0.8"
                                fill="currentColor"
                                stroke="none"/>

                        </svg>

                    </a>


                    <!-- Facebook -->

                    <a
                        href="https://www.facebook.com/roshansons13d"
                        target="_blank"
                        aria-label="Facebook"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-[#BE8B3E] text-[#BE8B3E] transition duration-300 hover:bg-[#BE8B3E] hover:text-white">

                        <svg
                            class="h-4 w-4"
                            fill="currentColor"
                            viewBox="0 0 24 24">

                            <path d="M14 8h3V4h-3c-2.76 0-5 2.24-5 5v3H6v4h3v8h4v-8h3l1-4h-4V9c0-.55.45-1 1-1Z"/>

                        </svg>

                    </a>


                    <!-- WhatsApp -->

                    <a
                        href="https://wa.me/{{ config('store.whatsapp') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="WhatsApp"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-[#BE8B3E] text-[#BE8B3E] transition duration-300 hover:bg-[#BE8B3E] hover:text-white">

                        <svg
                            class="h-4 w-4"
                            fill="currentColor"
                            viewBox="0 0 24 24">

                            <path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.5 0 .1 5.4.1 12c0 2.1.6 4.1 1.6 5.9L0 24l6.3-1.6a12 12 0 0 0 5.8 1.5h.1c6.6 0 11.9-5.4 11.9-12 0-3.2-1.3-6.2-3.6-8.4ZM12.1 21.8c-1.8 0-3.6-.5-5.1-1.4l-.4-.2-3.7 1 1-3.6-.2-.4a9.8 9.8 0 0 1-1.5-5.2c0-5.5 4.4-9.9 9.9-9.9 2.6 0 5.1 1 7 2.9a9.9 9.9 0 0 1 2.9 7c0 5.4-4.5 9.8-9.9 9.8Zm5.4-7.4c-.3-.2-1.8-.9-2.1-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.2-.2.2-.4.2-.7.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6.1-.1.3-.4.5-.5.2-.2.2-.3.3-.5.1-.2.1-.4 0-.5-.1-.2-.7-1.7-.9-2.3-.2-.6-.5-.5-.7-.5H7.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.2.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4Z"/>

                        </svg>

                    </a>

                </div>

            </div>


            <!-- SHOP -->

            <div class="lg:col-span-2">

                <h3 class="mb-5 text-xs font-semibold uppercase tracking-[0.25em] text-[#BE8B3E]">
                    Shop
                </h3>

                <nav class="space-y-3">

                    <a
                        href="{{ route('shop') }}"
                        class="group flex items-center text-sm text-neutral-400 transition duration-300 hover:text-[#BE8B3E]">

                        <span class="mr-0 w-0 overflow-hidden transition-all duration-300 group-hover:mr-2 group-hover:w-3">
                            →
                        </span>

                        All Products

                    </a>

                    <a
                        href="{{ route('categories') }}"
                        class="group flex items-center text-sm text-neutral-400 transition duration-300 hover:text-[#BE8B3E]">

                        <span class="mr-0 w-0 overflow-hidden transition-all duration-300 group-hover:mr-2 group-hover:w-3">
                            →
                        </span>

                        Categories

                    </a>

                    <a
                        href="{{ route('shop') }}"
                        class="group flex items-center text-sm text-neutral-400 transition duration-300 hover:text-[#BE8B3E]">

                        <span class="mr-0 w-0 overflow-hidden transition-all duration-300 group-hover:mr-2 group-hover:w-3">
                            →
                        </span>

                        New Arrivals

                    </a>

                </nav>

            </div>


            <!-- STORE -->

            <div class="lg:col-span-2">

                <h3 class="mb-5 text-xs font-semibold uppercase tracking-[0.25em] text-[#BE8B3E]">
                    Store
                </h3>

                <nav class="space-y-3">

                    <a
                        href="{{ route('about') }}"
                        class="group flex items-center text-sm text-neutral-400 transition duration-300 hover:text-[#BE8B3E]">

                        <span class="mr-0 w-0 overflow-hidden transition-all duration-300 group-hover:mr-2 group-hover:w-3">
                            →
                        </span>

                        About Us

                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="group flex items-center text-sm text-neutral-400 transition duration-300 hover:text-[#BE8B3E]">

                        <span class="mr-0 w-0 overflow-hidden transition-all duration-300 group-hover:mr-2 group-hover:w-3">
                            →
                        </span>

                        Contact

                    </a>

                </nav>

            </div>


            <!-- CONTACT -->

            <div class="lg:col-span-4">

                <h3 class="mb-5 text-xs font-semibold uppercase tracking-[0.25em] text-[#BE8B3E]">
                    Get In Touch
                </h3>

                <div class="space-y-4">

                    <a
                        href="https://wa.me/{{ config('store.whatsapp') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="group flex items-start gap-4">

                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-[#BE8B3E] text-amber-400 transition duration-300 group-hover:bg-[#BE8B3E] group-hover:text-white">

                            <svg
                                class="h-4 w-4"
                                fill="currentColor"
                                viewBox="0 0 24 24">

                                <path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.5 0 .1 5.4.1 12c0 2.1.6 4.1 1.6 5.9L0 24l6.3-1.6a12 12 0 0 0 5.8 1.5h.1c6.6 0 11.9-5.4 11.9-12 0-3.2-1.3-6.2-3.6-8.4ZM12.1 21.8c-1.8 0-3.6-.5-5.1-1.4l-.4-.2-3.7 1 1-3.6-.2-.4a9.8 9.8 0 0 1-1.5-5.2c0-5.5 4.4-9.9 9.9-9.9 2.6 0 5.1 1 7 2.9a9.9 9.9 0 0 1 2.9 7c0 5.4-4.5 9.8-9.9 9.8Zm5.4-7.4c-.3-.2-1.8-.9-2.1-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.2-.2.2-.4.2-.7.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6.1-.1.3-.4.5-.5.2-.2.2-.3.3-.5.1-.2.1-.4 0-.5-.1-.2-.7-1.7-.9-2.3-.2-.6-.5-.5-.7-.5H7.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.2.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4Z"/>

                            </svg>

                        </span>

                        <span>

                            <span class="block text-xs uppercase tracking-wider text-neutral-500">
                                WhatsApp
                            </span>

                            <span class="mt-1 block text-sm text-neutral-200 transition group-hover:text-amber-400">
                                Chat with our team →
                            </span>

                        </span>

                    </a>


                    <a
                        href="{{ route('contact') }}"
                        class="group inline-flex items-center text-sm text-neutral-400 transition duration-300 hover:text-white">

                        Contact our team

                        <span class="ml-2 transition-transform duration-300 group-hover:translate-x-1">
                            →
                        </span>

                    </a>

                </div>

            </div>

        </div>


        <!-- BOTTOM BAR -->

        <div class="mt-7 flex flex-col gap-4 border-t border-white/10 pt-6 text-center text-xs text-[#BE8B3E]">

            <p>
                © {{ date('Y') }} Bin Roshan. All rights reserved.
            </p>

        </div>

    </div>

</footer>

</body>

</html>