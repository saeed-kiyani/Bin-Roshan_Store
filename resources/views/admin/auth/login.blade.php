<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Login | Bin Ismail</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-black flex items-center justify-center px-4">


    <div class="w-full max-w-md">


        {{-- BRAND --}}

        <div class="h-24 border-b border-white/10 flex items-center px-7 pt-2">

    <a
        href="{{ route('admin.dashboard') }}"
        class="flex items-center gap-4"
    >

        {{-- LOGO --}}

        <div class="w-11 h-11 border border-[#a47c15] flex items-center justify-center flex-shrink-0">

            <span class="text-[#a47c15] text-xl font-serif">
                B
            </span>

        </div>


        {{-- BRAND TEXT --}}

        <div class="leading-none">

            <p class="text-white text-lg font-light tracking-wide">
                Bin Ismail
            </p>

            <p class="mt-2 text-[8px] uppercase tracking-[0.35em] text-[#a47c15]">
                Admin Panel
            </p>

        </div>

    </a>

</div>




        {{-- LOGIN CARD --}}

        <div class="bg-white p-8 sm:p-10">


            <div class="mb-8">

                <p class="text-[9px] uppercase tracking-[0.3em] text-[#a47c15] font-semibold">
                    Welcome Back
                </p>

                <h1 class="mt-3 text-2xl font-light text-gray-900">
                    Administrator Login
                </h1>

                <p class="mt-2 text-xs text-gray-500">
                    Sign in to manage your store.
                </p>

            </div>



            {{-- SUCCESS MESSAGE --}}

            @if(session('success'))

                <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-xs">
                    {{ session('success') }}
                </div>

            @endif



            {{-- ERROR MESSAGE --}}

            @if(session('error'))

                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-xs">
                    {{ session('error') }}
                </div>

            @endif



            {{-- VALIDATION ERRORS --}}

            @if($errors->any())

                <div class="mb-5 bg-red-50 border border-red-200 px-4 py-3">

                    <ul class="space-y-1">

                        @foreach($errors->all() as $error)

                            <li class="text-xs text-red-600">
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- FORM --}}

            <form
                method="POST"
                action="{{ route('admin.login.submit') }}"
                class="space-y-6"
            >

                @csrf



                {{-- EMAIL --}}

                <div>

                    <label
                        for="email"
                        class="block mb-2 text-[9px] uppercase tracking-[0.25em] font-semibold text-gray-500"
                    >
                        Email Address
                    </label>


                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        class="w-full border border-gray-200 px-4 py-3 text-sm text-gray-900 outline-none focus:border-[#a47c15] transition"
                        placeholder="admin@example.com"
                    >

                </div>



                {{-- PASSWORD --}}

                <div>

                    <label
                        for="password"
                        class="block mb-2 text-[9px] uppercase tracking-[0.25em] font-semibold text-gray-500"
                    >
                        Password
                    </label>


                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full border border-gray-200 px-4 py-3 text-sm text-gray-900 outline-none focus:border-[#a47c15] transition"
                        placeholder="••••••••"
                    >

                </div>



                {{-- REMEMBER --}}

                <div class="flex items-center gap-2">

                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        value="1"
                        class="w-4 h-4 accent-[#a47c15]"
                    >

                    <label
                        for="remember"
                        class="text-xs text-gray-500"
                    >
                        Remember me
                    </label>

                </div>



                {{-- LOGIN BUTTON --}}

                <button
                    type="submit"
                    class="w-full bg-black text-white py-4 text-[10px] uppercase tracking-[0.25em] font-semibold hover:bg-[#a47c15] transition"
                >
                    Sign In
                </button>

            </form>


        </div>



        {{-- BACK TO STORE --}}

        <div class="text-center mt-7">

            <a
                href="{{ route('shop') }}"
                class="text-[9px] uppercase tracking-[0.25em] text-gray-500 hover:text-white transition"
            >
                ← Back to Store
            </a>

        </div>


    </div>


</body>

</html>