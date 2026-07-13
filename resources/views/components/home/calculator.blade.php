@props(['vehicleCategories' => [], 'calendar' => []])

<section
    class="relative overflow-hidden"
    id="kalkulator"
    x-data="calculatorApp()"
    style="padding: 7rem 0 8rem; background: oklch(0.155 0.022 55); border-top: 1px solid oklch(0.22 0.02 55);"
>
    <div class="container mx-auto px-6 max-w-5xl">

        {{-- Section header — no eyebrow --}}
        <div
            class="mb-12"
            x-data="{ shown: false }"
            x-intersect.once.margin.-10%.0px="shown = true"
        >
            <h2
                class="font-display font-700 mb-4"
                style="font-size: clamp(2rem, 4vw, 3.2rem); line-height: 1.04; letter-spacing: -0.03em; color: oklch(0.93 0.012 75); text-wrap: balance; transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1);"
                :style="shown ? { opacity: 1 } : { opacity: 0 }"
            >
                Estimasi Harga Langsung.
            </h2>
            <p
                class="font-sans"
                style="font-size: 1rem; color: oklch(0.72 0.025 68); max-width: 46ch; line-height: 1.7; transition: opacity 0.8s 0.1s cubic-bezier(0.16,1,0.3,1);"
                :style="shown ? { opacity: 1 } : { opacity: 0 }"
            >
                Pilih jenis kendaraan dan material — estimasi harga keluar seketika. Nggak ribet, nggak ada biaya tersembunyi.
            </p>
        </div>

        {{-- Main panel --}}
        <div
            class="grid grid-cols-1 lg:grid-cols-12 gap-px"
            style="background: oklch(0.22 0.02 55); border: 1px solid oklch(0.22 0.02 55);"
        >
            {{-- Options Panel --}}
            <div class="lg:col-span-7 flex flex-col gap-10 p-8 md:p-12" style="background: oklch(0.12 0.018 55);">

                {{-- Step 1: Vehicle Category --}}
                <div>
                    <div class="flex items-center gap-3 mb-6" style="border-bottom: 1px solid oklch(0.22 0.02 55); padding-bottom: 1rem;">
                        <span class="font-display font-600" style="font-size: 1.25rem; color: oklch(0.67 0.13 66);">01</span>
                        <h3 class="font-sans font-700 text-sm uppercase tracking-wider" style="color: oklch(0.93 0.012 75);">Kategori Kendaraan</h3>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                        <template x-for="cat in vehicleCategories" :key="cat.id">
                            <button
                                @click="selectedCategory = cat.id; updateMaterials()"
                                class="touch-target py-3 px-4 text-left font-sans font-700 text-sm transition-all duration-200"
                                :style="selectedCategory === cat.id
                                    ? 'background: oklch(0.67 0.13 66 / 0.12); border: 1px solid oklch(0.67 0.13 66); color: oklch(0.75 0.11 67);'
                                    : 'background: transparent; border: 1px solid oklch(0.28 0.025 55); color: oklch(0.72 0.025 68);'"
                                x-text="cat.name"
                            ></button>
                        </template>
                    </div>
                </div>

                {{-- Step 2: Material --}}
                <div x-show="materials.length > 0" x-cloak>
                    <div class="flex items-center gap-3 mb-6" style="border-bottom: 1px solid oklch(0.22 0.02 55); padding-bottom: 1rem;">
                        <span class="font-display font-600" style="font-size: 1.25rem; color: oklch(0.67 0.13 66);">02</span>
                        <h3 class="font-sans font-700 text-sm uppercase tracking-wider" style="color: oklch(0.93 0.012 75);">Pilihan Material</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <template x-for="material in materials" :key="material.id">
                            <button
                                @click="selectedMaterial = material.id; calculateTotal()"
                                class="touch-target text-left p-4 transition-all duration-200"
                                :style="selectedMaterial === material.id
                                    ? 'background: oklch(0.67 0.13 66 / 0.10); border: 1px solid oklch(0.67 0.13 66);'
                                    : 'background: transparent; border: 1px solid oklch(0.28 0.025 55);'"
                            >
                                <div
                                    class="font-sans font-700 text-sm mb-1"
                                    :style="selectedMaterial === material.id ? 'color: oklch(0.75 0.11 67)' : 'color: oklch(0.93 0.012 75)'"
                                    x-text="material.item_name"
                                ></div>
                                <div
                                    class="font-mono text-xs"
                                    :style="selectedMaterial === material.id ? 'color: oklch(0.67 0.13 66)' : 'color: oklch(0.50 0.020 62)'"
                                >Rp <span x-text="formatNumber(material.price)"></span></div>
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Booking Calendar --}}
                <x-home.booking-calendar :calendar="$calendar" />
            </div>

            {{-- Price Panel --}}
            <div
                class="lg:col-span-5 flex flex-col justify-center p-8 md:p-12 relative overflow-hidden"
                style="background: oklch(0.10 0.015 55);"
            >
                {{-- Price display --}}
                <p class="font-sans text-xs uppercase tracking-[0.14em] mb-4" style="color: oklch(0.38 0.03 60);">Estimasi Biaya</p>
                <div class="flex items-start mb-8">
                    <span class="font-sans font-500 text-lg mt-1 mr-2" style="color: oklch(0.50 0.020 62);">Rp</span>
                    <span
                        class="font-display font-600"
                        style="font-size: clamp(2.5rem, 4vw, 3.5rem); color: oklch(0.93 0.012 75); letter-spacing: -0.02em; line-height: 1.1;"
                        x-text="formatNumber(animatedPrice)"
                    ></span>
                </div>

                <div style="height: 1px; background: oklch(0.22 0.02 55); margin-bottom: 1.75rem;"></div>

                {{-- Summary --}}
                <ul class="space-y-3 mb-8">
                    <li class="flex justify-between items-center text-sm">
                        <span class="font-sans" style="color: oklch(0.50 0.020 62);">Kendaraan</span>
                        <span class="font-sans font-700" style="color: oklch(0.93 0.012 75);" x-text="vehicleCategories.find(c => c.id === selectedCategory)?.name || '—'"></span>
                    </li>
                    <li class="flex justify-between items-center text-sm">
                        <span class="font-sans" style="color: oklch(0.50 0.020 62);">Material</span>
                        <span class="font-sans font-700" style="color: oklch(0.93 0.012 75);" x-text="materials.find(m => m.id === selectedMaterial)?.item_name || '—'"></span>
                    </li>
                    <li class="text-xs mt-2" style="color: oklch(0.38 0.03 60); padding-top: 0.75rem; border-top: 1px solid oklch(0.22 0.02 55);">
                        * Harga dapat berubah untuk penambahan busa atau motif custom.
                    </li>
                </ul>

                {{-- Contact inputs --}}
                <div class="space-y-3 mb-6">
                    <input
                        type="text"
                        x-model="customerName"
                        placeholder="Nama Anda (Opsional)"
                        class="input-field"
                        style="background: oklch(0.155 0.022 55); border-color: oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);"
                    >
                    <input
                        type="tel"
                        x-model="customerWa"
                        placeholder="Nomor WhatsApp (Opsional)"
                        class="input-field"
                        style="background: oklch(0.155 0.022 55); border-color: oklch(0.28 0.025 55); color: oklch(0.93 0.012 75);"
                    >
                </div>

                {{-- CTA --}}
                <button
                    @click="sendToWhatsApp()"
                    class="touch-target w-full flex items-center justify-center gap-2.5 py-4 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-250"
                    style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55); border: none;"
                    onmouseover="this.style.background='oklch(0.75 0.11 67)'"
                    onmouseout="this.style.background='oklch(0.67 0.13 66)'"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.025.507 3.934 1.399 5.61L0 24l6.545-1.376A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.371l-.359-.214-3.733.979.998-3.648-.234-.374A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                    Pesan via WhatsApp
                </button>
            </div>
        </div>

    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('calculatorApp', () => ({
            vehicleCategories: @json($vehicleCategories),
            selectedCategory: null,
            materials: [],
            selectedMaterial: null,
            currentPrice: 0,
            animatedPrice: 0,
            customerName: '',
            customerWa: '',
            selectedDate: null,
            customerDate: '',
            dateFormatted: '',

            init() {
                if (this.vehicleCategories && this.vehicleCategories.length > 0) {
                    this.selectedCategory = this.vehicleCategories[0].id;
                    this.updateMaterials();
                }
            },

            updateMaterials() {
                const cat = this.vehicleCategories.find(c => c.id === this.selectedCategory);
                if (cat && cat.pricelists) {
                    this.materials = cat.pricelists;
                    if (this.materials.length > 0) {
                        this.selectedMaterial = this.materials[0].id;
                    } else {
                        this.selectedMaterial = null;
                    }
                } else {
                    this.materials = [];
                    this.selectedMaterial = null;
                }
                this.calculateTotal();
            },

            calculateTotal() {
                let newPrice = 0;
                const mat = this.materials.find(m => m.id === this.selectedMaterial);
                if (mat) { newPrice = parseFloat(mat.price); }
                this.animateValue(this.animatedPrice, newPrice, 600);
                this.currentPrice = newPrice;
            },

            animateValue(start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    const easeOut = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    this.animatedPrice = Math.floor(easeOut * (end - start) + start);
                    if (progress < 1) { window.requestAnimationFrame(step); }
                    else { this.animatedPrice = end; }
                };
                window.requestAnimationFrame(step);
            },

            formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            },

            async sendToWhatsApp() {
                const cat = this.vehicleCategories.find(c => c.id === this.selectedCategory);
                const mat = this.materials.find(m => m.id === this.selectedMaterial);
                try {
                    fetch('/leads', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            customer_name:   this.customerName || null,
                            whatsapp_number: this.customerWa   || null,
                            material:        mat ? mat.item_name : '-',
                            capacity:        cat ? cat.name     : '-',
                            price:           this.currentPrice
                        })
                    });
                } catch(e) { console.error('Failed to capture lead', e); }

                const namaDisplay = this.customerName ? `*${this.customerName}*\n` : '';
                const dateDisplay = this.customerDate ? `%0A- Rencana Jadwal: *${this.dateFormatted} (${this.customerDate})*` : '';
                const text = `Halo Bengkel Jok Nusantara!%0A${namaDisplay ? encodeURIComponent(namaDisplay) : ''}Saya mau tanya-tanya dan pesan jok mobil.%0A%0A*Detail Kendaraan:*%0A- Tipe Kendaraan: ${cat ? cat.name : '-'}%0A- Material yang diminati: ${mat ? mat.item_name : '-'}${dateDisplay}%0A- Estimasi Harga: *Rp ${this.formatNumber(this.currentPrice)}*%0A%0ABisa dibantu info lebih lanjut dan jadwal pemasangannya? Terima kasih!`;
                window.open(`https://wa.me/6281259645665?text=${text}`, '_blank');
            }
        }));
    });
</script>
@endpush




