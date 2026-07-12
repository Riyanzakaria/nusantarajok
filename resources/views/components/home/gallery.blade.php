@props(['featuredGalleries' => []])

<section
    class="relative overflow-hidden"
    id="gallery"
    style="padding: 7rem 0 8rem; background: oklch(0.155 0.022 55); border-top: 1px solid oklch(0.22 0.02 55);"
>
    <div class="container mx-auto px-6 max-w-7xl">

        {{-- Header — no eyebrow, direct --}}
        <div
            class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-8"
            x-data="{ shown: false }"
            x-intersect.once.margin.-10%.0px="shown = true"
        >
            <div>
                <h2
                    class="font-display font-700"
                    style="font-size: clamp(1.8rem, 4vw, 3.2rem); line-height: 1.04; letter-spacing: -0.03em; color: oklch(0.93 0.012 75); text-wrap: balance; transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1, transform: 'translateY(0)' } : { opacity: 0, transform: 'translateY(20px)' }"
                >
                    Hasil Pekerjaan Kami.
                </h2>
                <p
                    class="font-sans mt-4"
                    style="font-size: 1rem; color: oklch(0.72 0.025 68); max-width: 44ch; line-height: 1.7; transition: opacity 0.8s 0.1s cubic-bezier(0.16,1,0.3,1);"
                    :style="shown ? { opacity: 1 } : { opacity: 0 }"
                >
                    Bukti nyata dedikasi pada kualitas — dari berbagai kelas kendaraan.
                </p>
            </div>
            <div
                style="transition: opacity 0.8s 0.2s cubic-bezier(0.16,1,0.3,1);"
                :style="shown ? { opacity: 1 } : { opacity: 0 }"
            >
                <a
                    href="{{ route('gallery.index') }}"
                    class="touch-target inline-flex items-center gap-2.5 px-6 py-3 font-sans font-700 text-xs uppercase tracking-wider transition-all duration-250"
                    style="color: oklch(0.67 0.13 66); border: 1px solid oklch(0.38 0.03 60);"
                    onmouseover="this.style.borderColor='oklch(0.67 0.13 66)'; this.style.background='oklch(0.67 0.13 66 / 0.08)'"
                    onmouseout="this.style.borderColor='oklch(0.38 0.03 60)'; this.style.background='transparent'"
                >
                    Lihat Semua Galeri
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        {{-- Gallery Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px" style="background: oklch(0.22 0.02 55);">
            @forelse($featuredGalleries as $index => $gallery)
                @php
                    $colSpan = ($index === 0 && count($featuredGalleries) % 2 !== 0) ? 'lg:col-span-2' : '';
                @endphp
                <div
                    x-data="{ shown: false }"
                    x-intersect.once.margin.-10%.0px="shown = true"
                    class="group {{ $colSpan }} overflow-hidden relative"
                    style="background: oklch(0.12 0.018 55);"
                >
                    <div
                        class="relative overflow-hidden"
                        style="height: 20rem; opacity: 0; transform: scale(1.03); transition: opacity 0.85s cubic-bezier(0.16,1,0.3,1), transform 0.85s cubic-bezier(0.16,1,0.3,1); transition-delay: {{ $index * 80 }}ms;"
                        :style="shown ? { opacity: 1, transform: 'scale(1)' } : {}"
                    >
                        <img
                            src="{{ asset($gallery->image_url) }}"
                            alt="{{ $gallery->title }}"
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-700"
                            style="filter: saturate(0.85) contrast(1.05);"
                            onmouseover="this.style.transform='scale(1.04)'"
                            onmouseout="this.style.transform='scale(1)'"
                        >

                        {{-- Bottom caption — always visible, no hover-gate --}}
                        <div
                            class="absolute bottom-0 left-0 right-0 px-6 py-4"
                            style="background: linear-gradient(to top, oklch(0.12 0.018 55 / 0.95) 0%, transparent 100%);"
                        >
                            <h3 class="font-sans font-700 text-sm" style="color: oklch(0.93 0.012 75);">{{ $gallery->title ?? 'Modifikasi Jok' }}</h3>
                            @if($gallery->category)
                                <p class="font-sans text-xs mt-0.5 uppercase tracking-wider" style="color: oklch(0.67 0.13 66);">{{ $gallery->category->name }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 flex flex-col items-center justify-center" style="background: oklch(0.12 0.018 55);">
                    <div style="width: 1px; height: 3rem; background: oklch(0.28 0.025 55); margin-bottom: 1.5rem;"></div>
                    <p class="font-sans text-sm" style="color: oklch(0.38 0.03 60);">Belum ada galeri yang ditampilkan.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>




