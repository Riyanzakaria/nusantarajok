{{-- Admin shared design tokens via inline CSS variables --}}
@php
    $bg       = 'oklch(0.12 0.018 55)';
    $bgCard   = 'oklch(0.155 0.022 55)';
    $border   = 'oklch(0.22 0.02 55)';
    $inkPri   = 'oklch(0.93 0.012 75)';
    $inkSec   = 'oklch(0.68 0.022 65)';
    $inkMute  = 'oklch(0.50 0.020 62)';
    $gold     = 'oklch(0.67 0.13 66)';
    $goldHov  = 'oklch(0.75 0.11 67)';
@endphp
<x-layout title="Daftar Harga — Admin BJN">
    <div class="min-h-screen" style="background: {{ $bg }}; padding: 8rem 0 8rem;">
        <div class="max-w-6xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 gap-4"
                 style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
                <div>
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: {{ $inkMute }};">Admin</p>
                    <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1;">Daftar Harga</h1>
                </div>
                <a href="{{ route('dashboard.index') }}"
                   class="inline-flex items-center gap-2 font-sans text-sm font-700 uppercase tracking-wider transition-colors duration-200"
                   style="color: {{ $inkMute }};"
                   onmouseover="this.style.color='{{ $goldHov }}'"
                   onmouseout="this.style.color='{{ $inkMute }}'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
            </div>

            {{-- Flash message --}}
            @if(session('success'))
                <div class="mb-8 flex items-center gap-3 px-5 py-4 font-sans text-sm"
                     style="background: oklch(0.62 0.14 155 / 0.08); border: 1px solid oklch(0.62 0.14 155 / 0.30); color: oklch(0.62 0.14 155);">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- Form panel --}}
                <div class="xl:col-span-4">
                    <div style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; padding: 2rem; position: sticky; top: 7rem;">
                        <h2 class="font-sans font-700 mb-6" style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.12em; color: {{ $inkMute }};">
                            Tambah Item Baru
                        </h2>
                        <form action="{{ route('admin.pricelist.store') }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <div>
                                <label class="block font-sans text-xs uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Kategori Kendaraan</label>
                                <select
                                    name="vehicle_category_id"
                                    required
                                    class="w-full font-sans text-sm px-4 py-3 outline-none transition-colors duration-200"
                                    style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                    onfocus="this.style.borderColor='{{ $gold }}'"
                                    onblur="this.style.borderColor='{{ $border }}'"
                                >
                                    <option value="" style="color: {{ $inkMute }};">— Pilih Kendaraan —</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle_category_id')<p class="mt-1.5 font-sans text-xs" style="color: oklch(0.70 0.18 25);">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block font-sans text-xs uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Nama Item</label>
                                <input
                                    type="text"
                                    name="item_name"
                                    placeholder="Premium Kulit Sintetis"
                                    required
                                    class="w-full font-sans text-sm px-4 py-3 outline-none transition-colors duration-200"
                                    style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                    onfocus="this.style.borderColor='{{ $gold }}'"
                                    onblur="this.style.borderColor='{{ $border }}'"
                                >
                                @error('item_name')<p class="mt-1.5 font-sans text-xs" style="color: oklch(0.70 0.18 25);">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block font-sans text-xs uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Harga (Rp)</label>
                                <input
                                    type="number"
                                    name="price"
                                    placeholder="3500000"
                                    step="0.01"
                                    min="0"
                                    required
                                    class="w-full font-sans text-sm px-4 py-3 outline-none transition-colors duration-200 font-mono"
                                    style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                    onfocus="this.style.borderColor='{{ $gold }}'"
                                    onblur="this.style.borderColor='{{ $border }}'"
                                >
                                @error('price')<p class="mt-1.5 font-sans text-xs" style="color: oklch(0.70 0.18 25);">{{ $message }}</p>@enderror
                            </div>

                            <button
                                type="submit"
                                class="w-full mt-2 font-sans font-700 text-sm uppercase tracking-wider py-3 transition-all duration-200"
                                style="background: {{ $gold }}; color: {{ $bg }}; border: 1px solid {{ $gold }};"
                                onmouseover="this.style.background='{{ $goldHov }}'; this.style.borderColor='{{ $goldHov }}'"
                                onmouseout="this.style.background='{{ $gold }}'; this.style.borderColor='{{ $gold }}'"
                            >
                                Simpan Item
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Table panel --}}
                <div class="xl:col-span-8">
                    <div style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; overflow-x-auto;">
                        {{-- Table header --}}
                        <div class="flex items-center min-w-[700px] gap-px" style="background: {{ $border }};">
                            <div class="flex-1 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em]" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Item &amp; Kendaraan</div>
                            <div class="w-32 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em] text-right" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Harga</div>
                            <div class="w-32 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em] text-right" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Aksi</div>
                        </div>

                        {{-- Rows --}}
                        @forelse($pricelists as $item)
                            <div class="flex items-center min-w-[700px] gap-px"
                                 style="background: {{ $border }}; border-top: 1px solid {{ $border }};"
                                 x-data="{ editing: false }">

                                {{-- View Mode --}}
                                <template x-if="!editing">
                                    <div class="flex-1 px-5 py-4" style="background: {{ $bgCard }};">
                                        <p class="font-sans font-700 text-sm" style="color: {{ $inkPri }};">{{ $item->item_name }}</p>
                                        <p class="font-sans text-xs mt-1" style="color: {{ $inkMute }};">{{ $item->vehicleCategory?->name ?? '—' }}</p>
                                    </div>
                                </template>
                                <template x-if="!editing">
                                    <div class="w-32 px-5 py-4 text-right font-mono text-sm" style="background: {{ $bgCard }}; color: {{ $inkPri }};">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </template>
                                <template x-if="!editing">
                                    <div class="w-32 px-5 py-4 flex items-center justify-end gap-3" style="background: {{ $bgCard }};">
                                        <button @click="editing = true"
                                                class="font-sans text-xs font-700 uppercase tracking-wider transition-colors duration-200"
                                                style="color: {{ $inkSec }};"
                                                onmouseover="this.style.color='{{ $inkPri }}'"
                                                onmouseout="this.style.color='{{ $inkSec }}'"
                                        >Edit</button>
                                        <form action="{{ route('admin.pricelist.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Hapus item ini?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="font-sans text-xs font-700 uppercase tracking-wider transition-colors duration-200"
                                                    style="color: oklch(0.60 0.20 25);"
                                                    onmouseover="this.style.color='oklch(0.70 0.22 25)'"
                                                    onmouseout="this.style.color='oklch(0.60 0.20 25)'"
                                            >Hapus</button>
                                        </form>
                                    </div>
                                </template>

                                {{-- Edit Mode --}}
                                <template x-if="editing">
                                    <div class="w-full px-5 py-4" style="background: {{ $bgCard }};">
                                        <form action="{{ route('admin.pricelist.update', $item) }}" method="POST" class="flex flex-wrap items-end gap-4">
                                            @csrf @method('PUT')
                                            <div class="flex-1 min-w-[200px]">
                                                <label class="block font-sans text-[0.65rem] uppercase tracking-wider mb-1" style="color: {{ $inkMute }};">Nama Item</label>
                                                <input type="text" name="item_name" value="{{ $item->item_name }}" required
                                                       class="w-full font-sans text-sm px-3 py-2 outline-none"
                                                       style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                                       onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
                                            </div>
                                            <div class="w-32">
                                                <label class="block font-sans text-[0.65rem] uppercase tracking-wider mb-1" style="color: {{ $inkMute }};">Kendaraan</label>
                                                <select name="vehicle_category_id" required
                                                        class="w-full font-sans text-sm px-3 py-2 outline-none"
                                                        style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                                        onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
                                                    <option value="" style="color: {{ $inkMute }};">—</option>
                                                    @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}" {{ $item->vehicle_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="w-32">
                                                <label class="block font-sans text-[0.65rem] uppercase tracking-wider mb-1" style="color: {{ $inkMute }};">Harga (Rp)</label>
                                                <input type="number" name="price" value="{{ $item->price }}" step="0.01" min="0" required
                                                       class="w-full font-mono text-sm px-3 py-2 outline-none"
                                                       style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                                       onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button type="submit" class="font-sans text-xs font-700 uppercase tracking-wider px-4 py-2"
                                                        style="background: oklch(0.62 0.14 155); color: {{ $bg }}; border: 1px solid oklch(0.62 0.14 155);"
                                                >Simpan</button>
                                                <button type="button" @click="editing = false" class="font-sans text-xs font-700 uppercase tracking-wider px-4 py-2"
                                                        style="background: transparent; color: {{ $inkMute }}; border: 1px solid {{ $border }};"
                                                >Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </template>

                            </div>
                        @empty
                            <div class="px-6 py-16 text-center" style="background: {{ $bgCard }};">
                                <svg class="w-10 h-10 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $inkMute }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                <p class="font-sans font-700 text-sm mb-1" style="color: {{ $inkPri }};">Belum ada data harga.</p>
                                <p class="font-sans text-xs" style="color: {{ $inkMute }};">Tambahkan item harga pertama dari panel kiri.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>


