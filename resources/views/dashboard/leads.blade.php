<x-layout title="Prospek (Leads) — AUTO-STITCH OS">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="convertModal()">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ route('dashboard.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h1 class="font-display text-3xl font-bold text-slate-900 tracking-tight">Prospek (Leads)</h1>
            </div>
            <p class="text-slate-500 mt-1">Daftar calon pelanggan dari kalkulator web. Konversi, ubah status, atau hapus data.</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 text-emerald-700 p-4 rounded-xl border border-emerald-200 flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Stats Bar --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-slate-200 rounded-2xl p-4 text-center shadow-sm">
            <div class="text-2xl font-black text-slate-900">{{ $leads->count() }}</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Total Prospek Aktif</div>
        </div>
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-center shadow-sm">
            <div class="text-2xl font-black text-amber-700">{{ $leads->where('status','raw')->count() }}</div>
            <div class="text-xs text-amber-600 font-medium mt-0.5">Baru (Raw)</div>
        </div>
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 text-center shadow-sm">
            <div class="text-2xl font-black text-blue-700">{{ $leads->where('status','follow_up')->count() }}</div>
            <div class="text-xs text-blue-600 font-medium mt-0.5">Negosiasi</div>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4 text-center shadow-sm">
            <div class="text-2xl font-black text-red-600">{{ $leads->where('status','dropped')->count() }}</div>
            <div class="text-xs text-red-500 font-medium mt-0.5">Batal (Dropped)</div>
        </div>
    </div>

    {{-- Leads Table --}}
    @if($leads->isEmpty())
        <div class="bg-white border border-dashed border-slate-300 rounded-3xl p-16 text-center">
            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="font-display text-lg font-black text-slate-900 mb-2">Belum Ada Prospek</h3>
            <p class="text-slate-500 text-sm">Prospek akan muncul saat calon pelanggan menggunakan kalkulator web.</p>
        </div>
    @else
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50">
                            <th class="text-left px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="text-left px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kendaraan / Material</th>
                            <th class="text-right px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Est. Harga</th>
                            <th class="text-center px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="text-left px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Masuk</th>
                            <th class="text-center px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($leads as $lead)
                        {{-- Baris di-dim jika status dropped --}}
                        <tr class="transition-colors {{ $lead->status === 'dropped' ? 'opacity-50 bg-slate-50' : 'hover:bg-slate-50' }}">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $lead->customer_name }}</div>
                                @if($lead->whatsapp_number && $lead->whatsapp_number !== 'Pending')
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->whatsapp_number) }}" target="_blank"
                                       class="text-xs text-green-600 hover:text-green-700 font-medium flex items-center gap-1 mt-0.5">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                                        {{ $lead->whatsapp_number }}
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400 italic">Nomor belum diisi</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-700 font-medium">{{ $lead->vehicle_type ?? '—' }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">{{ $lead->material_selected ?? '—' }}</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($lead->calculated_price > 0)
                                    <span class="font-mono font-bold text-slate-900 text-xs">Rp {{ number_format($lead->calculated_price, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>

                            {{-- Status Dropdown --}}
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('dashboard.leads.status', $lead) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                            class="text-xs font-bold px-2 py-1.5 rounded-lg border transition-colors cursor-pointer outline-none
                                            {{ match($lead->status) {
                                                'raw'       => 'bg-amber-50 border-amber-200 text-amber-700',
                                                'follow_up' => 'bg-blue-50 border-blue-200 text-blue-700',
                                                'dealt'     => 'bg-emerald-50 border-emerald-200 text-emerald-700',
                                                'dropped'   => 'bg-slate-100 border-slate-300 text-slate-500',
                                                default     => 'bg-slate-50 border-slate-200 text-slate-600',
                                            } }}">
                                        <option value="raw"       {{ $lead->status === 'raw'       ? 'selected' : '' }}>🟡 Baru</option>
                                        <option value="follow_up" {{ $lead->status === 'follow_up' ? 'selected' : '' }}>🔵 Negosiasi</option>
                                        <option value="dealt"     {{ $lead->status === 'dealt'     ? 'selected' : '' }}>🟢 Dealt</option>
                                        <option value="dropped"   {{ $lead->status === 'dropped'   ? 'selected' : '' }}>⚪ Batal</option>
                                    </select>
                                </form>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-500">{{ $lead->created_at->diffForHumans() }}</span>
                            </td>

                            {{-- Action Buttons --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Konversi ke Pesanan --}}
                                    @if($lead->status !== 'dropped' && $lead->status !== 'dealt')
                                    <button
                                        @click="openConvert({{ $lead->id }}, '{{ addslashes($lead->customer_name) }}', '{{ $lead->vehicle_type ?? '' }}', '{{ $lead->material_selected ?? '' }}')"
                                        title="Jadikan Pesanan"
                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-slate-900 text-white text-xs font-bold hover:bg-accent-500 transition-colors active:scale-95">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                        Order
                                    </button>
                                    @endif

                                    {{-- Hapus (Hard Delete) --}}
                                    <form action="{{ route('dashboard.leads.destroy', $lead) }}" method="POST"
                                          onsubmit="return confirm('Hapus permanen prospek \"{{ addslashes($lead->customer_name) }}\"? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Permanen"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-red-200 text-red-600 text-xs font-bold hover:bg-red-50 hover:border-red-300 transition-colors active:scale-95">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pruning Info Footer --}}
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center gap-2 text-xs text-slate-400">
                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Data dengan status <strong>Baru</strong> &amp; <strong>Batal</strong> yang berumur lebih dari 30 hari akan dihapus otomatis setiap Minggu pukul 02:00.
                Jalankan manual: <code class="bg-slate-200 text-slate-600 px-1 py-0.5 rounded font-mono">php artisan leads:prune</code>
            </div>
        </div>
    @endif

    {{-- =====================================================================
         MODAL: Convert Lead to Work Order
         ===================================================================== --}}
    <div x-show="open" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         @keydown.escape.window="open = false">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="open = false"
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"></div>

        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0">

            <div class="flex items-center justify-between px-7 pt-7 pb-5 border-b border-slate-100">
                <div>
                    <h3 class="font-display text-xl font-black text-slate-900">Jadikan Pesanan</h3>
                    <p class="text-sm text-slate-500 mt-0.5">Mengkonversi prospek <span class="font-bold text-slate-700" x-text="leadName"></span></p>
                </div>
                <button @click="open = false" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form :action="`/dashboard/leads/${leadId}/convert`" method="POST" class="px-7 py-6 space-y-5">
                @csrf
                <div class="bg-slate-50 rounded-2xl p-4 space-y-2 text-sm">
                    <div class="flex justify-between"><span class="text-slate-500">Pelanggan</span><span class="font-bold text-slate-900" x-text="leadName"></span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Kendaraan</span><span class="font-medium text-slate-700" x-text="leadVehicle || '—'"></span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Material</span><span class="font-medium text-slate-700" x-text="leadMaterial || '—'"></span></div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Plat Nomor <span class="text-red-500">*</span></label>
                    <input type="text" name="raw_plat" required placeholder="cth: B 1234 XYZ"
                           @input="$event.target.value = $event.target.value.toUpperCase()"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-mono font-bold placeholder-slate-400 focus:ring-2 focus:ring-slate-900/20 focus:border-slate-400 outline-none transition uppercase tracking-widest">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori Kendaraan <span class="text-red-500">*</span></label>
                    <select name="vehicle_category_id" required @change="updateMaterials($event.target.value)"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-medium focus:ring-2 focus:ring-slate-900/20 focus:border-slate-400 outline-none transition bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($vehicleCategories as $cat)
                            <option value="{{ $cat->id }}" data-pricelists="{{ $cat->pricelists->toJson() }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Material <span class="text-red-500">*</span></label>
                    <select name="pricelist_id" required x-model="selectedPricelist"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-medium focus:ring-2 focus:ring-slate-900/20 focus:border-slate-400 outline-none transition bg-white" :disabled="materials.length === 0">
                        <option value="">-- Pilih Material --</option>
                        <template x-for="mat in materials" :key="mat.id">
                            <option :value="mat.id" x-text="mat.item_name + ' — Rp ' + Number(mat.price).toLocaleString('id-ID')"></option>
                        </template>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal Jadwal <span class="text-red-500">*</span></label>
                    <input type="date" name="scheduled_at" required :min="today"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm font-medium focus:ring-2 focus:ring-slate-900/20 focus:border-slate-400 outline-none transition">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="button" @click="open = false" class="flex-1 py-3 rounded-xl border-2 border-slate-200 text-slate-600 font-bold text-sm hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-slate-900 text-white font-bold text-sm hover:bg-accent-500 transition-colors shadow-lg active:scale-95">Konversi ke Pesanan →</button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('convertModal', () => ({
        open: false,
        leadId: null,
        leadName: '',
        leadVehicle: '',
        leadMaterial: '',
        materials: [],
        selectedPricelist: '',
        today: new Date().toISOString().split('T')[0],

        openConvert(id, name, vehicle, material) {
            this.leadId       = id;
            this.leadName     = name;
            this.leadVehicle  = vehicle;
            this.leadMaterial = material;
            this.materials    = [];
            this.selectedPricelist = '';
            this.open = true;
        },

        updateMaterials(catId) {
            this.materials = [];
            this.selectedPricelist = '';
            if (!catId) return;
            const select = document.querySelector('select[name="vehicle_category_id"]');
            const option = select ? select.querySelector(`option[value="${catId}"]`) : null;
            if (option) {
                try { this.materials = JSON.parse(option.dataset.pricelists || '[]'); } catch(e) {}
            }
        }
    }));
});
</script>
@endpush
</x-layout>
