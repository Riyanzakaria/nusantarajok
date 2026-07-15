@php
    $bg     = 'oklch(0.12 0.018 55)';
    $surface= 'oklch(0.155 0.022 55)';
    $border = 'oklch(0.22 0.02 55)';
    $inkPri = 'oklch(0.93 0.012 75)';
    $inkSec = 'oklch(0.68 0.022 65)';
    $inkMut = 'oklch(0.50 0.020 62)';
    $gold   = 'oklch(0.67 0.13 66)';
    $goldH  = 'oklch(0.75 0.11 67)';

    // Build all images for gallery (primary + gallery_images)
    $allImages = [];
    if ($product->primary_image) {
        $allImages[] = $product->primary_image;
    }
    foreach ($product->gallery_images ?? [] as $img) {
        $allImages[] = $img;
    }
@endphp
<x-layout title="{{ $product->name }} — Bengkel Jok Nusantara">
<div class="min-h-screen pt-32 pb-24" style="background: {{ $bg }};" x-data="gallery({{ count($allImages) }})">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <p class="font-sans text-xs uppercase tracking-[0.14em] mb-10" style="color: {{ $inkMut }};">
            <a href="{{ route('home') }}" class="hover:underline" style="color: {{ $inkMut }};">Beranda</a>
            <span class="mx-2">›</span>
            <a href="{{ route('products.index') }}" class="hover:underline" style="color: {{ $inkMut }};">Produk</a>
            <span class="mx-2">›</span>
            <span style="color: {{ $inkSec }};">{{ $product->name }}</span>
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">

            {{-- LEFT: Gallery --}}
            <div class="lg:col-span-7">

                {{-- Main Photo --}}
                <div class="aspect-[4/3] overflow-hidden mb-3 relative" style="background: oklch(0.09 0.012 55);">
                    @if(count($allImages) > 0)
                        @foreach($allImages as $i => $img)
                        <img src="{{ Storage::disk('public')->url($img) }}"
                             alt="{{ $product->name }} — foto {{ $i + 1 }}"
                             class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300"
                             :class="active === {{ $i }} ? 'opacity-100' : 'opacity-0'">
                        @endforeach
                    @else
                        <div class="w-full h-full flex items-center justify-center font-mono text-sm" style="color: {{ $inkMut }};">
                            Foto belum tersedia
                        </div>
                    @endif

                    {{-- Nav arrows (only when > 1 image) --}}
                    @if(count($allImages) > 1)
                    <button @click="prev()" class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center transition"
                            style="background: oklch(0.08 0.01 55 / 0.7); color: {{ $inkPri }}; backdrop-filter: blur(4px);"
                            onmouseover="this.style.background='oklch(0.67 0.13 66 / 0.85)'"
                            onmouseout="this.style.background='oklch(0.08 0.01 55 / 0.7)'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button @click="next()" class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center transition"
                            style="background: oklch(0.08 0.01 55 / 0.7); color: {{ $inkPri }}; backdrop-filter: blur(4px);"
                            onmouseover="this.style.background='oklch(0.67 0.13 66 / 0.85)'"
                            onmouseout="this.style.background='oklch(0.08 0.01 55 / 0.7)'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>

                    {{-- Counter --}}
                    <div class="absolute bottom-3 right-3 px-2.5 py-1 text-xs font-bold font-mono"
                         style="background: oklch(0.08 0.01 55 / 0.7); color: {{ $inkSec }}; backdrop-filter: blur(4px);"
                         x-text="(active + 1) + ' / {{ count($allImages) }}'"></div>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if(count($allImages) > 1)
                <div class="flex gap-2 flex-wrap">
                    @foreach($allImages as $i => $img)
                    <button @click="active = {{ $i }}"
                            class="w-16 h-16 sm:w-20 sm:h-20 overflow-hidden transition-all duration-150 shrink-0"
                            :style="active === {{ $i }} ? 'border: 2px solid {{ $gold }};' : 'border: 2px solid transparent; opacity: 0.5;'">
                        <img src="{{ Storage::disk('public')->url($img) }}"
                             alt="Thumbnail {{ $i + 1 }}"
                             class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif

            </div>

            {{-- RIGHT: Info & CTA --}}
            <div class="lg:col-span-5 flex flex-col">
                <div class="mb-8">
                    <h1 class="font-display font-700 mb-4 leading-tight" style="font-size: clamp(2rem, 3.5vw, 2.75rem); letter-spacing: -0.03em; color: {{ $inkPri }}; text-wrap: balance;">
                        {{ $product->name }}
                    </h1>

                    <div class="inline-flex flex-col">
                        <span class="font-sans text-xs uppercase tracking-[0.1em]" style="color: {{ $inkMut }};">Mulai dari</span>
                        <p class="font-display font-700 leading-none mt-1.5" style="font-size: clamp(2.25rem, 4vw, 3rem); color: {{ $gold }}; letter-spacing: -0.02em;">
                            {{ $product->base_price_formatted }}
                        </p>
                    </div>
                </div>

                <div class="mb-10 pt-8" style="border-top: 1px solid {{ $border }}; border-bottom: 1px solid {{ $border }}; padding-bottom: 2rem;">
                    <h2 class="font-sans text-xs font-700 uppercase tracking-wider mb-4" style="color: {{ $inkMut }};">Tentang Produk</h2>
                    <div class="font-sans text-base sm:text-lg leading-relaxed space-y-4" style="color: {{ $inkSec }}; max-width: 65ch;">
                        {!! nl2br(e($product->description ?? 'Jok racing kustom dengan desain premium. Sistem Plug and Play (PNP) dirancang presisi untuk dudukan baut asli bawaan mobil Anda, tanpa perlu modifikasi tambahan.')) !!}
                    </div>
                </div>

                {{-- Key Features --}}
                <div class="mb-10 space-y-4">
                    @foreach([
                        ['icon' => 'M5 13l4 4L19 7', 'text' => '<strong style="color: '.$inkPri.'">Plug & Play</strong> — Pas dudukan baut bawaan mobil, tanpa bor atau las.'],
                        ['icon' => 'M5 13l4 4L19 7', 'text' => '<strong style="color: '.$inkPri.'">Kustomisasi Penuh</strong> — Bebas pilih warna material dan benang jahitan.'],
                        ['icon' => 'M5 13l4 4L19 7', 'text' => '<strong style="color: '.$inkPri.'">Fleksibel</strong> — Tersedia untuk pesanan 1 baris, 2 baris, atau full set.'],
                        ['icon' => 'M5 13l4 4L19 7', 'text' => '<strong style="color: '.$inkPri.'">Pengiriman Aman</strong> — Pengerjaan 7–14 hari kerja, dikirim via kargo ke seluruh Indonesia.'],
                    ] as $f)
                    <div class="flex items-start gap-4">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 mt-0.5" style="background: oklch(0.67 0.13 66 / 0.15);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $gold }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $f['icon'] }}"/></svg>
                        </div>
                        <span class="font-sans text-[15px] leading-relaxed" style="color: {{ $inkSec }};">{!! $f['text'] !!}</span>
                    </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <div class="mt-auto space-y-4 sticky bottom-4 z-10 p-4 lg:p-0 rounded-2xl lg:rounded-none" style="background: {{ $bg }}; border: 1px solid {{ $border }}; lg:border: none;">
                    <a href="{{ route('checkout.create', ['product' => $product->slug]) }}"
                       class="flex items-center justify-center gap-3 w-full py-4 sm:py-5 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-300 shadow-lg rounded-lg lg:rounded-none lg:shadow-none"
                       style="background: {{ $gold }}; color: oklch(0.12 0.018 55);"
                       onmouseover="this.style.background='{{ $goldH }}'; this.style.transform='translateY(-2px)'"
                       onmouseout="this.style.background='{{ $gold }}'; this.style.transform='translateY(0)'">
                        Mulai Pesan Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('gallery', (total) => ({
        active: 0,
        total: total,
        next() { this.active = (this.active + 1) % this.total; },
        prev() { this.active = (this.active - 1 + this.total) % this.total; },
    }));
});
</script>
@endpush
</x-layout>
