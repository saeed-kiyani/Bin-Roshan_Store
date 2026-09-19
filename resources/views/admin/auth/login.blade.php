<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Bin Roshan</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-[#f8f7f4] flex items-center justify-center px-4 relative overflow-hidden">

{{-- BACKGROUND VIDEO --}}

    <video
        autoplay
        muted
        loop
        playsinline
        class="fixed inset-0 w-full h-full object-cover -z-10">

        <source src="{{ asset('videos/admin-bg.mp4') }}" type="video/mp4">

    </video>

    {{-- DARK OVERLAY --}}

    <div class="fixed inset-0 bg-black/60 -z-10"></div>

    <div class="w-full max-w-md">


       {{-- BRAND --}}

<div class="h-32 flex items-center justify-center px-7">

    <a
        href="{{ route('admin.dashboard') }}"
        class="flex flex-col items-center justify-center">

        {{-- LOGO --}}

        <div class="w-25 h-25 flex items-center justify-center flex-shrink-0">
            <img
                src="{{ asset('images/logo/logo.png') }}"
                alt="Bin Ismail"
                class="w-full h-full object-contain">
        </div>

        {{-- BRAND TEXT --}}

        <div class="leading-none text-center -mt-1">

            <p class="text-[12px] font-bold uppercase tracking-[0.35em] text-[#BE8B3E]">
                Admin Panel
            </p>

        </div>

    </a>

</div>




        {{-- LOGIN CARD --}}

        <div class="bg-transparent border border-[#BE8B3E] rounded-xl p-8 sm:p-10">


            <div class="mb-8">

                <p class="text-[9px] uppercase tracking-[0.3em] text-[#BE8B3E] font-semibold">
                    Welcome Back
                </p>

                <h1 class="mt-3 text-2xl font-light text-white">
                    Administrator Login
                </h1>

                <p class="mt-2 text-xs text-gray-300">
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
                class="space-y-6">

                @csrf

                {{-- EMAIL --}}

<div>

    <label
        for="email"
        class="block mb-2 text-[9px] uppercase tracking-[0.25em] font-semibold text-gray-300">
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
        class="w-full border border-gray-200 rounded-full px-4 py-3 text-sm text-white outline-none placeholder:text-gray-400 focus:border-[#BE8B3E] focus:bg-transaprent transition"
        placeholder="admin@example.com">

</div>


{{-- PASSWORD --}}

<div>

    <label
        for="password"
        class="block mb-2 text-[9px] uppercase tracking-[0.25em] font-semibold text-gray-300">
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
            class="w-full border border-gray-200 rounded-full pl-11 pr-4 py-3 text-sm text-white outline-none placeholder:text-gray-400 focus:border-[#BE8B3E] focus:bg-transparent transition"
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
                        class="text-xs text-gray-500">
                        Remember me
                    </label>

                </div>



                {{-- LOGIN BUTTON --}}

                <button
                    type="submit"
                    class="w-full text-[#BE8B3E] border border-[#BE8B3E] rounded-full cursor-pointer py-4 text-[10px] uppercase tracking-[0.25em] font-semibold hover:bg-[#BE8B3E] hover:text-white transition">
                    Sign In
                </button>

            </form>


        </div>



        {{-- BACK TO STORE --}}

        <div class="text-center mt-7">

            <a
                href="{{ route('shop') }}"
                class="text-[9px] uppercase tracking-[0.25em] text-white hover:text-[#BE8B3E] transition">
                ← Back to Store
            </a>

        </div>


    </div>

    <script>
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

</body>

</html>