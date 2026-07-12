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
<x-layout title="Prospek (Leads) — Admin BJN">
    <div class="min-h-screen" style="background: {{ $bg }}; padding: 8rem 0 8rem;" x-data="convertModal()">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 gap-4"
                 style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <a href="{{ route('dashboard.index') }}"
                           class="w-8 h-8 flex items-center justify-center transition-colors duration-200"
                           style="color: {{ $inkMute }}; border: 1px solid {{ $border }};"
                           onmouseover="this.style.color='{{ $goldHov }}'; this.style.borderColor='{{ $goldHov }}'"
                           onmouseout="this.style.color='{{ $inkMute }}'; this.style.borderColor='{{ $border }}'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </a>
                        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1;">Prospek (Leads)</h1>
                    </div>
                    <p class="font-sans text-sm mt-1" style="color: {{ $inkMute }};">Daftar calon pelanggan dari kalkulator web.</p>
                </div>
            </div>

            {{-- Alerts --}}
            @if(session('success'))
                <div class="mb-8 flex items-center gap-3 px-5 py-4 font-sans text-sm"
                     style="background: oklch(0.62 0.14 155 / 0.08); border: 1px solid oklch(0.62 0.14 155 / 0.30); color: oklch(0.62 0.14 155);">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Stats Bar --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                <div class="p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; text-align: center;">
                    <div class="font-display font-700 text-4xl" style="color: {{ $inkPri }};">{{ $leads->count() }}</div>
                    <div class="font-sans text-[0.65rem] uppercase tracking-wider mt-2" style="color: {{ $inkMute }};">Total Prospek Aktif</div>
                </div>
                <div class="p-6" style="background: oklch(0.67 0.13 66 / 0.04); border: 1px solid oklch(0.67 0.13 66 / 0.20); text-align: center;">
                    <div class="font-display font-700 text-4xl" style="color: oklch(0.67 0.13 66);">{{ $leads->where('status','raw')->count() }}</div>
                    <div class="font-sans text-[0.65rem] uppercase tracking-wider mt-2" style="color: oklch(0.75 0.11 67);">Baru (Raw)</div>
                </div>
                <div class="p-6" style="background: oklch(0.60 0.18 255 / 0.04); border: 1px solid oklch(0.60 0.18 255 / 0.20); text-align: center;">
                    <div class="font-display font-700 text-4xl" style="color: oklch(0.60 0.18 255);">{{ $leads->where('status','follow_up')->count() }}</div>
                    <div class="font-sans text-[0.65rem] uppercase tracking-wider mt-2" style="color: oklch(0.65 0.18 255);">Negosiasi</div>
                </div>
                <div class="p-6" style="background: oklch(0.60 0.20 25 / 0.04); border: 1px solid oklch(0.60 0.20 25 / 0.20); text-align: center;">
                    <div class="font-display font-700 text-4xl" style="color: oklch(0.60 0.20 25);">{{ $leads->where('status','dropped')->count() }}</div>
                    <div class="font-sans text-[0.65rem] uppercase tracking-wider mt-2" style="color: oklch(0.70 0.22 25);">Batal (Dropped)</div>
                </div>
            </div>

            {{-- Leads Table --}}
            @if($leads->isEmpty())
                <div class="p-16 text-center" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                    <svg class="w-10 h-10 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $inkMute }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <h3 class="font-sans font-700 text-sm mb-1" style="color: {{ $inkPri }};">Belum Ada Prospek</h3>
                    <p class="font-sans text-xs" style="color: {{ $inkMute }};">Prospek akan muncul di sini saat calon pelanggan menggunakan kalkulator estimasi di website.</p>
                </div>
            @else
                <div style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; overflow-x-auto;">
                    <div class="flex items-center min-w-[1000px] gap-px" style="background: {{ $border }};">
                        <div class="w-64 px-5 py-3 font-sans text-[0.65rem] font-700 uppercase tracking-[0.12em]" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Pelanggan</div>
                        <div class="w-64 px-5 py-3 font-sans text-[0.65rem] font-700 uppercase tracking-[0.12em]" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Kendaraan / Material</div>
                        <div class="w-32 px-5 py-3 font-sans text-[0.65rem] font-700 uppercase tracking-[0.12em] text-right" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Est. Harga</div>
                        <div class="w-40 px-5 py-3 font-sans text-[0.65rem] font-700 uppercase tracking-[0.12em] text-center" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Status</div>
                        <div class="w-32 px-5 py-3 font-sans text-[0.65rem] font-700 uppercase tracking-[0.12em]" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Masuk</div>
                        <div class="flex-1 px-5 py-3 font-sans text-[0.65rem] font-700 uppercase tracking-[0.12em] text-right" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Aksi</div>
                    </div>

                    @foreach($leads as $lead)
                        <div class="flex items-center min-w-[1000px] gap-px transition-colors duration-200"
                             style="background: {{ $border }}; border-top: 1px solid {{ $border }}; {{ $lead->status === 'dropped' ? 'opacity: 0.5;' : '' }}"
                             onmouseover="this.querySelector('.row-bg').style.background='{{ $bg }}'"
                             onmouseout="this.querySelector('.row-bg').style.background='{{ $bgCard }}'">

                            {{-- Col 1: Pelanggan --}}
                            <div class="row-bg w-64 px-5 py-4" style="background: {{ $bgCard }};">
                                <p class="font-sans font-700 text-sm" style="color: {{ $inkPri }};">{{ $lead->customer_name }}</p>
                                @if($lead->whatsapp_number && $lead->whatsapp_number !== 'Pending')
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->whatsapp_number) }}" target="_blank"
                                       class="inline-flex items-center gap-1 font-mono text-[0.7rem] mt-1 transition-colors"
                                       style="color: oklch(0.62 0.14 155);"
                                       onmouseover="this.style.color='oklch(0.68 0.16 155)'" onmouseout="this.style.color='oklch(0.62 0.14 155)'">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                                        {{ $lead->whatsapp_number }}
                                    </a>
                                @else
                                    <span class="font-sans text-[0.65rem] italic" style="color: {{ $inkMute }};">Nomor belum diisi</span>
                                @endif
                            </div>

                            {{-- Col 2: Kendaraan / Material --}}
                            <div class="row-bg w-64 px-5 py-4" style="background: {{ $bgCard }};">
                                <p class="font-sans font-700 text-sm" style="color: {{ $inkSec }};">{{ $lead->vehicle_type ?? '—' }}</p>
                                <p class="font-sans text-[0.65rem] uppercase tracking-wider mt-0.5" style="color: {{ $inkMute }};">{{ $lead->material_selected ?? '—' }}</p>
                            </div>

                            {{-- Col 3: Est. Harga --}}
                            <div class="row-bg w-32 px-5 py-4 text-right" style="background: {{ $bgCard }};">
                                @if($lead->calculated_price > 0)
                                    <span class="font-mono font-700 text-sm" style="color: {{ $gold }};">Rp {{ number_format($lead->calculated_price, 0, ',', '.') }}</span>
                                @else
                                    <span style="color: {{ $inkMute }};">—</span>
                                @endif
                            </div>

                            {{-- Col 4: Status --}}
                            <div class="row-bg w-40 px-5 py-4 text-center" style="background: {{ $bgCard }};">
                                <form action="{{ route('dashboard.leads.status', $lead) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                            class="font-sans text-[0.65rem] font-700 uppercase tracking-widest px-2 py-1 outline-none cursor-pointer"
                                            style="
                                            {{ match($lead->status) {
                                                'raw'       => 'background: oklch(0.67 0.13 66 / 0.12); color: oklch(0.67 0.13 66); border: 1px solid oklch(0.67 0.13 66 / 0.30);',
                                                'follow_up' => 'background: oklch(0.60 0.18 255 / 0.12); color: oklch(0.60 0.18 255); border: 1px solid oklch(0.60 0.18 255 / 0.30);',
                                                'dealt'     => 'background: oklch(0.62 0.14 155 / 0.12); color: oklch(0.62 0.14 155); border: 1px solid oklch(0.62 0.14 155 / 0.30);',
                                                'dropped'   => 'background: transparent; color: ' . $inkMute . '; border: 1px solid ' . $border . ';',
                                                default     => 'background: ' . $bg . '; color: ' . $inkSec . '; border: 1px solid ' . $border . ';',
                                            } }}">
                                        <option value="raw"       {{ $lead->status === 'raw'       ? 'selected' : '' }} style="background: {{ $bgCard }}; color: {{ $inkPri }};">Baru</option>
                                        <option value="follow_up" {{ $lead->status === 'follow_up' ? 'selected' : '' }} style="background: {{ $bgCard }}; color: {{ $inkPri }};">Negosiasi</option>
                                        <option value="dealt"     {{ $lead->status === 'dealt'     ? 'selected' : '' }} style="background: {{ $bgCard }}; color: {{ $inkPri }};">Dealt</option>
                                        <option value="dropped"   {{ $lead->status === 'dropped'   ? 'selected' : '' }} style="background: {{ $bgCard }}; color: {{ $inkPri }};">Batal</option>
                                    </select>
                                </form>
                            </div>

                            {{-- Col 5: Waktu Masuk --}}
                            <div class="row-bg w-32 px-5 py-4" style="background: {{ $bgCard }};">
                                <span class="font-sans text-[0.65rem] uppercase tracking-wider" style="color: {{ $inkMute }};">{{ $lead->created_at->diffForHumans() }}</span>
                            </div>

                            {{-- Col 6: Aksi --}}
                            <div class="row-bg flex-1 px-5 py-4 text-right" style="background: {{ $bgCard }};">
                                <div class="flex items-center justify-end gap-3">
                                    @if($lead->status !== 'dropped' && $lead->status !== 'dealt')
                                        <button
                                            @click="openConvert({{ $lead->id }}, '{{ addslashes($lead->customer_name) }}', '{{ $lead->vehicle_type ?? '' }}', '{{ $lead->material_selected ?? '' }}')"
                                            class="font-sans text-[0.65rem] font-700 uppercase tracking-widest transition-colors duration-200"
                                            style="color: {{ $inkSec }};"
                                            onmouseover="this.style.color='{{ $inkPri }}'" onmouseout="this.style.color='{{ $inkSec }}'"
                                        >Order</button>
                                    @endif
                                    <form action="{{ route('dashboard.leads.destroy', $lead) }}" method="POST"
                                          onsubmit="return confirm('Hapus permanen prospek ini?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="font-sans text-[0.65rem] font-700 uppercase tracking-widest transition-colors duration-200"
                                                style="color: oklch(0.60 0.20 25);"
                                                onmouseover="this.style.color='oklch(0.70 0.22 25)'" onmouseout="this.style.color='oklch(0.60 0.20 25)'"
                                        >Hapus</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- Pruning Info --}}
                <div class="px-6 py-4 flex items-center gap-2" style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; border-top: none;">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $inkMute }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-sans text-[0.65rem] uppercase tracking-wider" style="color: {{ $inkMute }};">
                        Data dengan status <strong>Baru</strong> &amp; <strong>Batal</strong> berumur &gt; 30 hari dihapus otomatis.
                        <code style="background: {{ $border }}; padding: 0.125rem 0.25rem;">php artisan leads:prune</code>
                    </span>
                </div>
            @endif

        </div>

        {{-- =====================================================================
             MODAL: Convert Lead to Work Order
             ===================================================================== --}}
        <div x-show="open" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             @keydown.escape.window="open = false">

            {{-- Backdrop --}}
            <div class="absolute inset-0" style="background: oklch(0.08 0.01 55 / 0.88); backdrop-filter: blur(4px);"
                 @click="open = false"
                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"></div>

            {{-- Modal Panel --}}
            <div class="relative w-full max-w-lg overflow-hidden"
                 style="background: {{ $bgCard }}; border: 1px solid {{ $border }};"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <div class="flex items-center justify-between px-7 pt-7 pb-5" style="border-bottom: 1px solid {{ $border }};">
                    <div>
                        <h3 class="font-display font-700" style="font-size: 1.4rem; color: {{ $inkPri }}; letter-spacing: -0.02em;">Jadikan Pesanan</h3>
                        <p class="font-sans text-sm mt-1" style="color: {{ $inkMute }};">Mengkonversi prospek <span style="color: {{ $inkSec }};" x-text="leadName"></span></p>
                    </div>
                    <button @click="open = false" class="w-8 h-8 flex items-center justify-center transition-colors duration-200"
                            style="color: {{ $inkMute }}; border: 1px solid {{ $border }};"
                            onmouseover="this.style.color='{{ $inkPri }}'; this.style.borderColor='{{ $inkPri }}'"
                            onmouseout="this.style.color='{{ $inkMute }}'; this.style.borderColor='{{ $border }}'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form :action="`/dashboard/leads/${leadId}/convert`" method="POST" class="px-7 py-6 space-y-5">
                    @csrf
                    <div class="p-4 flex flex-col gap-2" style="background: {{ $bg }}; border: 1px solid {{ $border }};">
                        <div class="flex justify-between font-sans text-[0.65rem] uppercase tracking-wider"><span style="color: {{ $inkMute }};">Pelanggan</span><span style="color: {{ $inkPri }};" x-text="leadName"></span></div>
                        <div class="flex justify-between font-sans text-[0.65rem] uppercase tracking-wider"><span style="color: {{ $inkMute }};">Kendaraan</span><span style="color: {{ $inkSec }};" x-text="leadVehicle || '—'"></span></div>
                        <div class="flex justify-between font-sans text-[0.65rem] uppercase tracking-wider"><span style="color: {{ $inkMute }};">Material</span><span style="color: {{ $inkSec }};" x-text="leadMaterial || '—'"></span></div>
                    </div>

                    <div>
                        <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Plat Nomor <span style="color: oklch(0.60 0.20 25);">*</span></label>
                        <input type="text" name="raw_plat" required placeholder="cth: B 1234 XYZ"
                               @input="$event.target.value = $event.target.value.toUpperCase()"
                               class="w-full font-mono font-700 uppercase tracking-widest text-sm px-4 py-3 outline-none transition-colors duration-200"
                               style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                               onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
                    </div>
                    <div>
                        <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Kategori Kendaraan <span style="color: oklch(0.60 0.20 25);">*</span></label>
                        <select name="vehicle_category_id" required @change="updateMaterials($event.target.value)"
                                class="w-full font-sans text-sm px-4 py-3 outline-none transition-colors duration-200"
                                style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
                            <option value="" style="color: {{ $inkMute }};">-- Pilih Kategori --</option>
                            @foreach($vehicleCategories as $cat)
                                <option value="{{ $cat->id }}" data-pricelists="{{ $cat->pricelists->toJson() }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Material <span style="color: oklch(0.60 0.20 25);">*</span></label>
                        <select name="pricelist_id" required x-model="selectedPricelist" :disabled="materials.length === 0"
                                class="w-full font-sans text-sm px-4 py-3 outline-none transition-colors duration-200 disabled:opacity-50"
                                style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};"
                                onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
                            <option value="" style="color: {{ $inkMute }};">-- Pilih Material --</option>
                            <template x-for="mat in materials" :key="mat.id">
                                <option :value="mat.id" x-text="mat.item_name + ' — Rp ' + Number(mat.price).toLocaleString('id-ID')"></option>
                            </template>
                        </select>
                    </div>
                    <div>
                        <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMute }};">Tanggal Jadwal <span style="color: oklch(0.60 0.20 25);">*</span></label>
                        <input type="date" name="scheduled_at" required :min="today"
                               class="w-full font-sans text-sm px-4 py-3 outline-none transition-colors duration-200"
                               style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }}; color-scheme: dark;"
                               onfocus="this.style.borderColor='{{ $gold }}'" onblur="this.style.borderColor='{{ $border }}'">
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="button" @click="open = false" class="flex-1 py-3 font-sans font-700 text-sm transition-all duration-200"
                                style="border: 1px solid {{ $border }}; color: {{ $inkMute }}; background: transparent;"
                                onmouseover="this.style.borderColor='{{ $inkPri }}'; this.style.color='{{ $inkPri }}'"
                                onmouseout="this.style.borderColor='{{ $border }}'; this.style.color='{{ $inkMute }}'"
                        >Batal</button>
                        <button type="submit" class="flex-1 py-3 font-sans font-700 text-sm transition-all duration-200 active:scale-95"
                                style="background: {{ $gold }}; color: {{ $bg }}; border: 1px solid {{ $gold }};"
                                onmouseover="this.style.background='{{ $goldHov }}'; this.style.borderColor='{{ $goldHov }}'"
                                onmouseout="this.style.background='{{ $gold }}'; this.style.borderColor='{{ $gold }}'"
                        >Konversi ke Pesanan →</button>
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

