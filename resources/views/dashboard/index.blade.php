<x-layout title="Dashboard — Nusantara Jok">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative" x-data="orderModal()">
    <div class="absolute -top-40 right-0 w-[40rem] h-[40rem] bg-accent-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    {{-- Header --}}
    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4 z-10">
        <div>
            <h1 class="font-display text-3xl font-bold text-white tracking-tight drop-shadow-md">Dashboard</h1>
            <p class="text-slate-400 mt-1">Selamat datang, <span class="font-semibold text-slate-200">{{ Auth::user()->name ?? 'User' }}</span>. <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider border {{ Auth::user()->role === 'admin' ? 'bg-indigo-500/20 text-indigo-300 border-indigo-500/30' : 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30' }}">{{ Auth::user()->role }}</span></p>
        </div>
        @if(Auth::user()->role === 'admin')
        <div class="flex items-center gap-3">
            {{-- Leads Notification Badge --}}
            @if($rawLeadsCount > 0)
            <a href="{{ route('dashboard.leads.index') }}"
               class="relative inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-amber-500/50 bg-amber-500/20 text-amber-300 font-bold text-sm hover:bg-amber-500/30 transition-colors shadow-[0_0_15px_rgba(245,158,11,0.2)]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Prospek (Leads)
                <span class="absolute -top-2 -right-2 w-5 h-5 bg-accent-500 text-white text-[10px] font-black rounded-full flex items-center justify-center shadow-md">{{ $rawLeadsCount }}</span>
            </a>
            @else
            <a href="{{ route('dashboard.leads.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-white/10 bg-white/5 text-slate-300 font-bold text-sm hover:bg-white/10 transition-colors backdrop-blur-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Prospek (Leads)
            </a>
            @endif
            {{-- Primary CTA: Tambah Pesanan Manual --}}
            <button @click="open = true"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-accent-500 text-white font-bold text-sm hover:bg-accent-400 border border-accent-400/50 hover:-translate-y-0.5 shadow-[0_0_15px_rgba(249,115,22,0.3)] hover:shadow-[0_0_25px_rgba(249,115,22,0.5)] transition-all duration-200 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Pesanan Manual
            </button>
        </div>
        @endif
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="relative z-10 mb-6 bg-emerald-500/10 text-emerald-400 p-4 rounded-xl border border-emerald-500/30 flex items-center gap-3 backdrop-blur-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Admin Quick Links --}}
    @if(Auth::user()->role === 'admin')
        <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">
            <a href="{{ route('admin.categories.index') }}" class="group block bg-slate-800/80 backdrop-blur-md border border-white/10 p-5 rounded-2xl shadow-[0_0_15px_rgba(0,0,0,0.3)] hover:shadow-[0_0_25px_rgba(59,130,246,0.15)] transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 bg-blue-500/20 border border-blue-500/30 rounded-xl flex items-center justify-center text-blue-400 group-hover:bg-blue-500/30 transition-colors shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Kategori</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Atur kategori galeri</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="group block bg-slate-800/80 backdrop-blur-md border border-white/10 p-5 rounded-2xl shadow-[0_0_15px_rgba(0,0,0,0.3)] hover:shadow-[0_0_25px_rgba(139,92,246,0.15)] transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 bg-violet-500/20 border border-violet-500/30 rounded-xl flex items-center justify-center text-violet-400 group-hover:bg-violet-500/30 transition-colors shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Galeri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Unggah & atur showcase</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.pricelist.index') }}" class="group block bg-slate-800/80 backdrop-blur-md border border-white/10 p-5 rounded-2xl shadow-[0_0_15px_rgba(0,0,0,0.3)] hover:shadow-[0_0_25px_rgba(245,158,11,0.15)] transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 bg-amber-500/20 border border-amber-500/30 rounded-xl flex items-center justify-center text-amber-400 group-hover:bg-amber-500/30 transition-colors shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm">Pricelist</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Kelola harga material</p>
                    </div>
                </div>
            </a>
        </div>
    @endif

    {{-- Kanban Header --}}
    <div class="relative z-10 flex items-center justify-between mb-6">
        <div>
            <h2 class="font-display text-xl font-bold text-white tracking-tight drop-shadow-sm">Work Orders Aktif</h2>
            <p class="text-slate-400 text-sm mt-1">Klik tombol status untuk memajukan progres pengerjaan.</p>
        </div>
    </div>

    @php
        $nextStatus = [
            'antrian'   => 'bongkar',
            'bongkar'   => 'potong',
            'potong'    => 'jahit',
            'jahit'     => 'pasang',
            'pasang'    => 'finishing',
            'finishing' => 'selesai',
        ];
        $colorMap = [
            'slate'   => ['bg' => 'bg-slate-900/50',   'border' => 'border-slate-700', 'badge' => 'bg-slate-700 text-slate-200',  'dot' => 'bg-slate-400'],
            'amber'   => ['bg' => 'bg-amber-900/20',   'border' => 'border-amber-700/50', 'badge' => 'bg-amber-900/50 text-amber-300',  'dot' => 'bg-amber-400'],
            'blue'    => ['bg' => 'bg-blue-900/20',    'border' => 'border-blue-700/50',  'badge' => 'bg-blue-900/50 text-blue-300',   'dot' => 'bg-blue-400'],
            'violet'  => ['bg' => 'bg-violet-900/20',  'border' => 'border-violet-700/50','badge' => 'bg-violet-900/50 text-violet-300','dot' => 'bg-violet-400'],
            'emerald' => ['bg' => 'bg-emerald-900/20', 'border' => 'border-emerald-700/50','badge' => 'bg-emerald-900/50 text-emerald-300','dot' => 'bg-emerald-400'],
            'orange'  => ['bg' => 'bg-orange-900/20',  'border' => 'border-orange-700/50','badge' => 'bg-orange-900/50 text-orange-300','dot' => 'bg-orange-400'],
        ];
    @endphp

    <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        @foreach($kanbanColumns as $status => $orders)
            @php $colors = $colorMap[$statusColors[$status]] ?? $colorMap['slate']; @endphp
            <div class="flex flex-col">
                {{-- Column Header --}}
                <div class="flex items-center gap-2 mb-3 px-1">
                    <span class="w-2.5 h-2.5 rounded-full {{ $colors['dot'] }} shadow-[0_0_8px_currentColor]"></span>
                    <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider">{{ $statusLabels[$status] }}</h3>
                    <span class="ml-auto text-xs font-bold {{ $colors['badge'] }} border border-white/5 px-2 py-0.5 rounded-full">{{ $orders->count() }}</span>
                </div>

                {{-- Cards Container --}}
                <div class="flex flex-col gap-3 min-h-[120px] {{ $colors['bg'] }} border {{ $colors['border'] }} backdrop-blur-sm rounded-2xl p-3 shadow-inner">
                    @forelse($orders as $order)
                        <div class="bg-slate-800 border border-white/10 rounded-xl p-3.5 shadow-md hover:shadow-lg hover:border-white/20 transition-all">
                            <div class="flex items-start justify-between mb-2">
                                <span class="font-mono font-bold text-white text-sm tracking-wide">{{ $order->raw_plat }}</span>
                                <span class="text-[10px] font-bold {{ $colors['badge'] }} border border-white/5 px-1.5 py-0.5 rounded">{{ $order->progress_percent }}%</span>
                            </div>
                            <p class="text-xs text-slate-400 mb-0.5">{{ $order->vehicle_type }}</p>
                            @if($order->lead)
                                <p class="text-xs font-semibold text-slate-300 mb-0.5">{{ $order->lead->customer_name }}</p>
                            @endif
                            <p class="text-[10px] text-slate-500 mb-3">📅 {{ $order->scheduled_at->format('d M Y') }}</p>

                            @if(isset($nextStatus[$status]))
                                <form action="{{ route('dashboard.work-orders.update-status', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ $nextStatus[$status] }}">
                                    <button type="submit" class="w-full text-xs font-bold px-3 py-2 rounded-lg border border-white/10 bg-white/5 text-white hover:bg-accent-500 hover:border-accent-400 transition-colors touch-target shadow-sm">
                                        → {{ $statusLabels[$nextStatus[$status]] ?? ucfirst($nextStatus[$status]) }}
                                    </button>
                                </form>
                            @else
                                <span class="block text-center text-xs font-bold text-emerald-400 mb-2 drop-shadow-sm">✓ Tahap Akhir</span>
                            @endif

                            {{-- WA Notification Button for finishing column --}}
                            @if($status === 'finishing' && $order->lead && $order->lead->whatsapp_number !== 'Pending')
                                @php
                                    $waName = $order->lead->customer_name;
                                    $waPlat = $order->raw_plat;
                                    $waMsg = "Halo Bapak/Ibu {$waName}, salam dari Nusantara Jok. Mahakarya interior untuk kendaraan {$waPlat} telah selesai dikerjakan dengan sempurna oleh artisan kami dan siap diambil. Terima kasih atas kepercayaan Anda.";
                                    $waLink = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $order->lead->whatsapp_number) . '?text=' . urlencode($waMsg);
                                @endphp
                                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer"
                                   class="mt-2 w-full inline-flex items-center justify-center gap-1.5 text-xs font-bold px-3 py-2 rounded-lg border border-emerald-500/50 bg-emerald-500/20 hover:bg-emerald-500 hover:text-white text-emerald-300 transition-colors touch-target shadow-sm">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                                    Kabari Pelanggan
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="flex items-center justify-center h-full py-6">
                            <p class="text-xs text-slate-500 italic">Kosong</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

    {{-- =====================================================================
         MODAL: Tambah Pesanan Manual
         ===================================================================== --}}
    @if(Auth::user()->role === 'admin')
    <div x-show="open" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         @keydown.escape.window="open = false">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" @click="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        {{-- Modal Panel --}}
        <div class="relative bg-slate-800 border border-white/10 rounded-3xl shadow-[0_0_30px_rgba(0,0,0,0.5)] w-full max-w-lg overflow-hidden"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-7 pt-7 pb-5 border-b border-slate-700">
                <div>
                    <h3 class="font-display text-xl font-black text-white">Tambah Pesanan Manual</h3>
                    <p class="text-sm text-slate-400 mt-0.5">Pelanggan walk-in atau konversi dari WhatsApp.</p>
                </div>
                <button @click="open = false" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/10 text-slate-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Modal Form --}}
            <form action="{{ route('dashboard.work-orders.store') }}" method="POST" class="px-7 py-6 space-y-5">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Nama Pelanggan <span class="text-red-400">*</span></label>
                        <input type="text" name="customer_name" required placeholder="cth: Budi Santoso"
                               class="w-full px-4 py-3 rounded-xl border border-slate-600 bg-slate-900/50 text-white text-sm font-medium placeholder-slate-500 focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 outline-none transition">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Nomor WhatsApp <span class="text-red-400">*</span></label>
                        <input type="text" name="whatsapp_number" required placeholder="cth: 08123456789"
                               class="w-full px-4 py-3 rounded-xl border border-slate-600 bg-slate-900/50 text-white text-sm font-medium placeholder-slate-500 focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 outline-none transition">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Plat Nomor <span class="text-red-400">*</span></label>
                        <input type="text" name="raw_plat" required placeholder="cth: B 1234 XYZ"
                               x-model="rawPlat"
                               @input="rawPlat = $event.target.value.toUpperCase()"
                               class="w-full px-4 py-3 rounded-xl border border-slate-600 bg-slate-900/50 text-white text-sm font-mono font-bold placeholder-slate-500 focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 outline-none transition uppercase tracking-widest">
                        <p class="text-[11px] text-slate-400 mt-1">Auto-normalized: <span class="font-mono font-bold text-slate-300" x-text="normalizePlat(rawPlat)"></span></p>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Kategori Kendaraan <span class="text-red-400">*</span></label>
                        <select name="vehicle_category_id" required @change="updateMaterials($event.target.value)"
                                class="w-full px-4 py-3 rounded-xl border border-slate-600 bg-slate-900/50 text-white text-sm font-medium focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 outline-none transition [&>option]:bg-slate-800">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($vehicleCategories as $cat)
                                <option value="{{ $cat->id }}" data-pricelists="{{ $cat->pricelists->toJson() }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Material <span class="text-red-400">*</span></label>
                        <select name="pricelist_id" required x-model="selectedPricelist"
                                class="w-full px-4 py-3 rounded-xl border border-slate-600 bg-slate-900/50 text-white text-sm font-medium focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 outline-none transition disabled:opacity-50 [&>option]:bg-slate-800" :disabled="materials.length === 0">
                            <option value="">-- Pilih Material --</option>
                            <template x-for="mat in materials" :key="mat.id">
                                <option :value="mat.id" x-text="mat.item_name + ' — Rp ' + Number(mat.price).toLocaleString('id-ID')"></option>
                            </template>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Tanggal Jadwal Pengerjaan <span class="text-red-400">*</span></label>
                        <input type="date" name="scheduled_at" required :min="today"
                               class="w-full px-4 py-3 rounded-xl border border-slate-600 bg-slate-900/50 text-white text-sm font-medium focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 outline-none transition style-color-scheme-dark">
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="button" @click="open = false"
                            class="flex-1 py-3 rounded-xl border border-slate-600 text-slate-300 font-bold text-sm hover:bg-white/10 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 py-3 rounded-xl bg-accent-500 text-white font-bold text-sm hover:bg-accent-400 transition-colors shadow-[0_0_15px_rgba(249,115,22,0.3)] active:scale-95 border border-accent-400/50">
                        Masukkan ke Antrian →
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('orderModal', () => ({
        open: false,
        rawPlat: '',
        materials: [],
        selectedPricelist: '',
        today: new Date().toISOString().split('T')[0],

        normalizePlat(raw) {
            if (!raw) return '—';
            return raw.toUpperCase().replace(/[^A-Z0-9]/g, '') || '—';
        },

        updateMaterials(catId) {
            this.materials = [];
            this.selectedPricelist = '';
            if (!catId) return;
            const select = document.querySelector('select[name="vehicle_category_id"]');
            const option = select.querySelector(`option[value="${catId}"]`);
            if (option) {
                try {
                    this.materials = JSON.parse(option.dataset.pricelists || '[]');
                } catch(e) {
                    this.materials = [];
                }
            }
        },

        // Pre-fill modal from a Lead (used by Leads pipeline page via URL params)
        initFromParams() {
            const params = new URLSearchParams(window.location.search);
            if (params.get('open_modal') === '1') {
                this.open = true;
            }
        }
    }));
});
</script>
@endpush
</x-layout>
