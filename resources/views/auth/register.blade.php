<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | Bin Roshan</title>

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
                    Create your customer account
                </p>

            </div>


            @if ($errors->any())
                <div class="mb-5 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form
                method="POST"
                action="{{ route('register.submit') }}"
                class="space-y-5"
            >

                @csrf


                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Full Name
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900"
                    >

                </div>


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
                        autocomplete="new-password"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900"
                    >

                </div>


                <div>

                    <label
                        for="password_confirmation"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Confirm Password
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900"
                    >

                </div>


                <button
                    type="submit"
                    class="w-full rounded-lg bg-gray-900 px-4 py-3 font-semibold text-white transition hover:bg-gray-800"
                >
                    Create Account
                </button>

            </form>


            <div class="mt-6 text-center text-sm text-gray-600">

                Already have an account?

                <a
                    href="{{ route('login') }}"
                    class="font-semibold text-gray-900 hover:underline"
                >
                    Login
                </a>

            </div>

        </div>

    </div>

</body>
</html>