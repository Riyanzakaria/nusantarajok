<section
    class="relative overflow-hidden"
    id="problem"
    style="padding: 6rem 0 7rem; background: oklch(0.155 0.022 55); border-top: 1px solid oklch(0.22 0.02 55);"
>
    <div class="container mx-auto px-6 max-w-6xl">

        <div
            class="mb-16 md:mb-20"
            x-data="{ shown: false }"
            x-intersect.once.margin.-10%.0px="shown = true"
        >
            <h2
                class="font-display font-700"
                style="font-size: clamp(2rem, 4.5vw, 3.8rem); line-height: 1.04; letter-spacing: -0.03em; color: oklch(0.93 0.012 75); max-width: 22ch; text-wrap: balance; transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);"
                :style="shown ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(24px)' }"
            >
                Jok Bawaan Pabrik <span style="color: oklch(0.50 0.020 62); font-weight: 700;">Bikin Nyesel.</span>
            </h2>
            <p
                class="font-sans mt-5"
                style="font-size: 1.0625rem; line-height: 1.7; color: oklch(0.72 0.025 68); max-width: 50ch; transition: opacity 0.8s 0.12s cubic-bezier(0.16,1,0.3,1);"
                :style="shown ? { opacity: 1 } : { opacity: 0 }"
            >
                Jok ori kamu rentan rusak, cepet kotor, dan bikin kabin jadi gerah. Di sini masalahnya:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-px" style="background: oklch(0.22 0.02 55);">

            {{-- Problem 1: Gerah & Tidak Nyaman --}}
            <div
                class="md:col-span-8 p-10 md:p-14"
                style="background: oklch(0.12 0.018 55);"
                x-data="{ shown: false }"
                x-intersect.once.margin.-10%.0px="shown = true"
            >
                <div
                    style="transition: opacity 0.75s cubic-bezier(0.16,1,0.3,1), transform 0.75s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(20px)' }"
                >
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-5" style="color: oklch(0.50 0.020 62);">01</p>
                    <h3 class="font-display font-700 uppercase mb-5" style="font-size: 2rem; letter-spacing: -0.01em; color: oklch(0.93 0.012 75);">Panas Terik, Kabin Gerah</h3>
                    <p class="font-sans leading-relaxed" style="font-size: 1rem; color: oklch(0.72 0.025 68); max-width: 44ch; line-height: 1.7;">
                        Bahan kain bawaan nyerap panas, bikin duduk lama jadi tidak nyaman apalagi waktu macet siang bolong. Apalagi di cuaca Indonesia yang terik — bisa bikin mood rusak sebelum nyampe tujuan.
                    </p>
                </div>
            </div>

            {{-- Problem 2: Noda Susah Hilang --}}
            <div
                class="md:col-span-4 p-10 md:p-12 flex flex-col justify-between"
                style="background: oklch(0.14 0.020 55);"
                x-data="{ shown: false }"
                x-intersect.once.margin.-10%.0px="shown = true"
            >
                <div
                    style="transition: opacity 0.75s 0.08s cubic-bezier(0.16,1,0.3,1), transform 0.75s 0.08s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(20px)' }"
                >
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-5" style="color: oklch(0.50 0.020 62);">02</p>
                    <h3 class="font-display font-700 uppercase mb-4" style="font-size: 1.5rem; letter-spacing: -0.01em; color: oklch(0.93 0.012 75);">Tumpah Langsung Nyerap</h3>
                    <p class="font-sans leading-relaxed" style="font-size: 0.9rem; color: oklch(0.72 0.025 68); line-height: 1.7;">
                        Kopi, air mineral, ompol anak — semuanya langsung meresap ke busa. Nodanya susah hilang dan bau.
                    </p>
                </div>
            </div>

            {{-- Problem 3: Gampang Sobek --}}
            <div
                class="md:col-span-12 p-10 md:p-14 flex flex-col md:flex-row items-start md:items-center justify-between gap-10"
                style="background: oklch(0.10 0.015 55);"
                x-data="{ shown: false }"
                x-intersect.once.margin.-10%.0px="shown = true"
            >
                <div
                    style="transition: opacity 0.75s 0.15s cubic-bezier(0.16,1,0.3,1), transform 0.75s 0.15s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(20px)' }"
                >
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-5" style="color: oklch(0.50 0.020 62);">03</p>
                    <h3 class="font-display font-700 uppercase mb-4" style="font-size: 1.8rem; letter-spacing: -0.01em; color: oklch(0.93 0.012 75);">Cepet Rusak, Jual Mobil Rugi</h3>
                    <p class="font-sans leading-relaxed max-w-2xl" style="font-size: 1rem; color: oklch(0.72 0.025 68); line-height: 1.7;">
                        Jok yang lecet, sobek, dan kusam bikin nilai jual mobil second kamu anjlok. Pembeli langsung nawar lebih murah karena lihat kondisi interior.
                    </p>
                </div>
                {{-- Decorative seat icon --}}
                <div class="shrink-0 hidden md:block" aria-hidden="true">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.18;">
                        <rect x="10" y="40" width="60" height="30" rx="4" stroke="oklch(0.93 0.012 75)" stroke-width="1.5"/>
                        <rect x="18" y="15" width="44" height="32" rx="3" stroke="oklch(0.93 0.012 75)" stroke-width="1.5"/>
                        <line x1="10" y1="55" x2="70" y2="55" stroke="oklch(0.93 0.012 75)" stroke-width="0.75" stroke-dasharray="4 4"/>
                        <circle cx="22" cy="68" r="4" stroke="oklch(0.93 0.012 75)" stroke-width="1.5"/>
                        <circle cx="58" cy="68" r="4" stroke="oklch(0.93 0.012 75)" stroke-width="1.5"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>
</section>




