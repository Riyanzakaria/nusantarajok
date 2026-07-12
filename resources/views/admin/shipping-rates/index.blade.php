<x-layout title="Master Tarif Ongkir — Nusantara Jok">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-10" x-data="rateModal()" style="color: oklch(0.93 0.012 75);">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-display font-700 text-3xl" style="color: oklch(0.93 0.012 75);">Tarif Ongkos Kirim</h1>
            <p class="font-sans text-sm mt-1" style="color: oklch(0.50 0.020 62);">Manajemen tarif flat pengiriman kargo per provinsi.</p>
        </div>
        <button @click="openCreate()" class="px-5 py-2.5 font-sans font-700 text-sm transition-all duration-200" style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55);">
            + Tambah Provinsi
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
    @if($errors->any())
        <div class="mb-8 flex flex-col gap-1 px-5 py-4 font-sans text-sm font-500" style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.25); color: oklch(0.75 0.18 25);">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="overflow-x-auto" style="border: 1px solid oklch(0.22 0.02 55);">
        <table class="w-full text-left font-sans text-sm whitespace-nowrap">
            <thead style="background: oklch(0.155 0.022 55); border-bottom: 1px solid oklch(0.22 0.02 55);">
                <tr>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Provinsi</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Tarif Dasar (Per Baris)</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Estimasi Hari</th>
                    <th class="px-6 py-4 font-700 text-xs uppercase tracking-wider text-right" style="color: oklch(0.68 0.022 65);">Aksi</th>
                </tr>
            </thead>
            <tbody style="background: oklch(0.12 0.018 55);">
                @forelse($rates as $rate)
                <tr style="border-bottom: 1px solid oklch(0.22 0.02 55);">
                    <td class="px-6 py-4 font-700" style="color: oklch(0.93 0.012 75);">{{ $rate->province_name }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($rate->cost_per_row, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 font-mono text-[13px]">{{ $rate->estimated_days }} Hari</td>
                    <td class="px-6 py-4 text-right">
                        <button @click="openEdit({{ $rate }})" class="text-xs uppercase font-700 mr-3" style="color: oklch(0.67 0.13 66);">Edit</button>
                        <form action="{{ route('admin.shipping-rates.destroy', $rate) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tarif provinsi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs uppercase font-700" style="color: oklch(0.60 0.20 25);">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center" style="color: oklch(0.50 0.020 62);">Belum ada data tarif ongkos kirim.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div x-show="open" x-cloak class="fixed inset-0 z-[400] flex items-center justify-center p-4">
        <div class="absolute inset-0" style="background: oklch(0.08 0.01 55 / 0.88); backdrop-filter: blur(4px);" @click="open = false"></div>
        <div class="relative w-full max-w-lg p-7" style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.28 0.025 55);">
            <h3 class="font-display font-700 text-xl mb-4" x-text="isEdit ? 'Edit Tarif Provinsi' : 'Tambah Tarif Provinsi'"></h3>
            
            <form :action="formAction" method="POST" class="space-y-4">
                @csrf
                <template x-if="isEdit">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div>
                    <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Nama Provinsi</label>
                    <input type="text" name="province_name" x-model="form.province_name" required placeholder="Jawa Timur" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                </div>

                <div>
                    <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Tarif Dasar (Per Baris) - Rp</label>
                    <input type="number" name="cost_per_row" x-model="form.cost_per_row" required min="0" placeholder="150000" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                    <p class="text-[10px] mt-1" style="color: oklch(0.50 0.020 62);">Harga untuk berat volume 25kg.</p>
                </div>

                <div>
                    <label class="block text-xs font-700 uppercase tracking-wider mb-2" style="color: oklch(0.50 0.020 62);">Estimasi Sampai (Hari)</label>
                    <input type="text" name="estimated_days" x-model="form.estimated_days" required placeholder="3-5" class="w-full px-4 py-2 font-sans text-sm" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
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
    Alpine.data('rateModal', () => ({
        open: false,
        isEdit: false,
        formAction: '{{ route('admin.shipping-rates.store') }}',
        form: { province_name: '', cost_per_row: '', estimated_days: '' },

        openCreate() {
            this.isEdit = false;
            this.formAction = '{{ route('admin.shipping-rates.store') }}';
            this.form = { province_name: '', cost_per_row: '', estimated_days: '' };
            this.open = true;
        },

        openEdit(rate) {
            this.isEdit = true;
            this.formAction = `/admin/shipping-rates/${rate.id}`;
            this.form = { ...rate };
            this.open = true;
        }
    }));
});
</script>
@endpush
</x-layout>
