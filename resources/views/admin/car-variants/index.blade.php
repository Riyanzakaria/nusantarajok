<x-layout title="Master Varian Mobil — Nusantara Jok">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-10" x-data="variantModal()" style="color: oklch(0.93 0.012 75);">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-display font-700 text-3xl" style="color: oklch(0.93 0.012 75);">Varian Mobil</h1>
            <p class="font-sans text-sm mt-1" style="color: oklch(0.50 0.020 62);">Manajemen kompatibilitas mobil untuk e-commerce.</p>
        </div>
        <button @click="openCreate()" class="px-5 py-2.5 font-sans font-700 text-sm transition-all duration-200" style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55);">
            + Tambah Varian
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
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Merk & Model</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Tahun</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Baris Jok</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Penyesuaian Harga</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider text-right" style="color: oklch(0.68 0.022 65);">Aksi</th>
                </tr>
            </thead>
            <tbody style="background: oklch(0.12 0.018 55);">
                @forelse($variants as $variant)
                <tr style="border-bottom: 1px solid oklch(0.22 0.02 55);">
                    <td class="px-6 py-4">
                        <div class="font-700" style="color: oklch(0.93 0.012 75);">{{ $variant->brand }} {{ $variant->model_name }}</div>
                        <div class="text-[10px] uppercase tracking-wider mt-1" style="color: oklch(0.50 0.020 62);">Berat per baris: {{ $variant->weight_per_row_kg }} kg</div>
                    </td>
                    <td class="px-6 py-4 font-mono">{{ $variant->year_range }}</td>
                    <td class="px-6 py-4">{{ $variant->seat_rows }} Baris</td>
                    <td class="px-6 py-4">
                        @if($variant->price_adjustment > 0)
                            <span style="color: oklch(0.75 0.18 25);">+ Rp {{ number_format($variant->price_adjustment, 0, ',', '.') }}</span>
                        @elseif($variant->price_adjustment < 0)
                            <span style="color: oklch(0.62 0.14 155);">Rp {{ number_format($variant->price_adjustment, 0, ',', '.') }}</span>
                        @else
                            <span style="color: oklch(0.50 0.020 62);">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button @click="openEdit({{ $variant }})" class="text-xs uppercase font-700 mr-3" style="color: oklch(0.67 0.13 66);">Edit</button>
                        <form action="{{ route('admin.car-variants.destroy', $variant) }}" method="POST" class="inline" onsubmit="return confirm('Hapus varian ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs uppercase font-700" style="color: oklch(0.60 0.20 25);">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center" style="color: oklch(0.50 0.020 62);">Belum ada data varian mobil.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div x-show="open" x-cloak class="fixed inset-0 z-[400] flex items-center justify-center p-4 overflow-y-auto">
        <div class="absolute inset-0" style="background: oklch(0.08 0.01 55 / 0.88); backdrop-filter: blur(4px);" @click="open = false"></div>
        <div class="relative w-full max-w-lg p-7 my-8" style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.28 0.025 55);">
            <h3 class="font-display font-700 text-xl mb-4" x-text="isEdit ? 'Edit Varian Mobil' : 'Tambah Varian Mobil'"></h3>
            
            <form :action="formAction" method="POST" class="space-y-4">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Merk</label>
                        <input type="text" name="brand" x-model="form.brand" required placeholder="Honda" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                    </div>
                    <div>
                        <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Model</label>
                        <input type="text" name="model_name" x-model="form.model_name" required placeholder="Brio" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Tahun</label>
                    <input type="text" name="year_range" x-model="form.year_range" required placeholder="2018-2023" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Baris Tersedia</label>
                        <input type="number" name="seat_rows" x-model="form.seat_rows" min="1" max="3" required class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                    </div>
                    <div>
                        <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Berat per baris (Kg)</label>
                        <input type="number" step="1" name="weight_per_row_kg" x-model="form.weight_per_row_kg" required class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Penyesuaian Harga (Rp)</label>
                    <input type="number" name="price_adjustment" x-model="form.price_adjustment" required placeholder="0" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                    <p class="text-[10px] mt-1" style="color: oklch(0.50 0.020 62);">Gunakan angka minus jika lebih murah, atau 0 jika standar.</p>
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
    Alpine.data('variantModal', () => ({
        open: false,
        isEdit: false,
        formAction: '{{ route('admin.car-variants.store') }}',
        form: { brand: '', model_name: '', year_range: '', seat_rows: '', weight_per_row_kg: '', price_adjustment: 0 },

        openCreate() {
            this.isEdit = false;
            this.formAction = '{{ route('admin.car-variants.store') }}';
            this.form = { brand: '', model_name: '', year_range: '', seat_rows: '', weight_per_row_kg: '', price_adjustment: 0 };
            this.open = true;
        },

        openEdit(variant) {
            this.isEdit = true;
            this.formAction = `/admin/car-variants/${variant.id}`;
            this.form = { ...variant };
            this.open = true;
        }
    }));
});
</script>
@endpush
</x-layout>
