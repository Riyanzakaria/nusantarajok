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
<x-layout title="Kategori Kendaraan — Admin BJN">
    <div class="min-h-screen" style="background: {{ $bg }}; padding: 8rem 0 8rem;">
        <div class="max-w-6xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 gap-4"
                 style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
                <div>
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: {{ $inkMute }};">Admin</p>
                    <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1;">Kategori Kendaraan (Pricelist)</h1>
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

            @if(session('error'))
                <div class="mb-8 flex items-center gap-3 px-5 py-4 font-sans text-sm"
                     style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.30); color: oklch(0.60 0.20 25);">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- Form panel --}}
                <div class="lg:col-span-4">
                    <div style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; padding: 2rem; position: sticky; top: 7rem;">
                        <h2 class="font-sans font-700 mb-6" style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.12em; color: {{ $inkMute }};">
                            Tambah Kategori
                        </h2>
                        <form action="{{ route('admin.vehicle-categories.store') }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <div>
                                <label class="block font-sans text-xs uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Kapasitas Baris/Jenis</label>
                                <input
                                    type="text"
                                    name="name"
                                    placeholder="cth: 2 Baris, 3 Baris, Pick Up"
                                    required
                                    class="w-full font-sans text-sm px-4 py-3 outline-none transition-colors duration-200"
                                    style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                    onfocus="this.style.borderColor='{{ $gold }}'"
                                    onblur="this.style.borderColor='{{ $border }}'"
                                >
                                @error('name')<p class="mt-1.5 font-sans text-xs" style="color: oklch(0.70 0.18 25);">{{ $message }}</p>@enderror
                            </div>
                            <button
                                type="submit"
                                class="w-full font-sans font-700 text-sm uppercase tracking-wider py-3 transition-all duration-200"
                                style="background: {{ $gold }}; color: {{ $bg }}; border: 1px solid {{ $gold }};"
                                onmouseover="this.style.background='{{ $goldHov }}'; this.style.borderColor='{{ $goldHov }}'"
                                onmouseout="this.style.background='{{ $gold }}'; this.style.borderColor='{{ $gold }}'"
                            >
                                Simpan Kategori
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Table panel --}}
                <div class="lg:col-span-8">
                    <div style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; overflow: hidden;">
                        {{-- Table header --}}
                        <div class="grid grid-cols-12 gap-px" style="background: {{ $border }};">
                            <div class="col-span-5 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em]" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Nama</div>
                            <div class="col-span-5 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em] hidden sm:block" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Slug</div>
                            <div class="col-span-2 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em] text-right" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Aksi</div>
                        </div>

                        {{-- Rows --}}
                        @forelse($categories as $category)
                            <div class="grid grid-cols-12 gap-px" style="background: {{ $border }}; border-top: 1px solid {{ $border }};">
                                <div class="col-span-5 px-5 py-4 font-sans font-700 text-sm" style="background: {{ $bgCard }}; color: {{ $inkPri }};">{{ $category->name }}</div>
                                <div class="col-span-5 px-5 py-4 font-mono text-xs hidden sm:block" style="background: {{ $bgCard }}; color: {{ $inkMute }};">{{ $category->slug }}</div>
                                <div class="col-span-2 px-5 py-4 text-right" style="background: {{ $bgCard }};">
                                    <form action="{{ route('admin.vehicle-categories.destroy', $category) }}" method="POST"
                                          onsubmit="return confirm('Hapus kategori ini? Pastikan tidak ada data pricelist yang menggunakannya.');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="font-sans text-xs font-700 uppercase tracking-wider transition-colors duration-200"
                                                style="color: oklch(0.60 0.20 25);"
                                                onmouseover="this.style.color='oklch(0.70 0.22 25)'"
                                                onmouseout="this.style.color='oklch(0.60 0.20 25)'"
                                        >Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-16 text-center" style="background: {{ $bgCard }};">
                                <svg class="w-10 h-10 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $inkMute }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <p class="font-sans font-700 text-sm mb-1" style="color: {{ $inkPri }};">Belum ada kategori.</p>
                                <p class="font-sans text-xs" style="color: {{ $inkMute }};">Tambahkan kategori pertama dari panel kiri.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
