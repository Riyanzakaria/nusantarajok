<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Nusantara Jok' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Preload fonts if possible or just rely on CSS -->
</head>
<body class="bg-slate-900 text-slate-300 antialiased min-h-screen flex flex-col selection:bg-accent-500/30 selection:text-accent-300" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
    <!-- Sleek Navbar V4: Dark Glass -->
    <header 
        class="fixed top-0 w-full z-50 transition-all duration-300 border-b"
        :class="scrolled ? 'bg-slate-900/80 backdrop-blur-lg border-white/10 py-3 shadow-lg' : 'bg-transparent border-transparent py-5'"
    >
        <nav class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-display text-2xl font-black tracking-tighter text-white group flex items-center gap-2">
                <svg class="w-8 h-8 text-accent-500 group-hover:rotate-12 transition-transform duration-300 ease-out drop-shadow-[0_0_10px_rgba(249,115,22,0.5)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                    <path d="M2 17l10 5 10-5"></path>
                    <path d="M2 12l10 5 10-5"></path>
                </svg>
                NUSANTARA<span class="text-accent-500"> JOK</span>
            </a>
            
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}#layanan" class="text-sm font-semibold text-slate-300 hover:text-accent-400 transition-colors hidden md:block">Layanan</a>
                <a href="{{ route('home') }}#kalkulator" class="text-sm font-semibold text-slate-300 hover:text-accent-400 transition-colors hidden md:block">Estimasi</a>
                <a href="{{ route('tracker.index') }}" class="text-sm font-semibold text-slate-300 hover:text-accent-400 transition-colors hidden md:block">Lacak Progres</a>
                
                @auth
                <div class="flex items-center gap-4 border-l border-white/20 pl-6 ml-2">
                    <div class="flex flex-col items-end hidden sm:flex">
                        <span class="text-sm font-bold text-white">{{ Auth::user()->name }}</span>
                        <span class="text-xs font-medium text-slate-400 uppercase tracking-wider">{{ Auth::user()->role }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="touch-target rounded-full bg-white/10 border border-white/10 hover:bg-white/20 text-white p-2.5 transition-colors shadow-sm" title="Keluar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-accent-400 transition-colors">Login Admin</a>
                @endguest
            </div>
        </nav>
    </header>

    <!-- Spacer to offset fixed header -->
    <div class="h-24"></div>

    <main class="flex-grow flex flex-col">
        {{ $slot }}
    </main>

    <!-- Minimalist Footer V4: Dark Glass -->
    <footer class="border-t border-white/10 bg-slate-900 mt-auto relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiLz48L3N2Zz4=')] opacity-30 z-0"></div>
        <div class="max-w-7xl mx-auto px-6 py-12 md:py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <a href="{{ route('home') }}" class="font-display text-2xl font-black tracking-tighter text-white mb-4 block">
                        NUSANTARA<span class="text-accent-500"> JOK</span>
                    </a>
                    <p class="text-slate-400 font-medium leading-relaxed max-w-sm">
                        Modifikasi interior artisan dengan fokus pada kualitas, transparansi digital, dan kepuasan pelanggan kelas atas.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4 uppercase tracking-wider text-sm drop-shadow-[0_0_5px_rgba(255,255,255,0.3)]">Navigasi</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}#layanan" class="text-slate-400 hover:text-accent-400 transition-colors font-medium">Layanan Kami</a></li>
                        <li><a href="{{ route('home') }}#kalkulator" class="text-slate-400 hover:text-accent-400 transition-colors font-medium">Kalkulator Harga</a></li>
                        <li><a href="{{ route('tracker.index') }}" class="text-slate-400 hover:text-accent-400 transition-colors font-medium">Tracker Progres</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4 uppercase tracking-wider text-sm drop-shadow-[0_0_5px_rgba(255,255,255,0.3)]">Kontak</h4>
                    <ul class="space-y-3">
                        <li class="text-slate-400 font-medium flex items-center gap-2">
                            <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Jl. Artisan No. 99, Jakarta
                        </li>
                        <li class="text-slate-400 font-medium flex items-center gap-2">
                            <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            +62 812-3456-7890
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-slate-500 font-medium">
                    &copy; {{ date('Y') }} Nusantara Jok. All rights reserved.
                </p>
                <div class="flex gap-4">
                    <!-- Social icons placeholder -->
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-accent-500 hover:border-accent-500 hover:text-white hover:shadow-[0_0_15px_rgba(249,115,22,0.4)] transition-all duration-300">
                        IG
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-accent-500 hover:border-accent-500 hover:text-white hover:shadow-[0_0_15px_rgba(249,115,22,0.4)] transition-all duration-300">
                        WA
                    </a>
                </div>
            </div>
        </div>
    </footer>
    @stack('scripts')

    {{-- ================================================================
         WhatsApp Floating Button & Greeting Popup
         Muncul di semua halaman publik untuk konversi langsung ke WA.
         Nomor WA: ganti di variabel waNumber di bawah.
         ================================================================ --}}
    <script>
    (function () {
        const waNumber  = '6281234567890'; // ← Ganti dengan nomor WhatsApp admin
        const waDefault = `https://wa.me/${waNumber}?text=${encodeURIComponent('Halo Admin Nusantara Jok, saya ingin konsultasi modifikasi interior kendaraan saya. 🚗')}`;


        // ── 1. Inject styles ────────────────────────────────────────────
        const css = `
        /* Floating WA Button */
        #wa-float {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            text-decoration: none;
        }
        #wa-float-btn {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #25D366;
            box-shadow: 0 6px 24px rgba(37,211,102,.45);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .25s ease, box-shadow .25s ease;
            flex-shrink: 0;
        }
        #wa-float:hover #wa-float-btn {
            transform: scale(1.1) translateY(-2px);
            box-shadow: 0 10px 32px rgba(37,211,102,.55);
        }
        #wa-float-label {
            background: #fff;
            color: #1a1a1a;
            font-size: 13px;
            font-weight: 700;
            padding: 8px 14px;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,.10);
            white-space: nowrap;
            opacity: 0;
            transform: translateX(8px);
            transition: opacity .25s ease, transform .25s ease;
            pointer-events: none;
        }
        #wa-float:hover #wa-float-label {
            opacity: 1;
            transform: translateX(0);
        }
        /* Pulse ring */
        #wa-float-btn::before {
            content: '';
            position: absolute;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: rgba(37,211,102,.35);
            animation: waPulse 2.2s ease-out infinite;
        }
        @keyframes waPulse {
            0%   { transform: scale(1);   opacity: 1; }
            100% { transform: scale(2.2); opacity: 0; }
        }

        /* Popup */
        #wa-popup {
            position: fixed;
            bottom: 100px;
            right: 28px;
            z-index: 9998;
            width: 300px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 12px 48px rgba(0,0,0,.15);
            overflow: hidden;
            opacity: 0;
            transform: translateY(20px) scale(.95);
            transition: opacity .35s ease, transform .35s ease;
            pointer-events: none;
        }
        #wa-popup.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }
        #wa-popup-header {
            background: #075E54;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        #wa-popup-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #25D366;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        #wa-popup-name { color:#fff; font-weight:800; font-size:14px; line-height:1.2; }
        #wa-popup-status { color:rgba(255,255,255,.65); font-size:11px; margin-top:2px; }
        #wa-popup-close {
            margin-left: auto;
            background: transparent;
            border: none;
            color: rgba(255,255,255,.7);
            cursor: pointer;
            padding: 4px;
            line-height: 0;
            border-radius: 6px;
            transition: color .2s;
        }
        #wa-popup-close:hover { color:#fff; }
        #wa-popup-body {
            padding: 16px;
        }
        #wa-popup-bubble {
            background: #f0f4f7;
            border-radius: 0 14px 14px 14px;
            padding: 12px 14px;
            font-size: 13px;
            color: #1a1a1a;
            line-height: 1.5;
            margin-bottom: 12px;
            position: relative;
        }
        #wa-popup-bubble::before {
            content: '';
            position: absolute;
            top: 0; left: -7px;
            border: 7px solid transparent;
            border-top-color: #f0f4f7;
            border-right-color: #f0f4f7;
        }
        #wa-popup-cta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            background: #25D366;
            color: #fff;
            font-weight: 800;
            font-size: 14px;
            border-radius: 12px;
            text-decoration: none;
            transition: background .2s, transform .2s;
        }
        #wa-popup-cta:hover { background:#1ebe5d; transform: translateY(-1px); }
        #wa-popup-time { text-align:right; font-size:11px; color:#aaa; margin-top:6px; }
        `;
        const style = document.createElement('style');
        style.textContent = css;
        document.head.appendChild(style);

        // ── 2. Build floating button ────────────────────────────────────
        const floatEl = document.createElement('a');
        floatEl.id   = 'wa-float';
        floatEl.href = waDefault;
        floatEl.target = '_blank';
        floatEl.rel    = 'noopener noreferrer';
        floatEl.setAttribute('aria-label', 'Chat WhatsApp');
        floatEl.innerHTML = `
            <span id="wa-float-label">Chat dengan Kami</span>
            <span id="wa-float-btn">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="white">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/>
                </svg>
            </span>
        `;
        document.body.appendChild(floatEl);

        // ── 3. Build popup ──────────────────────────────────────────────
        const now    = new Date();
        const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

        const popup = document.createElement('div');
        popup.id    = 'wa-popup';
        popup.innerHTML = `
            <div id="wa-popup-header">
                <span id="wa-popup-avatar">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="white">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/>
                    </svg>
                </span>
                <div>
                    <div id="wa-popup-name">Nusantara Jok CS</div>
                    <div id="wa-popup-status">● Online sekarang</div>
                </div>
                <button id="wa-popup-close" aria-label="Tutup">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <div id="wa-popup-body">
                <div id="wa-popup-bubble">
                    Halo! 👋 Selamat datang di <strong>Nusantara Jok</strong>.<br>
                    Ada yang bisa kami bantu untuk kebutuhan modifikasi interior kendaraan Anda?
                </div>
                <div id="wa-popup-time">${timeStr} ✓✓</div>
                <a href="${waDefault}" target="_blank" rel="noopener noreferrer" id="wa-popup-cta">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                    Mulai Chat WhatsApp
                </a>
            </div>
        `;
        document.body.appendChild(popup);

        // ── 4. Logic: show once per session, auto-show after 5s ─────────
        const SEEN_KEY = 'wa_popup_seen';

        function showPopup()  { popup.classList.add('visible'); }
        function closePopup() {
            popup.classList.remove('visible');
            sessionStorage.setItem(SEEN_KEY, '1');
        }

        popup.querySelector('#wa-popup-close').addEventListener('click', closePopup);
        popup.querySelector('#wa-popup-cta').addEventListener('click', closePopup);

        if (!sessionStorage.getItem(SEEN_KEY)) {
            setTimeout(showPopup, 5000);
        }

        // Clicking the float button also closes popup if open
        floatEl.addEventListener('click', function () {
            if (popup.classList.contains('visible')) closePopup();
        });
    })();
    </script>
