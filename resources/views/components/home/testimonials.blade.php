<section
    class="relative overflow-hidden"
    id="testimoni"
    style="padding: 7rem 0 8rem; background: oklch(0.12 0.018 55); border-top: 1px solid oklch(0.22 0.02 55);"
>
    <div class="container mx-auto px-6 max-w-6xl">

        {{-- Header — no eyebrow --}}
        <div
            class="mb-14"
            x-data="{ shown: false }"
            x-intersect.once.margin.-10%.0px="shown = true"
        >
            <h2
                class="font-display font-700"
                style="font-size: clamp(2rem, 4.5vw, 3.5rem); line-height: 1.04; letter-spacing: -0.03em; color: oklch(0.93 0.012 75); text-wrap: balance; transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);"
                :style="shown ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(20px)' }"
            >
                Kata Mereka di <span style="color: oklch(0.67 0.13 66);">Google.</span>
            </h2>
            <p
                class="font-sans mt-4 flex items-center gap-2"
                style="font-size: 1rem; color: oklch(0.72 0.025 68); max-width: 44ch; line-height: 1.7; transition: opacity 0.8s 0.1s cubic-bezier(0.16,1,0.3,1);"
                :style="shown ? { opacity: 1 } : { opacity: 0 }"
            >
                Ratusan pelanggan puas dengan hasil pengerjaan kami.
                <span class="flex items-center" style="color: #FBBC04;">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span class="text-sm font-700 ml-1 font-mono" style="color: oklch(0.93 0.012 75);">5.0</span>
                </span>
            </p>
        </div>

        {{-- Editorial layout: 1 featured + 2 smaller --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-px" style="background: oklch(0.22 0.02 55);">

            {{-- Featured testimonial — full column --}}
            <div
                class="md:col-span-7 p-10 md:p-14 flex flex-col justify-between"
                style="background: oklch(0.10 0.015 55);"
                x-data="{ shown: false }"
                x-intersect.once.margin.-10%.0px="shown = true"
            >
                <div
                    style="transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1 } : { opacity: 0 }"
                >
                    <div class="flex items-center gap-1 mb-8" style="color: #FBBC04;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    
                    <blockquote class="font-sans mb-10" style="font-size: 1.25rem; line-height: 1.65; color: oklch(0.88 0.01 75); font-style: normal; font-weight: 400; max-width: 36ch;">
                        Cover joknya sngt presisi, jahitannya rapi, sangat rekomendasi untuk kalian yg ingin ganti cover jok yg sudah usang atau untuk melindungi cover jok mobil kalian.👍🏻
                    </blockquote>
                    <div class="flex items-end justify-between gap-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-display font-700 text-lg" style="background: oklch(0.22 0.02 55); color: oklch(0.93 0.012 75);">D</div>
                            <div>
                                <p class="font-sans font-700 text-sm" style="color: oklch(0.93 0.012 75);">Dhika _Kuchil</p>
                                <p class="font-sans text-xs mt-1 uppercase tracking-wider flex items-center gap-2" style="color: oklch(0.50 0.020 62);">
                                    setahun lalu
                                    <span style="color: oklch(0.28 0.025 55);">|</span>
                                    <span style="color: #4285F4; text-transform: none;" class="font-700">Google</span>
                                </p>
                            </div>
                        </div>
                        <div style="width: 3rem; height: 1px; background: oklch(0.67 0.13 66);"></div>
                    </div>
                </div>
            </div>

            {{-- Right column: 2 smaller --}}
            <div class="md:col-span-5 flex flex-col gap-px" style="background: oklch(0.22 0.02 55);">

                {{-- Testimonial 2 --}}
                <div
                    class="flex-1 p-8 md:p-10 flex flex-col justify-between"
                    style="background: oklch(0.14 0.020 55);"
                    x-data="{ shown: false }"
                    x-intersect.once.margin.-10%.0px="shown = true"
                >
                    <div
                        style="transition: opacity 0.8s 0.1s cubic-bezier(0.16,1,0.3,1);"
                        :style="shown ? { opacity: 1 } : { opacity: 0 }"
                    >
                        <div class="flex items-center gap-1 mb-5" style="color: #FBBC04;">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <blockquote class="font-sans font-400 mb-8" style="font-size: 0.95rem; line-height: 1.7; color: oklch(0.72 0.025 68); font-style: italic;">
                            &ldquo;Pelayanan ramah, sabar juga menghadapi kita yg bawel soal bahan dan pilihan warna, cs nya GK cemberut n jutek kita mintain contoh bahan, good service&rdquo;
                        </blockquote>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-display font-700 text-xs" style="background: oklch(0.22 0.02 55); color: oklch(0.93 0.012 75);">G</div>
                            <div>
                                <p class="font-sans font-700 text-sm" style="color: oklch(0.93 0.012 75);">Gatauakugabut</p>
                                <p class="font-sans text-[10px] mt-0.5 uppercase tracking-wider" style="color: oklch(0.50 0.020 62);">4 bulan lalu &bull; <span style="color: #4285F4; text-transform: none; font-weight: bold;">Google</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 3 --}}
                <div
                    class="flex-1 p-8 md:p-10 flex flex-col justify-between"
                    style="background: oklch(0.155 0.022 55);"
                    x-data="{ shown: false }"
                    x-intersect.once.margin.-10%.0px="shown = true"
                >
                    <div
                        style="transition: opacity 0.8s 0.18s cubic-bezier(0.16,1,0.3,1);"
                        :style="shown ? { opacity: 1 } : { opacity: 0 }"
                    >
                        <div class="flex items-center gap-1 mb-5" style="color: #FBBC04;">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <blockquote class="font-sans font-400 mb-8" style="font-size: 0.95rem; line-height: 1.7; color: oklch(0.72 0.025 68); font-style: italic;">
                            &ldquo;Puas banget dengan hasilnya.jahitan sangat rapi dan presisi. Cover jok kelihatan lebih elegan. Mantab pokoknya.&rdquo;
                        </blockquote>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-display font-700 text-xs" style="background: oklch(0.22 0.02 55); color: oklch(0.93 0.012 75);">F</div>
                            <div>
                                <p class="font-sans font-700 text-sm" style="color: oklch(0.93 0.012 75);">Fariz kim</p>
                                <p class="font-sans text-[10px] mt-0.5 uppercase tracking-wider" style="color: oklch(0.50 0.020 62);">setahun lalu &bull; <span style="color: #4285F4; text-transform: none; font-weight: bold;">Google</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
