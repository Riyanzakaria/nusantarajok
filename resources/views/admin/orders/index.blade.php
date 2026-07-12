@php
    $bg       = 'oklch(0.12 0.018 55)';
    $bgCard   = 'oklch(0.155 0.022 55)';
    $border   = 'oklch(0.22 0.02 55)';
    $inkPri   = 'oklch(0.93 0.012 75)';
    $inkSec   = 'oklch(0.68 0.022 65)';
    $inkMute  = 'oklch(0.50 0.020 62)';
    $gold     = 'oklch(0.67 0.13 66)';
    $goldHov  = 'oklch(0.75 0.11 67)';
    $green    = 'oklch(0.72 0.17 142)';
    $orange   = 'oklch(0.72 0.14 80)';
    $red      = 'oklch(0.65 0.22 25)';
@endphp
<x-layout title="Manajemen Pesanan — Admin BJN">
    <div class="min-h-screen" style="background: {{ $bg }}; padding: 7rem 0 8rem;">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 gap-4"
                 style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
                <div>
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: {{ $inkMute }};">Admin</p>
                    <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1;">Pesanan Masuk</h1>
                </div>
                <a href="{{ route('dashboard.index') }}"
                   class="inline-flex items-center gap-2 font-sans text-sm font-700 uppercase tracking-wider transition-colors duration-200"
                   style="color: {{ $inkMute }};"
                   onmouseover="this.style.color='{{ $goldHov }}'"
                   onmouseout="this.style.color='{{ $inkMute }}'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Dashboard
                </a>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                <div class="rounded-2xl p-5" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                    <p class="text-xs uppercase tracking-widest mb-1" style="color: {{ $inkMute }};">Total Pesanan</p>
                    <p class="text-3xl font-bold" style="color: {{ $inkPri }};">{{ $stats['total'] }}</p>
                </div>
                <div class="rounded-2xl p-5" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                    <p class="text-xs uppercase tracking-widest mb-1" style="color: {{ $inkMute }};">Belum Bayar</p>
                    <p class="text-3xl font-bold" style="color: {{ $red }};">{{ $stats['unpaid'] }}</p>
                </div>
                <div class="rounded-2xl p-5" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                    <p class="text-xs uppercase tracking-widest mb-1" style="color: {{ $inkMute }};">Diproduksi</p>
                    <p class="text-3xl font-bold" style="color: {{ $orange }};">{{ $stats['producing'] }}</p>
                </div>
                <div class="rounded-2xl p-5" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                    <p class="text-xs uppercase tracking-widest mb-1" style="color: {{ $inkMute }};">Dikirim</p>
                    <p class="text-3xl font-bold" style="color: {{ $green }};">{{ $stats['shipped'] }}</p>
                </div>
            </div>

            {{-- Success Alert --}}
            @if(session('success'))
            <div class="mb-6 p-4 rounded-xl text-sm" style="background: oklch(0.72 0.17 142 / 0.15); border: 1px solid oklch(0.72 0.17 142 / 0.4); color: oklch(0.85 0.12 142);">
                {{ session('success') }}
            </div>
            @endif

            {{-- Filters --}}
            <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap gap-3 mb-6">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari invoice / nama / WA..."
                    class="flex-1 min-w-48 rounded-xl px-4 py-2.5 text-sm outline-none"
                    style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};">
                <select name="payment" class="rounded-xl px-4 py-2.5 text-sm outline-none" style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};">
                    <option value="">Semua Status Bayar</option>
                    <option value="unpaid" {{ request('payment') === 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="paid" {{ request('payment') === 'paid' ? 'selected' : '' }}>Sudah Bayar</option>
                </select>
                <select name="production" class="rounded-xl px-4 py-2.5 text-sm outline-none" style="background: {{ $bgCard }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};">
                    <option value="">Semua Status Produksi</option>
                    <option value="waiting" {{ request('production') === 'waiting' ? 'selected' : '' }}>Menunggu</option>
                    <option value="producing" {{ request('production') === 'producing' ? 'selected' : '' }}>Diproduksi</option>
                    <option value="shipped" {{ request('production') === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                    <option value="delivered" {{ request('production') === 'delivered' ? 'selected' : '' }}>Diterima</option>
                </select>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold transition"
                    style="background: {{ $gold }}; color: oklch(0.12 0.018 55);"
                    onmouseover="this.style.background='{{ $goldHov }}'"
                    onmouseout="this.style.background='{{ $gold }}'">Filter</button>
                @if(request()->hasAny(['q', 'payment', 'production']))
                    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2.5 rounded-xl text-sm" style="border: 1px solid {{ $border }}; color: {{ $inkMute }};">Reset</a>
                @endif
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-2xl" style="border: 1px solid {{ $border }};">
                <table class="w-full text-sm whitespace-nowrap" style="color: {{ $inkSec }};">
                    <thead style="border-bottom: 1px solid {{ $border }};">
                        <tr>
                            <th class="text-left px-5 py-4 text-xs uppercase tracking-wider font-semibold" style="color: {{ $inkMute }};">Invoice</th>
                            <th class="text-left px-5 py-4 text-xs uppercase tracking-wider font-semibold" style="color: {{ $inkMute }};">Pelanggan</th>
                            <th class="text-left px-5 py-4 text-xs uppercase tracking-wider font-semibold hidden md:table-cell" style="color: {{ $inkMute }};">Produk</th>
                            <th class="text-left px-5 py-4 text-xs uppercase tracking-wider font-semibold hidden lg:table-cell" style="color: {{ $inkMute }};">Total</th>
                            <th class="text-left px-5 py-4 text-xs uppercase tracking-wider font-semibold" style="color: {{ $inkMute }};">Status Bayar</th>
                            <th class="text-left px-5 py-4 text-xs uppercase tracking-wider font-semibold hidden sm:table-cell" style="color: {{ $inkMute }};">Status Produksi</th>
                            <th class="px-5 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr style="border-top: 1px solid {{ $border }};" class="hover:bg-white/2 transition">
                            <td class="px-5 py-4">
                                <span class="font-mono text-xs" style="color: {{ $inkPri }};">{{ $order->invoice_number }}</span>
                                <p class="text-xs mt-0.5" style="color: {{ $inkMute }};">{{ $order->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <p style="color: {{ $inkPri }}; font-weight: 500;">{{ $order->customer_name }}</p>
                                <a href="{{ $order->customer_wa_link }}" target="_blank" class="text-xs hover:underline" style="color: {{ $gold }};">{{ $order->customer_wa }}</a>
                            </td>
                            <td class="px-5 py-4 hidden md:table-cell">
                                <p style="color: {{ $inkSec }};">{{ $order->product->name ?? '-' }}</p>
                                <p class="text-xs mt-0.5" style="color: {{ $inkMute }};">{{ $order->seat_row_label }} — {{ $order->primary_color }}</p>
                            </td>
                            <td class="px-5 py-4 hidden lg:table-cell font-semibold" style="color: {{ $inkPri }};">
                                {{ $order->grand_total_formatted }}
                            </td>
                            <td class="px-5 py-4">
                                @if($order->payment_status->value === 'paid')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold" style="background: oklch(0.72 0.17 142 / 0.15); color: oklch(0.85 0.12 142);">Lunas</span>
                                @elseif($order->payment_status->value === 'failed')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold" style="background: oklch(0.65 0.22 25 / 0.15); color: oklch(0.80 0.15 25);">Gagal</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-bold" style="background: oklch(0.72 0.14 80 / 0.15); color: oklch(0.85 0.10 80);">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 hidden sm:table-cell">
                                <span class="text-xs font-medium">{{ $order->production_status->label() }}</span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="text-xs font-bold uppercase tracking-wider transition"
                                   style="color: {{ $gold }};"
                                   onmouseover="this.style.color='{{ $goldHov }}'"
                                   onmouseout="this.style.color='{{ $gold }}'">Detail →</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center" style="color: {{ $inkMute }};">Belum ada pesanan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($orders->hasPages())
            <div class="mt-6">{{ $orders->links() }}</div>
            @endif

        </div>
    </div>
</x-layout>
