<x-layout>
    <x-slot:title>Checkout | Bengkel Jok Nusantara</x-slot:title>

    <div class="min-h-screen pt-32 pb-20 px-4 sm:px-6 lg:px-8"
         style="background: oklch(0.12 0.018 55);"
         x-data="checkoutForm()">
         
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- LEFT COLUMN: Form -->
            <div class="lg:col-span-8 space-y-10">
                <div class="mb-12">
                    <h1 class="font-display font-700 mb-4" style="font-size: clamp(2rem, 4vw, 3.2rem); letter-spacing: -0.03em; color: oklch(0.93 0.012 75); line-height: 1.1;">
                        Selesaikan Pesanan.
                    </h1>
                    <p class="font-sans text-lg" style="color: oklch(0.68 0.022 65);">
                        Lengkapi detail mobil, preferensi warna, dan alamat pengiriman Anda di bawah ini.
                    </p>
                </div>

                @if(session('error'))
                <div class="p-5 rounded-xl font-sans text-sm mb-8 flex items-center gap-3" style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.30); color: oklch(0.75 0.18 25);">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    {{ session('error') }}
                </div>
                @endif

                <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST" class="space-y-10">
                    @csrf
                    <input type="hidden" name="product_model_id" value="{{ $product->id }}">

                    <!-- 1. Data Kendaraan -->
                    <div class="p-8 md:p-10" style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.22 0.02 55);">
                        <div class="flex items-center gap-4 mb-8" style="border-bottom: 1px solid oklch(0.22 0.02 55); padding-bottom: 1.5rem;">
                            <span class="font-display font-600 text-2xl" style="color: oklch(0.67 0.13 66);">01</span>
                            <h2 class="font-sans font-700 text-base uppercase tracking-wider" style="color: oklch(0.93 0.012 75);">Kendaraan Anda</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: oklch(0.50 0.020 62);">Jenis Mobil</label>
                                <select name="car_variant_id" x-model="selectedVariantId" @change="updateCalculation()" class="w-full appearance-none px-5 py-4 font-sans text-sm outline-none transition-colors duration-200" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);" onfocus="this.style.borderColor='oklch(0.67 0.13 66)'" onblur="this.style.borderColor='oklch(0.28 0.025 55)'" required>
                                    <option value="" style="background: #111; color: #fff;">-- Pilih Jenis Mobil --</option>
                                    @foreach($carVariants as $brand => $variants)
                                        <optgroup label="{{ $brand }}" style="background: #1a1a1a; color: #aaa;">
                                            @foreach($variants as $v)
                                                <option value="{{ $v->id }}" style="background: #111; color: #fff;">{{ $v->model_name }} ({{ $v->year_range }})</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('car_variant_id') <p class="mt-2 text-xs" style="color: oklch(0.60 0.20 25);">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: oklch(0.50 0.020 62);">Baris Jok</label>
                                <select name="seat_row" x-model="selectedRow" @change="updateCalculation()" class="w-full appearance-none px-5 py-4 font-sans text-sm outline-none transition-colors duration-200" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);" onfocus="this.style.borderColor='oklch(0.67 0.13 66)'" onblur="this.style.borderColor='oklch(0.28 0.025 55)'" required>
                                    <option value="" style="background: #111; color: #fff;">-- Pilih Baris --</option>
                                    <option value="1" style="background: #111; color: #fff;">Baris Depan Saja</option>
                                    <option value="1,2" x-show="hasRow2" style="background: #111; color: #fff;">Baris Depan + Tengah</option>
                                    <option value="1,2,3" x-show="hasRow3" style="background: #111; color: #fff;">Full Set (3 Baris)</option>
                                </select>
                                @error('seat_row') <p class="mt-2 text-xs" style="color: oklch(0.60 0.20 25);">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- 2. Kustomisasi Desain -->
                    <div class="p-8 md:p-10" style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.22 0.02 55);">
                        <div class="flex items-center gap-4 mb-8" style="border-bottom: 1px solid oklch(0.22 0.02 55); padding-bottom: 1.5rem;">
                            <span class="font-display font-600 text-2xl" style="color: oklch(0.67 0.13 66);">02</span>
                            <h2 class="font-sans font-700 text-base uppercase tracking-wider" style="color: oklch(0.93 0.012 75);">Warna Jok</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: oklch(0.50 0.020 62);">Warna Utama (Mayoritas)</label>
                                <input type="text" name="primary_color" placeholder="Misal: Hitam, Beige" class="w-full px-5 py-4 font-sans text-sm outline-none transition-colors duration-200" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);" onfocus="this.style.borderColor='oklch(0.67 0.13 66)'" onblur="this.style.borderColor='oklch(0.28 0.025 55)'" required value="{{ old('primary_color') }}">
                            </div>
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: oklch(0.50 0.020 62);">Warna Sekunder/Jahitan</label>
                                <input type="text" name="secondary_color" placeholder="Misal: Jahitan Merah" class="w-full px-5 py-4 font-sans text-sm outline-none transition-colors duration-200" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);" onfocus="this.style.borderColor='oklch(0.67 0.13 66)'" onblur="this.style.borderColor='oklch(0.28 0.025 55)'" value="{{ old('secondary_color') }}">
                            </div>
                        </div>
                    </div>

                    <!-- 3. Data Pengiriman -->
                    <div class="p-8 md:p-10" style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.22 0.02 55);">
                        <div class="flex items-center gap-4 mb-8" style="border-bottom: 1px solid oklch(0.22 0.02 55); padding-bottom: 1.5rem;">
                            <span class="font-display font-600 text-2xl" style="color: oklch(0.67 0.13 66);">03</span>
                            <h2 class="font-sans font-700 text-base uppercase tracking-wider" style="color: oklch(0.93 0.012 75);">Data Pengiriman</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: oklch(0.50 0.020 62);">Nama Lengkap</label>
                                <input type="text" name="customer_name" class="w-full px-5 py-4 font-sans text-sm outline-none transition-colors duration-200" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);" onfocus="this.style.borderColor='oklch(0.67 0.13 66)'" onblur="this.style.borderColor='oklch(0.28 0.025 55)'" required value="{{ old('customer_name') }}">
                            </div>
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: oklch(0.50 0.020 62);">Nomor WhatsApp</label>
                                <input type="text" name="customer_wa" placeholder="08..." class="w-full px-5 py-4 font-sans text-sm outline-none transition-colors duration-200" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);" onfocus="this.style.borderColor='oklch(0.67 0.13 66)'" onblur="this.style.borderColor='oklch(0.28 0.025 55)'" required value="{{ old('customer_wa') }}">
                            </div>

                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: oklch(0.50 0.020 62);">Provinsi</label>
                                <select name="shipping_province" x-model="selectedProvince" @change="updateCalculation()" class="w-full appearance-none px-5 py-4 font-sans text-sm outline-none transition-colors duration-200" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);" onfocus="this.style.borderColor='oklch(0.67 0.13 66)'" onblur="this.style.borderColor='oklch(0.28 0.025 55)'" required>
                                    <option value="" style="background: #111; color: #fff;">-- Pilih Provinsi --</option>
                                    @foreach($provinces as $p)
                                        <option value="{{ $p->province_name }}" style="background: #111; color: #fff;">{{ $p->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: oklch(0.50 0.020 62);">Kota / Kabupaten</label>
                                <input type="text" name="shipping_city" class="w-full px-5 py-4 font-sans text-sm outline-none transition-colors duration-200" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);" onfocus="this.style.borderColor='oklch(0.67 0.13 66)'" onblur="this.style.borderColor='oklch(0.28 0.025 55)'" required value="{{ old('shipping_city') }}">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block font-sans text-xs font-700 uppercase tracking-wider mb-3" style="color: oklch(0.50 0.020 62);">Alamat Lengkap</label>
                                <textarea name="shipping_address" rows="3" class="w-full px-5 py-4 font-sans text-sm outline-none transition-colors duration-200" style="background: oklch(0.12 0.018 55); border: 1px solid oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);" onfocus="this.style.borderColor='oklch(0.67 0.13 66)'" onblur="this.style.borderColor='oklch(0.28 0.025 55)'" required placeholder="Nama jalan, RT/RW, detail...">{{ old('shipping_address') }}</textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <!-- RIGHT COLUMN: Summary (Sticky) -->
            <div class="lg:col-span-4 relative">
                <div class="sticky top-24 flex flex-col p-8 md:p-10" style="background: oklch(0.10 0.015 55); border: 1px solid oklch(0.22 0.02 55);">
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-8" style="color: oklch(0.50 0.020 62);">Ringkasan Pesanan</p>
                    
                    <div class="flex gap-5 mb-8">
                        @if($product->primary_image)
                            <div class="w-16 h-16 md:w-20 md:h-20 rounded-xl overflow-hidden bg-black/40 shrink-0 border border-[var(--color-border)]">
                            <img src="{{ Storage::url($product->primary_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" style="filter: saturate(0.85) contrast(1.05);">
                            </div>
                        @endif
                        <div class="flex flex-col justify-center">
                            <h4 class="font-sans font-700 text-lg leading-tight mb-1" style="color: oklch(0.93 0.012 75);">{{ $product->name }}</h4>
                            <p class="font-sans text-xs uppercase tracking-wider" style="color: oklch(0.50 0.020 62);">Jok Kustomisasi PNP</p>
                        </div>
                    </div>

                    <div style="height: 1px; background: oklch(0.22 0.02 55); margin-bottom: 2rem;"></div>

                    <ul class="space-y-4 mb-8 font-sans text-sm">
                        <li class="flex justify-between items-center">
                            <span style="color: oklch(0.50 0.020 62);">Harga Dasar</span>
                            <span class="font-700" style="color: oklch(0.93 0.012 75);" x-text="formatRupiah({{ $product->base_price }})"></span>
                        </li>
                        <li class="flex justify-between items-center" x-show="priceAdjustment > 0" style="display:none;">
                            <span style="color: oklch(0.50 0.020 62);">Penyesuaian Kendaraan</span>
                            <span class="font-700" style="color: oklch(0.67 0.13 66);" x-text="'+ ' + formatRupiah(priceAdjustment)"></span>
                        </li>
                        <li class="flex justify-between items-center" x-show="priceAdjustment < 0" style="display:none;">
                            <span style="color: oklch(0.50 0.020 62);">Penyesuaian Kendaraan</span>
                            <span class="font-700" style="color: oklch(0.62 0.14 155);" x-text="'- ' + formatRupiah(Math.abs(priceAdjustment))"></span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span style="color: oklch(0.50 0.020 62);">Biaya Kargo Darat</span>
                            <span class="font-700" style="color: oklch(0.93 0.012 75);" x-text="shippingCost > 0 ? formatRupiah(shippingCost) : '-'"></span>
                        </li>
                    </ul>

                    <div style="height: 1px; background: oklch(0.22 0.02 55); margin-bottom: 2rem;"></div>

                    <div class="flex items-start justify-between mb-8">
                        <span class="font-sans text-xs uppercase tracking-wider mt-2" style="color: oklch(0.50 0.020 62);">Total</span>
                        <div class="text-right">
                            <span class="font-sans font-500 text-lg mr-1" style="color: oklch(0.50 0.020 62);">Rp</span>
                            <span class="font-display font-600" style="font-size: clamp(2rem, 3vw, 2.5rem); color: oklch(0.93 0.012 75); letter-spacing: -0.02em; line-height: 1;" x-text="formatNumber(grandTotal)"></span>
                        </div>
                    </div>

                    <button 
                        type="submit" 
                        form="checkout-form" 
                        class="touch-target w-full flex items-center justify-center gap-2.5 py-4 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-250 disabled:opacity-50 disabled:cursor-not-allowed" 
                        style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55); border: none;"
                        onmouseover="if(!this.disabled){this.style.background='oklch(0.75 0.11 67)'}"
                        onmouseout="if(!this.disabled){this.style.background='oklch(0.67 0.13 66)'}"
                        :disabled="grandTotal === 0 || !selectedProvince || !selectedRow || !selectedVariantId">
                        Proses Pembayaran
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    
                    <div class="mt-6 flex items-center justify-center gap-2 font-sans text-[10px] uppercase tracking-widest text-center" style="color: oklch(0.50 0.020 62);">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Pembayaran Aman via Midtrans
                    </div>
                </div>
            </div>
            
        </div>
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

                formatRupiah(number) {
                    return 'Rp ' + this.formatNumber(number);
                },
                
                formatNumber(num) {
                    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                },

                init() {
                    this.updateCalculation();
                }
            }));
        });
    </script>
</x-layout>
