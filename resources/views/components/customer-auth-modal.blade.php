{{-- =====================================================
     CUSTOMER AUTH MODAL
====================================================== --}}

<div
    id="customer-auth-modal"
    class="fixed inset-0 z-[100] hidden"
    aria-hidden="true"
>

    {{-- BACKDROP --}}
    <div
        id="customer-auth-backdrop"
        class="absolute inset-0 bg-black/60 backdrop-blur-sm"
        onclick="closeCustomerAuthModal()">
    </div>


    {{-- MODAL WRAPPER --}}
    <div class="relative flex min-h-full items-center justify-center p-4">

        <div
    id="customer-auth-panel"
    class="relative w-full max-w-md rounded-2xl border border-[#BE8B3E] shadow-2xl">


            {{-- CLOSE --}}
            <button
                type="button"
                onclick="closeCustomerAuthModal()"
                class="absolute right-4 top-4 z-10 flex h-9 w-9 items-center justify-center rounded-full text-gray-500 transition hover:bg-gray-100 hover:text-black"
                aria-label="Close">
                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M6 6l12 12M18 6L6 18"
                        stroke-width="1.5"
                        stroke-linecap="round"/>
                </svg>
            </button>


            <div class="p-6 sm:p-8">

                {{-- LOGO --}}
        <div class="mb-4 text-center">
            <img
                src="{{ asset('images/logo/logo.png') }}"
                alt="Bin Ismail"
                class="mx-auto block h-12 sm:h-14 w-auto max-w-[130px]">

            <p
                id="customer-auth-subtitle"
                class="mt-1 text-sm text-[#BE8B3E]">
                Create an account to continue shopping
            </p>
        </div>


                {{-- TABS --}}
                <div class="mb-6 grid grid-cols-2 gap-1 rounded-full p-1">

    {{-- LOGIN TAB --}}
    <button
        type="button"
        id="customer-login-tab"
        onclick="showCustomerLogin()"
        class="rounded-full border border-[#BE8B3E] bg-transparent text-[#BE8B3E] px-4 py-2.5 text-sm font-semibold transition">
        Login
    </button>

    {{-- CREATE ACCOUNT TAB --}}
    <button
        type="button"
        id="customer-register-tab"
        onclick="showCustomerRegister()"
        class="rounded-full bg-[#BE8B3E] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition">
        Create Account
    </button>

</div>



                {{-- GENERAL MESSAGE --}}
                <div
                    id="customer-auth-message"
                    class="mb-5 hidden rounded-lg px-4 py-3 text-sm">
                </div>


                {{-- =================================================
                     LOGIN FORM
                ================================================== --}}

                <form
                    id="customer-login-form"
                    onsubmit="submitCustomerLogin(event)"
                    class="hidden space-y-3">

                    @csrf

                    <div>

                        <label
                            for="customer-login-email"
                            class="mb-1 block text-sm font-medium text-[#BE8B3E]">
                            Email Address
                        </label>

                        <input
                            id="customer-login-email"
                            type="email"
                            name="email"
                            placeholder="Enter Your Email..."
                            autocomplete="email"
                            required
                            class="w-full rounded-full text-white border border-[#BE8B3E] px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-login-email-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>

                    {{-- PASSWORD --}}

<div>

    <label
        for="password"
        class="mb-1 block text-sm font-medium text-[#BE8B3E]">
        Password
    </label>

    <div class="relative">

        {{-- EYE ICON --}}

        <button
            type="button"
            onclick="togglePassword()"
            class="absolute left-4 top-1/2 -translate-y-1/2 text-[#BE8B3E] hover:text-white transition"
            aria-label="Show password">

            {{-- Eye Open --}}
            <svg
                id="eye-open"
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

            </svg>


            {{-- Eye Closed --}}

            <svg
                id="eye-closed"
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 hidden"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.98 8.223A10.477 10.477 0 0 0 2.458 12C3.732 16.057 7.523 19 12 19c1.69 0 3.27-.399 4.674-1.106" />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6.228 6.228A10.451 10.451 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a10.45 10.45 0 0 1-4.113 5.208" />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 3l18 18" />

            </svg>

        </button>

        <input
            id="password"
            type="password"
            name="password"
            required
            autocomplete="current-password"
            class="w-full border border-[#BE8B3E] rounded-full pl-11 px-4 py-3 text-sm text-white outline-none placeholder:text-gray-400 focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E] transition"
            placeholder="••••••••">

    </div>

</div>

                {{-- REMEMBER --}}

                <div class="flex items-center gap-2">

                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        value="1"
                        class="w-4 h-4 accent-[#BE8B3E]">

                    <label
                        for="remember"
                        class="text-xs text-[#BE8B3E]">
                        Remember me
                    </label>

                </div>

                    <button
                        id="customer-login-button"
                        type="submit"
                        class="w-full rounded-full border border-[#BE8B3E] bg-[#BE8B3E] px-4 py-3.5 text-sm font-semibold uppercase tracking-widest text-white transition hover:bg-transparent hover:text-[#BE8B3E] cursor-pointer disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        Login
                    </button>

                </form>


                {{-- =================================================
                     REGISTER FORM
                ================================================== --}}

                <form
                    id="customer-register-form"
                    onsubmit="submitCustomerRegister(event)"
                    class="space-y-3"
                >

                    @csrf

                    <div>

                        <label
                            for="customer-register-name"
                            class="mb-1 block text-sm font-medium text-[#BE8B3E]">
                            Full Name
                        </label>

                        <input
                            id="customer-register-name"
                            type="text"
                            name="name"
                            autocomplete="name"
                            required
                            class="w-full rounded-full text-white border border-[#BE8B3E] px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-register-name-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <div>

                        <label
                            for="customer-register-email"
                            class="mb-1 block text-sm font-medium text-[#BE8B3E]">
                            Email Address
                        </label>

                        <input
                            id="customer-register-email"
                            type="email"
                            name="email"
                            autocomplete="email"
                            required
                            class="w-full rounded-full text-white border border-[#BE8B3E] px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-register-email-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <div>

                        <label
                            for="customer-register-password"
                            class="mb-1 block text-sm font-medium text-[#BE8B3E]">
                            Password
                        </label>

                        <input
                            id="customer-register-password"
                            type="password"
                            name="password"
                            autocomplete="new-password"
                            required
                            class="w-full rounded-full text-white border border-[#BE8B3E] px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-register-password-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <div>

                        <label
                            for="customer-register-password-confirmation"
                            class="mb-1 block text-sm font-medium text-[#BE8B3E]">
                            Confirm Password
                        </label>

                        <input
                            id="customer-register-password-confirmation"
                            type="password"
                            name="password_confirmation"
                            autocomplete="new-password"
                            required
                            class="w-full rounded-full text-white border border-[#BE8B3E] px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-register-password-confirmation-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <button
                        id="customer-register-button"
                        type="submit"
                        class="w-full rounded-full border border-[#BE8B3E] text-[#BE8B3E] px-4 py-3.5 text-sm font-semibold uppercase tracking-widest transition hover:bg-[#BE8B3E] hover:text-white cursor-pointer disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        Create Account
                    </button>

                </form>


                <p class="mt-6 text-center text-xs leading-5 text-[#BE8B3E]">
                    Login or create an account to add products to your bag.
                </p>

            </div>

        </div>

    </div>

</div>

<script>

    function showCustomerLogin() {

        const loginForm = document.getElementById('customer-login-form');
        const registerForm = document.getElementById('customer-register-form');

        const loginTab = document.getElementById('customer-login-tab');
        const registerTab = document.getElementById('customer-register-tab');

        const subtitle = document.getElementById('customer-auth-subtitle');

        // Forms
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');

        // Subtitle
        subtitle.textContent = 'Login to continue shopping';

        // Active Login
        loginTab.className =
            'rounded-full bg-[#BE8B3E] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition';

        // Inactive Create Account
        registerTab.className =
            'rounded-full border border-[#BE8B3E] bg-transparent px-4 py-2.5 text-sm font-semibold text-[#BE8B3E] transition';
    }


    function showCustomerRegister() {

        const loginForm = document.getElementById('customer-login-form');
        const registerForm = document.getElementById('customer-register-form');

        const loginTab = document.getElementById('customer-login-tab');
        const registerTab = document.getElementById('customer-register-tab');

        const subtitle = document.getElementById('customer-auth-subtitle');

        // Forms
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');

        // Subtitle
        subtitle.textContent = 'Create an account to continue shopping';

        // Inactive Login
        loginTab.className =
            'rounded-full border border-[#BE8B3E] bg-transparent px-4 py-2.5 text-sm font-semibold text-[#BE8B3E] transition';

        // Active Create Account
        registerTab.className =
            'rounded-full bg-[#BE8B3E] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition';
    }


    function togglePassword() {

        const password = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        if (password.type === 'password') {

            password.type = 'text';

            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');

        } else {

            password.type = 'password';

            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');

        }
    }

</script>


<style>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>
