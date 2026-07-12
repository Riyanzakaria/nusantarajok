<section
    class="relative overflow-hidden"
    id="solusi"
    style="padding: 7rem 0 8rem; background: oklch(0.12 0.018 55); border-top: 1px solid oklch(0.22 0.02 55);"
>
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 xl:gap-24 items-start">

            {{-- Left: Text content --}}
            <div
                x-data="{ shown: false }"
                x-intersect.once.margin.-10%.0px="shown = true"
            >
                <h2
                    class="font-display font-700 mb-8"
                    style="font-size: clamp(2rem, 4vw, 3.5rem); line-height: 1.04; letter-spacing: -0.03em; color: oklch(0.93 0.012 75); text-wrap: balance; transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(24px)' }"
                >
                    Keunggulan Jok<br>Nusantara.
                </h2>

                <p
                    class="font-sans mb-12"
                    style="font-size: 1.0625rem; line-height: 1.75; color: oklch(0.72 0.025 68); max-width: 44ch; transition: opacity 0.8s 0.12s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1 } : { opacity: 0 }"
                >
                    Dibuat khusus untuk kondisi jalan dan cuaca Indonesia. Pas buat Avanza, Innova, Xenia, Brio, Calya, Rush, Ertiga, dan masih banyak lagi — dengan pemasangan semi paten dan paten.
                </p>

                {{-- Feature list from copywriting brief --}}
                <ol
                    class="space-y-0"
                    style="transition: opacity 0.8s 0.22s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1 } : { opacity: 0 }"
                >
                    <li style="border-top: 1px solid oklch(0.22 0.02 55); padding: 1.5rem 0; display: flex; gap: 1.5rem; align-items: flex-start;">
                        <span class="font-display font-700 shrink-0" style="font-size: 1.25rem; color: oklch(0.67 0.13 66); line-height: 1; margin-top: 2px;">01</span>
                        <div>
                            <h3 class="font-sans font-700 mb-1.5" style="font-size: 1rem; color: oklch(0.93 0.012 75);">Bahan Premium Double Layer</h3>
                            <p class="font-sans text-sm leading-relaxed" style="color: oklch(0.72 0.025 68);">Kuat, anti sobek, jahitan rapi. Nggak molor walau didudukin tiap hari — tahan lama untuk kondisi pemakaian berat sekalipun.</p>
                        </div>
                    </li>
                    <li style="border-top: 1px solid oklch(0.22 0.02 55); padding: 1.5rem 0; display: flex; gap: 1.5rem; align-items: flex-start;">
                        <span class="font-display font-700 shrink-0" style="font-size: 1.25rem; color: oklch(0.67 0.13 66); line-height: 1; margin-top: 2px;">02</span>
                        <div>
                            <h3 class="font-sans font-700 mb-1.5" style="font-size: 1rem; color: oklch(0.93 0.012 75);">Water Resistant</h3>
                            <p class="font-sans text-sm leading-relaxed" style="color: oklch(0.72 0.025 68);">Tumpah kopi, air mineral, ompol anak? Tinggal lap — nggak langsung nyerap ke busa jok. Bebas was-was tiap hari.</p>
                        </div>
                    </li>
                    <li style="border-top: 1px solid oklch(0.22 0.02 55); border-bottom: 1px solid oklch(0.22 0.02 55); padding: 1.5rem 0; display: flex; gap: 1.5rem; align-items: flex-start;">
                        <span class="font-display font-700 shrink-0" style="font-size: 1.25rem; color: oklch(0.67 0.13 66); line-height: 1; margin-top: 2px;">03</span>
                        <div>
                            <h3 class="font-sans font-700 mb-1.5" style="font-size: 1rem; color: oklch(0.93 0.012 75);">Model Universal Nusantara</h3>
                            <p class="font-sans text-sm leading-relaxed" style="color: oklch(0.72 0.025 68);">Pas buat hampir semua jenis mobil. Jok ori kamu tetap awet, nggak lecet, nggak kotor — nilai jual mobil second tetap tinggi.</p>
                        </div>
                    </li>
                </ol>

                {{-- Benefit highlights --}}
                <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4"
                     style="transition: opacity 0.8s 0.35s cubic-bezier(0.16,1,0.3,1);"
                     :style="shown ? { opacity: 1 } : { opacity: 0 }">
                    <div class="p-4" style="background: oklch(0.67 0.13 66 / 0.07); border: 1px solid oklch(0.67 0.13 66 / 0.20);">
                        <p class="font-sans font-700 text-sm mb-1" style="color: oklch(0.75 0.11 67);">Jok Ori Awet</p>
                        <p class="font-sans text-xs" style="color: oklch(0.50 0.020 62);">Nggak lecet, nggak kotor</p>
                    </div>
                    <div class="p-4" style="background: oklch(0.67 0.13 66 / 0.07); border: 1px solid oklch(0.67 0.13 66 / 0.20);">
                        <p class="font-sans font-700 text-sm mb-1" style="color: oklch(0.75 0.11 67);">Harga Jual Tinggi</p>
                        <p class="font-sans text-xs" style="color: oklch(0.50 0.020 62);">Nilai mobil second tetap bagus</p>
                    </div>
                    <div class="p-4" style="background: oklch(0.67 0.13 66 / 0.07); border: 1px solid oklch(0.67 0.13 66 / 0.20);">
                        <p class="font-sans font-700 text-sm mb-1" style="color: oklch(0.75 0.11 67);">Kabin Lebih Adem</p>
                        <p class="font-sans text-xs" style="color: oklch(0.50 0.020 62);">Nyaman di cuaca Indonesia</p>
                    </div>
                </div>
            </div>

            {{-- Right: Image --}}
            <div
                class="relative"
                x-data="{ shown: false }"
                x-intersect.once.margin.-10%.0px="shown = true"
            >
                <div
                    class="overflow-hidden"
                    style="aspect-ratio: 4/5; transition: opacity 0.9s 0.2s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1 } : { opacity: 0 }"
                >
                    <img
                        src="{{ asset('images/testimonials/customer_1.png') }}"
                        alt="Proses pengerjaan jok mobil di Bengkel Jok Nusantara Magetan"
                        class="w-full h-full object-cover"
                        style="filter: contrast(1.04) saturate(0.85);"
                    >
                </div>

                <div
                    class="mt-5 flex items-start gap-4"
                    style="transition: opacity 0.8s 0.45s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1 } : { opacity: 0 }"
                >
                    <div style="width: 2px; height: 2.5rem; background: oklch(0.67 0.13 66); flex-shrink: 0; margin-top: 3px;"></div>
                    <div>
                        <p class="font-sans font-700 text-sm" style="color: oklch(0.93 0.012 75);">Dikerjakan di Magetan, Jawa Timur</p>
                        <p class="font-sans text-xs mt-1 leading-relaxed" style="color: oklch(0.50 0.020 62);">Ratusan mobil sudah dikerjakan. Pemasangan semi paten dan paten tersedia.</p>
                    </div>
                </div>

                {{-- Material swatches --}}
                <div
                    class="mt-8"
                    style="transition: opacity 0.8s 0.55s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1 } : { opacity: 0 }"
                >
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-4" style="color: oklch(0.50 0.020 62);">Pilihan Warna</p>
                    <div class="flex items-center gap-3">
                        <div class="group flex flex-col items-center gap-1.5">
                            <div class="w-10 h-10 cursor-pointer transition-transform duration-200 group-hover:scale-110"
                                 style="background: oklch(0.25 0.05 55); border: 1px solid oklch(0.35 0.03 55);" title="Hitam"></div>
                            <span class="font-sans text-[0.6rem] uppercase tracking-wider" style="color: oklch(0.38 0.03 60);">Hitam</span>
                        </div>
                        <div class="group flex flex-col items-center gap-1.5">
                            <div class="w-10 h-10 cursor-pointer transition-transform duration-200 group-hover:scale-110"
                                 style="background: oklch(0.42 0.07 55); border: 1px solid oklch(0.50 0.04 55);" title="Cokelat Tua"></div>
                            <span class="font-sans text-[0.6rem] uppercase tracking-wider" style="color: oklch(0.38 0.03 60);">Cokelat</span>
                        </div>
                        <div class="group flex flex-col items-center gap-1.5">
                            <div class="w-10 h-10 cursor-pointer transition-transform duration-200 group-hover:scale-110"
                                 style="background: oklch(0.67 0.13 66); border: 1px solid oklch(0.75 0.11 67);" title="Cognac"></div>
                            <span class="font-sans text-[0.6rem] uppercase tracking-wider" style="color: oklch(0.38 0.03 60);">Cognac</span>
                        </div>
                        <div class="group flex flex-col items-center gap-1.5">
                            <div class="w-10 h-10 cursor-pointer transition-transform duration-200 group-hover:scale-110"
                                 style="background: oklch(0.78 0.03 80); border: 1px solid oklch(0.70 0.03 80);" title="Krem"></div>
                            <span class="font-sans text-[0.6rem] uppercase tracking-wider" style="color: oklch(0.38 0.03 60);">Krem</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




