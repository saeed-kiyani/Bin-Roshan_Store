<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Bin Ismail')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">

    <meta name="description" content="@yield('description', 'Bin Ismail — Premium fashion, clothing, jewelry, watches and accessories.')">

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
        class="fixed left-0 top-0 z-[80] flex h-full w-[85%] max-w-sm -translate-x-full flex-col bg-[#faf9f7] transition-transform duration-300"
    >

        <div class="flex h-20 items-center justify-between border-b border-neutral-200 px-6">

            <img
                src="{{ asset('images/logo/logo.png') }}"
                alt="Bin Ismail"
                class="h-11 w-auto"
            >

            <button
                type="button"
                onclick="closeMobileMenu()"
                class="flex h-10 w-10 items-center justify-center"
                aria-label="Close menu"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                >
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>


        <nav class="flex flex-col px-6 py-8">

            <a
                href="{{ route('home') }}"
                class="border-b border-neutral-200 py-5 text-lg"
            >
                Home
            </a>

            <a
                href="{{ route('shop') }}"
                class="border-b border-neutral-200 py-5 text-lg"
            >
                Shop
            </a>

            <a
                href="{{ route('categories') }}"
                class="border-b border-neutral-200 py-5 text-lg"
            >
                Categories
            </a>

            <a
                href="{{ route('about') }}"
                class="border-b border-neutral-200 py-5 text-lg"
            >
                About
            </a>

            <a
                href="{{ route('contact') }}"
                class="border-b border-neutral-200 py-5 text-lg"
            >
                Contact
            </a>

        </nav>


        <div class="mt-auto border-t border-neutral-200 p-6">

            <p class="text-xs uppercase tracking-[0.2em] text-neutral-500">
                Need help?
            </p>

            <a
                href="https://wa.me/{{ config('store.whatsapp') }}"
                target="_blank"
                class="mt-3 block text-sm"
            >
                Chat with us on WhatsApp →
            </a>

        </div>

    </aside>


    <!-- =========================
         SEARCH OVERLAY
    ========================== -->

    <div
        id="search-overlay"
        class="fixed inset-0 z-[100] hidden bg-black/50"
        onclick="closeSearch()"
    >

        <div
            class="mx-auto mt-24 w-[calc(100%-2rem)] max-w-3xl"
            onclick="event.stopPropagation()"
        >

            <div class="overflow-hidden bg-[#faf9f7] shadow-2xl">

                <div class="flex items-center border-b border-neutral-200 px-5">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-neutral-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"/>
                    </svg>

                    <input
                        id="search-input"
                        type="text"
                        placeholder="Search products..."
                        class="h-16 flex-1 bg-transparent px-4 text-base outline-none"
                        oninput="searchProducts(this.value)"
                    >

                    <button
                        type="button"
                        onclick="closeSearch()"
                        class="text-sm text-neutral-500 hover:text-black"
                    >
                        ESC
                    </button>

                </div>


                <div id="search-results" class="max-h-[60vh] overflow-y-auto">

                    <div class="px-6 py-10 text-center text-sm text-neutral-500">
                        Search for products, categories or collections.
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
        onclick="closeCart()"
    ></div>


    <!-- =========================
         CART DRAWER
    ========================== -->

    <aside
        id="cart-drawer"
        class="drawer-shadow fixed right-0 top-0 z-[100] flex h-full w-full max-w-md translate-x-full flex-col bg-[#faf9f7] transition-transform duration-300"
    >

        <!-- Cart Header -->

        <div class="flex h-20 items-center justify-between border-b border-neutral-200 px-6">

            <div>

                <p class="text-xs uppercase tracking-[0.2em] text-neutral-500">
                    Your
                </p>

                <h2 class="text-xl font-medium">
                    Shopping Bag
                </h2>

            </div>


            <button
                type="button"
                onclick="closeCart()"
                class="flex h-10 w-10 items-center justify-center"
                aria-label="Close cart"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                >
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18 18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>


        <!-- Cart Items -->

        <div
            id="cart-items"
            class="flex-1 overflow-y-auto px-6 py-6"
        ></div>


        <!-- Cart Footer -->

        <div
            id="cart-footer"
            class="border-t border-neutral-200 bg-[#faf9f7] p-6"
        ></div>

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

    <footer class="border-t border-neutral-200 bg-white">

        <div class="mx-auto max-w-7xl px-5 py-14 lg:px-8">

            <div class="grid gap-10 md:grid-cols-4">

                <div>

                    <img
                        src="{{ asset('images/logo/logo.png') }}"
                        alt="Bin Ismail"
                        class="mb-5 h-12 w-auto"
                    >

                    <p class="max-w-xs text-sm leading-7 text-neutral-500">
                        Premium fashion, accessories and timeless pieces
                        curated for modern style.
                    </p>

                </div>


                <div>

                    <h3 class="mb-5 text-sm font-medium uppercase tracking-wider">
                        Shop
                    </h3>

                    <div class="space-y-3 text-sm text-neutral-500">

                        <a href="{{ route('shop') }}" class="block hover:text-black">
                            All Products
                        </a>

                        <a href="{{ route('categories') }}" class="block hover:text-black">
                            Categories
                        </a>

                        <a href="{{ route('shop') }}" class="block hover:text-black">
                            New Arrivals
                        </a>

                    </div>

                </div>


                <div>

                    <h3 class="mb-5 text-sm font-medium uppercase tracking-wider">
                        Company
                    </h3>

                    <div class="space-y-3 text-sm text-neutral-500">

                        <a href="{{ route('about') }}" class="block hover:text-black">
                            About Us
                        </a>

                        <a href="{{ route('contact') }}" class="block hover:text-black">
                            Contact
                        </a>

                    </div>

                </div>


                <div>

                    <h3 class="mb-5 text-sm font-medium uppercase tracking-wider">
                        Contact
                    </h3>

                    <a
                        href="https://wa.me/{{ config('store.whatsapp') }}"
                        target="_blank"
                        class="text-sm text-neutral-500 hover:text-black"
                    >
                        WhatsApp →
                    </a>

                </div>

            </div>


            <div class="mt-12 border-t border-neutral-200 pt-6 text-xs text-neutral-500">

                © {{ date('Y') }} Bin Ismail. All rights reserved.

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
                                class="h-7 w-7 text-neutral-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.3"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 3h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 1.9-1.4L21 7H6"
                                />
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
                            class="mt-6 bg-black px-6 py-3 text-sm text-white transition hover:bg-neutral-800"
                        >
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
                                class="text-neutral-400 hover:text-black"
                            >
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
                                    class="flex h-8 w-8 items-center justify-center hover:bg-neutral-100"
                                >
                                    −
                                </button>

                                <span class="flex h-8 w-8 items-center justify-center border-x border-neutral-300 text-sm">
                                    ${item.quantity}
                                </span>

                                <button
                                    type="button"
                                    onclick="increaseQuantity(${item.id})"
                                    class="flex h-8 w-8 items-center justify-center hover:bg-neutral-100"
                                >
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


                <p class="mb-5 text-xs leading-5 text-neutral-500">
                    Delivery charges will be confirmed when placing your order.
                </p>


                <button
                    type="button"
                    onclick="checkoutWhatsApp()"
                    class="w-full bg-black py-4 text-sm font-medium text-white transition hover:bg-neutral-800"
                >
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

        function openSearch() {

            document
                .getElementById('search-overlay')
                .classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

            setTimeout(() => {

                document
                    .getElementById('search-input')
                    .focus();

            }, 100);

        }


        function closeSearch() {

            document
                .getElementById('search-overlay')
                .classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | PRODUCT SEARCH
        |--------------------------------------------------------------------------
        |
        | For now this uses products supplied by the current page.
        | Later we will connect this to Laravel/database search.
        |
        */

        function searchProducts(query) {

            const results =
                document.getElementById('search-results');


            if (!query.trim()) {

                results.innerHTML = `
                    <div class="px-6 py-10 text-center text-sm text-neutral-500">
                        Search for products, categories or collections.
                    </div>
                `;

                return;

            }


            const products =
                window.binIsmailProducts || [];


            const filtered =
                products.filter(product =>
                    product.name
                        .toLowerCase()
                        .includes(query.toLowerCase())
                );


            if (filtered.length === 0) {

                results.innerHTML = `
                    <div class="px-6 py-10 text-center">

                        <p class="text-sm text-neutral-500">
                            No products found for "${query}".
                        </p>

                    </div>
                `;

                return;

            }


            results.innerHTML = filtered.map(product => `

                <a
                    href="${product.url}"
                    class="flex gap-4 border-b border-neutral-200 p-5 transition hover:bg-neutral-100"
                >

                    <img
                        src="${product.image}"
                        alt="${product.name}"
                        class="h-20 w-16 object-cover bg-neutral-100"
                    >

                    <div>

                        <h3 class="text-sm font-medium">
                            ${product.name}
                        </h3>

                        <p class="mt-2 text-sm text-neutral-500">
                            Rs. ${formatPrice(product.price)}
                        </p>

                    </div>

                </a>

            `).join('');

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