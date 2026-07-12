<x-layout title="Dashboard — Nusantara Jok">
<div
    class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-10"
    x-data="orderModal()"
    style="color: oklch(0.93 0.012 75);"
>
    {{-- ═══════════════════════════════════════
         Header
    ═══════════════════════════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 gap-4">
        <div>
            <h1
                class="font-display font-700"
                style="font-size: 2.25rem; letter-spacing: -0.03em; color: oklch(0.93 0.012 75); line-height: 1.0;"
            >Dashboard</h1>
            <p class="font-sans text-sm mt-1.5 flex items-center gap-2 not-italic" style="color: oklch(0.50 0.020 62);">
                Selamat datang,
                <span class="font-700 not-italic" style="color: oklch(0.72 0.025 68);">{{ Auth::user()->name ?? 'User' }}</span>
                <span
                    class="font-sans text-[0.6rem] font-700 uppercase tracking-widest px-2 py-0.5 not-italic"
                    style="{{ Auth::user()->role === 'admin'
                        ? 'background: oklch(0.67 0.13 66 / 0.12); color: oklch(0.75 0.11 67); border: 1px solid oklch(0.67 0.13 66 / 0.30);'
                        : 'background: oklch(0.62 0.14 155 / 0.10); color: oklch(0.62 0.14 155); border: 1px solid oklch(0.62 0.14 155 / 0.25);' }}"
                >{{ Auth::user()->role }}</span>
            </p>
        </div>

        @if(Auth::user()->role === 'admin')
        <div class="flex items-center gap-3">
            @if($rawLeadsCount > 0)
            <a
                href="{{ route('dashboard.leads.index') }}"
                class="relative inline-flex items-center gap-2 px-4 py-2.5 font-sans font-700 text-sm transition-all duration-200"
                style="color: oklch(0.72 0.014 80); border: 1px solid oklch(0.72 0.014 80 / 0.35); background: oklch(0.72 0.014 80 / 0.07);"
                onmouseover="this.style.borderColor='oklch(0.72 0.014 80 / 0.7)'; this.style.background='oklch(0.72 0.014 80 / 0.12)'"
                onmouseout="this.style.borderColor='oklch(0.72 0.014 80 / 0.35)'; this.style.background='oklch(0.72 0.014 80 / 0.07)'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Prospek (Leads)
                <span
                    class="absolute -top-2 -right-2 w-5 h-5 flex items-center justify-center font-sans font-900 text-[10px]"
                    style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55);"
                >{{ $rawLeadsCount }}</span>
            </a>
            @else
            <a
                href="{{ route('dashboard.leads.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 font-sans font-700 text-sm transition-all duration-200"
                style="color: oklch(0.50 0.020 62); border: 1px solid oklch(0.28 0.025 55); background: transparent;"
                onmouseover="this.style.borderColor='oklch(0.38 0.03 60)'; this.style.color='oklch(0.72 0.025 68)'"
                onmouseout="this.style.borderColor='oklch(0.28 0.025 55)'; this.style.color='oklch(0.50 0.020 62)'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Prospek (Leads)
            </a>
            @endif

            <button
                @click="open = true"
                class="inline-flex items-center gap-2 px-5 py-2.5 font-sans font-700 text-sm transition-all duration-200 active:scale-95"
                style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55); border: 1px solid oklch(0.67 0.13 66);"
                onmouseover="this.style.background='oklch(0.75 0.11 67)'; this.style.borderColor='oklch(0.75 0.11 67)'"
                onmouseout="this.style.background='oklch(0.67 0.13 66)'; this.style.borderColor='oklch(0.67 0.13 66)'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tambah Pesanan Manual
            </button>
        </div>
        @endif
    </div>

    {{-- ═══════════════════════════════════════
         Success Alert
    ═══════════════════════════════════════ --}}
    @if(session('success'))
        <div
            class="mb-8 flex items-center gap-3 px-5 py-4 font-sans text-sm font-500"
            style="background: oklch(0.62 0.14 155 / 0.08); border: 1px solid oklch(0.62 0.14 155 / 0.25); color: oklch(0.62 0.14 155);"
        >
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ═══════════════════════════════════════
         Admin Quick Links — horizontal nav strip (not identical card grid)
    ═══════════════════════════════════════ --}}
    @if(Auth::user()->role === 'admin')
        <div
            class="flex flex-wrap items-center gap-0 mb-10"
            style="border: 1px solid oklch(0.22 0.02 55);"
        >
            <a
                href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-2.5 px-5 py-3.5 font-sans font-700 text-sm transition-all duration-200 group"
                style="color: oklch(0.50 0.020 62); border-right: 1px solid oklch(0.22 0.02 55);"
                onmouseover="this.style.color='oklch(0.93 0.012 75)'; this.style.background='oklch(0.155 0.022 55)'"
                onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.background='transparent'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                Kategori
            </a>
            <a
                href="{{ route('admin.galleries.index') }}"
                class="flex items-center gap-2.5 px-5 py-3.5 font-sans font-700 text-sm transition-all duration-200"
                style="color: oklch(0.50 0.020 62); border-right: 1px solid oklch(0.22 0.02 55);"
                onmouseover="this.style.color='oklch(0.93 0.012 75)'; this.style.background='oklch(0.155 0.022 55)'"
                onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.background='transparent'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Galeri
            </a>
            <a
                href="{{ route('admin.pricelist.index') }}"
                class="flex items-center gap-2.5 px-5 py-3.5 font-sans font-700 text-sm transition-all duration-200"
                style="color: oklch(0.50 0.020 62); border-right: 1px solid oklch(0.22 0.02 55);"
                onmouseover="this.style.color='oklch(0.93 0.012 75)'; this.style.background='oklch(0.155 0.022 55)'"
                onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.background='transparent'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Pricelist
            </a>
            <a
                href="{{ route('admin.vehicle-categories.index') }}"
                class="flex items-center gap-2.5 px-5 py-3.5 font-sans font-700 text-sm transition-all duration-200"
                style="color: oklch(0.50 0.020 62); border-right: 1px solid oklch(0.22 0.02 55);"
                onmouseover="this.style.color='oklch(0.93 0.012 75)'; this.style.background='oklch(0.155 0.022 55)'"
                onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.background='transparent'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Kategori Kendaraan
            </a>
            <a
                href="{{ route('admin.schedule.index') }}"
                class="flex items-center gap-2.5 px-5 py-3.5 font-sans font-700 text-sm transition-all duration-200"
                style="color: oklch(0.50 0.020 62);"
                onmouseover="this.style.color='oklch(0.93 0.012 75)'; this.style.background='oklch(0.155 0.022 55)'"
                onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.background='transparent'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Jadwal Slot
            </a>
        </div>
    @endif

    {{-- ═══════════════════════════════════════
         Kanban Header & Filter
    ═══════════════════════════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
        <div>
            <h2 class="font-display font-700" style="font-size: 1.5rem; letter-spacing: -0.01em; color: oklch(0.93 0.012 75);">Work Orders Aktif</h2>
            <p class="font-sans text-sm mt-1" style="color: oklch(0.50 0.020 62);">Hanya menampilkan order yang belum selesai.</p>
        </div>

        <form action="{{ route('dashboard.index') }}" method="GET" class="flex items-center gap-2">
            <select
                name="month"
                onchange="this.form.submit()"
                class="font-sans text-sm font-500 px-3 py-2 outline-none transition-colors duration-200"
                style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.72 0.025 68);"
            >
                @foreach(range(1, 12) as $m)
                    <option
                        value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}"
                        {{ $filterMonth == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}
                        style="background: oklch(0.12 0.018 55); color: oklch(0.72 0.025 68);"
                    >{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                @endforeach
            </select>
            <select
                name="year"
                onchange="this.form.submit()"
                class="font-sans text-sm font-500 px-3 py-2 outline-none transition-colors duration-200"
                style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.72 0.025 68);"
            >
                @foreach(range(date('Y') - 1, date('Y') + 1) as $y)
                    <option
                        value="{{ $y }}"
                        {{ $filterYear == $y ? 'selected' : '' }}
                        style="background: oklch(0.12 0.018 55); color: oklch(0.72 0.025 68);"
                    >{{ $y }}</option>
                @endforeach
            </select>
            <a
                href="{{ route('dashboard.work-orders.history') }}"
                class="flex items-center gap-1.5 px-4 py-2 font-sans font-700 text-sm transition-all duration-200"
                style="color: oklch(0.50 0.020 62); border: 1px solid oklch(0.28 0.025 55); background: transparent;"
                onmouseover="this.style.color='oklch(0.72 0.025 68)'; this.style.borderColor='oklch(0.38 0.03 60)'"
                onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.borderColor='oklch(0.28 0.025 55)'"
            >
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Riwayat
            </a>
        </form>
    </div>

    {{-- ═══════════════════════════════════════
         Kanban Board
    ═══════════════════════════════════════ --}}
    @php
        $nextStatus = [
            'antrian' => 'proses',
            'proses'  => 'selesai',
        ];
        $dotColors = [
            'slate'   => 'oklch(0.60 0.04 250)',
            'amber'   => 'oklch(0.72 0.14 80)',
            'blue'    => 'oklch(0.60 0.18 255)',
            'violet'  => 'oklch(0.60 0.18 300)',
            'emerald' => 'oklch(0.62 0.14 155)',
            'orange'  => 'oklch(0.67 0.13 66)',
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        @foreach($kanbanColumns as $status => $orders)
            @php
                $dotColor = $dotColors[$statusColors[$status]] ?? $dotColors['slate'];
            @endphp
            <div class="flex flex-col">
                {{-- Column header --}}
                <div class="flex items-center gap-2 mb-3 px-1">
                    <span class="w-2 h-2" style="background: {{ $dotColor }}; border-radius: 0;"></span>
                    <h3 class="font-sans text-xs font-700 uppercase tracking-wider flex-1" style="color: oklch(0.72 0.025 68);">{{ $statusLabels[$status] }}</h3>
                    <span class="font-mono text-[10px] font-700 px-1.5 py-0.5" style="color: oklch(0.38 0.03 60); border: 1px solid oklch(0.22 0.02 55);">{{ $orders->count() }}</span>
                </div>

                {{-- Cards container --}}
                <div
                    class="flex flex-col gap-2.5 min-h-[100px] p-2.5"
                    style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.22 0.02 55);"
                >
                    @forelse($orders as $order)
                        <div
                            class="p-3.5 transition-all duration-200"
                            style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.22 0.02 55);"
                            onmouseover="this.style.borderColor='oklch(0.28 0.025 55)'"
                            onmouseout="this.style.borderColor='oklch(0.22 0.02 55)'"
                        >
                            <div class="flex items-start justify-between mb-2">
                                <span class="font-mono font-700 text-sm tracking-wide" style="color: oklch(0.93 0.012 75);">{{ $order->raw_plat }}</span>
                                <span
                                    class="font-mono text-[10px] font-700 px-1.5 py-0.5"
                                    style="color: {{ $dotColor }}; border: 1px solid {{ $dotColor }}; opacity: 0.7;"
                                >{{ $order->progress_percent }}%</span>
                            </div>
                            <p class="font-sans text-xs mb-0.5" style="color: oklch(0.50 0.020 62);">{{ $order->vehicle_type }}</p>
                            @if($order->lead)
                                <p class="font-sans text-xs font-700 mb-0.5" style="color: oklch(0.72 0.025 68);">{{ $order->lead->customer_name }}</p>
                            @endif
                            <p class="font-sans text-[10px] mb-3" style="color: oklch(0.38 0.03 60);">{{ $order->scheduled_at->format('d M Y') }}</p>

                            @if(isset($nextStatus[$status]))
                                <form action="{{ route('dashboard.work-orders.update-status', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ $nextStatus[$status] }}">
                                    <button
                                        type="submit"
                                        class="w-full font-sans text-xs font-700 px-3 py-2 transition-all duration-200 touch-target"
                                        style="background: transparent; border: 1px solid oklch(0.28 0.025 55); color: oklch(0.72 0.025 68);"
                                        onmouseover="this.style.background='oklch(0.67 0.13 66)'; this.style.borderColor='oklch(0.67 0.13 66)'; this.style.color='oklch(0.12 0.018 55)'"
                                        onmouseout="this.style.background='transparent'; this.style.borderColor='oklch(0.28 0.025 55)'; this.style.color='oklch(0.72 0.025 68)'"
                                    >→ {{ $statusLabels[$nextStatus[$status]] ?? ucfirst($nextStatus[$status]) }}</button>
                                </form>
                            @else
                                <p class="text-center font-sans text-xs font-700" style="color: oklch(0.62 0.14 155);">✓ Selesai</p>
                            @endif

                            {{-- WA Notification --}}
                            @if($status === 'proses' && $order->lead && $order->lead->whatsapp_number !== 'Pending')
                                @php
                                    $waName = $order->lead->customer_name;
                                    $waPlat = $order->raw_plat;
                                    $waMsg = "Halo Bapak/Ibu {$waName}, salam dari Nusantara Jok. Mahakarya interior untuk kendaraan {$waPlat} telah selesai dikerjakan dengan sempurna oleh artisan kami dan siap diambil. Terima kasih atas kepercayaan Anda.";
                                    $waLink = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $order->lead->whatsapp_number) . '?text=' . urlencode($waMsg);
                                @endphp
                                <a
                                    href="{{ $waLink }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-2 w-full inline-flex items-center justify-center gap-1.5 font-sans text-xs font-700 px-3 py-2 transition-all duration-200 touch-target"
                                    style="background: oklch(0.62 0.14 155 / 0.08); border: 1px solid oklch(0.62 0.14 155 / 0.25); color: oklch(0.62 0.14 155);"
                                    onmouseover="this.style.background='oklch(0.62 0.14 155 / 0.16)'; this.style.borderColor='oklch(0.62 0.14 155 / 0.5)'"
                                    onmouseout="this.style.background='oklch(0.62 0.14 155 / 0.08)'; this.style.borderColor='oklch(0.62 0.14 155 / 0.25)'"
                                >
                                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                                    Kabari Pelanggan
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="flex items-center justify-center py-6">
                            <p class="font-sans text-xs italic" style="color: oklch(0.35 0.015 60);">Kosong</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

    {{-- ═══════════════════════════════════════
         Modal: Tambah Pesanan Manual
    ═══════════════════════════════════════ --}}
    @if(Auth::user()->role === 'admin')
    <div
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[400] flex items-center justify-center p-4"
        @keydown.escape.window="open = false"
    >
        {{-- Backdrop --}}
        <div
            class="absolute inset-0"
            style="background: oklch(0.08 0.01 55 / 0.88); backdrop-filter: blur(4px);"
            @click="open = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        {{-- Panel --}}
        <div
            class="relative w-full max-w-lg overflow-hidden"
            style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.28 0.025 55);"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        >
            {{-- Modal header --}}
            <div class="flex items-center justify-between px-7 pt-7 pb-5" style="border-bottom: 1px solid oklch(0.22 0.02 55);">
                <div>
                    <h3 class="font-display font-700" style="font-size: 1.4rem; color: oklch(0.93 0.012 75); letter-spacing: -0.02em;">Tambah Pesanan Manual</h3>
                    <p class="font-sans text-sm mt-1" style="color: oklch(0.50 0.020 62);">Pelanggan walk-in atau konversi dari WhatsApp.</p>
                </div>
                <button
                    @click="open = false"
                    class="w-8 h-8 flex items-center justify-center transition-colors duration-200"
                    style="color: oklch(0.50 0.020 62); border: 1px solid oklch(0.28 0.025 55);"
                    onmouseover="this.style.color='oklch(0.93 0.012 75)'; this.style.borderColor='oklch(0.38 0.03 60)'"
                    onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.borderColor='oklch(0.28 0.025 55)'"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Form --}}
            <form action="{{ route('dashboard.work-orders.store') }}" method="POST" class="px-7 py-6 space-y-5">
                @csrf
                <div class="grid grid-cols-2 gap-4">

                    <div class="col-span-2">
                        <label class="font-sans text-xs font-700 uppercase tracking-wider mb-2 block" style="color: oklch(0.50 0.020 62);">
                            Nama Pelanggan <span style="color: oklch(0.60 0.20 25);">*</span>
                        </label>
                        <input type="text" name="customer_name" required placeholder="cth: Budi Santoso" class="input-field" style="background: oklch(0.12 0.018 55); border-color: oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                    </div>

                    <div class="col-span-2">
                        <label class="font-sans text-xs font-700 uppercase tracking-wider mb-2 block" style="color: oklch(0.50 0.020 62);">
                            Nomor WhatsApp <span style="color: oklch(0.60 0.20 25);">*</span>
                        </label>
                        <input type="text" name="whatsapp_number" required placeholder="cth: 08123456789" class="input-field" style="background: oklch(0.12 0.018 55); border-color: oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);">
                    </div>

                    <div class="col-span-2">
                        <label class="font-sans text-xs font-700 uppercase tracking-wider mb-2 block" style="color: oklch(0.50 0.020 62);">
                            Plat Nomor <span style="color: oklch(0.60 0.20 25);">*</span>
                        </label>
                        <input
                            type="text"
                            name="raw_plat"
                            required
                            placeholder="cth: B 1234 XYZ"
                            x-model="rawPlat"
                            @input="rawPlat = $event.target.value.toUpperCase()"
                            class="input-field font-mono font-700 uppercase tracking-widest"
                            style="background: oklch(0.12 0.018 55); border-color: oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);"
                        >
                        <p class="font-sans text-[11px] mt-1.5" style="color: oklch(0.38 0.03 60);">
                            Normalized: <span class="font-mono font-700" style="color: oklch(0.67 0.13 66);" x-text="normalizePlat(rawPlat)"></span>
                        </p>
                    </div>

                    <div class="col-span-2">
                        <label class="font-sans text-xs font-700 uppercase tracking-wider mb-2 block" style="color: oklch(0.50 0.020 62);">
                            Kategori Kendaraan <span style="color: oklch(0.60 0.20 25);">*</span>
                        </label>
                        <select
                            name="vehicle_category_id"
                            required
                            @change="updateMaterials($event.target.value)"
                            class="input-field"
                            style="background: oklch(0.12 0.018 55); border-color: oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);"
                        >
                            <option value="" style="background: oklch(0.12 0.018 55);">-- Pilih Kategori --</option>
                            @foreach($vehicleCategories as $cat)
                                <option value="{{ $cat->id }}" data-pricelists="{{ $cat->pricelists->toJson() }}" style="background: oklch(0.12 0.018 55);">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="font-sans text-xs font-700 uppercase tracking-wider mb-2 block" style="color: oklch(0.50 0.020 62);">
                            Material <span style="color: oklch(0.60 0.20 25);">*</span>
                        </label>
                        <select
                            name="pricelist_id"
                            required
                            x-model="selectedPricelist"
                            :disabled="materials.length === 0"
                            class="input-field disabled:opacity-40"
                            style="background: oklch(0.12 0.018 55); border-color: oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);"
                        >
                            <option value="" style="background: oklch(0.12 0.018 55);">-- Pilih Material --</option>
                            <template x-for="mat in materials" :key="mat.id">
                                <option :value="mat.id" x-text="mat.item_name + ' — Rp ' + Number(mat.price).toLocaleString('id-ID')" style="background: oklch(0.12 0.018 55);"></option>
                            </template>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="font-sans text-xs font-700 uppercase tracking-wider mb-2 block" style="color: oklch(0.50 0.020 62);">
                            Tanggal Jadwal Pengerjaan <span style="color: oklch(0.60 0.20 25);">*</span>
                        </label>
                        <input
                            type="date"
                            name="scheduled_at"
                            required
                            :min="today"
                            class="input-field"
                            style="background: oklch(0.12 0.018 55); border-color: oklch(0.28 0.025 55); color: oklch(0.93 0.012 75); color-scheme: dark;"
                        >
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button
                        type="button"
                        @click="open = false"
                        class="flex-1 py-3 font-sans font-700 text-sm transition-all duration-200"
                        style="border: 1px solid oklch(0.28 0.025 55); color: oklch(0.50 0.020 62); background: transparent;"
                        onmouseover="this.style.borderColor='oklch(0.38 0.03 60)'; this.style.color='oklch(0.72 0.025 68)'"
                        onmouseout="this.style.borderColor='oklch(0.28 0.025 55)'; this.style.color='oklch(0.50 0.020 62)'"
                    >Batal</button>
                    <button
                        type="submit"
                        class="flex-1 py-3 font-sans font-700 text-sm transition-all duration-200 active:scale-95"
                        style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55); border: 1px solid oklch(0.67 0.13 66);"
                        onmouseover="this.style.background='oklch(0.75 0.11 67)'"
                        onmouseout="this.style.background='oklch(0.67 0.13 66)'"
                    >Masukkan ke Antrian →</button>
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


