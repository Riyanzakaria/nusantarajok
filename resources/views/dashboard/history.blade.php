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
<x-layout title="Riwayat & Analisis — Admin BJN">
    <div class="min-h-screen" style="background: {{ $bg }}; padding: 8rem 0 8rem;">
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
                        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1;">Riwayat &amp; Analisis</h1>
                    </div>
                    <p class="font-sans text-sm mt-1" style="color: {{ $inkMute }};">Laporan lengkap seluruh pesanan dan progres bengkel.</p>
                </div>
                <div>
                    <a href="{{ route('dashboard.work-orders.export') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 font-sans font-700 text-sm transition-all duration-200 active:scale-95"
                       style="background: oklch(0.62 0.14 155); color: {{ $bg }}; border: 1px solid oklch(0.62 0.14 155);"
                       onmouseover="this.style.background='oklch(0.68 0.16 155)'"
                       onmouseout="this.style.background='oklch(0.62 0.14 155)'"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download CSV
                    </a>
                </div>
            </div>

            {{-- Analytics Widgets --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">
                <div class="p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: {{ $inkMute }};">Total Pesanan</p>
                    <div class="flex items-baseline gap-2">
                        <span class="font-display font-700 text-3xl" style="color: {{ $inkPri }};">{{ $totalOrders }}</span>
                        <span class="font-sans text-xs uppercase tracking-wider" style="color: {{ $inkMute }};">Unit</span>
                    </div>
                </div>
                <div class="p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: {{ $inkMute }};">Telah Selesai</p>
                    <div class="flex items-baseline gap-2">
                        <span class="font-display font-700 text-3xl" style="color: {{ $inkPri }};">{{ $completedOrders }}</span>
                        <span class="font-sans text-xs uppercase tracking-wider" style="color: {{ $inkMute }};">Unit</span>
                    </div>
                </div>
                <div class="p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: {{ $inkMute }};">Estimasi Pendapatan</p>
                    <div class="flex items-baseline gap-2">
                        <span class="font-mono font-700 text-2xl" style="color: {{ $gold }};">Rp {{ number_format($revenue, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- History Table --}}
            <div style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; overflow-x-auto;">
                <div class="flex items-center min-w-[900px] gap-px" style="background: {{ $border }};">
                    <div class="w-32 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em]" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Tgl Jadwal</div>
                    <div class="w-32 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em]" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Plat Nomor</div>
                    <div class="flex-1 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em]" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Pelanggan</div>
                    <div class="flex-1 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em]" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Kendaraan</div>
                    <div class="w-48 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em] text-right" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Harga &amp; Material</div>
                    <div class="w-32 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em] text-center" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Status</div>
                    <div class="w-24 px-5 py-3 font-sans text-xs uppercase tracking-[0.12em] text-center" style="background: {{ $bgCard }}; color: {{ $inkMute }};">Aksi</div>
                </div>

                @forelse($workOrders as $order)
                    <div class="flex items-center min-w-[900px] gap-px transition-colors duration-200"
                         style="background: {{ $border }}; border-top: 1px solid {{ $border }};"
                         onmouseover="this.querySelector('.row-bg').style.background='{{ $bg }}'"
                         onmouseout="this.querySelector('.row-bg').style.background='{{ $bgCard }}'">

                        <div class="row-bg w-32 px-5 py-4 font-sans text-sm" style="background: {{ $bgCard }}; color: {{ $inkSec }};">
                            {{ $order->scheduled_at->format('d M Y') }}
                        </div>
                        <div class="row-bg w-32 px-5 py-4 font-mono font-700 text-sm tracking-wide" style="background: {{ $bgCard }}; color: {{ $inkPri }};">
                            {{ $order->raw_plat }}
                        </div>
                        <div class="row-bg flex-1 px-5 py-4" style="background: {{ $bgCard }};">
                            <p class="font-sans font-700 text-sm" style="color: {{ $inkPri }};">{{ $order->lead->customer_name ?? '—' }}</p>
                            <p class="font-sans text-xs mt-0.5" style="color: {{ $inkMute }};">{{ $order->lead->whatsapp_number ?? '—' }}</p>
                        </div>
                        <div class="row-bg flex-1 px-5 py-4 font-sans text-sm" style="background: {{ $bgCard }}; color: {{ $inkSec }};">
                            {{ $order->vehicle_type }}
                        </div>
                        <div class="row-bg w-48 px-5 py-4 text-right" style="background: {{ $bgCard }};">
                            @if($order->lead)
                                <p class="font-mono font-700 text-sm" style="color: {{ $gold }};">Rp {{ number_format($order->lead->calculated_price ?? 0, 0, ',', '.') }}</p>
                                <p class="font-sans text-[0.65rem] uppercase tracking-wider mt-0.5" style="color: {{ $inkMute }};">{{ $order->lead->material_selected }}</p>
                            @else
                                <span style="color: {{ $inkMute }};">—</span>
                            @endif
                        </div>
                        <div class="row-bg w-32 px-5 py-4 text-center" style="background: {{ $bgCard }};">
                            @if($order->current_status === 'selesai')
                                <span class="font-sans text-[0.65rem] font-700 uppercase tracking-widest px-2 py-1"
                                      style="background: oklch(0.62 0.14 155 / 0.12); color: oklch(0.62 0.14 155); border: 1px solid oklch(0.62 0.14 155 / 0.30);">Selesai</span>
                            @elseif($order->current_status === 'proses')
                                <span class="font-sans text-[0.65rem] font-700 uppercase tracking-widest px-2 py-1"
                                      style="background: oklch(0.67 0.13 66 / 0.12); color: oklch(0.67 0.13 66); border: 1px solid oklch(0.67 0.13 66 / 0.30);">Proses</span>
                            @else
                                <span class="font-sans text-[0.65rem] font-700 uppercase tracking-widest px-2 py-1"
                                      style="background: oklch(0.60 0.04 250 / 0.12); color: oklch(0.72 0.025 68); border: 1px solid oklch(0.60 0.04 250 / 0.30);">Antrian</span>
                            @endif
                        </div>
                        <div class="row-bg w-24 px-5 py-4 flex items-center justify-center" style="background: {{ $bgCard }};">
                            <form action="{{ route('dashboard.work-orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan {{ $order->raw_plat }} secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-sans text-[0.65rem] font-700 uppercase tracking-widest px-2 py-1 text-red-500 hover:text-red-400 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-16 text-center" style="background: {{ $bgCard }};">
                        <p class="font-sans font-700 text-sm mb-1" style="color: {{ $inkPri }};">Belum ada riwayat pesanan.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($workOrders->hasPages())
                <div class="px-6 py-4 mt-4" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                    {{ $workOrders->links() }}
                </div>
            @endif

        </div>
    </div>
</x-layout>

