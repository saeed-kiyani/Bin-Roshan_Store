<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Panel | Bin Roshan')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-[#f8f7f4] text-gray-900 antialiased">

    {{-- =====================================================
        MOBILE OVERLAY
    ====================================================== --}}

    <div id="admin-overlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden"></div>

    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}

    <aside id="admin-sidebar" class="fixed bg-gray-200 inset-y-0 left-0 z-50 w-65 bg-black text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300">

        {{-- LOGO / BRAND --}}

        <div class="h-20 border-b border-white/10 flex items-center px-7">

            <a href="{{ route('admin.dashboard') }}" class="flex items-center">

                <div class="w-25 h-25 flex items-center justify-center">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Bin Roshan" class="h-16 lg:h-35 w-auto object-contain">
                </div>

                <div>
                    <p class="text-black text-lg font-light tracking-wide">
                        Bin Roshan
                    </p>
                    <p class="text-[8px] uppercase tracking-[0.35em] text-[#BE8B3E]">
                        Admin Panel
                    </p>
                </div>
            </a>
        </div>

        {{-- NAVIGATION --}}

        <nav class="px-4 py-7">

            <p class="px-3 mb-3 text-[9px] uppercase tracking-[0.35em] text-black font-semibold">
                Main Menu
            </p>

            {{-- DASHBOARD --}}

            <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-4 px-4 py-3.5 mb-1 text-sm transition
                {{ request()->routeIs('admin.dashboard')
                    ? 'bg-[#BE8B3E] rounded-lg text-white'
                    : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
                <svg
                    class="w-5 h-5 flex-shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 13h8V3H3v10zm10 8h8V11h-8v10zM3 21h8v-4H3v4zm10-10h8V3h-8v8z"/>
                </svg>

                <span>
                    Dashboard
                </span>
            </a>

            {{-- PRODUCTS --}}

            <a href="{{ route('admin.products.index') }}" 
               class="group flex items-center gap-4 px-4 py-3.5 mb-1 text-sm [#BE8B3E] rounded-lg transition
                    {{ request()->routeIs('admin.products.*')
                    ? 'bg-[#BE8B3E] text-white'
                    : 'text-[#BE8B3E] hover:bg-[#BE8B3E] hover:text-white' }}">

                <svg
                    class="w-5 h-5 flex-shrink-0 transition"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m-8-4l8 4m0 0v10"/>
                </svg>

                <span>
                    Products
                </span>

            </a>

            {{-- CATEGORIES --}}

            <a href="{{ route('admin.categories.index') }}"
               class="group flex items-center gap-4 px-4 py-3.5 mb-1 text-sm border border-[#BE8B3E] rounded-lg transition
               {{ request()->routeIs('admin.categories.*')
                   ? 'bg-[#BE8B3E] text-white'
                   : 'text-[#BE8B3E] hover:bg-[#BE8B3E] hover:text-white' }}">

                <svg
                    class="w-5 h-5 flex-shrink-0 transition"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 5h6v6H4V5zm10 0h6v6h-6V5zM4 15h6v6H4v-6zm10 0h6v6h-6v-6z"/>
                </svg>

                <span>
                    Categories
                </span>

            </a>

            {{-- DIVIDER --}}

            <div class="my-7 border-t border-[#BE8B3E]"></div>

            <p class="px-3 mb-3 text-[9px] uppercase tracking-[0.35em] text-black font-semibold">
                Store
            </p>

            {{-- VIEW STORE --}}

            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center border border-[#BE8B3E] rounded-lg bg-[#BE8B3E] gap-4 px-4 py-3.5 text-sm text-white hover:bg-white/5 hover:text-[#BE8B3E] transition">

                <svg
                    class="w-5 h-5 flex-shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M2.5 12s3.5-5 9.5-5 9.5 5 9.5 5-3.5 5-9.5 5-9.5-5-9.5-5z"/>

                <circle
                    cx="12"
                    cy="12"
                    r="2.5"/>
                </svg>

                <span>
                    View Store
                </span>

                <svg
                    class="w-3.5 h-3.5 ml-auto opacity-50"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M7 17L17 7M8 7h9v9"/>
                </svg>

            </a>

        </nav>

    </aside>

    {{-- =====================================================
        MAIN AREA
    ====================================================== --}}

    <div class="lg:ml-72 min-h-screen">

        {{-- =================================================
            ADMIN HEADER
        ================================================== --}}

        <header class="h-20 bg-white border-b border-[#BE8B3E] sticky top-0 z-30">

            <div class="h-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">

                {{-- MOBILE MENU BUTTON --}}

                <button
                    id="admin-menu-button"
                    type="button"
                    class="lg:hidden w-10 h-10 border border-gray-300 text-gray-300 rounded-full flex items-center justify-center hover:border-[#BE8B3E] hover:bg-[#BE8B3E] hover:text-gray-300 transition"
                    aria-label="Open menu">

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                </button>

                {{-- PAGE LABEL --}}

                <div class="hidden sm:block">

                    <p class="text-[9px] uppercase tracking-[0.3em] text-[#a47c15] font-semibold">
                        Bin Roshan
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Store Administration
                    </p>

                </div>

                {{-- HEADER RIGHT --}}

                <div class="flex items-center gap-3 ml-auto">

                    {{-- VIEW STORE --}}

                    <a href="{{ route('shop') }}" target="_blank"
                       class="hidden sm:inline-flex items-center gap-2 border border-[#BE8B3E] rounded-full px-4 py-2.5 text-[9px] uppercase tracking-widest font-semibold text-[#BE8B3E] hover:bg-[#BE8B3E] hover:text-gray-200 transition">

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.5 12s3.5-5 9.5-5 9.5 5 9.5 5-3.5 5-9.5 5-9.5-5-9.5-5z"/>
                            <circle
                                cx="12"
                                cy="12"
                                r="2.5"/>
                        </svg>
                        View Store
                    </a>

                    {{-- ADMIN PROFILE --}}

<div class="flex items-center gap-3">

    <form method="POST" action="{{ route('admin.logout') }}">

                @csrf

        <button type="submit"
                class="w-10 h-10 border border-[#BE8B3E] cursor-pointer rounded-full flex items-center justify-center text-[#BE8B3E] hover:bg-[#BE8B3E] hover:text-white transition" title="Logout">

            <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 5H5a2 2 0 00-2 2v10a2 2 0 002 2h4"/>

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16 17l5-5-5-5"/>

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 12H9"/>

            </svg>

        </button>

    </form>

</div>

</header>

        {{-- =================================================
            PAGE CONTENT
        ================================================== --}}

        <main>

            @yield('content')

        </main>


    </div>



    {{-- =====================================================
        MOBILE SIDEBAR SCRIPT
    ====================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const sidebar = document.getElementById('admin-sidebar');

            const overlay = document.getElementById('admin-overlay');

            const menuButton = document.getElementById('admin-menu-button');


            function openSidebar() {

                sidebar.classList.remove('-translate-x-full');

                overlay.classList.remove('hidden');

                document.body.classList.add('overflow-hidden');

            }


            function closeSidebar() {

                sidebar.classList.add('-translate-x-full');

                overlay.classList.add('hidden');

                document.body.classList.remove('overflow-hidden');

            }


            if (menuButton) {

                menuButton.addEventListener('click', openSidebar);

            }


            if (overlay) {

                overlay.addEventListener('click', closeSidebar);

            }


            document.querySelectorAll('#admin-sidebar a').forEach(function (link) {

                link.addEventListener('click', function () {

                    if (window.innerWidth < 1024) {

                        closeSidebar();

                    }

                });

            });

        });

    </script>

</body>

</html>