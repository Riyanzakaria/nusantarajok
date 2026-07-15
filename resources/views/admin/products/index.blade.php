<x-layout title="Master Produk E-Commerce — Nusantara Jok">
@php
    $bg     = 'oklch(0.12 0.018 55)';
    $surface= 'oklch(0.155 0.022 55)';
    $border = 'oklch(0.22 0.02 55)';
    $inkPri = 'oklch(0.93 0.012 75)';
    $inkSec = 'oklch(0.68 0.022 65)';
    $inkMut = 'oklch(0.50 0.020 62)';
    $gold   = 'oklch(0.67 0.13 66)';
    $goldH  = 'oklch(0.75 0.11 67)';
    $green  = 'oklch(0.72 0.17 142)';
    $red    = 'oklch(0.65 0.22 25)';
@endphp
<div class="min-h-screen pt-32 pb-24 px-4 sm:px-6 lg:px-8" style="background: {{ $bg }}; color: {{ $inkPri }};">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8" style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
            <div>
                <h1 class="font-display font-700 text-3xl" style="letter-spacing: -0.03em;">Master Produk</h1>
                <p class="font-sans text-sm mt-1" style="color: {{ $inkMut }};">Manajemen model jok PNP untuk e-commerce.</p>
            </div>
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 font-sans font-700 text-sm transition-all duration-200"
               style="background: {{ $gold }}; color: oklch(0.12 0.018 55);"
               onmouseover="this.style.background='{{ $goldH }}'" onmouseout="this.style.background='{{ $gold }}'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Produk
            </a>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
        <div class="mb-8 flex items-center gap-3 px-5 py-4 font-sans text-sm font-500" style="background: oklch(0.62 0.14 155 / 0.08); border: 1px solid oklch(0.62 0.14 155 / 0.25); color: oklch(0.62 0.14 155);">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-8 flex items-center gap-3 px-5 py-4 font-sans text-sm font-500" style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.25); color: oklch(0.75 0.18 25);">
            {{ session('error') }}
        </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto" style="border: 1px solid {{ $border }};">
            <table class="w-full text-left font-sans text-sm whitespace-nowrap">
                <thead style="background: {{ $surface }}; border-bottom: 1px solid {{ $border }};">
                    <tr>
                        <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: {{ $inkMut }};">Foto</th>
                        <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: {{ $inkMut }};">Produk</th>
                        <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: {{ $inkMut }};">Harga Dasar</th>
                        <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: {{ $inkMut }};">Gallery</th>
                        <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: {{ $inkMut }};">Status</th>
                        <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider text-right" style="color: {{ $inkMut }};">Aksi</th>
                    </tr>
                </thead>
                <tbody style="background: {{ $bg }};">
                    @forelse($products as $product)
                    <tr style="border-bottom: 1px solid {{ $border }};">
                        <td class="px-6 py-4">
                            @if($product->primary_image)
                                <img src="{{ Storage::disk('public')->url($product->primary_image) }}" alt="Foto"
                                     class="w-14 h-12 object-cover" style="border: 1px solid {{ $border }};">
                            @else
                                <div class="w-14 h-12 flex items-center justify-center text-[10px]"
                                     style="border: 1px dashed {{ $border }}; color: {{ $inkMut }};">No Img</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-700" style="color: {{ $inkPri }};">{{ $product->name }}</div>
                            <div class="text-xs mt-0.5" style="color: {{ $inkMut }};">/produk/{{ $product->slug }}</div>
                        </td>
                        <td class="px-6 py-4 font-mono" style="color: {{ $inkSec }};">
                            Rp {{ number_format($product->base_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            @php $galleryCount = count($product->gallery_images ?? []); @endphp
                            @if($galleryCount > 0)
                                <span class="font-mono text-xs" style="color: {{ $gold }};">{{ $galleryCount }} foto</span>
                            @else
                                <span class="text-xs" style="color: {{ $inkMut }};">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-[10px] font-700 uppercase tracking-widest"
                                  style="{{ $product->is_active ? 'background: oklch(0.62 0.14 155 / 0.1); color: oklch(0.62 0.14 155);' : 'background: oklch(0.60 0.20 25 / 0.1); color: oklch(0.75 0.18 25);' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('products.show', $product->slug) }}" target="_blank"
                               class="text-xs uppercase font-700 mr-4 transition-colors"
                               style="color: {{ $inkMut }};"
                               onmouseover="this.style.color='{{ $inkPri }}'" onmouseout="this.style.color='{{ $inkMut }}'">
                                Lihat
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="text-xs uppercase font-700 mr-4 transition-colors"
                               style="color: {{ $gold }};"
                               onmouseover="this.style.color='{{ $goldH }}'" onmouseout="this.style.color='{{ $gold }}'">
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Hapus produk {{ addslashes($product->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs uppercase font-700 transition-opacity"
                                        style="color: {{ $red }};" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center" style="color: {{ $inkMut }};">
                            Belum ada data produk. <a href="{{ route('admin.products.create') }}" style="color: {{ $gold }};">Tambah produk pertama →</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
</x-layout>
