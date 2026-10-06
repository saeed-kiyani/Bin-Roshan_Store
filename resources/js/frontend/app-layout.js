/*
|--------------------------------------------------------------------------
| GLOBAL AUTH STATE
|--------------------------------------------------------------------------
|
| Customer authentication is kept for the account/login system only.
| Cart and shopping do NOT require authentication.
|
*/

const isCustomerAuthenticated =
    document.querySelector(
        'meta[name="customer-authenticated"]'
    )?.getAttribute('content') === '1';


/*
|--------------------------------------------------------------------------
| CSRF HELPER
|--------------------------------------------------------------------------
*/

function getCsrfToken() {

    const meta =
        document.querySelector(
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


/*
|--------------------------------------------------------------------------
| LOAD CART
|--------------------------------------------------------------------------
|
| IMPORTANT:
| Cart is available to both logged-in and guest visitors.
|
*/

function loadCart() {

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
        | If an older cart exists from the previous implementation,
        | treat it as fresh once.
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


        /*
        |--------------------------------------------------------------------------
        | CART EXPIRY
        |--------------------------------------------------------------------------
        */

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
| SAVE CART
|--------------------------------------------------------------------------
|
| Cart is saved for ALL visitors.
|
*/

function saveCart() {

    try {

        localStorage.setItem(
            CART_STORAGE_KEY,
            JSON.stringify(cart)
        );


        localStorage.setItem(
            CART_TIMESTAMP_KEY,
            String(Date.now())
        );

    } catch (error) {

        console.error(
            'Cart saving error:',
            error
        );

    }


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


    /*
    |--------------------------------------------------------------------------
    | No authentication requirement.
    |--------------------------------------------------------------------------
    */

    const count =
        cart.reduce(
            (total, item) =>
                total +
                Number(
                    item.quantity || 0
                ),
            0
        );


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
|
| IMPORTANT:
| No login/register validation here.
| Guest users can directly add products.
|
*/

function addToCart(product) {

    if (
        !product ||
        !product.id
    ) {
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


    /*
    |--------------------------------------------------------------------------
    | Guest users can see their cart.
    |--------------------------------------------------------------------------
    */

    if (
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
|
| IMPORTANT:
| No login/register validation.
|
*/

function openCart() {

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
|
| Guest users can order via WhatsApp.
|
*/

function checkoutWhatsApp() {

    if (
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
|
| These functions remain available for the account/login system.
| They are NO LONGER connected to cart/add-to-bag.
|
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
| Cart no longer depends on authentication.
| Therefore there is NO pending-cart restoration here.
|
*/

function handleCustomerAuthSuccess() {

    closeCustomerAuthModal();


    /*
    |--------------------------------------------------------------------------
    | Reload page so Laravel Auth state is refreshed.
    |--------------------------------------------------------------------------
    */

    window.location.reload();

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

    }
);


/*
|--------------------------------------------------------------------------
| EXPOSE FUNCTIONS GLOBALLY
|--------------------------------------------------------------------------
|
| Required by Blade inline onclick handlers and other frontend scripts.
|
*/

Object.assign(window, {

    getCsrfToken,

    syncBodyScrollLock,

    loadCart,

    saveCart,

    updateCartCount,

    addToCart,

    addProductToCart,

    removeFromCart,

    increaseQuantity,

    decreaseQuantity,

    getCartTotal,

    formatPrice,

    escapeCartHtml,

    resolveImageUrl,

    renderCart,

    openCart,

    closeCart,

    checkoutWhatsApp,

    openCustomerAuthModal,

    closeCustomerAuthModal,

    showCustomerLogin,

    showCustomerRegister,

    clearCustomerAuthErrors,

    showCustomerAuthMessage,

    showCustomerFieldError,

    processCustomerAuthResponse,

    submitCustomerLogin,

    submitCustomerRegister,

    handleCustomerAuthSuccess,

    openMobileMenu,

    closeMobileMenu,

    openSearch,

    closeSearch,

    escapeSearchHtml,

    searchProducts,

    handleSearchKeydown,

    initializeNewsletter

});