<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Bin Roshan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50">

    <div class="flex min-h-screen items-center justify-center px-4">

        <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow-lg">

            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900">
                    Bin Roshan
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Login to your account
                </p>
            </div>


            @if (session('success'))
                <div class="mb-5 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif


            @if ($errors->any())
                <div class="mb-5 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif


            <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">

                @csrf

                <div>
                    <label
                        for="email"
                        class="mb-2 block text-sm font-medium text-gray-700"
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
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900"
                    >
                </div>


                <div>
                    <label
                        for="password"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900"
                    >
                </div>


                <div class="flex items-center justify-between">

                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="rounded border-gray-300"
                        >

                        Remember me
                    </label>

                    <a
                        href="#"
                        class="text-sm font-medium text-gray-900 hover:underline"
                    >
                        Forgot password?
                    </a>

                </div>


                <button
                    type="submit"
                    class="w-full rounded-lg bg-gray-900 px-4 py-3 font-semibold text-white transition hover:bg-gray-800"
                >
                    Login
                </button>

            </form>


            <div class="mt-6 text-center text-sm text-gray-600">

                Don't have an account?

                <a
                    href="{{ route('register') }}"
                    class="font-semibold text-gray-900 hover:underline"
                >
                    Create Account
                </a>

            </div>

        </div>

    </div>

</body>
</html>