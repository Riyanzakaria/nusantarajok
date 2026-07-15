<!DOCTYPE html>
<html lang="id" class="scroll-smooth dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Bengkel Jok Nusantara — Spesialis Jok Custom Racing PNP Se-Indonesia' }}</title>
    <meta name="description" content="Bengkel Jok Nusantara melayani pembuatan jok mobil custom racing, PNP (Plug and Play), dan restorasi interior dengan pengiriman ke seluruh Indonesia.">
    <meta name="keywords" content="jok racing custom, jok mobil PNP, bengkel jok magetan, kirim jok seluruh indonesia, jok mobil custom murah, modifikasi interior mobil">
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Open Graph / Facebook / WhatsApp --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Bengkel Jok Nusantara — Jok Custom Racing PNP Se-Indonesia' }}">
    <meta property="og:description" content="Spesialis jok racing custom PNP tanpa perlu titip mobil. Terima pesanan dan pengiriman aman ke seluruh Indonesia.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- JSON-LD Structured Data for LocalBusiness & Nationwide Service --}}
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "AutoRepair",
      "name": "Bengkel Jok Nusantara",
      "image": "{{ asset('images/logo.png') }}",
      "@@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "telephone": "+6281259645665",
      "description": "Spesialis jok mobil custom racing dan PNP dengan jangkauan pengiriman ke seluruh Indonesia.",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Magetan",
        "addressLocality": "Magetan",
        "addressRegion": "Jawa Timur",
        "addressCountry": "ID"
      },
      "areaServed": {
        "@@type": "Country",
        "name": "Indonesia"
      },
      "priceRange": "$$"
    }
    </script>
</head>
<body
    class="antialiased min-h-screen flex flex-col"
    style="background-color: oklch(0.12 0.018 55); color: oklch(0.93 0.012 75);"
    x-data="{ scrolled: false, mobileMenuOpen: false }"
    @scroll.window="scrolled = (window.pageYOffset > 40)"
    @keydown.escape.window="mobileMenuOpen = false"
>

    {{-- ═══════════════════════════════════════════
         NAVBAR — Dark artisan, no theme toggle
    ═══════════════════════════════════════════ --}}
    <header
        class="fixed top-0 w-full z-[200] transition-all duration-500"
        :class="scrolled
            ? 'border-b py-3'
            : 'border-b border-transparent py-5'"
        :style="scrolled
            ? 'background: oklch(0.10 0.015 55 / 0.96); backdrop-filter: blur(20px); border-color: oklch(0.22 0.02 55);'
            : 'background: transparent;'"
    >
        <nav class="max-w-7xl mx-auto px-6 flex items-center justify-between">

            {{-- Wordmark with Logo --}}
            <a href="{{ route('home') }}" class="flex items-center group" aria-label="Bengkel Jok Nusantara">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Nusantara Jok" class="h-16 sm:h-20 w-auto transition-transform duration-300 group-hover:scale-105 rounded-md" style="object-fit: contain;">
            </a>

            {{-- Nav items --}}
            <div class="flex items-center gap-7 lg:gap-10">
                <a href="{{ route('home') }}#gallery"
                   class="hidden md:block text-sm font-sans font-medium transition-colors duration-200 hover:opacity-100"
                   style="color: oklch(0.72 0.025 68); opacity: 0.85;"
                   onmouseover="this.style.color='oklch(0.75 0.11 67)'"
                   onmouseout="this.style.color='oklch(0.72 0.025 68)'">Galeri</a>

                <a href="{{ route('home') }}#kalkulator"
                   class="hidden md:block text-sm font-sans font-medium transition-colors duration-200"
                   style="color: oklch(0.72 0.025 68); opacity: 0.85;"
                   onmouseover="this.style.color='oklch(0.75 0.11 67)'"
                   onmouseout="this.style.color='oklch(0.72 0.025 68)'">Estimasi Harga</a>

                <a href="{{ route('tracker.index') }}"
                   class="hidden md:block text-sm font-sans font-medium transition-colors duration-200"
                   style="color: oklch(0.72 0.025 68); opacity: 0.85;"
                   onmouseover="this.style.color='oklch(0.75 0.11 67)'"
                   onmouseout="this.style.color='oklch(0.72 0.025 68)'">Lacak Pesanan</a>

                @auth
                <div class="flex items-center gap-4 pl-6 ml-2" style="border-left: 1px solid oklch(0.28 0.025 55);">
                    <div class="hidden sm:flex flex-col items-end">
                        <span class="text-sm font-sans font-600" style="color: oklch(0.93 0.012 75);">{{ Auth::user()->name }}</span>
                        <span class="text-[0.65rem] font-sans font-500 tracking-wider uppercase" style="color: oklch(0.50 0.020 62);">{{ Auth::user()->role }}</span>
                    </div>
                    <a href="{{ route('dashboard.index') }}"
                       class="touch-target px-4 py-2 text-xs font-sans font-700 uppercase tracking-wider transition-all duration-200"
                       style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55); border: 1px solid oklch(0.67 0.13 66);"
                       onmouseover="this.style.background='oklch(0.75 0.11 67)'; this.style.borderColor='oklch(0.75 0.11 67)'"
                       onmouseout="this.style.background='oklch(0.67 0.13 66)'; this.style.borderColor='oklch(0.67 0.13 66)'">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="touch-target w-9 h-9 flex items-center justify-center transition-colors duration-200"
                            style="color: oklch(0.50 0.020 62); border: 1px solid oklch(0.28 0.025 55);"
                            onmouseover="this.style.color='oklch(0.93 0.012 75)'; this.style.borderColor='oklch(0.38 0.03 60)'"
                            onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.borderColor='oklch(0.28 0.025 55)'"
                            title="Keluar">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
                @endauth

                @guest
                <a href="{{ route('login') }}"
                   class="hidden md:inline-flex touch-target px-4 py-2 text-xs font-sans font-700 uppercase tracking-wider transition-all duration-200"
                   style="color: oklch(0.67 0.13 66); border: 1px solid oklch(0.38 0.03 60);"
                   onmouseover="this.style.borderColor='oklch(0.67 0.13 66)'; this.style.background='oklch(0.67 0.13 66 / 0.08)'"
                   onmouseout="this.style.borderColor='oklch(0.38 0.03 60)'; this.style.background='transparent'">
                    Login
                </a>
                @endguest

                {{-- Hamburger — mobile only --}}
                <button
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden w-9 h-9 flex items-center justify-center transition-colors duration-200"
                    style="color: oklch(0.72 0.025 68); border: 1px solid oklch(0.28 0.025 55);"
                    :style="mobileMenuOpen ? 'color: oklch(0.93 0.012 75); border-color: oklch(0.38 0.03 60);' : ''"
                    aria-label="Buka menu"
                >
                    <svg x-show="!mobileMenuOpen" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </nav>

        {{-- Mobile Menu Drawer --}}
        <div
            x-show="mobileMenuOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden"
            style="background: oklch(0.10 0.015 55 / 0.98); backdrop-filter: blur(20px); border-top: 1px solid oklch(0.22 0.02 55);"
        >
            <nav class="max-w-7xl mx-auto px-6 py-6 flex flex-col gap-1">
                <a href="{{ route('home') }}#gallery"
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-3.5 font-sans font-700 text-sm transition-colors duration-200"
                   style="color: oklch(0.72 0.025 68); border-bottom: 1px solid oklch(0.18 0.02 55);"
                   onmouseover="this.style.color='oklch(0.93 0.012 75)'"
                   onmouseout="this.style.color='oklch(0.72 0.025 68)'">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Galeri Pekerjaan
                </a>
                <a href="{{ route('home') }}#kalkulator"
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-3.5 font-sans font-700 text-sm transition-colors duration-200"
                   style="color: oklch(0.72 0.025 68); border-bottom: 1px solid oklch(0.18 0.02 55);"
                   onmouseover="this.style.color='oklch(0.93 0.012 75)'"
                   onmouseout="this.style.color='oklch(0.72 0.025 68)'">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Estimasi Harga
                </a>
                <a href="{{ route('tracker.index') }}"
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-3.5 font-sans font-700 text-sm transition-colors duration-200"
                   style="color: oklch(0.72 0.025 68); border-bottom: 1px solid oklch(0.18 0.02 55);"
                   onmouseover="this.style.color='oklch(0.93 0.012 75)'"
                   onmouseout="this.style.color='oklch(0.72 0.025 68)'">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Lacak Progres
                </a>
                @guest
                <a href="{{ route('login') }}"
                   class="flex items-center gap-3 px-4 py-3.5 font-sans font-700 text-sm mt-2 transition-all duration-200"
                   style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55);">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Login Admin
                </a>
                @endguest
            </nav>
        </div>
    </header>

    <main class="flex-grow w-full">
        {{ $slot }}
    </main>

    {{-- ═══════════════════════════════════════════
         FOOTER — Artisan workshop
    ═══════════════════════════════════════════ --}}
    <footer style="border-top: 1px solid oklch(0.22 0.02 55); background: oklch(0.10 0.015 55);">

        {{-- Stitch divider --}}
        <div style="height: 1px; background: repeating-linear-gradient(to right, oklch(0.28 0.025 55) 0, oklch(0.28 0.025 55) 6px, transparent 6px, transparent 12px);"></div>

        <div class="max-w-7xl mx-auto px-6 py-14 md:py-20">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 md:gap-16">

                {{-- Brand block --}}
                <div class="md:col-span-5">
                    <a href="{{ route('home') }}" class="flex items-center mb-6 group w-fit">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Nusantara Jok" class="h-24 w-auto rounded-md">
                    </a>
                    <p class="text-sm leading-relaxed max-w-xs mb-8" style="color: oklch(0.50 0.020 62);">
                        Interior artisan untuk kendaraan Anda. Material asli, pengerjaan presisi, dan transparansi digital dari konsultasi hingga selesai.
                    </p>
                    {{-- Social --}}
                    <div class="flex items-center gap-3">
                        <a href="https://instagram.com/jok_mobil_magetan" target="_blank" rel="noopener"
                           class="w-9 h-9 flex items-center justify-center transition-all duration-200"
                           style="color: oklch(0.50 0.020 62); border: 1px solid oklch(0.28 0.025 55);"
                           onmouseover="this.style.color='oklch(0.67 0.13 66)'; this.style.borderColor='oklch(0.67 0.13 66)'"
                           onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.borderColor='oklch(0.28 0.025 55)'"
                           aria-label="Instagram">
                           <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="https://wa.me/6281259645665" target="_blank" rel="noopener"
                           class="w-9 h-9 flex items-center justify-center transition-all duration-200"
                           style="color: oklch(0.50 0.020 62); border: 1px solid oklch(0.28 0.025 55);"
                           onmouseover="this.style.color='oklch(0.67 0.13 66)'; this.style.borderColor='oklch(0.67 0.13 66)'"
                           onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.borderColor='oklch(0.28 0.025 55)'"
                           aria-label="WhatsApp">
                           <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.012 2.015c-5.503 0-9.972 4.474-9.972 9.98 0 1.761.463 3.483 1.341 4.996l-1.42 5.187 5.3-1.391a9.92 9.92 0 004.751 1.205h.004c5.503 0 9.971-4.476 9.971-9.98 0-2.67-1.04-5.18-2.928-7.072-1.889-1.892-4.402-2.934-7.075-2.934zm.004 16.732a8.291 8.291 0 01-4.227-1.15l-.303-.18-3.14.823.84-3.064-.197-.314a8.272 8.272 0 01-1.267-4.444c0-4.57 3.723-8.297 8.298-8.297 2.215 0 4.295.864 5.862 2.433 1.565 1.568 2.428 3.652 2.428 5.871 0 4.568-3.723 8.293-8.294 8.293zm4.551-6.223c-.25-.125-1.478-.73-1.707-.814-.23-.083-.396-.125-.563.125-.167.25-.644.814-.79.981-.147.167-.292.188-.543.063-1.182-.591-2.091-1.066-2.871-2.22-.213-.314-.022-.486.103-.61.112-.113.25-.292.375-.438.124-.146.166-.25.25-.417.082-.167.04-.313-.021-.438-.063-.125-.563-1.356-.77-1.856-.202-.485-.407-.42-.562-.427-.147-.006-.314-.006-.481-.006-.166 0-.437.063-.666.313-.23.25-.875.856-.875 2.086 0 1.23.896 2.42 1.021 2.586.124.167 1.761 2.69 4.265 3.771 1.637.708 2.25.772 3.033.655.855-.128 2.754-1.127 3.14-2.214.385-1.087.385-2.02.271-2.213-.114-.193-.427-.308-.677-.433z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Nav links --}}
                <div class="md:col-span-3">
                    <p class="label-caps mb-5" style="color: oklch(0.38 0.03 60);">Navigasi</p>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}#gallery" class="text-sm font-sans transition-colors duration-200" style="color: oklch(0.50 0.020 62);" onmouseover="this.style.color='oklch(0.75 0.11 67)'" onmouseout="this.style.color='oklch(0.50 0.020 62)'">Galeri Pekerjaan</a></li>
                        <li><a href="{{ route('home') }}#kalkulator" class="text-sm font-sans transition-colors duration-200" style="color: oklch(0.50 0.020 62);" onmouseover="this.style.color='oklch(0.75 0.11 67)'" onmouseout="this.style.color='oklch(0.50 0.020 62)'">Estimasi Harga</a></li>
                        <li><a href="{{ route('tracker.index') }}" class="text-sm font-sans transition-colors duration-200" style="color: oklch(0.50 0.020 62);" onmouseover="this.style.color='oklch(0.75 0.11 67)'" onmouseout="this.style.color='oklch(0.50 0.020 62)'">Lacak Progres</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div class="md:col-span-4">
                    <p class="label-caps mb-5" style="color: oklch(0.38 0.03 60);">Kontak</p>
                    <ul class="space-y-4">
                        <li>
                            <a href="https://maps.app.goo.gl/ksmwqYfaw64oFbzs6"
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-start gap-2 text-sm font-sans transition-colors duration-200 group"
                               style="color: oklch(0.50 0.020 62);"
                               onmouseover="this.style.color='oklch(0.75 0.11 67)'"
                               onmouseout="this.style.color='oklch(0.50 0.020 62)'"
                            >
                                <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Magetan, Jawa Timur<br>
                                <span class="text-xs" style="color: oklch(0.42 0.025 60);">Lihat di Google Maps ↗</span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:+6281259645665" class="text-sm font-sans transition-colors duration-200" style="color: oklch(0.50 0.020 62);" onmouseover="this.style.color='oklch(0.75 0.11 67)'" onmouseout="this.style.color='oklch(0.50 0.020 62)'">+62 812-5964-5665</a>
                        </li>
                        <li>
                            <a href="https://wa.me/6281259645665" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 text-xs font-sans font-700 uppercase tracking-wider px-4 py-2.5 mt-2 transition-all duration-200"
                               style="color: oklch(0.12 0.018 55); background: oklch(0.67 0.13 66); border: 1px solid oklch(0.67 0.13 66);"
                               onmouseover="this.style.background='oklch(0.75 0.11 67)'; this.style.borderColor='oklch(0.75 0.11 67)'"
                               onmouseout="this.style.background='oklch(0.67 0.13 66)'; this.style.borderColor='oklch(0.67 0.13 66)'">
                                Tanya / Pesan via WA
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Stitch bottom divider --}}
            <div class="mt-14 mb-8" style="height: 1px; background: repeating-linear-gradient(to right, oklch(0.22 0.02 55) 0, oklch(0.22 0.02 55) 6px, transparent 6px, transparent 12px);"></div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs font-sans" style="color: oklch(0.35 0.015 60);">
                    &copy; {{ date('Y') }} Bengkel Jok Nusantara. All rights reserved.
                </p>
                <p class="text-xs font-sans" style="color: oklch(0.35 0.015 60);">
                    Handcrafted with precision.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    {{-- ═══════════════════════════════════════════
         WhatsApp Floating Button
    ═══════════════════════════════════════════ --}}
    @if(empty($hideWaButton))
    <script>
    (function () {
        const waNumber  = '6281259645665';
        const waDefault = `https://wa.me/${waNumber}?text=${encodeURIComponent('Halo Bengkel Jok Nusantara, saya mau tanya-tanya soal pemasangan jok mobil. Bisa minta info harga dan jadwalnya?')}`;

        const css = `
        #wa-float {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            text-decoration: none;
        }
        #wa-float-btn {
            width: 54px;
            height: 54px;
            border-radius: 0;
            background: #25D366;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.25s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.25s ease;
            flex-shrink: 0;
            box-shadow: 0 4px 20px rgba(37,211,102,0.30);
        }
        #wa-float:hover #wa-float-btn {
            transform: scale(1.06) translateY(-2px);
            box-shadow: 0 8px 28px rgba(37,211,102,0.45);
        }
        #wa-float-label {
            background: oklch(0.155 0.022 55);
            color: oklch(0.93 0.012 75);
            font-size: 12px;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 8px 14px;
            border: 1px solid oklch(0.28 0.025 55);
            white-space: nowrap;
            opacity: 0;
            transform: translateX(8px);
            transition: opacity 0.2s ease, transform 0.2s ease;
            pointer-events: none;
        }
        #wa-float:hover #wa-float-label {
            opacity: 1;
            transform: translateX(0);
        }
        #wa-float-btn::before {
            content: '';
            position: absolute;
            width: 54px;
            height: 54px;
            background: rgba(37,211,102,0.25);
            animation: waPulse 2.4s ease-out infinite;
        }
        @keyframes waPulse {
            0%   { transform: scale(1);   opacity: 1; }
            100% { transform: scale(2.4); opacity: 0; }
        }
        #wa-popup {
            position: fixed;
            bottom: 96px;
            right: 28px;
            z-index: 599;
            width: calc(100vw - 40px);
            max-width: 288px;
            background: oklch(0.155 0.022 55);
            border: 1px solid oklch(0.28 0.025 55);
            border-radius: 0;
            box-shadow: 0 12px 48px rgba(0,0,0,.5);
            overflow: hidden;
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.3s ease, transform 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            pointer-events: none;
        }
        #wa-popup.visible {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        #wa-popup-header {
            background: #075E54;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        #wa-popup-avatar {
            width: 38px;
            height: 38px;
            border-radius: 0;
            background: #25D366;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        #wa-popup-name { color:#fff; font-weight:800; font-size:13px; font-family:'DM Sans',sans-serif; }
        #wa-popup-status { color:rgba(255,255,255,.6); font-size:10px; margin-top:1px; font-family:'DM Sans',sans-serif; }
        #wa-popup-close {
            margin-left: auto;
            background: transparent;
            border: none;
            color: rgba(255,255,255,.6);
            cursor: pointer;
            padding: 4px;
            line-height: 0;
            transition: color .2s;
        }
        #wa-popup-close:hover { color:#fff; }
        #wa-popup-body { padding: 14px; }
        #wa-popup-bubble {
            background: oklch(0.22 0.025 55);
            border: 1px solid oklch(0.28 0.025 55);
            padding: 12px 14px;
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            color: oklch(0.72 0.025 68);
            line-height: 1.55;
            margin-bottom: 10px;
        }
        #wa-popup-cta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 11px;
            background: #25D366;
            color: #fff;
            font-weight: 800;
            font-size: 12px;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            text-decoration: none;
            transition: background .2s;
        }
        #wa-popup-cta:hover { background:#1ebe5d; }
        #wa-popup-time { text-align:right; font-size:10px; color:oklch(0.38 0.03 60); margin-top:6px; font-family:'DM Sans',sans-serif; }
        `;
        const style = document.createElement('style');
        style.textContent = css;
        document.head.appendChild(style);

        const floatEl = document.createElement('a');
        floatEl.id   = 'wa-float';
        floatEl.href = waDefault;
        floatEl.target = '_blank';
        floatEl.rel    = 'noopener noreferrer';
        floatEl.setAttribute('aria-label', 'Chat WhatsApp');
        floatEl.innerHTML = `
            <span id="wa-float-label">Chat Sekarang</span>
            <span id="wa-float-btn">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="white">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/>
                </svg>
            </span>
        `;
        document.body.appendChild(floatEl);

        const now     = new Date();
        const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        const popup   = document.createElement('div');
        popup.id      = 'wa-popup';
        popup.innerHTML = `
            <div id="wa-popup-header">
                <span id="wa-popup-avatar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/>
                    </svg>
                </span>
                <div>
                    <div id="wa-popup-name">BJN — Admin</div>
                    <div id="wa-popup-status">● Tersedia sekarang</div>
                </div>
                <button id="wa-popup-close" aria-label="Tutup">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <div id="wa-popup-body">
                <div id="wa-popup-bubble">
                    Halo! Selamat datang di <strong>Bengkel Jok Nusantara</strong> — Magetan.<br>Mau tanya-tanya soal jok atau langsung order? Chat aja, kami siap bantu!
                </div>
                <div id="wa-popup-time">${timeStr} ✓✓</div>
                <a href="${waDefault}" target="_blank" rel="noopener noreferrer" id="wa-popup-cta">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                    Mulai Chat
                </a>
            </div>
        `;
        document.body.appendChild(popup);

        const SEEN_KEY = 'wa_popup_seen';
        function showPopup()  { popup.classList.add('visible'); }
        function closePopup() { popup.classList.remove('visible'); sessionStorage.setItem(SEEN_KEY, '1'); }

        popup.querySelector('#wa-popup-close').addEventListener('click', closePopup);
        popup.querySelector('#wa-popup-cta').addEventListener('click', closePopup);

        if (!sessionStorage.getItem(SEEN_KEY)) {
            setTimeout(showPopup, 5000);
        }

        floatEl.addEventListener('click', function () {
            if (popup.classList.contains('visible')) closePopup();
        });
    })();
    </script>
    @endif
</body>
</html>


