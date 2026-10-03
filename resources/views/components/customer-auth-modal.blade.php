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
            class="relative w-full max-w-md max-h-[90vh] overflow-y-auto rounded-2xl bg-white shadow-2xl"
        >

            {{-- CLOSE --}}
            <button
                type="button"
                onclick="closeCustomerAuthModal()"
                class="absolute right-4 top-4 z-10 flex h-9 w-9 items-center justify-center rounded-full text-gray-500 transition hover:bg-gray-100 hover:text-black"
                aria-label="Close"
            >
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

                {{-- BRAND --}}
                <div class="mb-6 text-center">

                    <h2 class="text-2xl font-semibold tracking-wide text-gray-900">
                        Bin Roshan
                    </h2>

                    <p
                        id="customer-auth-subtitle"
                        class="mt-2 text-sm text-gray-500">
                        Login to continue shopping
                    </p>

                </div>


                {{-- TABS --}}
                <div class="mb-6 grid grid-cols-2 rounded-full bg-gray-100 p-1">

                    <button
                        type="button"
                        id="customer-login-tab"
                        onclick="showCustomerLogin()"
                        class="rounded-full bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm transition">
                        Login
                    </button>

                    <button
                        type="button"
                        id="customer-register-tab"
                        onclick="showCustomerRegister()"
                        class="rounded-full px-4 py-2.5 text-sm font-semibold text-gray-500 transition">
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
                    class="space-y-5"
                >

                    @csrf

                    <div>

                        <label
                            for="customer-login-email"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Email Address
                        </label>

                        <input
                            id="customer-login-email"
                            type="email"
                            name="email"
                            autocomplete="email"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-login-email-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <div>

                        <label
                            for="customer-login-password"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Password
                        </label>

                        <input
                            id="customer-login-password"
                            type="password"
                            name="password"
                            autocomplete="current-password"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-login-password-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <label class="flex items-center gap-2 text-sm text-gray-600">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="rounded border-gray-300 text-[#BE8B3E] focus:ring-[#BE8B3E]"
                        >

                        Remember me

                    </label>


                    <button
                        id="customer-login-button"
                        type="submit"
                        class="w-full rounded-full bg-[#BE8B3E] px-4 py-3.5 text-sm font-semibold uppercase tracking-widest text-white transition hover:bg-black disabled:cursor-not-allowed disabled:opacity-60"
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
                    class="hidden space-y-5"
                >

                    @csrf

                    <div>

                        <label
                            for="customer-register-name"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Full Name
                        </label>

                        <input
                            id="customer-register-name"
                            type="text"
                            name="name"
                            autocomplete="name"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-register-name-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <div>

                        <label
                            for="customer-register-email"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Email Address
                        </label>

                        <input
                            id="customer-register-email"
                            type="email"
                            name="email"
                            autocomplete="email"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-register-email-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <div>

                        <label
                            for="customer-register-password"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Password
                        </label>

                        <input
                            id="customer-register-password"
                            type="password"
                            name="password"
                            autocomplete="new-password"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-register-password-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <div>

                        <label
                            for="customer-register-password-confirmation"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Confirm Password
                        </label>

                        <input
                            id="customer-register-password-confirmation"
                            type="password"
                            name="password_confirmation"
                            autocomplete="new-password"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-[#BE8B3E] focus:ring-1 focus:ring-[#BE8B3E]"
                        >

                        <p
                            id="customer-register-password-confirmation-error"
                            class="mt-1 hidden text-xs text-red-600">
                        </p>

                    </div>


                    <button
                        id="customer-register-button"
                        type="submit"
                        class="w-full rounded-full bg-[#BE8B3E] px-4 py-3.5 text-sm font-semibold uppercase tracking-widest text-white transition hover:bg-black disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        Create Account
                    </button>

                </form>


                <p class="mt-6 text-center text-xs leading-5 text-gray-500">
                    Login or create an account to add products to your bag.
                </p>

            </div>

        </div>

    </div>

</div>