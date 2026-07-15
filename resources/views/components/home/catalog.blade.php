@props(['products'])

<section id="katalog" class="py-24" style="background: var(--color-bg);">
    <div class="container mx-auto px-6 max-w-6xl">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-14 gap-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-display font-700 tracking-tight mb-3" style="color: var(--color-heading); letter-spacing: -0.03em;">
                    Katalog <span style="color: var(--color-primary);">Jok Racing PNP</span>
                </h2>
                <p class="font-sans text-base" style="color: oklch(0.68 0.022 65); max-width: 50ch;">
                    Rakit custom, pas dudukan baut bawaan — langsung pasang tanpa modifikasi.
                </p>
            </div>
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 font-sans text-sm font-700 uppercase tracking-wider whitespace-nowrap transition-colors duration-200 shrink-0"
               style="color: var(--color-primary);"
               onmouseover="this.style.opacity='0.75'" onmouseout="this.style.opacity='1'">
                Lihat Semua Produk
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
            <a href="{{ route('products.show', $product->slug) }}"
               class="group flex flex-col overflow-hidden transition-all duration-300"
               style="background: var(--color-surface); border: 1px solid var(--color-border);"
               onmouseover="this.style.borderColor='oklch(0.67 0.13 66 / 0.5)'"
               onmouseout="this.style.borderColor='var(--color-border)'">

                {{-- Foto --}}
                <div class="aspect-[4/3] bg-black/40 overflow-hidden relative">
                    @if($product->primary_image)
                        <img src="{{ Storage::disk('public')->url($product->primary_image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.03]">
                    @else
                        <div class="w-full h-full flex items-center justify-center font-mono text-sm" style="color: oklch(0.50 0.020 62);">
                            Foto segera hadir
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="font-display font-700 text-base mb-1 leading-tight" style="color: var(--color-heading);">
                        {{ $product->name }}
                    </h3>
                    <p class="font-sans text-xs mb-4 flex-1" style="color: oklch(0.68 0.022 65);">
                        Mulai dari <strong style="color: var(--color-primary);">{{ $product->base_price_formatted }}</strong>
                    </p>
                    <span class="font-sans text-xs font-700 uppercase tracking-wider flex items-center gap-1 transition-colors" style="color: var(--color-primary);">
                        Lihat Detail
                        <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>

        @if($products->count() >= 3)
        <div class="mt-10 text-center">
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2.5 px-8 py-4 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-200"
               style="border: 1px solid var(--color-primary); color: var(--color-primary);"
               onmouseover="this.style.background='oklch(0.67 0.13 66)'; this.style.color='oklch(0.12 0.018 55)'"
               onmouseout="this.style.background='transparent'; this.style.color='var(--color-primary)'">
                Lihat Semua Produk
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
        @endif

    </div>
</section>
