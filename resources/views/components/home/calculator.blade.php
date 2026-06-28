@props(['vehicleCategories' => [], 'calendar' => []])

<section class="py-16 md:py-24 bg-slate-100 dark:bg-slate-950 relative border-t border-slate-200 dark:border-slate-800" id="kalkulator" x-data="calculatorApp()">
    <div class="container mx-auto px-6 max-w-5xl relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 md:mb-16 gap-6" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
            <div class="max-w-xl">
                <h2 class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3 transition-all duration-700 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'">PENAWARAN SPESIAL</h2>
                <h3 class="text-3xl md:text-5xl font-display font-black text-slate-900 dark:text-white leading-tight transition-all duration-700 delay-100 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Estimasi Biaya <br/><span class="text-accent-500">Transparan.</span></h3>
            </div>
            <div class="max-w-md">
                <p class="text-base md:text-lg text-slate-600 dark:text-slate-400 font-medium transition-all duration-700 delay-200 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Pilih material dan kapasitas kendaraan Anda untuk mendapatkan perkiraan harga seketika. Tanpa biaya tersembunyi.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-800">
            
            <!-- Options Panel -->
            <div class="lg:col-span-7 flex flex-col gap-10 p-6 md:p-10 border-b lg:border-b-0 lg:border-r border-slate-200 dark:border-slate-800">
                <!-- Vehicle Category Selection -->
                <div>
                    <h4 class="text-slate-900 dark:text-white font-black mb-4 flex items-center gap-3 uppercase tracking-tight text-sm">
                        <span class="w-8 h-8 rounded-none bg-slate-900 dark:bg-white text-white dark:text-slate-900 flex items-center justify-center text-sm font-bold">1</span>
                        Kategori Kendaraan
                    </h4>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <template x-for="cat in vehicleCategories" :key="cat.id">
                            <button 
                                @click="selectedCategory = cat.id; updateMaterials()"
                                class="touch-target py-3 px-4 rounded-none border-2 transition-all duration-200 font-bold text-center text-sm md:text-base"
                                :class="selectedCategory === cat.id ? 'border-accent-500 bg-accent-50 text-accent-600 dark:bg-accent-500/10 dark:text-accent-400' : 'border-slate-200 dark:border-slate-700 bg-transparent text-slate-600 dark:text-slate-400 hover:border-slate-400 dark:hover:border-slate-500'"
                                x-text="cat.name"
                            >
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Material Selection -->
                <div x-show="materials.length > 0">
                    <h4 class="text-slate-900 dark:text-white font-black mb-4 flex items-center gap-3 uppercase tracking-tight text-sm">
                        <span class="w-8 h-8 rounded-none bg-slate-900 dark:bg-white text-white dark:text-slate-900 flex items-center justify-center text-sm font-bold">2</span>
                        Pilihan Material
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <template x-for="material in materials" :key="material.id">
                            <button 
                                @click="selectedMaterial = material.id; calculateTotal()"
                                class="touch-target text-left p-4 rounded-none border-2 transition-all duration-200 group"
                                :class="selectedMaterial === material.id ? 'border-accent-500 bg-accent-50 dark:bg-accent-500/5' : 'border-slate-200 dark:border-slate-700 bg-transparent hover:border-slate-400 dark:hover:border-slate-500'"
                            >
                                <div class="flex justify-between items-start mb-2">
                                    <div class="font-bold" :class="selectedMaterial === material.id ? 'text-accent-600 dark:text-accent-400' : 'text-slate-900 dark:text-white'" x-text="material.item_name"></div>
                                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center"
                                         :class="selectedMaterial === material.id ? 'border-accent-500' : 'border-slate-300 dark:border-slate-600'">
                                        <div class="w-2.5 h-2.5 rounded-full bg-accent-500 transition-transform duration-300"
                                             :class="selectedMaterial === material.id ? 'scale-100' : 'scale-0'"></div>
                                    </div>
                                </div>
                                <div class="text-sm font-medium font-mono" :class="selectedMaterial === material.id ? 'text-slate-700 dark:text-slate-300' : 'text-slate-500'">Rp <span x-text="formatNumber(material.price)"></span></div>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Booking Calendar (Tersedia / Sisa 1 / Penuh) -->
                <x-home.booking-calendar :calendar="$calendar" />
            </div>

            <!-- Price Panel -->
            <div class="lg:col-span-5 flex flex-col justify-center bg-slate-50 dark:bg-slate-950 p-6 md:p-10 relative overflow-hidden">
                <p class="text-slate-400 font-black uppercase tracking-widest text-xs mb-4">ESTIMASI BIAYA</p>
                
                <!-- Odometer Price Animation -->
                <div class="flex items-start text-slate-900 dark:text-white font-display mb-6">
                    <span class="text-xl font-bold mt-2 mr-2 opacity-50">Rp</span>
                    <span class="text-4xl md:text-5xl font-black tracking-tight" x-text="formatNumber(animatedPrice)"></span>
                </div>
                
                <div class="h-px w-full bg-slate-200 dark:bg-slate-700 mb-6"></div>

                <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-300 mb-8">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-accent-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Kendaraan: <strong class="text-slate-900 dark:text-white" x-text="vehicleCategories.find(c => c.id === selectedCategory)?.name || '-'"></strong></span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-accent-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Material: <strong class="text-slate-900 dark:text-white" x-text="materials.find(m => m.id === selectedMaterial)?.item_name || '-'"></strong></span>
                    </li>
                    <li class="flex items-start gap-3 opacity-70">
                        <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-xs">Harga dapat berubah jika ada penambahan busa (retouch) atau motif *custom*.</span>
                    </li>
                </ul>

                <!-- Optional Contact Fields -->
                <div class="space-y-3 mb-6">
                    <input
                        type="text"
                        x-model="customerName"
                        placeholder="Nama Anda (Opsional)"
                        class="w-full px-4 py-3 rounded-none border-2 border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-0 focus:border-accent-500 outline-none transition-colors"
                    >
                    <input
                        type="tel"
                        x-model="customerWa"
                        placeholder="Nomor WhatsApp (Opsional)"
                        class="w-full px-4 py-3 rounded-none border-2 border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white text-sm focus:ring-0 focus:border-accent-500 outline-none transition-colors"
                    >
                </div>

                <!-- CTA to WA -->
                <button 
                    @click="sendToWhatsApp()"
                    class="touch-target w-full bg-accent-500 hover:bg-accent-600 text-white font-bold py-4 rounded-none flex items-center justify-center gap-2 transition-colors duration-200"
                >
                    <span>Pesan via WhatsApp</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
                if (mat) {
                    newPrice = parseFloat(mat.price);
                }
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
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        this.animatedPrice = end;
                    }
                };
                window.requestAnimationFrame(step);
            },

            formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
                            customer_name:    this.customerName || null,
                            whatsapp_number:  this.customerWa   || null,
                            material:         mat ? mat.item_name : '-',
                            capacity:         cat ? cat.name     : '-',
                            price:            this.currentPrice
                        })
                    });
                } catch (e) {
                    console.error('Failed to capture lead', e);
                }

                const namaDisplay = this.customerName ? `*${this.customerName}* — ` : '';
                const dateDisplay = this.customerDate ? `%0A- Rencana Jadwal: *${this.dateFormatted} (${this.customerDate})*` : '';
                const text = `Halo Admin *BJN*, ${namaDisplay}saya ingin konsultasi modifikasi interior kendaraan saya.%0A%0A*Detail Estimasi:*%0A- Kendaraan: ${cat ? cat.name : '-'}%0A- Material: ${mat ? mat.item_name : '-'}${dateDisplay}%0A- Estimasi Harga: *Rp ${this.formatNumber(this.currentPrice)}*%0A%0AMohon info lebih lanjut mengenai jadwal pengerjaan. Terima kasih!`;

                window.open(`https://wa.me/6281234567890?text=${text}`, '_blank');
            }
        }));
    });
</script>
@endpush
