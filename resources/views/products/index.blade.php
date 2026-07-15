@php
    $bg     = 'oklch(0.12 0.018 55)';
    $surface= 'oklch(0.155 0.022 55)';
    $border = 'oklch(0.22 0.02 55)';
    $inkPri = 'oklch(0.93 0.012 75)';
    $inkSec = 'oklch(0.68 0.022 65)';
    $inkMut = 'oklch(0.50 0.020 62)';
    $gold   = 'oklch(0.67 0.13 66)';
    $goldH  = 'oklch(0.75 0.11 67)';
@endphp
<x-layout title="Katalog Produk Jok PNP — Bengkel Jok Nusantara">
<div class="min-h-screen pt-32 pb-24" style="background: {{ $bg }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-14">
            <p class="font-sans text-xs uppercase tracking-[0.14em] mb-3" style="color: {{ $inkMut }};">
                <a href="{{ route('home') }}" class="hover:underline" style="color: {{ $inkMut }};">Beranda</a>
                <span class="mx-2">›</span> Katalog Produk
            </p>
            <h1 class="font-display font-700 mb-4" style="font-size: clamp(2rem, 4vw, 3.2rem); letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1; text-wrap: balance;">
                Jok Racing PNP.<br>
                <span style="color: {{ $gold }};">Plug &amp; Play,</span> Langsung Pasang.
            </h1>
            <p class="font-sans text-lg max-w-2xl" style="color: {{ $inkSec }};">
                Semua model dirancang agar pas dengan dudukan baut bawaan mobil Anda — tanpa bor, tanpa las, tanpa bengkel tambahan.
            </p>
        </div>

        {{-- Grid Produk --}}
        @if($products->isEmpty())
            <div class="py-24 text-center" style="color: {{ $inkMut }};">
                <p class="text-lg font-semibold">Belum ada produk yang tersedia saat ini.</p>
            </div>
        @else
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
            @foreach($products as $product)
            <a href="{{ route('products.show', $product->slug) }}"
               class="group flex flex-col overflow-hidden transition-all duration-300"
               style="background: {{ $surface }}; border: 1px solid {{ $border }};"
               onmouseover="this.style.borderColor='{{ $gold }}40'"
               onmouseout="this.style.borderColor='{{ $border }}'">

                {{-- Foto --}}
                <div class="aspect-[4/3] bg-black/40 overflow-hidden relative">
                    @if($product->primary_image)
                        <img src="{{ Storage::disk('public')->url($product->primary_image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.03]">
                    @else
                        <div class="w-full h-full flex items-center justify-center font-mono text-sm" style="color: {{ $inkMut }};">
                            Foto belum tersedia
                        </div>
                    @endif

                    {{-- Gallery count badge --}}
                    @if(!empty($product->gallery_images) && count($product->gallery_images) > 0)
                    <div class="absolute bottom-3 right-3 flex items-center gap-1 px-2 py-1 text-[10px] font-bold"
                         style="background: oklch(0.08 0.01 55 / 0.75); color: {{ $inkSec }}; backdrop-filter: blur(4px);">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        +{{ count($product->gallery_images) }}
                    </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-4 sm:p-6 flex-1 flex flex-col">
                    <h2 class="font-display font-700 text-sm sm:text-lg mb-1 leading-tight" style="color: {{ $inkPri }};">
                        {{ $product->name }}
                    </h2>
                    
                    <div class="flex items-center justify-between mt-auto pt-3 sm:pt-4" style="border-top: 1px solid {{ $border }}; margin-top: auto;">
                        <div>
                            <span class="font-sans text-[10px] sm:text-xs uppercase tracking-wider" style="color: {{ $inkMut }};">Mulai dari</span>
                            <p class="font-display font-700 text-sm sm:text-lg leading-tight" style="color: {{ $gold }};">
                                {{ $product->base_price_formatted }}
                            </p>
                        </div>
                        <span class="hidden sm:flex font-sans text-xs font-700 uppercase tracking-wider transition-colors duration-200 items-center gap-1"
                              style="color: {{ $gold }};">
                            Detail
                            <svg class="w-3 h-3 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif

    </div>
</div>
</x-layout>
