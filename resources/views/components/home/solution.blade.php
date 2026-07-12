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
                    Keunggulan Jok<br>Racing PNP.
                </h2>

                <p
                    class="font-sans mb-12"
                    style="font-size: 1.0625rem; line-height: 1.75; color: oklch(0.72 0.025 68); max-width: 44ch; transition: opacity 0.8s 0.12s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1 } : { opacity: 0 }"
                >
                    Dibuat khusus untuk kamu yang menginginkan interior sporty dan pemasangan instan. Jok komplit dikirim dalam bentuk utuh (lengkap dengan rangka) — siap pasang dalam hitungan menit.
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
                            <h3 class="font-sans font-700 mb-1.5" style="font-size: 1rem; color: oklch(0.93 0.012 75);">100% Plug and Play (PNP)</h3>
                            <p class="font-sans text-sm leading-relaxed" style="color: oklch(0.72 0.025 68);">Kami mengirimkan satu set jok utuh komplit dengan rangkanya. Tinggal copot jok lama, lalu pasang (baut) jok racing PNP ini di titik dudukan asli mobilmu.</p>
                        </div>
                    </li>
                    <li style="border-top: 1px solid oklch(0.22 0.02 55); padding: 1.5rem 0; display: flex; gap: 1.5rem; align-items: flex-start;">
                        <span class="font-display font-700 shrink-0" style="font-size: 1.25rem; color: oklch(0.67 0.13 66); line-height: 1; margin-top: 2px;">02</span>
                        <div>
                            <h3 class="font-sans font-700 mb-1.5" style="font-size: 1rem; color: oklch(0.93 0.012 75);">Desain Racing Sporty Premium</h3>
                            <p class="font-sans text-sm leading-relaxed" style="color: oklch(0.72 0.025 68);">Tingkatkan estetika interior dengan jok utuh bergaya bucket-seat. Material premium yang empuk dan rangka kokoh untuk pemakaian harian.</p>
                        </div>
                    </li>
                    <li style="border-top: 1px solid oklch(0.22 0.02 55); border-bottom: 1px solid oklch(0.22 0.02 55); padding: 1.5rem 0; display: flex; gap: 1.5rem; align-items: flex-start;">
                        <span class="font-display font-700 shrink-0" style="font-size: 1.25rem; color: oklch(0.67 0.13 66); line-height: 1; margin-top: 2px;">03</span>
                        <div>
                            <h3 class="font-sans font-700 mb-1.5" style="font-size: 1rem; color: oklch(0.93 0.012 75);">Tanpa Merusak Jok Asli (Aman Dijual)</h3>
                            <p class="font-sans text-sm leading-relaxed" style="color: oklch(0.72 0.025 68);">Simpan jok ori bawaan pabrikmu dengan aman di gudang. Jika suatu saat mobil ingin dijual, cukup pasang kembali jok orinya, dan interior mobil kembali 100% standar pabrik.</p>
                        </div>
                    </li>
                </ol>

                {{-- Benefit highlights --}}
                <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4"
                     style="transition: opacity 0.8s 0.35s cubic-bezier(0.16,1,0.3,1);"
                     :style="shown ? { opacity: 1 } : { opacity: 0 }">
                    <div class="p-4" style="background: oklch(0.67 0.13 66 / 0.07); border: 1px solid oklch(0.67 0.13 66 / 0.20);">
                        <p class="font-sans font-700 text-sm mb-1" style="color: oklch(0.75 0.11 67);">Pasang di Rumah</p>
                        <p class="font-sans text-xs" style="color: oklch(0.50 0.020 62);">Hemat waktu & bebas repot</p>
                    </div>
                    <div class="p-4" style="background: oklch(0.67 0.13 66 / 0.07); border: 1px solid oklch(0.67 0.13 66 / 0.20);">
                        <p class="font-sans font-700 text-sm mb-1" style="color: oklch(0.75 0.11 67);">Tampilan Sporty</p>
                        <p class="font-sans text-xs" style="color: oklch(0.50 0.020 62);">Kabin lebih mewah</p>
                    </div>
                    <div class="p-4" style="background: oklch(0.67 0.13 66 / 0.07); border: 1px solid oklch(0.67 0.13 66 / 0.20);">
                        <p class="font-sans font-700 text-sm mb-1" style="color: oklch(0.75 0.11 67);">Jok Asli Aman</p>
                        <p class="font-sans text-xs" style="color: oklch(0.50 0.020 62);">Tidak robek, simpan di gudang</p>
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
                        src="{{ asset('images/workshop_jok.jpg') }}"
                        alt="Gudang stok cover jok mobil Bengkel Jok Nusantara Magetan — ratusan pilihan warna dan model"
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
                        <p class="font-sans font-700 text-sm" style="color: oklch(0.93 0.012 75);">Kustomisasi Penuh & Dikirim Ke Rumah</p>
                        <p class="font-sans text-xs mt-1 leading-relaxed" style="color: oklch(0.50 0.020 62);">Pesan jok racing komplit (lengkap dengan rangka). Pilih warna favoritmu, dan kami kirim langsung dalam bentuk utuh siap pasang.</p>
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




