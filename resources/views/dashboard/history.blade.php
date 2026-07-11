<x-layout title="Riwayat & Analisis — Nusantara Jok">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative">
    <div class="absolute -top-40 right-0 w-[40rem] h-[40rem] bg-accent-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

    {{-- Header --}}
    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4 z-10">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('dashboard.index') }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <h1 class="font-display text-3xl font-bold text-slate-900 dark:text-white tracking-tight drop-shadow-md">Riwayat & Analisis</h1>
            </div>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Laporan lengkap seluruh pesanan dan progres bengkel.</p>
        </div>
        <div>
            <a href="{{ route('dashboard.work-orders.export') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-500 text-slate-900 dark:text-white font-bold text-sm hover:bg-emerald-400 border border-emerald-400/50 hover:-translate-y-0.5 shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)] transition-all duration-200 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Download CSV
            </a>
        </div>
    </div>

    {{-- Analytics Widgets --}}
    <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border border-slate-200 dark:border-white/10 p-6 rounded-2xl shadow-[0_0_15px_rgba(0,0,0,0.3)]">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-500/20 border border-blue-500/30 rounded-xl flex items-center justify-center text-blue-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pesanan</p>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $totalOrders }} <span class="text-sm font-medium text-slate-500">Unit</span></h3>
                </div>
            </div>
        </div>
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border border-slate-200 dark:border-white/10 p-6 rounded-2xl shadow-[0_0_15px_rgba(0,0,0,0.3)]">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-500/20 border border-emerald-500/30 rounded-xl flex items-center justify-center text-emerald-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Telah Selesai</p>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $completedOrders }} <span class="text-sm font-medium text-slate-500">Unit</span></h3>
                </div>
            </div>
        </div>
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border border-slate-200 dark:border-white/10 p-6 rounded-2xl shadow-[0_0_15px_rgba(0,0,0,0.3)]">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-500/20 border border-amber-500/30 rounded-xl flex items-center justify-center text-amber-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Estimasi Pendapatan</p>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white mt-1">Rp {{ number_format($revenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- History Table --}}
    <div class="relative z-10 bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/10 rounded-2xl shadow-[0_0_15px_rgba(0,0,0,0.3)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        <th class="px-6 py-4 whitespace-nowrap">Tgl Jadwal</th>
                        <th class="px-6 py-4 whitespace-nowrap">Plat Nomor</th>
                        <th class="px-6 py-4 whitespace-nowrap">Pelanggan</th>
                        <th class="px-6 py-4 whitespace-nowrap">Kendaraan</th>
                        <th class="px-6 py-4 whitespace-nowrap">Harga / Material</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700/50">
                    @forelse($workOrders as $order)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                {{ $order->scheduled_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-bold text-slate-900 dark:text-white">{{ $order->raw_plat }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $order->lead->customer_name ?? '-' }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $order->lead->whatsapp_number ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                {{ $order->vehicle_type }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($order->lead)
                                    <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($order->lead->calculated_price ?? 0, 0, ',', '.') }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $order->lead->material_selected }}</p>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($order->current_status === 'selesai')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border bg-emerald-500/20 text-emerald-600 dark:text-emerald-300 border-emerald-500/30">
                                        Selesai
                                    </span>
                                @elseif($order->current_status === 'proses')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border bg-amber-500/20 text-amber-600 dark:text-amber-300 border-amber-500/30">
                                        Proses
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 border-slate-300 dark:border-slate-600">
                                        Antrian
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400 text-sm">
                                Belum ada data riwayat pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @if($workOrders->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $workOrders->links() }}
            </div>
        @endif
    </div>
</div>
</x-layout>
