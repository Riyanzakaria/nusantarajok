@php
    $bg     = 'oklch(0.12 0.018 55)';
    $surface= 'oklch(0.155 0.022 55)';
    $border = 'oklch(0.22 0.02 55)';
    $inkPri = 'oklch(0.93 0.012 75)';
    $inkMut = 'oklch(0.50 0.020 62)';
    $gold   = 'oklch(0.67 0.13 66)';
    $goldH  = 'oklch(0.75 0.11 67)';
@endphp
<x-layout title="Tambah Produk — Admin BJN">
<div class="min-h-screen pt-32 pb-24 px-4 sm:px-6 lg:px-8" style="background: {{ $bg }}; color: {{ $inkPri }};">
    <div class="max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-10" style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
            <div>
                <p class="font-sans text-xs uppercase tracking-[0.14em] mb-1" style="color: {{ $inkMut }};">Admin / Master Produk</p>
                <h1 class="font-display font-700 text-2xl" style="letter-spacing: -0.03em;">Tambah Produk Baru</h1>
            </div>
            <a href="{{ route('admin.products.index') }}"
               class="inline-flex items-center gap-2 font-sans text-sm font-700 uppercase tracking-wider transition-colors"
               style="color: {{ $inkMut }};"
               onmouseover="this.style.color='{{ $goldH }}'"
               onmouseout="this.style.color='{{ $inkMut }}'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>

        @if($errors->any())
        <div class="mb-8 p-5 font-sans text-sm" style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.25); color: oklch(0.75 0.18 25);">
            <div class="font-700 mb-2">Terjadi kesalahan:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 font-sans text-sm outline-none transition-colors"
                    style="background: {{ $surface }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                    onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Deskripsi Produk</label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-3 font-sans text-sm outline-none resize-none transition-colors"
                    style="background: {{ $surface }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                    onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">{{ old('description') }}</textarea>
            </div>

            {{-- Harga --}}
            <div>
                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Harga Dasar (Rp) *</label>
                <input type="number" name="base_price" value="{{ old('base_price') }}" required min="0"
                    class="w-full px-4 py-3 font-sans text-sm outline-none transition-colors"
                    style="background: {{ $surface }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                    onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
            </div>

            {{-- Foto Utama --}}
            <div>
                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Foto Utama (Cover)</label>
                <input type="file" name="primary_image" accept="image/*" id="primary_image_input"
                    class="w-full px-4 py-3 font-sans text-sm outline-none transition-colors"
                    style="background: {{ $surface }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                    onchange="previewImage(this, 'primary_preview')">
                <p class="text-[11px] mt-1.5" style="color: {{ $inkMut }};">Format: JPEG, PNG, WebP. Maks 4MB. Foto ini tampil sebagai thumbnail di katalog.</p>
                <div id="primary_preview" class="mt-3 hidden">
                    <img src="" alt="Preview" class="w-32 h-24 object-cover" style="border: 1px solid {{ $border }};">
                </div>
            </div>

            {{-- Foto Gallery --}}
            <div>
                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Foto Gallery (Maks 8 Foto)</label>
                <input type="file" name="gallery_images[]" accept="image/*" multiple id="gallery_input"
                    class="w-full px-4 py-3 font-sans text-sm outline-none transition-colors"
                    style="background: {{ $surface }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                    onchange="previewGallery(this)">
                <p class="text-[11px] mt-1.5" style="color: {{ $inkMut }};">Pilih beberapa foto sekaligus. Foto-foto ini tampil di halaman detail produk.</p>
                <div id="gallery_preview" class="flex flex-wrap gap-2 mt-3"></div>
            </div>

            {{-- Status --}}
            <div class="flex items-center gap-3 py-4" style="border-top: 1px solid {{ $border }}; border-bottom: 1px solid {{ $border }};">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                    class="w-4 h-4 accent-amber-500">
                <label for="is_active" class="font-sans text-sm font-500" style="color: {{ $inkPri }};">
                    Aktifkan produk ini untuk dijual di katalog
                </label>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('admin.products.index') }}" class="font-sans text-sm font-700 transition-colors" style="color: {{ $inkMut }};"
                   onmouseover="this.style.color='{{ $inkPri }}'" onmouseout="this.style.color='{{ $inkMut }}'">Batal</a>
                <button type="submit" class="px-7 py-3 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-200"
                    style="background: {{ $gold }}; color: oklch(0.12 0.018 55);"
                    onmouseover="this.style.background='{{ $goldH }}'" onmouseout="this.style.background='{{ $gold }}'">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const img = preview.querySelector('img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; preview.classList.remove('hidden'); };
        reader.readAsDataURL(input.files[0]);
    }
}
function previewGallery(input) {
    const container = document.getElementById('gallery_preview');
    container.innerHTML = '';
    if (!input.files) return;
    Array.from(input.files).slice(0, 8).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-20 h-16 object-cover';
            img.style.cssText = 'border: 1px solid oklch(0.22 0.02 55);';
            container.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endpush
</x-layout>
