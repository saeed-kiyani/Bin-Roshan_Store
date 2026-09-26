<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Bin Roshan')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">

    <meta name="description" content="@yield('description', 'Bin Roshan — Premium fancy laces, clothing, jewelry, watches and accessories.')">

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

    <!-- =========================
         MOBILE MENU
    ========================== -->

    <div id="mobile-menu-overlay" class="fixed inset-0 z-[70] hidden bg-black/40" onclick="closeMobileMenu()"></div>

    <aside
        id="mobile-menu"
        class="fixed left-0 top-0 z-[80] flex h-full w-[85%] max-w-sm -translate-x-full flex-col bg-[#f8f7f4] transition-transform duration-300">

        <div class="flex h-20 items-center justify-between border-b border-neutral-200 px-6">

            <img
                src="{{ asset('images/logo/logo.png') }}"
                alt="Bin Ismail"
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

                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>


        <nav class="flex flex-col px-6 py-8">

            <a
                href="{{ route('home') }}"
                class="border-b border-neutral-200 py-5 hover:text-[#BE8B3E] text-lg">
                Home
            </a>

            <a
                href="{{ route('shop') }}"
                class="border-b border-neutral-200 py-5 hover:text-[#BE8B3E] text-lg">
                Shop
            </a>

            <a
                href="{{ route('categories') }}"
                class="border-b border-neutral-200 py-5 hover:text-[#BE8B3E] text-lg">
                Categories
            </a>

            <a
                href="{{ route('about') }}"
                class="border-b border-neutral-200 py-5 hover:text-[#BE8B3E] text-lg">
                About
            </a>

            <a href="{{ route('blog.index') }}"
               class="border-b border-neutral-200 py-5 hover:text-[#BE8B3E] text-lg">
               Blogs
            </a>

            <a
                href="{{ route('contact') }}"
                class="border-b border-neutral-200 py-5 hover:text-[#BE8B3E] text-lg">
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
                class="mt-3 block text-sm">
                Chat with us on WhatsApp →
            </a>

        </div>

    </aside>


    <!-- =========================
     SEARCH OVERLAY
========================== -->

<!-- =========================
     SEARCH OVERLAY
========================== -->

<div
    id="search-overlay"
    class="fixed inset-0 z-[99999] hidden bg-black/60"
    onclick="closeSearch()"
>

    <div
        class="mx-auto mt-20 w-[calc(100%-2rem)] max-w-3xl"
        onclick="event.stopPropagation()">

        <div class="overflow-hidden rounded-xl bg-transparent border border-[#BE8B3E] shadow-2xl">

            {{-- SEARCH FORM --}}
            <form
                id="global-search-form"
                method="GET"
                action="{{ route('shop') }}">

                <div class="flex items-center border-b border-[#BE8B3E] px-5">

                    {{-- Search Icon --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 text-[#BE8B3E] cursor-pointer"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"
                        />
                    </svg>

                    {{-- SEARCH INPUT --}}
                    <input
                        id="search-input"
                        type="text"
                        placeholder="Search products..."
                        class="h-16 flex-1 bg-transparent text-white px-4 text-base outline-none"
                        oninput="searchProducts(this.value)"
                        onkeydown="handleSearchKeydown(event)">

                    {{-- ESC --}}
                    <button
                        type="button"
                        onclick="closeSearch()"
                        class="ml-3 shrink-0 text-sm font-medium tracking-wider cursor-pointer text-[#BE8B3E] transition hover:text-white">
                        ESC
                    </button>

                </div>

            </form>


            {{-- SEARCH SUGGESTIONS --}}
            <div
                id="search-results"
                class="max-h-[65vh] overflow-y-auto">

                <div class="px-6 py-10 text-center">

                    <p class="text-sm text-neutral-500">
                        Search for products, categories or collections.
                    </p>

                    <p class="mt-2 text-xs text-neutral-400">
                        Start typing to see suggestions
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

    <!-- =========================
         CART OVERLAY
    ========================== -->

    <div
        id="cart-overlay"
        class="fixed inset-0 z-[90] hidden bg-black/40"
        onclick="closeCart()"></div>


    <!-- =========================
         CART DRAWER
    ========================== -->

    <aside
        id="cart-drawer"
        class="drawer-shadow fixed bg-[#f8f7f4] right-0 top-0 z-[100] flex h-full w-full max-w-md translate-x-full flex-col bg-[#f8f7f4] transition-transform duration-300">

        <!-- Cart Header -->

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
                class="flex h-10 w-10 items-center justify-center text-[#BE8B3E] cursor-pointer hover:text-black"
                aria-label="Close cart">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5">
                    
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18 18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>


        <!-- Cart Items -->

        <div
            id="cart-items"
            class="flex-1 overflow-y-auto px-6 py-6"></div>


        <!-- Cart Footer -->

        <div
            id="cart-footer"
            class="border-t border-neutral-200 p-6"></div>

    </aside>


    <!-- =========================
         PAGE CONTENT
    ========================== -->

    <main>
        @yield('content')
    </main>


    <!-- =========================
         FOOTER
    ========================== -->

    <footer class="bg-neutral-950 text-white">

    {{-- =========================================
         PREMIUM NEWSLETTER / BRAND CTA
    ========================================== --}}
    <div class="border-b border-white/10">

        <div class="mx-auto max-w-7xl px-5 py-10 lg:px-8 lg:py-12">

            <div class="grid items-center gap-10 lg:grid-cols-2">

                {{-- Heading --}}
                <div>

                    <p class="mb-4 text-xs font-medium uppercase tracking-[0.35em] text-amber-400">
                        Stay Connected
                    </p>

                    <h2 class="max-w-xl text-3xl font-light tracking-tight sm:text-4xl lg:text-4xl">
                        Stay in the world of
                        <span class="text-[#BE8B3E] font-bold italic">Bin Roshan.</span>
                    </h2>

                    <p class="mt-5 max-w-lg text-sm leading-7 text-neutral-400">
                        Be the first to discover new arrivals, exclusive collections
                        and timeless pieces curated for your style.
                    </p>

                </div>


                {{-- Newsletter --}}
                <div class="lg:justify-self-end lg:w-full lg:max-w-xl">

                    <form action="#" method="POST">

                        @csrf

                        <div class="flex border-b border-white/30 pb-3 transition duration-300 focus-within:border-amber-400">

                            <input
                                type="email"
                                name="email"
                                required
                                placeholder="Enter your email address"
                                class="w-full bg-transparent px-0 text-sm text-white placeholder-neutral-500 outline-none">

                            <button
                                type="submit"
                                class="ml-4 flex shrink-0 items-center gap-2 text-sm font-medium text-[#BE8B3E] transition duration-300 hover:text-white cursor-pointer">
                                Subscribe
                                <span class="text-lg transition-transform duration-300 hover:translate-x-1">
                                    →
                                </span>
                            </button>

                        </div>

                        <p class="mt-3 text-[11px] text-[#BE8B3E]">
                            By subscribing, you agree to receive updates from Bin Ismail.
                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================
         MAIN FOOTER
    ========================================== --}}
    <div class="mx-auto max-w-7xl px-5 py-10 lg:px-8 lg:py-12">

        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-12">


            {{-- =====================================
                 BRAND
            ====================================== --}}
            <div class="lg:col-span-4">

                <a href="{{ url('/') }}" class="inline-block">

                    <img
                        src="{{ asset('images/logo/logo.png') }}"
                        alt="Bin Ismail"
                        class="h-25 w-auto brightness-0 invert">

                </a>


                <p class="mt-5 max-w-sm text-sm leading-7 text-neutral-400">
                    Premium fashion, elegant accessories and timeless pieces
                    carefully curated for modern style.
                </p>


                {{-- Social Icons --}}
                <div class="mt-6 flex items-center gap-3">

                    {{-- Instagram --}}
                    <a
                        href="#"
                        aria-label="Instagram"
                        class="flex h-10 w-10 items-center justify-center border border-[#BE8B3E] text-[#BE8B3E] transition duration-300 hover:bg-[#BE8B3E] hover:text-white rounded-full">
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="5"/>
                            <circle cx="12" cy="12" r="4"/>
                            <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor" stroke="none"/>
                        </svg>
                    </a>


                    {{-- Facebook --}}
                    <a
                        href="#"
                        aria-label="Facebook"
                        class="flex h-10 w-10 items-center justify-center border border-[#BE8B3E] text-[#BE8B3E] transition duration-300 hover:bg-[#BE8B3E] hover:text-white rounded-full">
                        <svg
                            class="h-4 w-4"
                            fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M14 8h3V4h-3c-2.76 0-5 2.24-5 5v3H6v4h3v8h4v-8h3l1-4h-4V9c0-.55.45-1 1-1Z"/>
                        </svg>
                    </a>


                    {{-- WhatsApp --}}
                    <a
                        href="https://wa.me/{{ config('store.whatsapp') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="WhatsApp"
                        class="flex h-10 w-10 items-center justify-center border border-[#BE8B3E] text-[#BE8B3E] transition duration-300 hover:bg-[#BE8B3E] hover:text-white rounded-full">
                        <svg
                            class="h-4 w-4"
                            fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.5 0 .1 5.4.1 12c0 2.1.6 4.1 1.6 5.9L0 24l6.3-1.6a12 12 0 0 0 5.8 1.5h.1c6.6 0 11.9-5.4 11.9-12 0-3.2-1.3-6.2-3.6-8.4ZM12.1 21.8c-1.8 0-3.6-.5-5.1-1.4l-.4-.2-3.7 1 1-3.6-.2-.4a9.8 9.8 0 0 1-1.5-5.2c0-5.5 4.4-9.9 9.9-9.9 2.6 0 5.1 1 7 2.9a9.9 9.9 0 0 1 2.9 7c0 5.4-4.5 9.8-9.9 9.8Zm5.4-7.4c-.3-.2-1.8-.9-2.1-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.2-.2.2-.4.2-.7.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6.1-.1.3-.4.5-.5.2-.2.2-.3.3-.5.1-.2.1-.4 0-.5-.1-.2-.7-1.7-.9-2.3-.2-.6-.5-.5-.7-.5H7.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.2.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4Z"/>
                        </svg>
                    </a>

                </div>

            </div>


            {{-- =====================================
                 SHOP
            ====================================== --}}
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


            {{-- =====================================
                 COMPANY
            ====================================== --}}
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


            {{-- =====================================
                 CONTACT
            ====================================== --}}
            <div class="lg:col-span-4">

                <h3 class="mb-5 text-xs font-semibold uppercase tracking-[0.25em] text-[#BE8B3E]">
                    Get In Touch
                </h3>


                <div class="space-y-4">

                    {{-- WhatsApp --}}
                    <a
                        href="https://wa.me/{{ config('store.whatsapp') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="group flex items-start gap-4">

                        <span class="flex h-10 w-10 shrink-0 items-center justify-center border border-[#BE8B3E] text-amber-400 transition duration-300 group-hover:bg-[#BE8B3E] group-hover:text-white rounded-full">

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


                    {{-- Contact --}}
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

        {{-- =====================================
             BOTTOM BAR
        ====================================== --}}
        <div class="mt-7 flex flex-col gap-4 border-t border-white/10 pt-6 text-center text-xs text-[#BE8B3E]">

            <p>
                © {{ date('Y') }} Bin Roshan. All rights reserved.
            </p>

        </div>

    </div>

</footer>

    <!-- =========================
         JAVASCRIPT
    ========================== -->

    <script>

        /*
        |--------------------------------------------------------------------------
        | CART
        |--------------------------------------------------------------------------
        */

        let cart = JSON.parse(localStorage.getItem('bin_ismail_cart')) || [];


        function saveCart() {

            localStorage.setItem(
                'bin_ismail_cart',
                JSON.stringify(cart)
            );

            updateCartCount();

        }


        function updateCartCount() {

            const countElement = document.getElementById('cart-count');

            if (!countElement) {
                return;
            }

            const count = cart.reduce(
                (total, item) => total + item.quantity,
                0
            );

            countElement.textContent = count;

            if (count > 0) {

                countElement.classList.remove('hidden');
                countElement.classList.add('flex');

            } else {

                countElement.classList.add('hidden');
                countElement.classList.remove('flex');

            }

        }


        function addToCart(product) {

            const existing = cart.find(
                item => item.id == product.id
            );


            if (existing) {

                existing.quantity += 1;

            } else {

                cart.push({
                    id: product.id,
                    name: product.name,
                    price: Number(product.price),
                    image: product.image,
                    quantity: 1
                });

            }


            saveCart();

            renderCart();

            openCart();

        }


        function removeFromCart(id) {

            cart = cart.filter(
                item => item.id != id
            );

            saveCart();

            renderCart();

        }


        function increaseQuantity(id) {

            const item = cart.find(
                item => item.id == id
            );

            if (item) {

                item.quantity += 1;

            }

            saveCart();

            renderCart();

        }


        function decreaseQuantity(id) {

            const item = cart.find(
                item => item.id == id
            );

            if (!item) {
                return;
            }


            if (item.quantity > 1) {

                item.quantity -= 1;

            } else {

                removeFromCart(id);
                return;

            }


            saveCart();

            renderCart();

        }


        function getCartTotal() {

            return cart.reduce(
                (total, item) =>
                    total + (item.price * item.quantity),
                0
            );

        }


        function formatPrice(price) {

            return new Intl.NumberFormat('en-PK').format(price);

        }


        function renderCart() {

            const container =
                document.getElementById('cart-items');

            const footer =
                document.getElementById('cart-footer');


            if (!container || !footer) {
                return;
            }


            if (cart.length === 0) {

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
                            class="mt-6 border border-[#BE8B3E] rounded-full px-6 py-3 text-sm text-[#BE8B3E] transition hover:bg-[#BE8B3E] hover:text-white">
                            Continue Shopping
                        </a>

                    </div>
                `;


                footer.innerHTML = '';

                return;

            }


            container.innerHTML = cart.map(item => `

                <div class="mb-6 flex gap-4">

                    <img
                        src="${item.image}"
                        alt="${item.name}"
                        class="h-28 w-24 shrink-0 object-cover bg-neutral-100"
                    >

                    <div class="flex min-w-0 flex-1 flex-col">

                        <div class="flex justify-between gap-3">

                            <h3 class="truncate text-sm font-medium">
                                ${item.name}
                            </h3>

                            <button
                                type="button"
                                onclick="removeFromCart(${item.id})"
                                class="text-neutral-400 hover:text-black">
                                ×
                            </button>

                        </div>

                        <p class="mt-2 text-sm text-neutral-500">
                            Rs. ${formatPrice(item.price)}
                        </p>


                        <div class="mt-auto flex items-center justify-between">

                            <div class="flex items-center border border-neutral-300">

                                <button
                                    type="button"
                                    onclick="decreaseQuantity(${item.id})"
                                    class="flex h-8 w-8 items-center justify-center text-gray-600 hover:bg-[#BE8B3E] hover:text-white cursor-pointer">
                                    −
                                </button>

                                <span class="flex h-8 w-8 items-center justify-center border-x border-neutral-300 text-sm">
                                    ${item.quantity}
                                </span>

                                <button
                                    type="button"
                                    onclick="increaseQuantity(${item.id})"
                                    class="flex h-8 w-8 items-center justify-center text-gray-600 hover:bg-[#BE8B3E] hover:text-white cursor-pointer">
                                    +
                                </button>

                            </div>

                            <span class="text-sm font-medium">
                                Rs. ${formatPrice(item.price * item.quantity)}
                            </span>

                        </div>

                    </div>

                </div>

            `).join('');


            const total = getCartTotal();


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
                    class="w-full border border-[#BE8B3E] rounded-full bg-[#BE8B3E] py-4 text-sm font-medium text-white transition hover:bg-transparent hover:text-[#BE8B3E] cursor-pointer">
                    Order via WhatsApp
                </button>

            `;

        }


        function openCart() {

            renderCart();

            document
                .getElementById('cart-overlay')
                .classList.remove('hidden');

            document
                .getElementById('cart-drawer')
                .classList.remove('translate-x-full');

            document.body.classList.add('overflow-hidden');

        }


        function closeCart() {

            document
                .getElementById('cart-overlay')
                .classList.add('hidden');

            document
                .getElementById('cart-drawer')
                .classList.add('translate-x-full');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | WHATSAPP CHECKOUT
        |--------------------------------------------------------------------------
        */

        function checkoutWhatsApp() {

            if (cart.length === 0) {
                return;
            }


            let message =
                `Hello Bin Ismail,%0A%0AI would like to place an order:%0A%0A`;


            cart.forEach(item => {

                message +=
                    `• ${item.name} × ${item.quantity} — Rs. ${formatPrice(item.price * item.quantity)}%0A`;

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
        | MOBILE MENU
        |--------------------------------------------------------------------------
        */

        function openMobileMenu() {

            document
                .getElementById('mobile-menu-overlay')
                .classList.remove('hidden');

            document
                .getElementById('mobile-menu')
                .classList.remove('-translate-x-full');

            document.body.classList.add('overflow-hidden');

        }


        function closeMobileMenu() {

            document
                .getElementById('mobile-menu-overlay')
                .classList.add('hidden');

            document
                .getElementById('mobile-menu')
                .classList.add('-translate-x-full');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

         /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    let searchTimer = null;


    function openSearch() {

        const overlay = document.getElementById('search-overlay');
        const input = document.getElementById('search-input');

        if (!overlay || !input) {
            return;
        }

        overlay.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

        setTimeout(() => {

            input.focus();

        }, 100);

    }


    function closeSearch() {

        const overlay = document.getElementById('search-overlay');
        const input = document.getElementById('search-input');
        const results = document.getElementById('search-results');

        if (!overlay) {
            return;
        }

        overlay.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

        if (input) {
            input.value = '';
        }

        if (results) {

            results.innerHTML = `
                <div class="px-6 py-10 text-center">

                    <p class="text-sm text-neutral-500">
                        Search for products, categories or collections.
                    </p>

                    <p class="mt-2 text-xs text-neutral-400">
                        Start typing to see suggestions
                    </p>

                </div>
            `;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | LIVE PRODUCT SEARCH
    |--------------------------------------------------------------------------
    */

    /*
|--------------------------------------------------------------------------
| LIVE PRODUCT SEARCH SUGGESTIONS
|--------------------------------------------------------------------------
*/

let searchDebounceTimer = null;
let searchController = null;
let searchSequence = 0;

function searchProducts(value) {

    const input = document.getElementById('search-input');
    const results = document.getElementById('search-results');

    if (!input || !results) return;

    const query = value.trim();

    /*
    |--------------------------------------------------------------------------
    | Every new input gets a new sequence number.
    |--------------------------------------------------------------------------
    */

    const currentSequence = ++searchSequence;

    /*
    |--------------------------------------------------------------------------
    | Cancel previous debounce
    |--------------------------------------------------------------------------
    */

    clearTimeout(searchDebounceTimer);

    /*
    |--------------------------------------------------------------------------
    | Cancel previous HTTP request
    |--------------------------------------------------------------------------
    */

    if (searchController) {
        searchController.abort();
        searchController = null;
    }

    /*
    |--------------------------------------------------------------------------
    | Empty input
    |--------------------------------------------------------------------------
    */

    if (query === '') {

        results.innerHTML = `
            <div class="px-6 py-10 text-center text-sm text-neutral-500">
                Search for products, categories or collections.
            </div>
        `;

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Wait a little before sending request
    |--------------------------------------------------------------------------
    */

    searchDebounceTimer = setTimeout(async () => {

        /*
        | Make sure this is still the latest input.
        */

        if (currentSequence !== searchSequence) {
            return;
        }

        /*
        | Make sure input wasn't changed.
        */

        if (input.value.trim() !== query) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Loading
        |--------------------------------------------------------------------------
        */

        results.innerHTML = `
            <div class="px-6 py-8 text-center">
                <div class="inline-flex items-center gap-3 text-sm text-neutral-500">
                    <span class="h-4 w-4 animate-spin rounded-full border-2 border-neutral-300 border-t-[#BE8B3E]"></span>
                    Searching...
                </div>
            </div>
        `;

        /*
        |--------------------------------------------------------------------------
        | New AbortController
        |--------------------------------------------------------------------------
        */

        searchController = new AbortController();

        try {

            const response = await fetch(
                `/shop/search-suggestions?search=${encodeURIComponent(query)}`,
                {
                    method: 'GET',

                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },

                    signal: searchController.signal,

                    cache: 'no-store'
                }
            );

            if (!response.ok) {
                throw new Error(
                    `HTTP ${response.status}`
                );
            }

            const data = await response.json();

            /*
            |--------------------------------------------------------------------------
            | VERY IMPORTANT
            |--------------------------------------------------------------------------
            | Ignore response if user has typed something else.
            |--------------------------------------------------------------------------
            */

            if (currentSequence !== searchSequence) {
                return;
            }

            if (input.value.trim() !== query) {
                return;
            }

            const products = data.products || [];

            /*
            |--------------------------------------------------------------------------
            | No results
            |--------------------------------------------------------------------------
            */

            if (products.length === 0) {

                results.innerHTML = `
                    <div class="px-6 py-10 text-center">

                        <p class="text-sm text-neutral-500">
                            No products found for
                            <span class="font-medium text-neutral-700">
                                "${escapeSearchHtml(query)}"
                            </span>
                        </p>

                    </div>
                `;

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Render results
            |--------------------------------------------------------------------------
            */

            results.innerHTML = `
                <div class="divide-y divide-neutral-200">

                    ${products.map(product => `

                        <a
                            href="${product.url}"
                            class="group flex items-center gap-4 px-5 py-4 transition hover:bg-neutral-50"
                        >

                            <div class="h-16 w-14 shrink-0 overflow-hidden rounded-md bg-neutral-100">

                                ${
                                    product.image
                                    ? `
                                        <img
                                            src="${product.image}"
                                            alt="${escapeSearchHtml(product.name)}"
                                            class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                            loading="lazy"
                                        >
                                    `
                                    : `
                                        <div class="flex h-full w-full items-center justify-center text-neutral-400">
                                            No Image
                                        </div>
                                    `
                                }

                            </div>

                            <div class="min-w-0 flex-1">

                                <h3 class="truncate text-sm font-medium text-neutral-900 group-hover:text-[#BE8B3E]">
                                    ${escapeSearchHtml(product.name)}
                                </h3>

                                <p class="mt-1 text-sm text-neutral-500">
                                    Rs. ${formatPrice(product.price)}
                                </p>

                            </div>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0 text-neutral-400 transition group-hover:translate-x-1 group-hover:text-[#BE8B3E]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>

                        </a>

                    `).join('')}

                </div>

                <a
                    href="/shop?search=${encodeURIComponent(query)}"
                    class="flex items-center justify-center gap-2 border-t border-neutral-200 px-5 py-4 text-sm font-medium text-[#BE8B3E] hover:bg-neutral-50 hover:text-black"
                >
                    View all results for
                    "${escapeSearchHtml(query)}"

                    <span class="text-lg">
                        →
                    </span>
                </a>
            `;

        } catch (error) {

            /*
            | Aborted request is normal.
            */

            if (error.name === 'AbortError') {
                return;
            }

            console.error('Search error:', error);

            /*
            | Don't replace newer results with an old error.
            */

            if (currentSequence !== searchSequence) {
                return;
            }

            results.innerHTML = `
                <div class="px-6 py-10 text-center">
                    <p class="text-sm text-red-500">
                        Unable to load search suggestions.
                    </p>
                </div>
            `;
        }

    }, 180);
}


function escapeSearchHtml(value) {

    const div = document.createElement('div');

    div.textContent = value;

    return div.innerHTML;
}

/*
|--------------------------------------------------------------------------
| Escape HTML
|--------------------------------------------------------------------------
*/

function escapeSearchHtml(value) {

    const div = document.createElement('div');

    div.textContent = value;

    return div.innerHTML;
}

/*
|--------------------------------------------------------------------------
| Escape HTML
|--------------------------------------------------------------------------
*/

function escapeSearchHtml(value) {

    const div = document.createElement('div');

    div.textContent = value;

    return div.innerHTML;

}

    /*
    |--------------------------------------------------------------------------
    | SEARCH INPUT
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function () {

        const searchInput =
            document.getElementById('search-input');


        if (!searchInput) {
            return;
        }


        searchInput.addEventListener('input', function () {

            const query = this.value;


            clearTimeout(searchTimer);


            /*
            |--------------------------------------------------------------------------
            | Small delay prevents request on every keystroke
            |--------------------------------------------------------------------------
            */

            searchTimer = setTimeout(() => {

                searchProducts(query);

            }, 250);

        });

    });

    function handleSearchKeydown(event) {

    if (event.key !== 'Enter') {
        return;
    }

    event.preventDefault();

    const input = document.getElementById('search-input');

    if (!input) return;

    const query = input.value.trim();

    if (!query) return;

    window.location.href =
        `/shop?search=${encodeURIComponent(query)}`;
}

        /*
        |--------------------------------------------------------------------------
        | KEYBOARD
        |--------------------------------------------------------------------------
        */

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                closeSearch();
                closeCart();
                closeMobileMenu();

            }

        });


        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

        document.addEventListener('DOMContentLoaded', function() {

            updateCartCount();
            renderCart();

        });

    </script>

</body>
</html>