<x-layout>
    <!-- Hero Section V4: Midnight Leather & Glass -->
    <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden pt-20 bg-slate-900">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero_jok_premium.png') }}" alt="Premium Leather Car Seat" class="w-full h-full object-cover opacity-50 scale-105 transform origin-center animate-[pulse_20s_ease-in-out_infinite_alternate]" />
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/80 via-slate-900/60 to-slate-900/95"></div>
            <!-- Dynamic Grid Pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50"></div>
            
            <!-- Glowing Orbs for ambiance -->
            <div class="absolute -top-40 -right-40 w-[40rem] h-[40rem] bg-accent-500/20 rounded-full blur-[120px] animate-pulse" style="animation-duration: 8s;"></div>
            <div class="absolute bottom-0 -left-40 w-[40rem] h-[40rem] bg-blue-500/20 rounded-full blur-[120px] animate-pulse" style="animation-duration: 12s;"></div>
        </div>

        <!-- Floating Assets/Elements -->
        <div class="absolute inset-0 z-10 pointer-events-none hidden lg:block overflow-hidden">
            <!-- Floating Glass Card 1: Material Quality -->
            <div class="absolute top-[20%] left-[10%] backdrop-blur-md bg-white/5 border border-white/10 p-4 rounded-2xl shadow-2xl animate-[bounce_8s_infinite] transform -rotate-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-accent-500/20 flex items-center justify-center text-accent-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm">Material Premium</p>
                        <p class="text-slate-400 text-xs">Kulit Nappa & Microfiber</p>
                    </div>
                </div>
            </div>

            <!-- Floating Glass Card 2: Warranty -->
            <div class="absolute bottom-[25%] right-[12%] backdrop-blur-md bg-white/5 border border-white/10 p-4 rounded-2xl shadow-2xl animate-[bounce_10s_infinite_0.5s] transform rotate-3">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm">Garansi 2 Tahun</p>
                        <p class="text-slate-400 text-xs">Pemasangan & Jahitan</p>
                    </div>
                </div>
            </div>
            
            <!-- Floating Element 3: Stitching Detail -->
            <div class="absolute top-[35%] right-[15%] w-32 h-32 bg-gradient-to-br from-accent-500/10 to-transparent border border-accent-500/20 rounded-full blur-[2px] animate-[pulse_6s_infinite] flex items-center justify-center">
                <svg class="w-12 h-12 text-accent-500/50 transform rotate-45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="4 4">
                    <path d="M4 20L20 4"></path>
                    <path d="M4 12L12 4"></path>
                    <path d="M12 20L20 12"></path>
                </svg>
            </div>
        </div>

        <div class="relative z-20 container mx-auto px-6 grid grid-cols-1 items-center justify-items-center text-center max-w-4xl">
            <div class="space-y-8 mt-12" x-data="{ mounted: false }" x-init="setTimeout(() => mounted = true, 100)">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full backdrop-blur-sm bg-white/10 border border-white/20 text-slate-200 text-xs font-bold tracking-widest uppercase shadow-xl transition-all duration-700 ease-out transform" :class="mounted ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'">
                    <span class="w-2 h-2 rounded-full bg-accent-500 animate-pulse"></span>
                    Spesialis Jok Mobil Premium
                </div>
                
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-display font-black text-white leading-[1.05] tracking-tighter transition-all duration-700 delay-100 ease-out transform" :class="mounted ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    Modifikasi Interior <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-400 to-accent-600 relative inline-block">
                        Tanpa Kompromi.
                        <svg class="absolute w-full h-4 -bottom-2 left-0 text-accent-500/40" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" fill="transparent"/></svg>
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-slate-300 font-medium leading-relaxed max-w-2xl mx-auto transition-all duration-700 delay-200 ease-out transform" :class="mounted ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    Elevasi estetika dan kenyamanan kabin kendaraan Anda dengan material jok eksklusif, jahitan artisan yang presisi, dan desain kustom kelas dunia.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-8 transition-all duration-700 delay-300 ease-out transform" :class="mounted ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <a href="#kalkulator" class="touch-target px-8 py-4 rounded-xl text-lg font-bold w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-accent-500 text-white hover:bg-accent-400 hover:-translate-y-1 shadow-[0_0_20px_rgba(249,115,22,0.4)] hover:shadow-[0_0_30px_rgba(249,115,22,0.6)] transition-all duration-300">
                        Mulai Estimasi
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                    <a href="{{ route('tracker.index') }}" class="touch-target px-8 py-4 rounded-xl text-lg font-bold w-full sm:w-auto inline-flex items-center justify-center backdrop-blur-md bg-white/5 border-2 border-white/20 text-white hover:border-white hover:bg-white/10 hover:-translate-y-1 shadow-lg transition-all duration-300">
                        Lacak Progres
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Badges & Value Proposition V4: Midnight Glass -->
    <section class="py-24 bg-slate-900 border-t border-slate-800 relative" id="layanan">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiLz48L3N2Zz4=')] opacity-50 z-0"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16">
                <!-- Value 1 -->
                <div class="group flex flex-col items-center text-center p-8 rounded-3xl transition-all duration-500 backdrop-blur-md bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                    <div class="w-20 h-20 flex items-center justify-center mb-6 text-white group-hover:text-accent-500 transition-colors duration-500">
                        <!-- Custom Artisan Hand-drawn style SVG for Material -->
                        <svg class="w-16 h-16 group-hover:scale-110 transition-transform duration-500 drop-shadow-[0_0_10px_rgba(255,255,255,0.2)] group-hover:drop-shadow-[0_0_15px_rgba(249,115,22,0.5)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                            <path d="M12 22V12"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-display font-black text-white mb-4 tracking-tight">Material Premium</h3>
                    <p class="text-slate-400 font-medium leading-relaxed">Kulit sintetis dan asli berkualitas tinggi, dijahit dengan presisi untuk kenyamanan dan keawetan maksimal.</p>
                </div>
                <!-- Value 2 -->
                <div class="group flex flex-col items-center text-center p-8 rounded-3xl transition-all duration-500 backdrop-blur-md bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                    <div class="w-20 h-20 flex items-center justify-center mb-6 text-white group-hover:text-accent-500 transition-colors duration-500">
                        <!-- Custom Artisan Hand-drawn style SVG for Craftsmanship -->
                        <svg class="w-16 h-16 group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-500 drop-shadow-[0_0_10px_rgba(255,255,255,0.2)] group-hover:drop-shadow-[0_0_15px_rgba(249,115,22,0.5)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.121 14.121L19 19m-7-7l-7-7m7 7l-2.828 2.828M15.536 8.464a2 2 0 11-2.828-2.828 2 2 0 012.828 2.828z"></path>
                            <circle cx="12" cy="12" r="10"></circle>
                        </svg>
                    </div>
                    <h3 class="text-xl font-display font-black text-white mb-4 tracking-tight">Pengerjaan Artisan</h3>
                    <p class="text-slate-400 font-medium leading-relaxed">Dikerjakan oleh tangan-tangan ahli yang berpengalaman puluhan tahun di industri modifikasi interior.</p>
                </div>
                <!-- Value 3 -->
                <div class="group flex flex-col items-center text-center p-8 rounded-3xl transition-all duration-500 backdrop-blur-md bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 hover:-translate-y-2 shadow-xl hover:shadow-2xl">
                    <div class="w-20 h-20 flex items-center justify-center mb-6 text-white group-hover:text-accent-500 transition-colors duration-500">
                        <!-- Custom Artisan Hand-drawn style SVG for Transparency -->
                        <svg class="w-16 h-16 group-hover:scale-110 transition-transform duration-500 drop-shadow-[0_0_10px_rgba(255,255,255,0.2)] group-hover:drop-shadow-[0_0_15px_rgba(249,115,22,0.5)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                            <path d="M9 16l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-display font-black text-white mb-4 tracking-tight">Transparansi Digital</h3>
                    <p class="text-slate-400 font-medium leading-relaxed">Pantau langsung status pengerjaan kendaraan Anda melalui platform tracking kami kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- The Faces Behind the Craft V4: Dark Aesthetic -->
    <section class="py-24 bg-slate-800 relative overflow-hidden border-t border-slate-700/50">
        <!-- Background Orbs -->
        <div class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-accent-500/5 rounded-full blur-[100px]"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <!-- Text Content -->
                <div class="w-full md:w-1/2 space-y-8" x-data="{ shown: false }" x-intersect.once.margin.-20%.0px="shown = true">
                    <div class="inline-block px-4 py-2 rounded-full backdrop-blur-md bg-white/5 border border-white/10 text-slate-300 text-xs font-bold tracking-widest uppercase transition-all duration-700 transform shadow-lg" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                        OTENTIK & BERDEDIKASI
                    </div>
                    <h2 class="text-4xl md:text-5xl font-display font-black text-white tracking-tight transition-all duration-700 delay-100 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                        Wajah di Balik <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-400 to-accent-600">Karya.</span>
                    </h2>
                    <p class="text-lg text-slate-400 font-medium leading-relaxed transition-all duration-700 delay-200 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                        Bagi kami, jok kendaraan bukan sekadar tempat duduk, melainkan kanvas. Puluhan tahun pengalaman telah membentuk insting kami dalam memilih, memotong, dan menjahit material agar menyatu sempurna dengan kontur interior mobil Anda. 
                    </p>
                    <p class="text-lg text-slate-400 font-medium leading-relaxed transition-all duration-700 delay-300 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                        Setiap lekukan dikerjakan dengan penuh ketelitian oleh pengrajin lokal kami yang mengedepankan kualitas tanpa kompromi.
                    </p>
                </div>
                <!-- Images Grid -->
                <div class="w-full md:w-1/2 grid grid-cols-2 gap-4">
                    <div class="space-y-4 pt-12">
                        <div class="rounded-[2rem] overflow-hidden bg-slate-700 aspect-[4/5] transform hover:-translate-y-2 transition-transform duration-500 shadow-[0_0_30px_rgba(0,0,0,0.5)] border border-white/10 relative group">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <img src="{{ asset('images/testimonials/customer_1.png') }}" alt="Artisan at work" class="w-full h-full object-cover filter grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700 scale-105 group-hover:scale-100">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="rounded-[2rem] overflow-hidden bg-slate-700 aspect-[4/5] transform hover:-translate-y-2 transition-transform duration-500 shadow-[0_0_30px_rgba(0,0,0,0.5)] border border-white/10 relative group">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <img src="{{ asset('images/testimonials/customer_2.png') }}" alt="Sewing process" class="w-full h-full object-cover filter grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700 scale-105 group-hover:scale-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Smart Calculator V4: Dark Premium -->
    <section class="py-24 bg-slate-900 relative border-t border-slate-800" id="kalkulator" x-data="calculatorApp()">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiLz48L3N2Zz4=')] opacity-30 z-0"></div>
        <div class="absolute -left-40 top-40 w-[30rem] h-[30rem] bg-accent-500/10 rounded-full blur-[100px] z-0"></div>
        
        <div class="container mx-auto px-6 max-w-5xl relative z-10">
            <div class="text-center mb-16" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
                <h2 class="text-4xl md:text-5xl font-display font-black text-white mb-6 tracking-tight transition-all duration-700 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Smart Estimasi</h2>
                <p class="text-lg text-slate-400 font-medium max-w-2xl mx-auto transition-all duration-700 delay-100 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Pilih material dan kapasitas kendaraan Anda untuk mendapatkan estimasi harga transparan dalam hitungan detik.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 backdrop-blur-xl bg-slate-800/80 p-6 md:p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-slate-700">
                
                <!-- Options Panel -->
                <div class="lg:col-span-7 flex flex-col gap-10">
                    <!-- Vehicle Category Selection -->
                    <div>
                        <h4 class="text-white font-black mb-4 flex items-center gap-3 uppercase tracking-wider text-sm">
                            <span class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-sm text-slate-300 font-bold border border-slate-600">1</span>
                            Jenis Kendaraan
                        </h4>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <template x-for="cat in vehicleCategories" :key="cat.id">
                                <button 
                                    @click="selectedCategory = cat.id; updateMaterials()"
                                    class="touch-target flex-1 py-5 px-6 rounded-2xl border transition-all duration-300 active:scale-[0.98] font-black text-center text-lg"
                                    :class="selectedCategory === cat.id ? 'border-accent-500 bg-accent-500/10 text-accent-400 shadow-[0_0_20px_rgba(249,115,22,0.15)]' : 'border-slate-700 bg-slate-900/50 text-slate-400 hover:border-slate-500 hover:text-white'"
                                    x-text="cat.name"
                                >
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Material Selection -->
                    <div x-show="materials.length > 0">
                        <h4 class="text-white font-black mb-4 flex items-center gap-3 uppercase tracking-wider text-sm">
                            <span class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-sm text-slate-300 font-bold border border-slate-600">2</span>
                            Pilihan Material
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <template x-for="material in materials" :key="material.id">
                                <button 
                                    @click="selectedMaterial = material.id; calculateTotal()"
                                    class="touch-target text-left p-6 rounded-2xl border transition-all duration-300 active:scale-[0.98] group relative overflow-hidden"
                                    :class="selectedMaterial === material.id ? 'border-accent-500 bg-accent-500/5 shadow-[0_0_20px_rgba(249,115,22,0.1)]' : 'border-slate-700 bg-slate-900/50 hover:border-slate-500 hover:bg-slate-800'"
                                >
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="font-black transition-colors duration-300" :class="selectedMaterial === material.id ? 'text-accent-400' : 'text-white'" x-text="material.item_name"></div>
                                        <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-colors duration-300"
                                             :class="selectedMaterial === material.id ? 'border-accent-500' : 'border-slate-600'">
                                            <div class="w-2.5 h-2.5 rounded-full bg-accent-500 transition-transform duration-300"
                                                 :class="selectedMaterial === material.id ? 'scale-100' : 'scale-0'"></div>
                                        </div>
                                    </div>
                                    <div class="text-sm font-medium leading-relaxed font-mono transition-colors duration-300" :class="selectedMaterial === material.id ? 'text-slate-300' : 'text-slate-500'">Rp <span x-text="formatNumber(material.price)"></span></div>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Price Panel -->
                <div class="lg:col-span-5 flex flex-col justify-center bg-slate-900/80 p-8 md:p-10 rounded-[2rem] border border-slate-700 relative overflow-hidden group hover:shadow-[0_0_40px_rgba(0,0,0,0.6)] transition-shadow duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-accent-500/5 to-transparent z-0"></div>
                    <div class="relative z-10">
                        <p class="text-accent-400 font-bold uppercase tracking-widest text-xs mb-6 drop-shadow-[0_0_5px_rgba(249,115,22,0.5)]">Estimasi Total Biaya</p>
                        
                        <!-- Odometer Price Animation -->
                        <div class="flex items-start text-white font-display mb-8">
                            <span class="text-2xl font-black mt-2 mr-2 opacity-60">Rp</span>
                            <span class="text-5xl md:text-6xl font-black tracking-tighter" x-text="formatNumber(animatedPrice)"></span>
                        </div>
                        
                        <div class="h-px w-full bg-slate-700 mb-8"></div>

                        <ul class="space-y-4 text-sm text-slate-300 font-medium mb-8">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-accent-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                <span>Kendaraan <strong class="text-white font-black" x-text="vehicleCategories.find(c => c.id === selectedCategory)?.name || '-'"></strong></span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-accent-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                <span>Material <strong class="text-white font-black" x-text="materials.find(m => m.id === selectedMaterial)?.item_name || '-'"></strong></span>
                            </li>
                            <li class="flex items-start gap-3 opacity-60">
                                <svg class="w-5 h-5 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-xs">Belum termasuk tambahan busa (retouch) atau motif kustom.</span>
                            </li>
                        </ul>

                        <!-- Optional Contact Fields -->
                        <div class="space-y-3 mb-6">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Identitas (Opsional — untuk follow-up lebih cepat)</p>
                            <input
                                type="text"
                                x-model="customerName"
                                placeholder="Nama Anda"
                                class="w-full px-4 py-3 rounded-xl border border-slate-700 bg-slate-800 text-white text-sm font-medium placeholder-slate-500 focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 outline-none transition"
                            >
                            <input
                                type="tel"
                                x-model="customerWa"
                                placeholder="Nomor WhatsApp (cth: 08123456789)"
                                class="w-full px-4 py-3 rounded-xl border border-slate-700 bg-slate-800 text-white text-sm font-medium placeholder-slate-500 focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 outline-none transition"
                            >
                        </div>

                        <!-- CTA to WA Pipeline -->
                        <button 
                            @click="sendToWhatsApp()"
                            class="touch-target w-full bg-accent-500 hover:bg-accent-400 text-white font-bold py-5 rounded-xl text-lg flex items-center justify-center gap-3 group/btn shadow-[0_0_20px_rgba(249,115,22,0.3)] hover:shadow-[0_0_30px_rgba(249,115,22,0.5)] transition-all duration-300 transform hover:-translate-y-1 active:scale-95 border border-accent-400/50"
                        >
                            <span>Kirim Spesifikasi ke WA</span>
                            <svg class="w-5 h-5 group-hover/btn:translate-x-1 group-hover/btn:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- The Artisan's Gallery V4: Dark Theme -->
    <section class="py-24 bg-slate-800 relative border-t border-slate-700/50" id="gallery">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
                <div class="max-w-2xl">
                    <h2 class="text-4xl md:text-5xl font-display font-black text-white mb-4 tracking-tight transition-all duration-700 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Karya <span class="text-accent-500">Artisan.</span></h2>
                    <p class="text-lg text-slate-400 font-medium transition-all duration-700 delay-100 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Setiap jahitan menceritakan dedikasi. Jelajahi portofolio modifikasi interior kami dari berbagai kelas kendaraan.</p>
                </div>
            </div>

            <!-- Gallery Grid with Dark Style -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredGalleries as $index => $gallery)
                    @php
                        $colSpan = ($index === 0 && count($featuredGalleries) % 2 !== 0) ? 'lg:col-span-2' : '';
                    @endphp
                    <div 
                        x-data="{ shown: false }" 
                        x-intersect.once.margin.-10%.0px="shown = true"
                        class="rounded-[2rem] overflow-hidden group {{ $colSpan }} shadow-[0_0_20px_rgba(0,0,0,0.3)] hover:shadow-[0_0_40px_rgba(0,0,0,0.6)] transition-all duration-700 bg-slate-900 border border-white/5 relative"
                    >
                        <div 
                            class="relative h-80 md:h-96 w-full overflow-hidden opacity-0 translate-y-12 transition-all duration-[1200ms] ease-out"
                            :class="shown ? '!opacity-100 !translate-y-0' : ''"
                            style="transition-delay: {{ $index * 100 }}ms;"
                        >
                            <img src="{{ asset($gallery->image_url) }}" alt="{{ $gallery->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-110 opacity-80 group-hover:opacity-100">
                            
                            <!-- Premium Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500 flex items-end">
                                <div class="p-8 w-full opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                                    <h4 class="text-2xl font-display font-black text-white mb-2">{{ $gallery->title ?? 'Karya Artisan' }}</h4>
                                    <div class="w-12 h-1 bg-accent-500 rounded-full shadow-[0_0_10px_rgba(249,115,22,0.5)]"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-500">
                        Belum ada galeri unggulan.
                    </div>
                @endforelse
            </div>

            <!-- CTA Button -->
            <div class="mt-16 text-center" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
                <a href="{{ route('gallery.index') }}" 
                   class="inline-flex items-center gap-2 px-8 py-4 rounded-xl text-lg font-bold backdrop-blur-md bg-white/5 border border-white/20 text-white hover:bg-white/10 hover:border-white/30 hover:-translate-y-1 shadow-[0_0_20px_rgba(0,0,0,0.5)] transition-all duration-300 transform opacity-0 translate-y-8"
                   :class="shown ? '!opacity-100 !translate-y-0' : ''">
                    Lihat Galeri Lengkap
                    <svg class="w-5 h-5 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
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

                init() {
                    if (this.vehicleCategories.length > 0) {
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
                    this.animateValue(this.animatedPrice, newPrice, 800);
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

                    // Fire-and-forget: capture lead in background
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
                    const text = `Halo Admin *AUTO-STITCH OS*, ${namaDisplay}saya ingin konsultasi modifikasi interior kendaraan saya.%0A%0A*Detail Estimasi:*%0A- Kendaraan: ${cat ? cat.name : '-'}%0A- Material: ${mat ? mat.item_name : '-'}%0A- Estimasi Harga: *Rp ${this.formatNumber(this.currentPrice)}*%0A%0AMohon info lebih lanjut mengenai jadwal pengerjaan. Terima kasih!`;

                    window.open(`https://wa.me/6281234567890?text=${text}`, '_blank');
                }
            }));
        });
    </script>
    @endpush
</x-layout>
