<x-layout>
    <x-slot:title>Checkout | Bengkel Jok Nusantara</x-slot:title>
    <x-slot:hideWaButton>true</x-slot:hideWaButton>

    @php
        $bg      = 'oklch(0.12 0.018 55)';
        $surface = 'oklch(0.155 0.022 55)';
        $border  = 'oklch(0.22 0.02 55)';
        $inkPri  = 'oklch(0.93 0.012 75)';
        $inkSec  = 'oklch(0.68 0.022 65)';
        $inkMut  = 'oklch(0.50 0.020 62)';
        $gold    = 'oklch(0.67 0.13 66)';
        $goldH   = 'oklch(0.75 0.11 67)';
    @endphp

    <div x-data="checkoutForm()">
        <div class="min-h-screen pt-32 pb-32 sm:pb-24 px-4 sm:px-6 lg:px-8"
             style="background: {{ $bg }};">
             
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-8 md:gap-12 items-start">
            
            <!-- LEFT COLUMN: Form -->
            <div class="flex-1 min-w-0 space-y-8">
                
                {{-- Header --}}
                <div class="mb-8">
                    <a href="{{ route('products.show', $product->slug) }}"
                       class="inline-flex items-center gap-2 font-sans text-[11px] sm:text-xs font-700 uppercase tracking-wider mb-6 transition-colors"
                       style="color: {{ $inkMut }};"
                       onmouseover="this.style.color='{{ $gold }}'"
                       onmouseout="this.style.color='{{ $inkMut }}'">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Detail Produk
                    </a>
                    <h1 class="font-display font-700 mb-2" style="font-size: clamp(2rem, 3.5vw, 2.75rem); letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1;">
                        Pengiriman & Pembayaran
                    </h1>
                    <p class="font-sans text-sm sm:text-base" style="color: {{ $inkSec }}; max-width: 50ch;">
                        Selesaikan pesanan Anda dengan mengisi detail di bawah ini secara lengkap.
                    </p>
                </div>

                @if(session('error'))
                <div class="p-5 rounded-xl font-sans text-sm flex items-center gap-3" style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.25); color: oklch(0.75 0.18 25);">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    {{ session('error') }}
                </div>
                @endif

                <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="product_model_id" value="{{ $product->id }}">

                    <!-- SECTION 1: Data Pengiriman -->
                    <div class="rounded-2xl p-6 sm:p-8" style="background: {{ $surface }}; border: 1px solid {{ $border }};">
                        <div class="flex items-center gap-3 mb-6 pb-5" style="border-bottom: 1px solid {{ $border }};">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0" style="background: oklch(0.67 0.13 66 / 0.15);">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $gold }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <h2 class="font-sans font-700 text-base uppercase tracking-wider" style="color: {{ $inkPri }};">Alamat Pengiriman</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Nama Penerima</label>
                                <input type="text" name="customer_name" class="w-full px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" required value="{{ old('customer_name') }}" placeholder="Sesuai KTP/Penerima">
                            </div>
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">No. WhatsApp</label>
                                <input type="text" name="customer_wa" class="w-full px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" required value="{{ old('customer_wa') }}" placeholder="Contoh: 08123456789">
                            </div>

                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Provinsi (Kargo Darat)</label>
                                <div class="relative">
                                    <select name="shipping_province" x-model="selectedProvince" @change="updateCalculation()" class="w-full appearance-none px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" required>
                                        <option value="" style="background: {{ $surface }};">-- Pilih Provinsi --</option>
                                        @foreach($provinces as $p)
                                            <option value="{{ $p->province_name }}" style="background: {{ $surface }};">{{ $p->province_name }}</option>
                                        @endforeach
                                    </select>
                                    <svg class="w-4 h-4 pointer-events-none" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: {{ $inkMut }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Kota / Kabupaten</label>
                                <input type="text" name="shipping_city" class="w-full px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" required value="{{ old('shipping_city') }}" placeholder="Ketikan kota/kabupaten">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Detail Alamat Lengkap</label>
                                <textarea name="shipping_address" rows="3" class="w-full px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200 resize-none" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" required placeholder="Nama jalan, Gedung, RT/RW, Patokan...">{{ old('shipping_address') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: Kendaraan & Kustomisasi -->
                    <div class="rounded-2xl p-6 sm:p-8" style="background: {{ $surface }}; border: 1px solid {{ $border }};">
                        <div class="flex items-center gap-3 mb-6 pb-5" style="border-bottom: 1px solid {{ $border }};">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0" style="background: oklch(0.67 0.13 66 / 0.15);">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $gold }};"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                            </div>
                            <h2 class="font-sans font-700 text-base uppercase tracking-wider" style="color: {{ $inkPri }};">Kustomisasi Pesanan</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Mobil Anda</label>
                                <div class="relative">
                                    <select name="car_variant_id" x-model="selectedVariantId" @change="updateCalculation()" class="w-full appearance-none px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" required>
                                        <option value="" style="background: {{ $surface }};">-- Pilih Jenis Mobil --</option>
                                        @foreach($carVariants as $brand => $variants)
                                            <optgroup label="{{ $brand }}" style="background: oklch(0.08 0.01 55); color: {{ $inkSec }};">
                                                @foreach($variants as $v)
                                                    <option value="{{ $v->id }}" style="background: {{ $surface }}; color: {{ $inkPri }};">{{ $v->model_name }} ({{ $v->year_range }})</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <svg class="w-4 h-4 pointer-events-none" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: {{ $inkMut }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                                @error('car_variant_id') <p class="mt-2 text-[11px]" style="color: oklch(0.60 0.20 25);">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Pesan Untuk Baris Jok</label>
                                <div class="relative">
                                    <select name="seat_row" x-model="selectedRow" @change="updateCalculation()" class="w-full appearance-none px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" required>
                                        <option value="" style="background: {{ $surface }};">-- Pilih Jumlah Baris --</option>
                                        <option value="1" style="background: {{ $surface }};">Baris Depan Saja</option>
                                        <option value="1,2" x-show="hasRow2" style="background: {{ $surface }};">Baris Depan + Tengah</option>
                                        <option value="1,2,3" x-show="hasRow3" style="background: {{ $surface }};">Full Set (3 Baris)</option>
                                    </select>
                                    <svg class="w-4 h-4 pointer-events-none" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: {{ $inkMut }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                                @error('seat_row') <p class="mt-2 text-[11px]" style="color: oklch(0.60 0.20 25);">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Warna Dominan Jok</label>
                                <input type="text" name="primary_color" placeholder="Misal: Hitam, Beige..." class="w-full px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" required value="{{ old('primary_color') }}">
                            </div>
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Warna Aksen / Jahitan</label>
                                <input type="text" name="secondary_color" placeholder="Misal: Jahitan Merah..." class="w-full px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" value="{{ old('secondary_color') }}">
                            </div>
                            
                            <div class="sm:col-span-2 mt-2">
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-2" style="color: {{ $inkMut }};">Catatan Pesanan (Opsional)</label>
                                <textarea name="notes" rows="2" class="w-full px-4 py-3 rounded-xl font-sans text-sm outline-none transition-all duration-200 resize-none" style="background: {{ $bg }}; border: 1px solid {{ $border }}; color: {{ $inkPri }};" onfocus="this.style.borderColor='{{ $gold }}'; this.style.boxShadow='0 0 0 3px oklch(0.67 0.13 66 / 0.15)'" onblur="this.style.borderColor='{{ $border }}'; this.style.boxShadow='none'" placeholder="Ada permintaan khusus bentuk jok, jenis bahan, dll?">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- RIGHT COLUMN: Summary (Sticky) -->
            <div class="w-full hidden md:block sticky z-10 shrink-0" style="top: 7rem; width: 360px; max-width: 40%;">
                <!-- Desktop Sidebar -->
                <div class="flex flex-col p-8 rounded-2xl" style="background: {{ $surface }}; border: 1px solid {{ $border }};">
                    <p class="font-sans text-xs font-700 uppercase tracking-wider mb-6" style="color: {{ $inkPri }};">Ringkasan Pesanan</p>
                    
                    <div class="flex gap-4 mb-6">
                        @if($product->primary_image)
                            <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border" style="border-color: {{ $border }}; background: {{ $bg }};">
                                <img src="{{ Storage::disk('public')->url($product->primary_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="flex flex-col justify-center">
                            <h4 class="font-sans font-700 text-sm mb-1" style="color: {{ $inkPri }}; line-height: 1.3;">{{ $product->name }}</h4>
                            <p class="font-sans text-[11px] uppercase tracking-wider" style="color: {{ $inkMut }};">Custom PNP</p>
                        </div>
                    </div>

                    <div style="height: 1px; background: {{ $border }}; margin-bottom: 1.5rem;"></div>

                    <ul class="space-y-3.5 mb-6 font-sans text-[13px]">
                        <li class="flex justify-between items-center">
                            <span style="color: {{ $inkSec }};">Harga Produk</span>
                            <span class="font-700" style="color: {{ $inkPri }};" x-text="formatRupiah({{ $product->base_price }})"></span>
                        </li>
                        <li class="flex justify-between items-center" x-show="priceAdjustment > 0" style="display:none;">
                            <span style="color: {{ $inkSec }};">Penyesuaian Mobil</span>
                            <span class="font-700" style="color: {{ $gold }};" x-text="'+ ' + formatRupiah(priceAdjustment)"></span>
                        </li>
                        <li class="flex justify-between items-center" x-show="priceAdjustment < 0" style="display:none;">
                            <span style="color: {{ $inkSec }};">Penyesuaian Mobil</span>
                            <span class="font-700" style="color: oklch(0.62 0.14 155);" x-text="'- ' + formatRupiah(Math.abs(priceAdjustment))"></span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span style="color: {{ $inkSec }};">Ongkir (Kargo Darat)</span>
                            <span class="font-700" style="color: {{ $inkPri }};" x-text="shippingCost > 0 ? formatRupiah(shippingCost) : '-'"></span>
                        </li>
                    </ul>

                    <div class="flex items-end justify-between p-4 rounded-xl mb-6" style="background: {{ $bg }}; border: 1px solid {{ $border }};">
                        <span class="font-sans text-[11px] font-700 uppercase tracking-wider" style="color: {{ $inkSec }};">Total Bayar</span>
                        <div class="text-right">
                            <span class="font-display font-700 text-2xl" style="color: {{ $gold }}; letter-spacing: -0.02em; line-height: 1;" x-text="formatRupiah(grandTotal)"></span>
                        </div>
                    </div>

                    <button 
                        type="submit" 
                        form="checkout-form" 
                        class="w-full flex items-center justify-center gap-2.5 py-3.5 rounded-xl font-sans font-700 text-sm uppercase tracking-wider transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg" 
                        style="background: {{ $gold }}; color: oklch(0.12 0.018 55); border: none;"
                        onmouseover="if(!this.disabled){this.style.background='{{ $goldH }}'; this.style.transform='translateY(-2px)'}"
                        onmouseout="if(!this.disabled){this.style.background='{{ $gold }}'; this.style.transform='translateY(0)'}"
                        :disabled="grandTotal === 0 || !selectedProvince || !selectedRow || !selectedVariantId">
                        Proses Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    
                    <div class="mt-5 flex items-center justify-center gap-2 font-sans text-[10px] font-700 uppercase tracking-widest" style="color: {{ $inkMut }};">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Pembayaran Aman via Midtrans
                    </div>
                </div>
            </div>
            
        </div>
    </div>

        <!-- MOBILE STICKY BOTTOM BAR -->
        <div class="fixed bottom-0 left-0 right-0 z-[500] md:hidden"
             x-show="true" x-transition>
             
            <!-- Slide-up Details Panel -->
            <div class="absolute left-0 right-0 rounded-t-2xl shadow-[0_-10px_40px_rgba(0,0,0,0.5)] border-t"
                 style="bottom: 100%; background: {{ $surface }}; border-color: {{ $border }};"
                 x-show="showDetails" x-transition.opacity.duration.300ms>
                
                <div class="p-6 pb-8">
                    <div class="flex justify-between items-center mb-5">
                        <h4 class="font-sans font-700 text-sm" style="color: {{ $inkPri }};">Rincian Pembayaran</h4>
                        <button type="button" @click="showDetails = false" class="p-1 rounded-md" style="color: {{ $inkMut }}; background: {{ $bg }}; border: 1px solid {{ $border }};">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    
                    <ul class="space-y-3.5 font-sans text-xs">
                        <li class="flex justify-between items-center">
                            <span style="color: {{ $inkSec }};">Harga Produk</span>
                            <span class="font-700" style="color: {{ $inkPri }};" x-text="formatRupiah({{ $product->base_price }})"></span>
                        </li>
                        <li class="flex justify-between items-center" x-show="priceAdjustment > 0" style="display:none;">
                            <span style="color: {{ $inkSec }};">Penyesuaian Mobil</span>
                            <span class="font-700" style="color: {{ $gold }};" x-text="'+ ' + formatRupiah(priceAdjustment)"></span>
                        </li>
                        <li class="flex justify-between items-center" x-show="priceAdjustment < 0" style="display:none;">
                            <span style="color: {{ $inkSec }};">Penyesuaian Mobil</span>
                            <span class="font-700" style="color: oklch(0.62 0.14 155);" x-text="'- ' + formatRupiah(Math.abs(priceAdjustment))"></span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span style="color: {{ $inkSec }};">Ongkir (Kargo Darat)</span>
                            <span class="font-700" style="color: {{ $inkPri }};" x-text="shippingCost > 0 ? formatRupiah(shippingCost) : '-'"></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Bottom Bar -->
            <div class="relative z-10 py-4 px-4 sm:px-6 flex items-center justify-between"
                 style="background: oklch(0.10 0.015 55); border-top: 1px solid {{ $border }};">
                
                <div class="flex flex-col cursor-pointer group" @click="showDetails = !showDetails">
                    <span class="font-sans text-[10px] font-700 uppercase tracking-wider flex items-center gap-1.5 transition-colors" style="color: {{ $inkMut }};" onmouseover="this.style.color='{{ $inkPri }}'" onmouseout="this.style.color='{{ $inkMut }}'">
                        Total Bayar
                        <div class="w-4 h-4 rounded-full flex items-center justify-center transition-all" :class="showDetails ? 'rotate-180 bg-[oklch(0.67_0.13_66/0.2)] text-[oklch(0.67_0.13_66)]' : 'bg-[oklch(0.22_0.02_55)]'">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/></svg>
                        </div>
                    </span>
                    <div class="flex items-baseline gap-1 mt-0.5">
                        <span class="font-display font-700 text-xl" style="color: {{ $gold }}; letter-spacing: -0.02em; line-height: 1;" x-text="formatRupiah(grandTotal)"></span>
                    </div>
                </div>

                <button 
                    type="submit" 
                    form="checkout-form" 
                    class="flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl font-sans font-700 text-xs uppercase tracking-wider transition-colors disabled:opacity-50 disabled:cursor-not-allowed shadow-md" 
                    style="background: {{ $gold }}; color: oklch(0.12 0.018 55); border: none;"
                    :disabled="grandTotal === 0 || !selectedProvince || !selectedRow || !selectedVariantId">
                    Beli
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
        </div>

    </div> <!-- CLOSING DIV FOR checkoutForm() -->
    </div>

    <!-- Scripts for dynamic pricing -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkoutForm', () => ({
                productBasePrice: {{ $product->base_price }},
                
                // Variants Map from server
                variants: {
                    @foreach($carVariants as $brand => $groups)
                        @foreach($groups as $v)
                            "{{ $v->id }}": { adjustment: {{ $v->price_adjustment }}, rows: {{ $v->seat_rows }} },
                        @endforeach
                    @endforeach
                },
                
                // Shipping Map from server
                provinces: {
                    @foreach($provinces as $p)
                        "{{ $p->province_name }}": {{ $p->cost_per_row }},
                    @endforeach
                },

                selectedVariantId: '',
                selectedRow: '',
                selectedProvince: '',

                priceAdjustment: 0,
                shippingCost: 0,
                grandTotal: 0,
                showDetails: false,

                hasRow2: false,
                hasRow3: false,

                updateCalculation() {
                    let productPrice = this.productBasePrice;
                    this.priceAdjustment = 0;
                    
                    if (this.selectedVariantId && this.variants[this.selectedVariantId]) {
                        const variant = this.variants[this.selectedVariantId];
                        this.priceAdjustment = variant.adjustment;
                        productPrice += this.priceAdjustment;

                        this.hasRow2 = variant.rows >= 2;
                        this.hasRow3 = variant.rows >= 3;
                    }

                    // Reset selected row if it's invalid for current car
                    if (this.selectedRow === '1,2,3' && !this.hasRow3) this.selectedRow = '';
                    if (this.selectedRow === '1,2' && !this.hasRow2) this.selectedRow = '';

                    // Calculate Shipping
                    this.shippingCost = 0;
                    if (this.selectedProvince && this.selectedRow) {
                        const costPerRow = this.provinces[this.selectedProvince] || 0;
                        const rowCount = this.selectedRow.split(',').length;
                        this.shippingCost = costPerRow * rowCount;
                    }

                    // Ensure minimum price doesn't go below 0 for product
                    if(productPrice < 0) productPrice = 0;

                    this.grandTotal = productPrice + this.shippingCost;
                },

                formatNumber(num) {
                    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                },

                formatRupiah(number) {
                    return 'Rp ' + this.formatNumber(number);
                },

                init() {
                    this.updateCalculation();
                    
                    // Trigger sync for mobile bottom bar when values change
                    this.$watch('grandTotal', (value) => {
                        // Alpine handles reactivity, but since bottom bar accesses via window context sometimes,
                        // this ensures it triggers update visually.
                    });
                }
            }));
        });
    </script>
</x-layout>
