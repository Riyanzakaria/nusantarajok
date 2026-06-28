<section class="py-24 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800" id="solusi">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            
            <div x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
                <h2 class="text-sm font-bold text-accent-500 uppercase tracking-widest mb-3 transition-all duration-700 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'">SOLUSI KAMI</h2>
                <h3 class="text-3xl md:text-5xl font-display font-black text-slate-900 dark:text-white mb-6 leading-tight transition-all duration-700 delay-100 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Modifikasi Premium <br/>Sesuai Standar Pabrik.</h3>
                <p class="text-lg text-slate-500 dark:text-slate-400 mb-8 transition-all duration-700 delay-200 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Di Bengkel Jok Nusantara (BJN), kami mengedepankan kualitas material dan detail jahitan presisi untuk memastikan hasil akhir yang tidak hanya estetis, tetapi juga awet dan nyaman untuk penggunaan jangka panjang.</p>
                
                <ul class="space-y-6 transition-all duration-700 delay-300 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-accent-500/10 text-accent-500 flex items-center justify-center shrink-0 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-lg">Material Kulit Asli & Sintetis Premium</h4>
                            <p class="text-slate-500 dark:text-slate-400">Pilihan bahan tahan lama, mudah dibersihkan, dan memiliki sirkulasi udara baik.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-accent-500/10 text-accent-500 flex items-center justify-center shrink-0 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-lg">Pengerjaan Artisan Presisi</h4>
                            <p class="text-slate-500 dark:text-slate-400">Pola dipotong presisi dengan teknik jahit *double-stitch* untuk kekuatan maksimal.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-accent-500/10 text-accent-500 flex items-center justify-center shrink-0 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-lg">Sistem Tracker Transparan</h4>
                            <p class="text-slate-500 dark:text-slate-400">Pantau proses pengerjaan mobil Anda secara online kapan saja dan di mana saja.</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Visual Side -->
            <div class="relative" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
                <div class="aspect-[4/5] rounded-3xl overflow-hidden bg-slate-100 dark:bg-slate-800 transition-all duration-1000 transform" :class="shown ? 'scale-100 opacity-100' : 'scale-95 opacity-0'">
                    <img src="{{ asset('images/testimonials/customer_1.png') }}" alt="Proses pengerjaan jok mobil" class="w-full h-full object-cover">
                    <!-- overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 p-6 backdrop-blur-md bg-white/10 border border-white/20 rounded-2xl">
                        <p class="text-white font-bold mb-1">Dikerjakan oleh Profesional</p>
                        <p class="text-white/80 text-sm">Tim kami telah menangani ratusan modifikasi interior dari berbagai tipe kendaraan.</p>
                    </div>
                </div>
                
                <!-- Floating badge -->
                <div class="absolute -top-6 -right-6 bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 transition-all duration-700 delay-500 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-accent-500 rounded-full flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <p class="text-slate-900 dark:text-white font-black leading-none">2 Tahun</p>
                            <p class="text-slate-500 dark:text-slate-400 text-xs mt-1 uppercase tracking-wider font-bold">Garansi Resmi</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
