@php
    $bg     = 'oklch(0.12 0.018 55)';
    $surface= 'oklch(0.155 0.022 55)';
    $border = 'oklch(0.22 0.02 55)';
    $inkPri = 'oklch(0.93 0.012 75)';
    $inkSec = 'oklch(0.68 0.022 65)';
    $inkMut = 'oklch(0.50 0.020 62)';
    $gold   = 'oklch(0.67 0.13 66)';
    $goldH  = 'oklch(0.75 0.11 67)';
    $red    = 'oklch(0.65 0.22 25)';
@endphp
<x-layout title="Edit Produk: {{ $product->name }} — Admin BJN">
<div class="min-h-screen pt-32 pb-24 px-4 sm:px-6 lg:px-8" style="background: {{ $bg }}; color: {{ $inkPri }};">
    <div class="max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-10" style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
            <div>
                <p class="font-sans text-xs uppercase tracking-[0.14em] mb-1" style="color: {{ $inkMut }};">Admin / Master Produk</p>
                <h1 class="font-display font-700 text-2xl" style="letter-spacing: -0.03em;">Edit: {{ $product->name }}</h1>
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

        @if(session('success'))
        <div class="mb-8 px-5 py-4 font-sans text-sm font-500" style="background: oklch(0.62 0.14 155 / 0.08); border: 1px solid oklch(0.62 0.14 155 / 0.25); color: oklch(0.62 0.14 155);">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-8 p-5 font-sans text-sm" style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.25); color: oklch(0.75 0.18 25);">
            <div class="font-700 mb-2">Terjadi kesalahan:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
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
                    onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Harga --}}
            <div>
                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Harga Dasar (Rp) *</label>
                <input type="number" name="base_price" value="{{ old('base_price', $product->base_price) }}" required min="0"
                    class="w-full px-4 py-3 font-sans text-sm outline-none transition-colors"
                    style="background: {{ $surface }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                    onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
            </div>

            {{-- Foto Utama --}}
            <div>
                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: {{ $inkMut }};">Foto Utama (Cover)</label>
                @if($product->primary_image)
                <div class="flex items-start gap-4 mb-3 p-3" style="background: {{ $surface }}; border: 1px solid {{ $border }};">
                    <img src="{{ Storage::disk('public')->url($product->primary_image) }}" alt="Foto utama"
                         class="w-24 h-20 object-cover shrink-0" style="border: 1px solid {{ $border }};">
                    <div>
                        <p class="font-sans text-xs font-700 mb-1" style="color: {{ $inkSec }};">Foto utama saat ini</p>
                        <p class="font-sans text-[10px]" style="color: {{ $inkMut }};">Upload foto baru di bawah untuk menggantinya.</p>
                    </div>
                </div>
                @endif
                <input type="file" name="primary_image" accept="image/*"
                    class="w-full px-4 py-3 font-sans text-sm outline-none transition-colors"
                    style="background: {{ $surface }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                    onchange="previewNew(this)">
                <div id="new_primary_preview" class="mt-3 hidden">
                    <img src="" alt="Preview baru" class="w-32 h-24 object-cover" style="border: 1px solid {{ $gold }};">
                    <p class="text-[10px] mt-1" style="color: {{ $gold }};">↑ Foto baru (belum tersimpan)</p>
                </div>
            </div>

            {{-- Gallery Images --}}
            <div>
                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: {{ $inkMut }};">Foto Gallery</label>

                {{-- Existing gallery --}}
                @php $gallery = $product->gallery_images ?? []; @endphp
                @if(count($gallery) > 0)
                <div class="mb-4 p-4" style="background: {{ $surface }}; border: 1px solid {{ $border }};">
                    <p class="font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: {{ $inkMut }};">
                        Foto Gallery Saat Ini ({{ count($gallery) }} foto) — centang untuk menghapus:
                    </p>
                    <div class="flex flex-wrap gap-3">
                        @foreach($gallery as $i => $img)
                        <div class="relative group">
                            <img src="{{ Storage::disk('public')->url($img) }}" alt="Gallery {{ $i+1 }}"
                                 class="w-20 h-16 object-cover transition-opacity"
                                 style="border: 1px solid {{ $border }};"
                                 id="gal_img_{{ $i }}">
                            <label class="absolute inset-0 flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity"
                                   style="background: oklch(0.65 0.22 25 / 0.6);" for="remove_gal_{{ $i }}">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </label>
                            <input type="checkbox" name="remove_gallery[]" value="{{ $img }}"
                                   id="remove_gal_{{ $i }}" class="sr-only"
                                   onchange="toggleGalleryDelete(this, 'gal_img_{{ $i }}')">
                            <div id="gal_del_{{ $i }}" class="hidden absolute top-0 left-0 right-0 text-center py-0.5 text-[9px] font-700 uppercase" style="background: {{ $red }}; color: white;">Hapus</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Upload new gallery --}}
                <input type="file" name="gallery_images[]" accept="image/*" multiple
                    class="w-full px-4 py-3 font-sans text-sm outline-none transition-colors"
                    style="background: {{ $surface }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                    onchange="previewNewGallery(this)">
                <p class="text-[11px] mt-1.5" style="color: {{ $inkMut }};">Upload foto tambahan (maks 8 foto total). Foto lama yang tidak dicentang tetap tersimpan.</p>
                <div id="new_gallery_preview" class="flex flex-wrap gap-2 mt-3"></div>
            </div>

            {{-- Status --}}
            <div class="flex items-center gap-3 py-4" style="border-top: 1px solid {{ $border }}; border-bottom: 1px solid {{ $border }};">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}
                    class="w-4 h-4 accent-amber-500">
                <label for="is_active" class="font-sans text-sm font-500" style="color: {{ $inkPri }};">
                    Aktifkan produk ini untuk dijual di katalog
                </label>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-between">
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('Hapus produk ini secara permanen?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="font-sans text-sm font-700 uppercase tracking-wider transition-colors"
                            style="color: {{ $red }};"
                            onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                        Hapus Produk
                    </button>
                </form>

                <button type="submit" class="px-7 py-3 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-200"
                    style="background: {{ $gold }}; color: oklch(0.12 0.018 55);"
                    onmouseover="this.style.background='{{ $goldH }}'" onmouseout="this.style.background='{{ $gold }}'">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewNew(input) {
    const preview = document.getElementById('new_primary_preview');
    const img = preview.querySelector('img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; preview.classList.remove('hidden'); };
        reader.readAsDataURL(input.files[0]);
    }
}
function previewNewGallery(input) {
    const container = document.getElementById('new_gallery_preview');
    container.innerHTML = '';
    if (!input.files) return;
    Array.from(input.files).slice(0, 8).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const wrap = document.createElement('div');
            wrap.className = 'relative';
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-20 h-16 object-cover';
            img.style.cssText = 'border: 1px solid oklch(0.67 0.13 66);';
            const badge = document.createElement('div');
            badge.className = 'absolute top-0 left-0 right-0 text-center py-0.5';
            badge.style.cssText = 'background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55); font-size: 9px; font-weight: 700;';
            badge.textContent = 'BARU';
            wrap.appendChild(img);
            wrap.appendChild(badge);
            container.appendChild(wrap);
        };
        reader.readAsDataURL(file);
    });
}
function toggleGalleryDelete(checkbox, imgId) {
    const img = document.getElementById(imgId);
    const badge = document.getElementById(imgId.replace('gal_img_', 'gal_del_'));
    if (checkbox.checked) {
        img.style.opacity = '0.3';
        img.style.filter = 'grayscale(1)';
        badge.classList.remove('hidden');
    } else {
        img.style.opacity = '1';
        img.style.filter = 'none';
        badge.classList.add('hidden');
    }
}
</script>
@endpush
</x-layout>
