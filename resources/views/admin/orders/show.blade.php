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
<x-layout title="Detail Pesanan {{ $order->invoice_number }} — Admin BJN">
    <div class="min-h-screen" style="background: {{ $bg }}; padding: 7rem 0 8rem;">
        <div class="max-w-5xl mx-auto px-6 space-y-8">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4"
                 style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
                <div>
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: {{ $inkMute }};">Admin / Pesanan</p>
                    <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 700; letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1;">
                        {{ $order->invoice_number }}
                    </h1>
                    <p class="text-sm mt-1" style="color: {{ $inkMute }};">Dibuat {{ $order->created_at->isoFormat('D MMMM YYYY, HH:mm') }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.orders.print-label', $order->id) }}" target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2 font-sans text-sm font-700 transition-colors duration-200 rounded-lg shadow-sm"
                       style="background: {{ $gold }}; color: oklch(0.12 0.018 55);"
                       onmouseover="this.style.background='{{ $goldHov }}'"
                       onmouseout="this.style.background='{{ $gold }}'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Cetak Label
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                       class="inline-flex items-center gap-2 font-sans text-sm font-700 uppercase tracking-wider transition-colors duration-200"
                       style="color: {{ $inkMute }};"
                       onmouseover="this.style.color='{{ $goldHov }}'"
                       onmouseout="this.style.color='{{ $inkMute }}'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali
                    </a>
                </div>

            {{-- Success Alert --}}
            @if(session('success'))
            <div class="p-4 rounded-xl text-sm" style="background: oklch(0.72 0.17 142 / 0.15); border: 1px solid oklch(0.72 0.17 142 / 0.4); color: oklch(0.85 0.12 142);">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="p-4 rounded-xl text-sm" style="background: oklch(0.65 0.22 25 / 0.15); border: 1px solid oklch(0.65 0.22 25 / 0.4); color: oklch(0.80 0.15 25);">
                {{ $errors->first() }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left: Detail --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Customer Info --}}
                    <div class="rounded-2xl p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                        <h2 class="font-semibold text-base mb-5" style="color: {{ $inkPri }};">Data Pelanggan</h2>
                        <dl class="space-y-3">
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Nama</dt>
                                <dd class="text-sm font-medium" style="color: {{ $inkPri }};">{{ $order->customer_name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">WhatsApp</dt>
                                <dd>
                                    <a href="{{ $order->customer_wa_link }}" target="_blank" class="text-sm font-medium hover:underline" style="color: {{ $gold }};">
                                        {{ $order->customer_wa }}
                                    </a>
                                </dd>
                            </div>
                            @if($order->customer_email)
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Email</dt>
                                <dd class="text-sm" style="color: {{ $inkSec }};">{{ $order->customer_email }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    {{-- Order Detail --}}
                    <div class="rounded-2xl p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                        <h2 class="font-semibold text-base mb-5" style="color: {{ $inkPri }};">Detail Pesanan</h2>
                        <dl class="space-y-3">
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Produk / Model Jok</dt>
                                <dd class="text-sm font-medium" style="color: {{ $inkPri }};">{{ $order->product->name ?? '-' }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Kendaraan</dt>
                                <dd class="text-sm" style="color: {{ $inkSec }};">{{ $order->carVariant ? "{$order->carVariant->brand} {$order->carVariant->model_name}" : '-' }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Baris Jok</dt>
                                <dd class="text-sm" style="color: {{ $inkSec }};">{{ $order->seat_row_label }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Warna Utama</dt>
                                <dd class="text-sm" style="color: {{ $inkSec }};">{{ $order->primary_color }}</dd>
                            </div>
                            @if($order->secondary_color)
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Warna Sekunder</dt>
                                <dd class="text-sm" style="color: {{ $inkSec }};">{{ $order->secondary_color }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    {{-- Shipping Info --}}
                    <div class="rounded-2xl p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                        <h2 class="font-semibold text-base mb-5" style="color: {{ $inkPri }};">Pengiriman</h2>
                        <dl class="space-y-3">
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Tujuan</dt>
                                <dd class="text-sm" style="color: {{ $inkSec }};">{{ $order->shipping_city }}, {{ $order->shipping_province }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Alamat Lengkap</dt>
                                <dd class="text-sm text-right" style="color: {{ $inkSec }}; max-width: 60%;">{{ $order->shipping_address }}</dd>
                            </div>
                            @if($order->courier_name)
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Ekspedisi</dt>
                                <dd class="text-sm" style="color: {{ $inkSec }};">{{ $order->courier_name }}</dd>
                            </div>
                            @endif
                            @if($order->shipping_awb)
                            <div class="flex justify-between">
                                <dt class="text-sm" style="color: {{ $inkMute }};">Nomor Resi (AWB)</dt>
                                <dd class="text-sm font-mono font-bold" style="color: {{ $gold }};">{{ $order->shipping_awb }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    {{-- Notes --}}
                    @if($order->notes)
                    <div class="rounded-2xl p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                        <h2 class="font-semibold text-base mb-3" style="color: {{ $inkPri }};">Catatan</h2>
                        <p class="text-sm" style="color: {{ $inkSec }};">{{ $order->notes }}</p>
                    </div>
                    @endif

                </div>

                {{-- Right: Status & Actions --}}
                <div class="space-y-6">

                    {{-- Payment Status --}}
                    <div class="rounded-2xl p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                        <h2 class="font-semibold text-base mb-4" style="color: {{ $inkPri }};">Status Pembayaran</h2>
                        <p class="text-2xl font-bold">
                            @if($order->payment_status->value === 'paid')
                                <span style="color: oklch(0.72 0.17 142);">✓ Lunas</span>
                            @elseif($order->payment_status->value === 'failed')
                                <span style="color: oklch(0.65 0.22 25);">✗ Gagal</span>
                            @else
                                <span style="color: oklch(0.72 0.14 80);">⏳ Belum Bayar</span>
                            @endif
                        </p>
                        @if($order->paid_at)
                        <p class="text-xs mt-1" style="color: {{ $inkMute }};">Dibayar: {{ $order->paid_at->isoFormat('D MMM YYYY, HH:mm') }}</p>
                        @endif
                        <div class="mt-4 pt-4" style="border-top: 1px solid {{ $border }};">
                            <div class="flex justify-between text-sm mb-2">
                                <span style="color: {{ $inkMute }};">Harga Produk</span>
                                <span style="color: {{ $inkSec }};">{{ $order->product_price_formatted }}</span>
                            </div>
                            <div class="flex justify-between text-sm mb-3">
                                <span style="color: {{ $inkMute }};">Ongkir</span>
                                <span style="color: {{ $inkSec }};">{{ $order->shipping_cost_formatted }}</span>
                            </div>
                            <div class="flex justify-between font-bold">
                                <span style="color: {{ $inkPri }};">Total</span>
                                <span style="color: {{ $gold }};">{{ $order->grand_total_formatted }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Update Status Form --}}
                    @if($order->payment_status->value === 'paid')
                    <div class="rounded-2xl p-6" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                        <h2 class="font-semibold text-base mb-4" style="color: {{ $inkPri }};">Update Status Produksi</h2>
                        
                        {{-- Progress Indicator --}}
                        <div class="flex items-center gap-2 mb-6">
                            @foreach(\App\Enums\ProductionStatus::cases() as $status)
                                <div class="flex-1 text-center">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold mx-auto mb-1"
                                         style="background: {{ $order->production_status->stepNumber() >= $status->stepNumber() ? $gold : 'oklch(0.20 0.02 55)' }}; color: {{ $order->production_status->stepNumber() >= $status->stepNumber() ? 'oklch(0.12 0.018 55)' : $inkMute }};">
                                        {{ $status->stepNumber() }}
                                    </div>
                                    <p class="text-[10px] leading-tight" style="color: {{ $inkMute }};">{{ $status->label() }}</p>
                                </div>
                                @if(!$loop->last)
                                <div class="flex-none h-px w-4" style="background: {{ $border }};"></div>
                                @endif
                            @endforeach
                        </div>

                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-xs font-medium mb-2 uppercase tracking-wider" style="color: {{ $inkMute }};">Status Baru</label>
                                <select name="production_status" class="w-full rounded-xl px-4 py-2.5 text-sm outline-none" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};">
                                    @foreach(\App\Enums\ProductionStatus::cases() as $status)
                                        <option value="{{ $status->value }}" {{ $order->production_status === $status ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium mb-2 uppercase tracking-wider" style="color: {{ $inkMute }};">Nama Ekspedisi Kargo</label>
                                <input type="text" name="courier_name" value="{{ $order->courier_name }}"
                                    placeholder="Indah Cargo, JNE Kargo, dll"
                                    class="w-full rounded-xl px-4 py-2.5 text-sm outline-none" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};">
                            </div>
                            <div>
                                <label class="block text-xs font-medium mb-2 uppercase tracking-wider" style="color: {{ $inkMute }};">Nomor Resi (AWB) <span style="color: {{ $gold }};">*wajib saat Dikirim</span></label>
                                <input type="text" name="shipping_awb" value="{{ $order->shipping_awb }}"
                                    placeholder="Masukkan nomor resi..."
                                    class="w-full rounded-xl px-4 py-2.5 text-sm font-mono outline-none" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};">
                            </div>
                            <div>
                                <label class="block text-xs font-medium mb-2 uppercase tracking-wider" style="color: {{ $inkMute }};">Catatan Internal</label>
                                <textarea name="notes" rows="2" class="w-full rounded-xl px-4 py-2.5 text-sm outline-none resize-none" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};">{{ $order->notes }}</textarea>
                            </div>
                            <button type="submit" class="w-full py-3 rounded-xl text-sm font-bold transition"
                                style="background: {{ $gold }}; color: oklch(0.12 0.018 55);"
                                onmouseover="this.style.background='{{ $goldHov }}'"
                                onmouseout="this.style.background='{{ $gold }}'">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="rounded-2xl p-6 text-center" style="background: {{ $bgCard }}; border: 1px solid {{ $border }};">
                        <p class="text-sm" style="color: {{ $inkMute }};">Update status produksi hanya tersedia setelah pesanan dibayar.</p>
                        <a href="{{ $order->customer_wa_link }}" target="_blank"
                           class="inline-block mt-4 px-5 py-2.5 rounded-xl text-sm font-bold transition"
                           style="background: oklch(0.46 0.17 142); color: white;">
                            📱 Hubungi via WA
                        </a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-layout>
