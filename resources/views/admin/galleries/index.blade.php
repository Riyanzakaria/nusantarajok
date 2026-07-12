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
<x-layout title="Galeri Foto — Admin BJN">
    <div class="min-h-screen" style="background: {{ $bg }}; padding: 8rem 0 8rem;">
        <div class="max-w-6xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 gap-4"
                 style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
                <div>
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: {{ $inkMute }};">Admin</p>
                    <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1;">Manajemen Galeri</h1>
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

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- Form panel --}}
                <div class="lg:col-span-4">
                    <div style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; padding: 2rem; position: sticky; top: 7rem;">
                        <h2 class="font-sans font-700 mb-6" style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.12em; color: {{ $inkMute }};">
                            Unggah Foto Baru
                        </h2>
                        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                            @csrf
                            <div>
                                <label class="block font-sans text-xs uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Kategori Kendaraan</label>
                                <select
                                    name="category_id"
                                    required
                                    class="w-full font-sans text-sm px-4 py-3 outline-none transition-colors duration-200"
                                    style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                    onfocus="this.style.borderColor='{{ $gold }}'"
                                    onblur="this.style.borderColor='{{ $border }}'"
                                >
                                    <option value="" style="color: {{ $inkMute }};">— Pilih Kategori —</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<p class="mt-1.5 font-sans text-xs" style="color: oklch(0.70 0.18 25);">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block font-sans text-xs uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Judul (Opsional)</label>
                                <input
                                    type="text"
                                    name="title"
                                    placeholder="Jok Innova Reborn..."
                                    class="w-full font-sans text-sm px-4 py-3 outline-none transition-colors duration-200"
                                    style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                    onfocus="this.style.borderColor='{{ $gold }}'"
                                    onblur="this.style.borderColor='{{ $border }}'"
                                >
                                @error('title')<p class="mt-1.5 font-sans text-xs" style="color: oklch(0.70 0.18 25);">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block font-sans text-xs uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">File Foto (Max 2MB)</label>
                                <input
                                    type="file"
                                    name="image"
                                    accept="image/*"
                                    required
                                    class="w-full font-sans text-sm outline-none file:mr-4 file:py-2 file:px-4 file:border-0 file:text-xs file:font-700 file:uppercase file:tracking-wider file:bg-transparent file:text-[oklch(0.67_0.13_66)] hover:file:bg-[oklch(0.67_0.13_66/0.1)] transition-colors cursor-pointer"
                                    style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkMute }};"
                                >
                                @error('image')<p class="mt-1.5 font-sans text-xs" style="color: oklch(0.70 0.18 25);">{{ $message }}</p>@enderror
                            </div>

                            <label class="flex items-center gap-3 cursor-pointer mt-2 group">
                                <input type="checkbox" name="is_featured" value="1" class="w-4 h-4 appearance-none outline-none cursor-pointer checked:bg-[oklch(0.67_0.13_66)] checked:border-[oklch(0.67_0.13_66)] transition-colors relative after:content-[''] after:absolute after:hidden checked:after:block after:left-1.5 after:top-0.5 after:w-1 after:h-2.5 after:border-r-2 after:border-b-2 after:border-[oklch(0.12_0.018_55)] after:rotate-45" style="background: {{ $bg }}; border: 1px solid {{ $border }};">
                                <span class="font-sans text-sm group-hover:text-[oklch(0.93_0.012_75)] transition-colors" style="color: {{ $inkMute }};">Tampilkan di Homepage (Featured)</span>
                            </label>

                            <button
                                type="submit"
                                class="w-full mt-4 font-sans font-700 text-sm uppercase tracking-wider py-3 transition-all duration-200"
                                style="background: {{ $gold }}; color: {{ $bg }}; border: 1px solid {{ $gold }};"
                                onmouseover="this.style.background='{{ $goldHov }}'; this.style.borderColor='{{ $goldHov }}'"
                                onmouseout="this.style.background='{{ $gold }}'; this.style.borderColor='{{ $gold }}'"
                            >
                                Unggah Foto
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Gallery Grid --}}
                <div class="lg:col-span-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($galleries as $gallery)
                            <div class="group relative overflow-hidden flex flex-col" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                                {{-- Image --}}
                                <div class="relative aspect-video overflow-hidden" style="background: {{ $bg }}; border-bottom: 1px solid {{ $border }};">
                                    <img src="{{ asset($gallery->image_url) }}" alt="{{ $gallery->title }}"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                         style="filter: contrast(1.05) saturate(0.9);">
                                    @if($gallery->is_featured)
                                        <div class="absolute top-3 left-3 px-3 py-1 font-sans text-[0.65rem] font-700 uppercase tracking-widest"
                                             style="background: {{ $gold }}; color: {{ $bg }};">
                                            Featured
                                        </div>
                                    @endif
                                </div>
                                {{-- Info --}}
                                <div class="p-4 flex items-center justify-between">
                                    <div>
                                        <h3 class="font-sans font-700 text-sm" style="color: {{ $inkPri }};">{{ $gallery->title ?: 'Tanpa Judul' }}</h3>
                                        <p class="font-sans text-xs mt-1 uppercase tracking-wider" style="color: {{ $inkMute }};">{{ $gallery->category->name }}</p>
                                    </div>
                                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST"
                                          onsubmit="return confirm('Hapus foto ini?');">
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
                            <div class="sm:col-span-2 px-6 py-16 text-center" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                                <svg class="w-10 h-10 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $inkMute }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="font-sans font-700 text-sm mb-1" style="color: {{ $inkPri }};">Belum ada foto.</p>
                                <p class="font-sans text-xs" style="color: {{ $inkMute }};">Upload foto pertama dari panel di kiri.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>


