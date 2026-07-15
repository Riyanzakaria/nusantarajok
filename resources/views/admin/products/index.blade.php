<x-layout title="Master Produk E-Commerce — Nusantara Jok">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-10" x-data="productModal()" style="color: oklch(0.93 0.012 75);">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-display font-700 text-3xl" style="color: oklch(0.93 0.012 75);">Master Produk</h1>
            <p class="font-sans text-sm mt-1" style="color: oklch(0.50 0.020 62);">Manajemen model jok PNP untuk e-commerce.</p>
        </div>
        <button @click="openCreate()" class="px-5 py-2.5 font-sans font-700 text-sm transition-all duration-200" style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55);">
            + Tambah Produk
        </button>
    </div>

    @if(session('success'))
        <div class="mb-8 flex items-center gap-3 px-5 py-4 font-sans text-sm font-500" style="background: oklch(0.62 0.14 155 / 0.08); border: 1px solid oklch(0.62 0.14 155 / 0.25); color: oklch(0.62 0.14 155);">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-8 p-5 font-sans text-sm" style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.25); color: oklch(0.75 0.18 25);">
            <div class="font-700 mb-2">Terjadi kesalahan:</div>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-8 flex items-center gap-3 px-5 py-4 font-sans text-sm font-500" style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.25); color: oklch(0.75 0.18 25);">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto" style="border: 1px solid oklch(0.22 0.02 55);">
        <table class="w-full text-left font-sans text-sm whitespace-nowrap">
            <thead style="background: oklch(0.155 0.022 55); border-bottom: 1px solid oklch(0.22 0.02 55);">
                <tr>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Foto</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Produk</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Harga Dasar</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Status</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider text-right" style="color: oklch(0.68 0.022 65);">Aksi</th>
                </tr>
            </thead>
            <tbody style="background: oklch(0.12 0.018 55);">
                @forelse($products as $product)
                <tr style="border-bottom: 1px solid oklch(0.22 0.02 55);">
                    <td class="px-6 py-4">
                        @if($product->primary_image)
                            <img src="{{ Storage::disk('public')->url($product->primary_image) }}" alt="Foto" class="w-12 h-12 object-cover rounded-lg border border-[var(--color-border)]">
                        @else
                            <div class="w-12 h-12 rounded-lg border border-dashed border-[var(--color-border)] flex items-center justify-center text-[10px] text-gray-500">No Img</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-700" style="color: oklch(0.93 0.012 75);">{{ $product->name }}</div>
                        <div class="text-xs mt-1" style="color: oklch(0.50 0.020 62);">/{{ $product->slug }}</div>
                    </td>
                    <td class="px-6 py-4">Rp {{ number_format($product->base_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-[10px] font-700 uppercase tracking-widest" style="{{ $product->is_active ? 'background: oklch(0.62 0.14 155 / 0.1); color: oklch(0.62 0.14 155);' : 'background: oklch(0.60 0.20 25 / 0.1); color: oklch(0.75 0.18 25);' }}">
                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button @click="openEdit({{ $product }})" class="text-xs uppercase font-700 mr-3" style="color: oklch(0.67 0.13 66);">Edit</button>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs uppercase font-700" style="color: oklch(0.60 0.20 25);">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center" style="color: oklch(0.50 0.020 62);">Belum ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div x-show="open" x-cloak class="fixed inset-0 z-[400] flex items-center justify-center p-4">
        <div class="absolute inset-0" style="background: oklch(0.08 0.01 55 / 0.88); backdrop-filter: blur(4px);" @click="open = false"></div>
        <div class="relative w-full max-w-lg p-7" style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.28 0.025 55);">
            <h3 class="font-display font-700 text-xl mb-4" x-text="isEdit ? 'Edit Produk' : 'Tambah Produk'"></h3>
            
            <form :action="formAction" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div>
                    <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Nama Produk</label>
                    <input type="text" name="name" x-model="form.name" required class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                </div>

                <div>
                    <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Foto Produk</label>
                    <input type="file" name="primary_image" accept="image/*" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                    <p class="text-[10px] mt-1" style="color: oklch(0.50 0.020 62);">Biarkan kosong jika tidak ingin mengubah foto (saat edit).</p>
                </div>

                <div>
                    <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Deskripsi</label>
                    <textarea name="description" x-model="form.description" rows="3" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Harga Dasar (Rp)</label>
                    <input type="number" name="base_price" x-model="form.base_price" required min="0" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" x-bind:checked="form.is_active == 1">
                    <label for="is_active" class="text-sm">Aktifkan untuk dijual</label>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm font-700" style="color: oklch(0.50 0.020 62);">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-700" style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55);">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('productModal', () => ({
        open: false,
        isEdit: false,
        formAction: '{{ route('admin.products.store') }}',
        form: { name: '', description: '', base_price: '', is_active: 1 },

        openCreate() {
            this.isEdit = false;
            this.formAction = '{{ route('admin.products.store') }}';
            this.form = { name: '', description: '', base_price: '', is_active: 1 };
            this.open = true;
        },

        openEdit(product) {
            this.isEdit = true;
            this.formAction = `/admin/products/${product.id}`;
            this.form = { ...product };
            this.open = true;
        }
    }));
});
</script>
@endpush
</x-layout>
