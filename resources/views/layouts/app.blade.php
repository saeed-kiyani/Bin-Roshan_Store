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
     CUSTOMER AUTH MODAL
========================================================== -->

@include('components.customer-auth-modal')


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
                        href="#"
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
                        href="#"
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

<!-- =========================================================
     JAVASCRIPT
========================================================== -->

<script>

    /*
    |--------------------------------------------------------------------------
    | GLOBAL AUTH STATE
    |--------------------------------------------------------------------------
    */

    const isCustomerAuthenticated = @json(Auth::check());


    /*
    |--------------------------------------------------------------------------
    | CSRF HELPER
    |--------------------------------------------------------------------------
    */

    function getCsrfToken() {

        const meta = document.querySelector(
            'meta[name="csrf-token"]'
        );

        return meta
            ? meta.getAttribute('content')
            : '';

    }


    /*
    |--------------------------------------------------------------------------
    | BODY SCROLL LOCK
    |--------------------------------------------------------------------------
    |
    | Keeps the page locked while ANY overlay/modal is open.
    |
    */

    function syncBodyScrollLock() {

        const elements = [
            document.getElementById('mobile-menu-overlay'),
            document.getElementById('search-overlay'),
            document.getElementById('cart-overlay'),
            document.getElementById('customer-auth-modal')
        ];

        const anyOverlayOpen =
            elements.some(element => {

                return element &&
                    !element.classList.contains('hidden');

            });

        document.body.classList.toggle(
            'overflow-hidden',
            anyOverlayOpen
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CART STORAGE
    |--------------------------------------------------------------------------
    |
    | Cart expires after 72 hours.
    |
    */

    const CART_STORAGE_KEY =
        'bin_roshan_cart';

    const CART_TIMESTAMP_KEY =
        'bin_roshan_cart_updated_at';

    const CART_EXPIRY_MS =
        72 * 60 * 60 * 1000;


    function loadCart() {

        if (!isCustomerAuthenticated) {

            localStorage.removeItem(
                CART_STORAGE_KEY
            );

            localStorage.removeItem(
                CART_TIMESTAMP_KEY
            );

            return [];

        }


        try {

            const storedCart =
                localStorage.getItem(
                    CART_STORAGE_KEY
                );

            const storedTimestamp =
                localStorage.getItem(
                    CART_TIMESTAMP_KEY
                );


            /*
            |--------------------------------------------------------------------------
            | Existing cart without timestamp
            |--------------------------------------------------------------------------
            |
            | If an older cart exists from the previous
            | implementation, treat it as fresh once.
            |
            */

            if (
                storedCart &&
                !storedTimestamp
            ) {

                localStorage.setItem(
                    CART_TIMESTAMP_KEY,
                    String(Date.now())
                );

            }


            const timestamp =
                Number(
                    localStorage.getItem(
                        CART_TIMESTAMP_KEY
                    )
                );


            if (
                timestamp &&
                Date.now() - timestamp >
                    CART_EXPIRY_MS
            ) {

                localStorage.removeItem(
                    CART_STORAGE_KEY
                );

                localStorage.removeItem(
                    CART_TIMESTAMP_KEY
                );

                return [];

            }


            if (!storedCart) {
                return [];
            }


            const parsed =
                JSON.parse(storedCart);


            return Array.isArray(parsed)
                ? parsed
                : [];

        } catch (error) {

            console.error(
                'Cart loading error:',
                error
            );


            localStorage.removeItem(
                CART_STORAGE_KEY
            );

            localStorage.removeItem(
                CART_TIMESTAMP_KEY
            );


            return [];

        }

    }


    let cart =
        loadCart();


    /*
    |--------------------------------------------------------------------------
    | PENDING CART PRODUCT
    |--------------------------------------------------------------------------
    */

    let pendingCartProduct = null;


    /*
    |--------------------------------------------------------------------------
    | SAVE CART
    |--------------------------------------------------------------------------
    */

    function saveCart() {

        if (!isCustomerAuthenticated) {

            localStorage.removeItem(
                CART_STORAGE_KEY
            );

            localStorage.removeItem(
                CART_TIMESTAMP_KEY
            );

            cart = [];

            updateCartCount();

            return;

        }


        localStorage.setItem(
            CART_STORAGE_KEY,
            JSON.stringify(cart)
        );


        localStorage.setItem(
            CART_TIMESTAMP_KEY,
            String(Date.now())
        );


        updateCartCount();

    }


    /*
    |--------------------------------------------------------------------------
    | CART COUNT
    |--------------------------------------------------------------------------
    */

    function updateCartCount() {

        const countElement =
            document.getElementById(
                'cart-count'
            );

        const mobileCountElement =
            document.getElementById(
                'cart-count-mobile'
            );


        const count =
            isCustomerAuthenticated
                ? cart.reduce(
                    (total, item) =>
                        total +
                        Number(
                            item.quantity || 0
                        ),
                    0
                )
                : 0;


        [
            countElement,
            mobileCountElement
        ].forEach(element => {

            if (!element) {
                return;
            }


            element.textContent =
                count;


            if (count > 0) {

                element.classList.remove(
                    'hidden'
                );

                element.classList.add(
                    'flex'
                );

            } else {

                element.classList.add(
                    'hidden'
                );

                element.classList.remove(
                    'flex'
                );

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | ADD TO CART
    |--------------------------------------------------------------------------
    */

    function addToCart(product) {

        if (!product || !product.id) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Customer must be logged in before shopping.
        |--------------------------------------------------------------------------
        */

        if (!isCustomerAuthenticated) {

            pendingCartProduct =
                product;


            /*
            | Save product in sessionStorage as well.
            | This survives the page reload after login.
            */

            try {

                sessionStorage.setItem(
                    'bin_roshan_pending_cart_product',
                    JSON.stringify(product)
                );

                sessionStorage.setItem(
                    'bin_roshan_open_cart_after_auth',
                    '1'
                );

            } catch (error) {

                console.error(
                    'Unable to save pending cart product:',
                    error
                );

            }


            openCustomerAuthModal(
                'login'
            );

            return;

        }


        addProductToCart(
            product
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ADD PRODUCT DIRECTLY
    |--------------------------------------------------------------------------
    */

    function addProductToCart(product) {

        if (
            !product ||
            !product.id
        ) {
            return;
        }


        const existing =
            cart.find(
                item =>
                    item.id == product.id
            );


        if (existing) {

            existing.quantity =
                Number(
                    existing.quantity || 0
                ) + 1;

        } else {

            cart.push({

                id:
                    product.id,

                name:
                    product.name || '',

                price:
                    Number(
                        product.price || 0
                    ),

                image:
                    product.image || '',

                quantity:
                    1

            });

        }


        saveCart();

        renderCart();

        openCart();

    }


    /*
    |--------------------------------------------------------------------------
    | REMOVE FROM CART
    |--------------------------------------------------------------------------
    */

    function removeFromCart(id) {

        cart =
            cart.filter(
                item =>
                    item.id != id
            );


        saveCart();

        renderCart();

    }


    /*
    |--------------------------------------------------------------------------
    | INCREASE QUANTITY
    |--------------------------------------------------------------------------
    */

    function increaseQuantity(id) {

        const item =
            cart.find(
                item =>
                    item.id == id
            );


        if (!item) {
            return;
        }


        item.quantity =
            Number(
                item.quantity || 0
            ) + 1;


        saveCart();

        renderCart();

    }


    /*
    |--------------------------------------------------------------------------
    | DECREASE QUANTITY
    |--------------------------------------------------------------------------
    */

    function decreaseQuantity(id) {

        const item =
            cart.find(
                item =>
                    item.id == id
            );


        if (!item) {
            return;
        }


        const quantity =
            Number(
                item.quantity || 0
            );


        if (quantity > 1) {

            item.quantity =
                quantity - 1;

        } else {

            removeFromCart(id);

            return;

        }


        saveCart();

        renderCart();

    }


    /*
    |--------------------------------------------------------------------------
    | CART TOTAL
    |--------------------------------------------------------------------------
    */

    function getCartTotal() {

        return cart.reduce(
            (total, item) =>
                total +
                (
                    Number(
                        item.price || 0
                    ) *
                    Number(
                        item.quantity || 0
                    )
                ),
            0
        );

    }


    /*
    |--------------------------------------------------------------------------
    | PRICE FORMAT
    |--------------------------------------------------------------------------
    */

    function formatPrice(price) {

        return new Intl.NumberFormat(
            'en-PK'
        ).format(
            Number(price || 0)
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CART HTML ESCAPE
    |--------------------------------------------------------------------------
    */

    function escapeCartHtml(value) {

        const div =
            document.createElement(
                'div'
            );


        div.textContent =
            value == null
                ? ''
                : String(value);


        return div.innerHTML;

    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE URL HELPER
    |--------------------------------------------------------------------------
    |
    | Handles:
    | - Cloudinary absolute URLs
    | - https URLs
    | - /storage/... URLs
    | - relative image paths
    |
    */

    function resolveImageUrl(url) {

        if (!url) {
            return '';
        }


        const value =
            String(url).trim();


        if (!value) {
            return '';
        }


        if (
            /^(https?:|data:|blob:|\/\/)/i.test(
                value
            )
        ) {
            return value;
        }


        try {

            return new URL(
                value,
                window.location.origin
            ).href;

        } catch (error) {

            return value;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | RENDER CART
    |--------------------------------------------------------------------------
    */

    function renderCart() {

        const container =
            document.getElementById(
                'cart-items'
            );

        const footer =
            document.getElementById(
                'cart-footer'
            );


        if (
            !container ||
            !footer
        ) {
            return;
        }


        if (
            !isCustomerAuthenticated ||
            cart.length === 0
        ) {

            container.innerHTML = `

                <div class="flex h-full flex-col items-center justify-center text-center">

                    <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-neutral-100">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7 text-neutral-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.3">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 3h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 1.9-1.4L21 7H6"/>

                        </svg>

                    </div>

                    <h3 class="text-lg font-medium">
                        Your bag is empty
                    </h3>

                    <p class="mt-2 text-sm text-neutral-500">
                        Add something beautiful to your bag.
                    </p>

                    <a
                        href="{{ route('shop') }}"
                        onclick="closeCart()"
                        class="mt-6 rounded-full border border-[#BE8B3E] px-6 py-3 text-sm text-[#BE8B3E] transition hover:bg-[#BE8B3E] hover:text-white">

                        Continue Shopping

                    </a>

                </div>

            `;


            footer.innerHTML = '';

            return;

        }


        container.innerHTML =
            cart.map(item => {

                const imageUrl =
                    resolveImageUrl(
                        item.image || ''
                    );


                return `

                    <div class="mb-6 flex gap-4">

                        <div class="h-28 w-24 shrink-0 overflow-hidden bg-neutral-100">

                            ${
                                imageUrl
                                    ? `
                                        <img
                                            src="${escapeCartHtml(imageUrl)}"
                                            alt="${escapeCartHtml(item.name || '')}"
                                            class="h-full w-full object-cover"
                                            loading="lazy"
                                            onerror="this.style.display='none'">
                                      `
                                    : ''
                            }

                        </div>


                        <div class="flex min-w-0 flex-1 flex-col">

                            <div class="flex justify-between gap-3">

                                <h3 class="truncate text-sm font-medium">
                                    ${escapeCartHtml(item.name || '')}
                                </h3>

                                <button
                                    type="button"
                                    onclick="removeFromCart(${Number(item.id)})"
                                    class="text-neutral-400 hover:text-black">

                                    ×

                                </button>

                            </div>


                            <p class="mt-2 text-sm text-neutral-500">

                                Rs.
                                ${formatPrice(item.price)}

                            </p>


                            <div class="mt-auto flex items-center justify-between">

                                <div class="flex items-center border border-neutral-300">

                                    <button
                                        type="button"
                                        onclick="decreaseQuantity(${Number(item.id)})"
                                        class="flex h-8 w-8 cursor-pointer items-center justify-center text-gray-600 hover:bg-[#BE8B3E] hover:text-white">

                                        −

                                    </button>


                                    <span class="flex h-8 w-8 items-center justify-center border-x border-neutral-300 text-sm">

                                        ${Number(item.quantity || 0)}

                                    </span>


                                    <button
                                        type="button"
                                        onclick="increaseQuantity(${Number(item.id)})"
                                        class="flex h-8 w-8 cursor-pointer items-center justify-center text-gray-600 hover:bg-[#BE8B3E] hover:text-white">

                                        +

                                    </button>

                                </div>


                                <span class="text-sm font-medium">

                                    Rs.
                                    ${formatPrice(
                                        Number(item.price || 0) *
                                        Number(item.quantity || 0)
                                    )}

                                </span>

                            </div>

                        </div>

                    </div>

                `;

            }).join('');


        const total =
            getCartTotal();


        footer.innerHTML = `

            <div class="mb-5 flex items-center justify-between">

                <span class="text-sm text-neutral-500">
                    Subtotal
                </span>

                <span class="text-lg font-medium">
                    Rs. ${formatPrice(total)}
                </span>

            </div>


            <p class="mb-5 text-xs leading-5 text-neutral-600">

                Delivery charges will be confirmed when placing your order.

            </p>


            <button
                type="button"
                onclick="checkoutWhatsApp()"
                class="w-full cursor-pointer rounded-full border border-[#BE8B3E] bg-[#BE8B3E] py-4 text-sm font-medium text-white transition hover:bg-transparent hover:text-[#BE8B3E]">

                Order via WhatsApp

            </button>

        `;

    }


    /*
    |--------------------------------------------------------------------------
    | OPEN CART
    |--------------------------------------------------------------------------
    */

    function openCart() {

        if (!isCustomerAuthenticated) {

            /*
            | User clicked cart while logged out.
            | Remember that the cart should open after authentication.
            */

            try {

                sessionStorage.setItem(
                    'bin_roshan_open_cart_after_auth',
                    '1'
                );

            } catch (error) {

                console.error(
                    'Unable to save cart intent:',
                    error
                );

            }


            openCustomerAuthModal(
                'login'
            );

            return;

        }


        renderCart();


        const overlay =
            document.getElementById(
                'cart-overlay'
            );

        const drawer =
            document.getElementById(
                'cart-drawer'
            );


        if (
            !overlay ||
            !drawer
        ) {
            return;
        }


        overlay.classList.remove(
            'hidden'
        );

        drawer.classList.remove(
            'translate-x-full'
        );


        syncBodyScrollLock();

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE CART
    |--------------------------------------------------------------------------
    */

    function closeCart() {

        const overlay =
            document.getElementById(
                'cart-overlay'
            );

        const drawer =
            document.getElementById(
                'cart-drawer'
            );


        if (overlay) {

            overlay.classList.add(
                'hidden'
            );

        }


        if (drawer) {

            drawer.classList.add(
                'translate-x-full'
            );

        }


        syncBodyScrollLock();

    }


    /*
    |--------------------------------------------------------------------------
    | WHATSAPP CHECKOUT
    |--------------------------------------------------------------------------
    */

    function checkoutWhatsApp() {

        if (
            !isCustomerAuthenticated ||
            cart.length === 0
        ) {
            return;
        }


        let message =
            `Hello Bin Roshan,%0A%0AI would like to place an order:%0A%0A`;


        cart.forEach(item => {

            message +=
                `• ${encodeURIComponent(item.name)} × ${item.quantity} — Rs. ${formatPrice(item.price * item.quantity)}%0A`;

        });


        message +=
            `%0ATotal: Rs. ${formatPrice(getCartTotal())}`;


        const whatsappNumber =
            "{{ config('store.whatsapp') }}";


        window.open(
            `https://wa.me/${whatsappNumber}?text=${message}`,
            '_blank'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER AUTH MODAL
    |--------------------------------------------------------------------------
    */

    function openCustomerAuthModal(
        mode = 'login'
    ) {

        const modal =
            document.getElementById(
                'customer-auth-modal'
            );


        if (!modal) {
            return;
        }


        modal.classList.remove(
            'hidden'
        );


        modal.setAttribute(
            'aria-hidden',
            'false'
        );


        clearCustomerAuthErrors();


        if (
            mode === 'register'
        ) {

            showCustomerRegister();

        } else {

            showCustomerLogin();

        }


        syncBodyScrollLock();

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE AUTH MODAL
    |--------------------------------------------------------------------------
    */

    function closeCustomerAuthModal() {

        const modal =
            document.getElementById(
                'customer-auth-modal'
            );


        if (!modal) {
            return;
        }


        modal.classList.add(
            'hidden'
        );


        modal.setAttribute(
            'aria-hidden',
            'true'
        );


        clearCustomerAuthErrors();


        syncBodyScrollLock();

    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN TAB
    |--------------------------------------------------------------------------
    */

    function showCustomerLogin() {

        const loginForm =
            document.getElementById(
                'customer-login-form'
            );

        const registerForm =
            document.getElementById(
                'customer-register-form'
            );

        const loginTab =
            document.getElementById(
                'customer-login-tab'
            );

        const registerTab =
            document.getElementById(
                'customer-register-tab'
            );

        const subtitle =
            document.getElementById(
                'customer-auth-subtitle'
            );


        if (
            !loginForm ||
            !registerForm ||
            !loginTab ||
            !registerTab ||
            !subtitle
        ) {
            return;
        }


        loginForm.classList.remove(
            'hidden'
        );

        registerForm.classList.add(
            'hidden'
        );


        loginTab.classList.add(
            'bg-white',
            'text-gray-900',
            'shadow-sm'
        );

        loginTab.classList.remove(
            'text-gray-500'
        );


        registerTab.classList.remove(
            'bg-white',
            'text-gray-900',
            'shadow-sm'
        );

        registerTab.classList.add(
            'text-gray-500'
        );


        subtitle.textContent =
            'Login to continue shopping';


        clearCustomerAuthErrors();

    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER TAB
    |--------------------------------------------------------------------------
    */

    function showCustomerRegister() {

        const loginForm =
            document.getElementById(
                'customer-login-form'
            );

        const registerForm =
            document.getElementById(
                'customer-register-form'
            );

        const loginTab =
            document.getElementById(
                'customer-login-tab'
            );

        const registerTab =
            document.getElementById(
                'customer-register-tab'
            );

        const subtitle =
            document.getElementById(
                'customer-auth-subtitle'
            );


        if (
            !loginForm ||
            !registerForm ||
            !loginTab ||
            !registerTab ||
            !subtitle
        ) {
            return;
        }


        loginForm.classList.add(
            'hidden'
        );

        registerForm.classList.remove(
            'hidden'
        );


        registerTab.classList.add(
            'bg-white',
            'text-gray-900',
            'shadow-sm'
        );

        registerTab.classList.remove(
            'text-gray-500'
        );


        loginTab.classList.remove(
            'bg-white',
            'text-gray-900',
            'shadow-sm'
        );

        loginTab.classList.add(
            'text-gray-500'
        );


        subtitle.textContent =
            'Create an account to continue shopping';


        clearCustomerAuthErrors();

    }


    /*
    |--------------------------------------------------------------------------
    | CLEAR AUTH ERRORS
    |--------------------------------------------------------------------------
    */

    function clearCustomerAuthErrors() {

        document
            .querySelectorAll(
                '[id^="customer-login-"][id$="-error"], [id^="customer-register-"][id$="-error"]'
            )
            .forEach(element => {

                element.textContent = '';

                element.classList.add(
                    'hidden'
                );

            });


        const message =
            document.getElementById(
                'customer-auth-message'
            );


        if (message) {

            message.textContent = '';

            message.classList.add(
                'hidden'
            );

            message.classList.remove(
                'bg-red-50',
                'text-red-700',
                'bg-green-50',
                'text-green-700'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | AUTH MESSAGE
    |--------------------------------------------------------------------------
    */

    function showCustomerAuthMessage(
        message,
        type = 'error'
    ) {

        const element =
            document.getElementById(
                'customer-auth-message'
            );


        if (!element) {
            return;
        }


        element.textContent =
            message;


        element.classList.remove(
            'hidden',
            'bg-red-50',
            'text-red-700',
            'bg-green-50',
            'text-green-700'
        );


        if (
            type === 'success'
        ) {

            element.classList.add(
                'bg-green-50',
                'text-green-700'
            );

        } else {

            element.classList.add(
                'bg-red-50',
                'text-red-700'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | FIELD ERROR
    |--------------------------------------------------------------------------
    */

    function showCustomerFieldError(
        field,
        message
    ) {

        const element =
            document.getElementById(
                field
            );


        if (!element) {
            return;
        }


        element.textContent =
            message;


        element.classList.remove(
            'hidden'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | AUTH RESPONSE HANDLER
    |--------------------------------------------------------------------------
    */

    function processCustomerAuthResponse(
        response,
        data,
        prefix
    ) {

        if (!response.ok) {

            if (data.errors) {

                Object.entries(
                    data.errors
                ).forEach(
                    ([field, messages]) => {

                        showCustomerFieldError(
                            `${prefix}-${field}-error`,
                            Array.isArray(messages)
                                ? messages[0]
                                : messages
                        );

                    }
                );

            }


            showCustomerAuthMessage(
                data.message ||
                (
                    response.status === 419
                        ? 'Your session has expired. Please refresh the page and try again.'
                        : 'Please check your information and try again.'
                )
            );


            return false;

        }


        return true;

    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER LOGIN
    |--------------------------------------------------------------------------
    */

    async function submitCustomerLogin(
        event
    ) {

        event.preventDefault();

        clearCustomerAuthErrors();


        const form =
            document.getElementById(
                'customer-login-form'
            );

        const button =
            document.getElementById(
                'customer-login-button'
            );


        if (
            !form ||
            !button
        ) {
            return;
        }


        const formData =
            new FormData(form);


        button.disabled =
            true;

        button.textContent =
            'Logging in...';


        try {

            const response =
                await fetch(
                    "{{ route('login.submit') }}",
                    {
                        method: 'POST',

                        credentials:
                            'same-origin',

                        headers: {

                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest',

                            'X-CSRF-TOKEN':
                                getCsrfToken()

                        },

                        body:
                            formData

                    }
                );


            let data = {};


            try {

                data =
                    await response.json();

            } catch (jsonError) {

                data = {};

            }


            const success =
                processCustomerAuthResponse(
                    response,
                    data,
                    'customer-login'
                );


            if (!success) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | IMPORTANT:
            | Reload page after successful login.
            |
            | This updates:
            | - Laravel Auth::check()
            | - session cookie state
            | - CSRF token
            | - JavaScript auth state
            |--------------------------------------------------------------------------
            */

            showCustomerAuthMessage(
                data.message ||
                'Login successful!',
                'success'
            );


            handleCustomerAuthSuccess();

        } catch (error) {

            console.error(
                'Customer login error:',
                error
            );


            showCustomerAuthMessage(
                'Something went wrong. Please try again.'
            );

        } finally {

            button.disabled =
                false;

            button.textContent =
                'Login';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER REGISTER
    |--------------------------------------------------------------------------
    */

    async function submitCustomerRegister(
        event
    ) {

        event.preventDefault();

        clearCustomerAuthErrors();


        const form =
            document.getElementById(
                'customer-register-form'
            );

        const button =
            document.getElementById(
                'customer-register-button'
            );


        if (
            !form ||
            !button
        ) {
            return;
        }


        const formData =
            new FormData(form);


        button.disabled =
            true;

        button.textContent =
            'Creating Account...';


        try {

            const response =
                await fetch(
                    "{{ route('register.submit') }}",
                    {
                        method: 'POST',

                        credentials:
                            'same-origin',

                        headers: {

                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest',

                            'X-CSRF-TOKEN':
                                getCsrfToken()

                        },

                        body:
                            formData

                    }
                );


            let data = {};


            try {

                data =
                    await response.json();

            } catch (jsonError) {

                data = {};

            }


            const success =
                processCustomerAuthResponse(
                    response,
                    data,
                    'customer-register'
                );


            if (!success) {
                return;
            }


            showCustomerAuthMessage(
                data.message ||
                'Account created successfully!',
                'success'
            );


            handleCustomerAuthSuccess();

        } catch (error) {

            console.error(
                'Customer registration error:',
                error
            );


            showCustomerAuthMessage(
                'Something went wrong. Please try again.'
            );

        } finally {

            button.disabled =
                false;

            button.textContent =
                'Create Account';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | AUTH SUCCESS
    |--------------------------------------------------------------------------
    |
    | Instead of trying to continue the cart flow while the current page
    | still contains the old Auth::check() value, save the intent and reload.
    |
    */

    function handleCustomerAuthSuccess() {

        try {

            if (pendingCartProduct) {

                sessionStorage.setItem(
                    'bin_roshan_pending_cart_product',
                    JSON.stringify(
                        pendingCartProduct
                    )
                );


                sessionStorage.setItem(
                    'bin_roshan_open_cart_after_auth',
                    '1'
                );

            }

        } catch (error) {

            console.error(
                'Unable to preserve auth cart state:',
                error
            );

        }


        pendingCartProduct =
            null;


        closeCustomerAuthModal();


        /*
        |--------------------------------------------------------------------------
        | Reload the page so Auth::check() becomes true.
        |--------------------------------------------------------------------------
        */

        window.location.reload();

    }


    /*
    |--------------------------------------------------------------------------
    | RESTORE PENDING CART AFTER LOGIN
    |--------------------------------------------------------------------------
    */

    function restorePendingCartAfterAuth() {

        if (!isCustomerAuthenticated) {
            return;
        }


        let pendingProduct = null;

        let shouldOpenCart = false;


        try {

            const storedProduct =
                sessionStorage.getItem(
                    'bin_roshan_pending_cart_product'
                );


            const openCartIntent =
                sessionStorage.getItem(
                    'bin_roshan_open_cart_after_auth'
                );


            if (storedProduct) {

                pendingProduct =
                    JSON.parse(
                        storedProduct
                    );

            }


            shouldOpenCart =
                openCartIntent === '1';


            sessionStorage.removeItem(
                'bin_roshan_pending_cart_product'
            );

            sessionStorage.removeItem(
                'bin_roshan_open_cart_after_auth'
            );

        } catch (error) {

            console.error(
                'Unable to restore pending cart:',
                error
            );

        }


        if (
            pendingProduct &&
            pendingProduct.id
        ) {

            addProductToCart(
                pendingProduct
            );

            return;

        }


        if (shouldOpenCart) {

            renderCart();

            openCart();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE MENU
    |--------------------------------------------------------------------------
    */

    function openMobileMenu() {

        const overlay =
            document.getElementById(
                'mobile-menu-overlay'
            );

        const menu =
            document.getElementById(
                'mobile-menu'
            );


        if (
            !overlay ||
            !menu
        ) {
            return;
        }


        overlay.classList.remove(
            'hidden'
        );

        menu.classList.remove(
            '-translate-x-full'
        );


        syncBodyScrollLock();

    }


    function closeMobileMenu() {

        const overlay =
            document.getElementById(
                'mobile-menu-overlay'
            );

        const menu =
            document.getElementById(
                'mobile-menu'
            );


        if (overlay) {

            overlay.classList.add(
                'hidden'
            );

        }


        if (menu) {

            menu.classList.add(
                '-translate-x-full'
            );

        }


        syncBodyScrollLock();

    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    let searchDebounceTimer =
        null;

    let searchController =
        null;

    let searchSequence =
        0;


    /*
    |--------------------------------------------------------------------------
    | OPEN SEARCH
    |--------------------------------------------------------------------------
    */

    function openSearch() {

        const overlay =
            document.getElementById(
                'search-overlay'
            );

        const input =
            document.getElementById(
                'search-input'
            );


        if (
            !overlay ||
            !input
        ) {
            return;
        }


        overlay.classList.remove(
            'hidden'
        );


        syncBodyScrollLock();


        setTimeout(
            () => input.focus(),
            100
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE SEARCH
    |--------------------------------------------------------------------------
    */

    function closeSearch() {

        const overlay =
            document.getElementById(
                'search-overlay'
            );

        const input =
            document.getElementById(
                'search-input'
            );

        const results =
            document.getElementById(
                'search-results'
            );


        if (!overlay) {
            return;
        }


        overlay.classList.add(
            'hidden'
        );


        if (input) {

            input.value = '';

        }


        if (searchController) {

            searchController.abort();

            searchController =
                null;

        }


        clearTimeout(
            searchDebounceTimer
        );


        if (results) {

            results.innerHTML = `

                <div class="px-6 py-10 text-center">

                    <p class="text-sm text-neutral-300">
                        Search for products, categories or collections.
                    </p>

                    <p class="mt-2 text-xs text-white">
                        Start typing to see suggestions
                    </p>

                </div>

            `;

        }


        syncBodyScrollLock();

    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH HTML ESCAPE
    |--------------------------------------------------------------------------
    */

    function escapeSearchHtml(value) {

        const div =
            document.createElement(
                'div'
            );


        div.textContent =
            value == null
                ? ''
                : String(value);


        return div.innerHTML;

    }


    /*
    |--------------------------------------------------------------------------
    | LIVE PRODUCT SEARCH
    |--------------------------------------------------------------------------
    */

    function searchProducts(value) {

        const input =
            document.getElementById(
                'search-input'
            );

        const results =
            document.getElementById(
                'search-results'
            );


        if (
            !input ||
            !results
        ) {
            return;
        }


        const query =
            value.trim();


        const currentSequence =
            ++searchSequence;


        clearTimeout(
            searchDebounceTimer
        );


        if (searchController) {

            searchController.abort();

            searchController =
                null;

        }


        if (!query) {

            results.innerHTML = `

                <div class="px-6 py-10 text-center text-sm text-neutral-300">

                    Search for products, categories or collections.

                </div>

            `;

            return;

        }


        searchDebounceTimer =
            setTimeout(
                async () => {

                    if (
                        currentSequence !==
                        searchSequence
                    ) {
                        return;
                    }


                    if (
                        input.value.trim() !==
                        query
                    ) {
                        return;
                    }


                    results.innerHTML = `

                        <div class="px-6 py-8 text-center">

                            <div class="inline-flex items-center gap-3 text-sm text-white">

                                <span class="h-4 w-4 animate-spin rounded-full border-2 border-neutral-300 border-t-[#BE8B3E]"></span>

                                Searching...

                            </div>

                        </div>

                    `;


                    searchController =
                        new AbortController();


                    try {

                        const response =
                            await fetch(
                                `/shop/search-suggestions?search=${encodeURIComponent(query)}`,
                                {
                                    method: 'GET',

                                    credentials:
                                        'same-origin',

                                    headers: {

                                        'Accept':
                                            'application/json',

                                        'X-Requested-With':
                                            'XMLHttpRequest'

                                    },

                                    signal:
                                        searchController.signal,

                                    cache:
                                        'no-store'

                                }
                            );


                        if (!response.ok) {

                            throw new Error(
                                `HTTP ${response.status}`
                            );

                        }


                        const data =
                            await response.json();


                        if (
                            currentSequence !==
                            searchSequence
                        ) {
                            return;
                        }


                        if (
                            input.value.trim() !==
                            query
                        ) {
                            return;
                        }


                        const products =
                            Array.isArray(
                                data.products
                            )
                                ? data.products
                                : [];


                        if (
                            products.length === 0
                        ) {

                            results.innerHTML = `

                                <div class="px-6 py-10 text-center">

                                    <p class="text-sm text-white">

                                        No products found for

                                        <span class="font-medium text-[#BE8B3E]">
                                            "${escapeSearchHtml(query)}"
                                        </span>

                                    </p>

                                </div>

                            `;

                            return;

                        }


                        results.innerHTML = `

                            <div class="divide-y divide-neutral-200">

                                ${products.map(product => {

                                    const imageUrl =
                                        resolveImageUrl(
                                            product.image || ''
                                        );


                                    const productUrl =
                                        product.url || '#';


                                    return `

                                        <a
                                            href="${escapeSearchHtml(productUrl)}"
                                            class="group flex items-center gap-4 px-5 py-4 transition hover:bg-black/70">

                                            <div class="h-16 w-14 shrink-0 overflow-hidden rounded-md bg-neutral-100">

                                                ${
                                                    imageUrl
                                                        ? `
                                                            <img
                                                                src="${escapeSearchHtml(imageUrl)}"
                                                                alt="${escapeSearchHtml(product.name || '')}"
                                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                                                loading="lazy"
                                                                onerror="this.style.display='none'">
                                                          `
                                                        : `
                                                            <div class="flex h-full w-full items-center justify-center text-xs text-neutral-400">
                                                                No Image
                                                            </div>
                                                          `
                                                }

                                            </div>


                                            <div class="min-w-0 flex-1">

                                                <h3 class="truncate text-sm font-medium text-[#BE8B3E] group-hover:text-white">

                                                    ${escapeSearchHtml(product.name || '')}

                                                </h3>


                                                <p class="mt-1 text-sm text-neutral-500">

                                                    Rs.
                                                    ${formatPrice(product.price)}

                                                </p>

                                            </div>


                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 shrink-0 text-[#BE8B3E] transition group-hover:translate-x-1 group-hover:text-white"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M9 5l7 7-7 7"/>

                                            </svg>

                                        </a>

                                    `;

                                }).join('')}

                            </div>


                            <a
                                href="/shop?search=${encodeURIComponent(query)}"
                                class="flex items-center justify-center gap-2 border-t border-neutral-200 px-5 py-4 text-sm font-medium text-[#BE8B3E] hover:bg-[#BE8B3E] hover:text-white">

                                View all results for
                                "${escapeSearchHtml(query)}"

                                <span class="text-lg">
                                    →
                                </span>

                            </a>

                        `;


                    } catch (error) {

                        if (
                            error.name ===
                            'AbortError'
                        ) {
                            return;
                        }


                        console.error(
                            'Search error:',
                            error
                        );


                        if (
                            currentSequence !==
                            searchSequence
                        ) {
                            return;
                        }


                        results.innerHTML = `

                            <div class="px-6 py-10 text-center">

                                <p class="text-sm text-red-400">
                                    Unable to load search suggestions.
                                </p>

                            </div>

                        `;

                    }

                },
                250
            );

    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH KEYBOARD
    |--------------------------------------------------------------------------
    */

    function handleSearchKeydown(
        event
    ) {

        if (
            event.key !== 'Enter'
        ) {
            return;
        }


        event.preventDefault();


        const input =
            document.getElementById(
                'search-input'
            );


        if (!input) {
            return;
        }


        const query =
            input.value.trim();


        if (!query) {
            return;
        }


        window.location.href =
            `/shop?search=${encodeURIComponent(query)}`;

    }


    /*
    |--------------------------------------------------------------------------
    | KEYBOARD SHORTCUTS
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function(event) {

            if (
                event.key !==
                'Escape'
            ) {
                return;
            }


            closeSearch();

            closeCart();

            closeMobileMenu();

            closeCustomerAuthModal();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | NEWSLETTER
    |--------------------------------------------------------------------------
    */

    function initializeNewsletter() {

        const form =
            document.getElementById(
                'newsletter-form'
            );

        const emailInput =
            document.getElementById(
                'newsletter-email'
            );

        const submitButton =
            document.getElementById(
                'newsletter-submit'
            );

        const buttonText =
            document.getElementById(
                'newsletter-button-text'
            );

        const message =
            document.getElementById(
                'newsletter-message'
            );


        if (
            !form ||
            !emailInput ||
            !submitButton ||
            !buttonText ||
            !message
        ) {
            return;
        }


        form.addEventListener(
            'submit',
            async function(event) {

                event.preventDefault();


                message.textContent =
                    '';

                message.classList.add(
                    'hidden'
                );


                const formData =
                    new FormData(form);


                submitButton.disabled =
                    true;


                submitButton.classList.add(
                    'opacity-50',
                    'cursor-not-allowed'
                );


                buttonText.textContent =
                    'Subscribing...';


                try {

                    const response =
                        await fetch(
                            form.action,
                            {
                                method: 'POST',

                                credentials:
                                    'same-origin',

                                headers: {

                                    'Accept':
                                        'application/json',

                                    'X-Requested-With':
                                        'XMLHttpRequest',

                                    'X-CSRF-TOKEN':
                                        getCsrfToken()

                                },

                                body:
                                    formData

                            }
                        );


                    let data = {};


                    try {

                        data =
                            await response.json();

                    } catch (jsonError) {

                        data = {};

                    }


                    if (!response.ok) {

                        message.textContent =
                            data.message ||
                            (
                                response.status === 419
                                    ? 'Your session has expired. Please refresh the page and try again.'
                                    : 'Unable to subscribe. Please try again.'
                            );


                        message.classList.remove(
                            'hidden'
                        );

                        message.classList.remove(
                            'text-green-400'
                        );

                        message.classList.add(
                            'text-red-400'
                        );


                        return;

                    }


                    message.textContent =
                        data.message ||
                        'Subscribed successfully!';


                    message.classList.remove(
                        'hidden'
                    );


                    if (data.success) {

                        message.classList.remove(
                            'text-red-400',
                            'text-amber-400'
                        );

                        message.classList.add(
                            'text-green-400'
                        );


                        emailInput.value =
                            '';

                    } else {

                        message.classList.remove(
                            'text-green-400'
                        );

                        message.classList.add(
                            'text-amber-400'
                        );

                    }


                    setTimeout(
                        () => {

                            message.classList.add(
                                'hidden'
                            );

                            message.textContent =
                                '';

                        },
                        2000
                    );


                } catch (error) {

                    console.error(
                        'Newsletter subscription error:',
                        error
                    );


                    message.textContent =
                        'Something went wrong. Please try again.';


                    message.classList.remove(
                        'hidden'
                    );

                    message.classList.remove(
                        'text-green-400',
                        'text-amber-400'
                    );

                    message.classList.add(
                        'text-red-400'
                    );


                    setTimeout(
                        () => {

                            message.classList.add(
                                'hidden'
                            );

                            message.textContent =
                                '';

                        },
                        2000
                    );


                } finally {

                    submitButton.disabled =
                        false;


                    submitButton.classList.remove(
                        'opacity-50',
                        'cursor-not-allowed'
                    );


                    buttonText.textContent =
                        'Subscribe';

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'DOMContentLoaded',
        function() {

            updateCartCount();

            renderCart();

            initializeNewsletter();


            /*
            |--------------------------------------------------------------------------
            | Restore product/cart intent after successful login/register.
            |--------------------------------------------------------------------------
            */

            if (
                isCustomerAuthenticated
            ) {

                restorePendingCartAfterAuth();

            }

        }
    );

</script>

</body>

</html>