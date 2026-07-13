<section
    class="relative min-h-[100svh] flex flex-col justify-end overflow-hidden"
    style="background: oklch(0.12 0.018 55);"
>
    {{-- Full-bleed background image --}}
    <div class="absolute inset-0 z-0">
        <img
            src="{{ asset('images/hero_jok_premium.png') }}"
            alt=""
            aria-hidden="true"
            class="w-full h-full object-cover"
            style="opacity: 0.30; mix-blend-mode: luminosity;"
        />
        <div class="absolute inset-0" style="background: linear-gradient(to top, oklch(0.12 0.018 55) 0%, oklch(0.12 0.018 55 / 0.85) 35%, oklch(0.12 0.018 55 / 0.40) 65%, oklch(0.12 0.018 55 / 0.20) 100%);"></div>
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22%3E%3Cfilter id=%22n%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.75%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3CfeColorMatrix type=%22saturate%22 values=%220%22/%3E%3C/filter%3E%3Crect width=%22200%22 height=%22200%22 filter=%22url(%23n)%22 opacity=%220.04%22/%3E%3C/svg%3E'); opacity: 0.6;"></div>
    </div>

    {{-- Content — bottom-anchored --}}
    <div class="relative z-10 container mx-auto px-6 max-w-6xl pt-32 pb-20 md:pb-28">

        <div
            x-data="{ animateIn: false }"
            x-init="requestAnimationFrame(() => requestAnimationFrame(() => animateIn = true))"
        >
            <h1
                class="font-display font-700 mb-6"
                style="font-size: clamp(2.8rem, 7.5vw, 5.5rem); line-height: 1.0; letter-spacing: -0.035em; color: oklch(0.93 0.012 75); text-wrap: balance; transition: opacity 0.9s cubic-bezier(0.16,1,0.3,1), transform 0.9s cubic-bezier(0.16,1,0.3,1);"
                :style="animateIn ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(28px)' }"
            >
                Spesialis Modifikasi Interior &<br>
                <span style="color: oklch(0.67 0.13 66);">Jok Racing Custom PNP</span>
            </h1>

            <p
                class="font-sans mb-10"
                style="font-size: 1.075rem; line-height: 1.75; color: oklch(0.68 0.022 65); max-width: 50ch; font-weight: 400; transition: opacity 0.9s 0.15s cubic-bezier(0.16,1,0.3,1), transform 0.9s 0.15s cubic-bezier(0.16,1,0.3,1);"
                :style="animateIn ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(20px)' }"
            >
                Tingkatkan kenyamanan dan gaya interior mobil Anda. Pilih layanan modifikasi cover jok custom di bengkel kami, atau pesan Jok Racing utuh (Plug-and-Play) komplit yang bisa dipasang sendiri di rumah.
            </p>

            {{-- CTAs --}}
            <div
                class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4"
                style="transition: opacity 0.9s 0.28s cubic-bezier(0.16,1,0.3,1), transform 0.9s 0.28s cubic-bezier(0.16,1,0.3,1);"
                :style="animateIn ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(16px)' }"
            >
                <a
                    href="#katalog"
                    class="touch-target inline-flex items-center justify-center gap-3 px-8 py-4 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-300"
                    style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55); border: 2px solid oklch(0.67 0.13 66);"
                    onmouseover="this.style.background='oklch(0.75 0.11 67)'; this.style.borderColor='oklch(0.75 0.11 67)'; this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.background='oklch(0.67 0.13 66)'; this.style.borderColor='oklch(0.67 0.13 66)'; this.style.transform='translateY(0)'"
                >
                    Lihat Katalog Produk
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a
                    href="https://wa.me/6281259645665"
                    target="_blank"
                    rel="noopener"
                    class="touch-target inline-flex items-center justify-center gap-3 px-8 py-4 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-300"
                    style="background: transparent; color: oklch(0.93 0.012 75); border: 1px solid oklch(0.38 0.03 60);"
                    onmouseover="this.style.borderColor='oklch(0.93 0.012 75)'; this.style.background='oklch(0.93 0.012 75 / 0.05)'; this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.borderColor='oklch(0.38 0.03 60)'; this.style.background='transparent'; this.style.transform='translateY(0)'"
                >
                    Chat WhatsApp Sekarang
                </a>
            </div>

            {{-- Stat bar --}}
            <div
                class="flex flex-wrap items-center gap-x-10 gap-y-4 mt-16 pt-8"
                style="border-top: 1px solid oklch(0.28 0.025 55); transition: opacity 0.9s 0.45s cubic-bezier(0.16,1,0.3,1);"
                :style="animateIn ? { opacity: 1 } : { opacity: 0 }"
            >
                <div>
                    <p class="font-display font-600" style="font-size: 2rem; color: oklch(0.93 0.012 75); line-height: 1;">500+</p>
                    <p class="font-sans text-xs uppercase tracking-widest mt-1" style="color: oklch(0.50 0.020 62);">Kendaraan Selesai</p>
                </div>
                <div style="width: 1px; height: 2.5rem; background: oklch(0.28 0.025 55);"></div>
                <div>
                    <p class="font-display font-600" style="font-size: 2rem; color: oklch(0.93 0.012 75); line-height: 1;">5+ Thn</p>
                    <p class="font-sans text-xs uppercase tracking-widest mt-1" style="color: oklch(0.50 0.020 62);">Pengalaman</p>
                </div>
                <div style="width: 1px; height: 2.5rem; background: oklch(0.28 0.025 55);"></div>
                <div>
                    <p class="font-display font-600" style="font-size: 2rem; color: oklch(0.93 0.012 75); line-height: 1;">Magetan</p>
                    <p class="font-sans text-xs uppercase tracking-widest mt-1" style="color: oklch(0.50 0.020 62);">Jawa Timur</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll cue --}}
    <div class="absolute bottom-8 right-8 z-10 hidden md:flex flex-col items-center gap-2"
         style="color: oklch(0.38 0.03 60);">
        <span class="font-sans text-[0.6rem] uppercase tracking-[0.2em]" style="writing-mode: vertical-rl; transform: rotate(180deg);">Scroll</span>
        <div style="width: 1px; height: 48px; background: linear-gradient(to bottom, oklch(0.38 0.03 60), transparent);"></div>
    </div>
</section>




