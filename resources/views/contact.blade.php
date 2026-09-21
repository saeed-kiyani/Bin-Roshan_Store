@extends('layouts.app')

@section('title', 'Contact Us | Bin Roshan')

@section('description', 'Contact Bin Roshan for products, orders, availability and customer support.')

@section('content')

{{-- =========================================================
     HERO
========================================================= --}}

<section class="relative min-h-[60vh] sm:min-h-[70vh] flex items-center overflow-hidden">

    {{-- =====================================================
         TRANSPARENT NAVIGATION
    ====================================================== --}}
    <header class="absolute top-0 left-0 right-0 z-40">

        <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-12">

            <nav class="h-24 flex items-center justify-between">

                {{-- LEFT SIDE --}}

                <div class="hidden lg:flex items-center gap-10 flex-1">

                    <a
                        href="{{ route('home') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Home
                    </a>

                    <a
                        href="{{ route('shop') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Shop
                    </a>

                    <a
                        href="{{ route('categories') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Categories
                    </a>

                </div>


                {{-- =================================================
                     CENTER LOGO
                ================================================== --}}

                <a
                    href="{{ route('home') }}"
                    class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 -mt-2">

                    <img
                        src="{{ asset('images/logo/logo.png') }}"
                        alt="Bin Ismail"
                        class="h-14 sm:h-16 lg:h-35 max-w-[150px] sm:max-w-none w-auto object-contain">

                </a>


                {{-- RIGHT SIDE --}}

                <div class="hidden lg:flex items-center justify-end gap-10 flex-1">

                    <a
                        href="{{ route('about') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        About
                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="text-sm text-white uppercase tracking-[0.18em] hover:text-[#BE8B3E] transition">
                        Contact
                    </a>


                    {{-- SEARCH --}}

                    <button
                        type="button"
                        onclick="openSearch()"
                        aria-label="Search"
                        class="text-white hover:text-[#BE8B3E] transition cursor-pointer">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                                stroke-width="1.7"/>

                            <path
                                d="m20 20-4-4"
                                stroke-width="1.7"
                                stroke-linecap="round"/>

                        </svg>

                    </button>


                    {{-- CART --}}

                    <button
                        type="button"
                        onclick="openCart()"
                        aria-label="Shopping bag"
                        class="relative text-white hover:text-[#BE8B3E] transition cursor-pointer">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                d="M6 8h12l1 13H5L6 8Z"
                                stroke-width="1.5"
                                stroke-linejoin="round"/>

                            <path
                                d="M9 8V6a3 3 0 0 1 6 0v2"
                                stroke-width="1.5"
                                stroke-linecap="round"/>

                        </svg>


                        {{-- CART COUNT --}}

                        <span
                            id="cart-count"
                            class="absolute -top-2 -right-3 min-w-[17px] h-[17px] px-1 rounded-full bg-white text-black text-[9px] flex items-center justify-center font-semibold">
                            0
                        </span>

                    </button>

                </div>


                {{-- =================================================
                     MOBILE MENU BUTTON
                ================================================== --}}

                <button
                    type="button"
                    onclick="openMobileMenu()"
                    class="lg:hidden text-white shrink-0"
                    aria-label="Open menu">

                    <svg
                        class="w-7 h-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            d="M4 7h16M4 12h16M4 17h16"
                            stroke-width="1.5"
                            stroke-linecap="round"/>

                    </svg>

                </button>


                {{-- MOBILE CART --}}

                <button
                    type="button"
                    onclick="openCart()"
                    class="lg:hidden relative text-white shrink-0"
                    aria-label="Shopping bag">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            d="M6 8h12l1 13H5L6 8Z"
                            stroke-width="1.5"
                            stroke-linejoin="round"/>

                        <path
                            d="M9 8V6a3 3 0 0 1 6 0v2"
                            stroke-width="1.5"
                            stroke-linecap="round"/>

                    </svg>

                    <span
                        id="cart-count-mobile"
                        class="absolute -top-2 -right-3 min-w-[17px] h-[17px] px-1 rounded-full bg-white text-black text-[9px] flex items-center justify-center font-semibold">
                        0
                    </span>

                </button>

            </nav>

        </div>

    </header>


    <img
        src="{{ asset('images/banners/BinRoshanfashioncollection.jpeg') }}"
        alt="Bin Roshan fashion collection"
        class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/55"></div>

    <div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">

            <p class="text-xs uppercase tracking-[0.45em] text-white/70">
                Our Concierge
            </p>

        <h1 class="mt-7 text-4xl sm:text-6xl lg:text-8xl font-light leading-tight">
            We’re Here To <span class="text-[#BE8B3E] font-serif italic">Help</span>
        </h1>

        <p class="mt-5 sm:mt-8 max-w-2xl mx-auto text-sm sm:text-base text-white/80 leading-6 sm:leading-8">
            Whether you're looking for a specific product, need more information, or simply want to say hello, we'd love to hear from you.
        </p>

    </div>

</section>



{{-- =========================================================
     CONTACT CONTENT
========================================================= --}}

<section class="py-16 sm:py-20 lg:py-28 bg-[#f8f7f4]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-5 gap-10 sm:gap-12 lg:gap-20">


            {{-- =================================================
                 CONTACT INFORMATION
            ================================================= --}}

            <div class="lg:col-span-2">

                <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
                    Bin Roshan
                </p>

                <h2 class="mt-4 sm:mt-5 text-3xl sm:text-4xl font-light leading-tight">
                    We'd Love To Hear From You.
                </h2>

                <p class="mt-5 sm:mt-6 text-sm sm:text-base text-gray-600 leading-7 sm:leading-8">
                    Reach out to us for product information,
                    availability, orders or general enquiries.
                </p>


                <div class="mt-8 sm:mt-10 space-y-6 sm:space-y-7">


                    {{-- WhatsApp --}}

                    <div class="flex gap-3 sm:gap-4">

                        <div class="w-11 h-11 border border-[#BE8B3E] rounded-full flex items-center justify-center flex-shrink-0">

                            <svg
                                class="w-5 h-5 text-[#BE8B3E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M21 11.5a8.38 8.38 0 0 1-9 8.3 8.6 8.6 0 0 1-3.9-.9L3 20l1.2-4.8a8.3 8.3 0 1 1 16.8-3.7Z"/>

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs uppercase tracking-widest text-gray-400">
                                WhatsApp
                            </p>

                            <a
                                href="https://wa.me/{{ config('store.whatsapp') }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-1 block text-sm hover:text-[#BE8B3E] transition">
                                Chat with us
                            </a>

                        </div>

                    </div>


                    {{-- Phone --}}

                    <div class="flex gap-3 sm:gap-4">

                        <div class="w-11 h-11 border border-[#BE8B3E] rounded-full flex items-center justify-center flex-shrink-0">

                            <svg
                                class="w-5 h-5 text-[#BE8B3E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.968-.852-1.09l-4.423-.991a1.125 1.125 0 0 0-1.173.417l-.97 1.293a1.125 1.125 0 0 1-1.21.38 12.04 12.04 0 0 1-7.23-7.23 1.125 1.125 0 0 1 .38-1.21l1.293-.97c.37-.278.53-.757.417-1.173L7.02 3.102A1.125 1.125 0 0 0 5.93 2.25H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs uppercase tracking-widest text-gray-400">
                                Phone
                            </p>

                            <p class="mt-1 text-sm break-words">
                                +92 312 1353516
                            </p>

                        </div>

                    </div>


                    {{-- Email --}}

                    <div class="flex gap-3 sm:gap-4">

                        <div class="w-11 h-11 border border-[#BE8B3E] rounded-full flex items-center justify-center flex-shrink-0">

                            <svg
                                class="w-5 h-5 text-[#BE8B3E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M3 5.5h18v13H3z"/>

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="m3 6 9 7 9-7"/>

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs uppercase tracking-widest text-gray-400">
                                Email
                            </p>

                            <p class="mt-1 text-sm break-all">
                                info@binismail.com
                            </p>

                        </div>

                    </div>


                    {{-- Business Hours --}}

                    <div class="flex gap-3 sm:gap-4">

                        <div class="w-11 h-11 border border-[#BE8B3E] rounded-full flex items-center justify-center flex-shrink-0">

                            <svg
                                class="w-5 h-5 text-[#BE8B3E]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                    stroke-width="1.5"/>

                                <path
                                    stroke-linecap="round"
                                    stroke-width="1.5"
                                    d="M12 7v5l3 2"/>

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs uppercase tracking-widest text-gray-400">
                                Business Hours
                            </p>

                            <p class="mt-1 text-sm">
                                Monday — Saturday
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                10:00 AM — 9:00 PM
                            </p>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 CONTACT FORM
            ================================================= --}}

            <div class="lg:col-span-3">

                <div class="border border-gray-200 p-5 sm:p-7 lg:p-10 rounded-lg">

                    <div class="mb-7 sm:mb-8">

                        <h2 class="text-xl sm:text-2xl font-light">
                            Send us a message
                        </h2>

                        <p class="mt-2 text-sm text-[#BE8B3E]">
                            We'll get back to you as soon as possible.
                        </p>

                    </div>


                    <form
                        action="#"
                        method="POST"
                        onsubmit="return showContactMessage(event)"
                        class="space-y-5 sm:space-y-6">

                        @csrf


                        {{-- Name --}}

                        <div>

                            <label
                                for="name"
                                class="block text-xs uppercase tracking-widest font-semibold">
                                Your Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                required
                                placeholder="Enter your name"
                                class="mt-3 w-full border border-gray-300 px-4 py-3.5 sm:py-4 rounded-lg text-sm outline-none focus:border-[#BE8B3E] transition">

                        </div>


                        {{-- Email --}}

                        <div>

                            <label
                                for="email"
                                class="block text-xs uppercase tracking-widest font-semibold">
                                Email Address
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                required
                                placeholder="you@example.com"
                                class="mt-3 w-full border border-gray-300 rounded-lg px-4 py-3.5 sm:py-4 text-sm outline-none focus:border-[#BE8B3E] transition">

                        </div>


                        {{-- Phone --}}

                        <div>

                            <label
                                for="phone"
                                class="block text-xs uppercase tracking-widest font-semibold">
                                Phone / WhatsApp
                            </label>

                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                placeholder="+92"
                                class="mt-3 w-full border border-gray-300 rounded-lg px-4 py-3.5 sm:py-4 text-sm outline-none focus:border-[#BE8B3E] transition">

                        </div>


                        {{-- Subject --}}

                        <div>

                            <label
                                for="subject"
                                class="block text-xs uppercase tracking-widest font-semibold">
                                Subject
                            </label>

                            <select
                                id="subject"
                                name="subject"
                                class="mt-3 w-full border border-gray-300 rounded-lg px-4 py-3.5 sm:py-4 text-sm outline-none focus:border-[#BE8B3E] transition bg-transparent">

                                <option>Product Inquiry</option>
                                <option>Order Inquiry</option>
                                <option>Availability</option>
                                <option>General Question</option>

                            </select>

                        </div>


                        {{-- Message --}}

                        <div>

                            <label
                                for="message"
                                class="block text-xs uppercase tracking-widest font-semibold">
                                Message
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                required
                                placeholder="How can we help?"
                                class="mt-3 w-full border border-gray-300 rounded-lg px-4 py-3.5 sm:py-4 text-sm outline-none focus:border-[#BE8B3E] transition resize-none"></textarea>

                        </div>


                        {{-- Submit --}}

                        <button
                            type="submit"
                            class="w-full bg-transparent text-[#BE8B3E] border border-[#BE8B3E] rounded-full cursor-pointer py-4 sm:py-5 text-sm font-semibold uppercase tracking-widest hover:bg-[#BE8B3E] hover:text-white transition">
                            Send Message
                        </button>


                        <p
                            id="contact-success"
                            class="hidden text-center text-sm text-green-700 bg-green-50 p-4"
                        >
                            Thank you! Your message has been prepared.
                        </p>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     WHATSAPP SECTION
========================================================= --}}

<section class="bg-black text-white py-16 sm:py-20">

    <div class="max-w-4xl mx-auto px-4 text-center">

        <p class="text-xs uppercase tracking-[0.35em] sm:tracking-[0.4em] text-[#BE8B3E]">
            Prefer WhatsApp?
        </p>

        <h2 class="mt-4 sm:mt-5 text-3xl sm:text-5xl font-light leading-tight">
            Talk To Us <span class="italic text-[#BE8B3E]">Directly.</span>
        </h2>

        <p class="mt-5 text-sm sm:text-base text-gray-400 leading-6 sm:leading-7">
            For the fastest response, send us a message on WhatsApp.
        </p>

        <a
            href="https://wa.me/{{ config('store.whatsapp') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex w-full sm:w-auto justify-center mt-8 bg-transparent text-[#BE8B3E] border border-[#BE8B3E] rounded-full px-7 sm:px-9 py-4 text-sm font-semibold uppercase tracking-widest hover:bg-[#BE8B3E] hover:text-white transition">
            Open WhatsApp
        </a>

    </div>

</section>



{{-- =========================================================
     LOCATION
========================================================= --}}

<section class="py-16 sm:py-24 bg-[#f8f7f4]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-10 sm:gap-12 items-center">

            <div>

                <p class="text-xs uppercase tracking-[0.3em] sm:tracking-[0.4em] text-[#BE8B3E] font-semibold">
                    Visit Us
                </p>

                <h2 class="mt-4 sm:mt-5 text-3xl sm:text-5xl font-light leading-tight">
                    Find <span class="italic font-serif text-[#BE8B3E]">Bin Roshan</span>
                </h2>

                <p class="mt-5 sm:mt-6 text-sm sm:text-base text-gray-600 leading-7 sm:leading-8 max-w-lg">
                    Our physical store location can be displayed
                    here...
                </p>


                <div class="mt-7 sm:mt-8">

                    <p class="text-xs uppercase tracking-widest text-gray-400">
                        Address
                    </p>

                    <p class="mt-2 text-sm leading-6">
                        Shop G-15, Diamond Arcade, Plot SB-02, Block 13/D-1, Gulshan-e-Iqbal.
                    </p>

                    <p class="text-sm text-[#BE8B3E]">
                        Karachi, Pakistan
                    </p>

                </div>


                <a
                    href="https://maps.app.goo.gl/4vjMMiPtVwyyuW6L7"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex w-full sm:w-auto justify-center mt-7 sm:mt-8 border border-[#BE8B3E] text-[#BE8B3E] rounded-full px-7 py-4 text-xs font-semibold uppercase tracking-widest hover:bg-[#BE8B3E] hover:text-white transition">
                    Get Directions
                </a>

            </div>


            {{-- Map --}}

            <div class="w-full aspect-[4/3] overflow-hidden rounded-lg">

                <iframe
                    class="w-full h-full rounded-lg"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.555389154772!2d67.07852937482828!3d24.913143043148487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f480c113d77%3A0x105a502ce70cef3b!2sRoshan%20Sons!5e0!3m2!1sen!2s!4v1789728004222!5m2!1sen!2s"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin">
                </iframe>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     FLOATING WHATSAPP BUTTON
========================================================= --}}

<a
    href="https://wa.me/{{ config('store.whatsapp') }}?text={{ urlencode('Hello Bin Roshan, I would like to know more about your products.') }}"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Chat with Bin Roshan on WhatsApp"
    class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 w-12 h-12 sm:w-14 sm:h-14 bg-[#BE8B3E] text-white rounded-full shadow-xl flex items-center justify-center hover:scale-110 transition duration-300">

    <svg
        viewBox="0 0 24 24"
        fill="currentColor"
        class="w-6 h-6 sm:w-7 sm:h-7">

        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.1-.198.05-.372-.025-.521-.075-.149-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.372-.01-.57-.01-.198 0-.52.075-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982 1-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.437-9.884 9.89-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.002 5.45-4.438 9.884-9.889 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.304-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.478-8.413"/>

    </svg>

</a>



{{-- =========================================================
     CONTACT FORM JAVASCRIPT
========================================================= --}}

<script>

function showContactMessage(event) {

    event.preventDefault();

    const name =
        document.getElementById('name').value.trim();

    const email =
        document.getElementById('email').value.trim();

    const message =
        document.getElementById('message').value.trim();


    if (!name || !email || !message) {

        return false;

    }


    document
        .getElementById('contact-success')
        .classList.remove('hidden');


    /*
    |--------------------------------------------------------------------------
    | FRONTEND ONLY
    |--------------------------------------------------------------------------
    |
    | Later this form will submit to a Laravel controller.
    |
    */


    return false;

}

</script>

@endsection