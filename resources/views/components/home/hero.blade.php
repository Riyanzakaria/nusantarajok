<section class="relative min-h-[100svh] flex items-center justify-center overflow-hidden pt-24 pb-12 bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
    <!-- Editorial Background -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hero_jok_premium.png') }}" alt="Premium Leather Car Seat" class="w-full h-full object-cover opacity-60 dark:opacity-50 contrast-125" />
        <!-- Side fade to ensure text readability on the left -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-50/95 via-slate-50/70 to-slate-50/20 dark:from-slate-900/95 dark:via-slate-900/80 dark:to-slate-900/40"></div>
        <!-- Bottom fade to blend with next section -->
        <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-transparent to-transparent dark:from-slate-900"></div>
    </div>

    <div class="relative z-10 container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-8" x-data="{ mounted: false }" x-init="setTimeout(() => mounted = true, 100)">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-accent-50 text-accent-600 dark:bg-accent-500/10 dark:text-accent-400 text-xs font-bold tracking-widest uppercase border border-accent-100 dark:border-accent-500/20 transition-all duration-700 ease-out transform" :class="mounted ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'">
                Spesialis Jok Mobil Premium
            </div>
            
            <h1 class="text-5xl md:text-7xl font-display font-black text-slate-900 dark:text-white leading-[1.05] tracking-tight transition-all duration-700 delay-100 ease-out transform" :class="mounted ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                Kenyamanan & Wibawa<br/>
                <span class="text-accent-500">Dalam Satu Kabin.</span>
            </h1>
            
            <p class="text-base md:text-xl text-slate-600 dark:text-slate-300 font-medium leading-relaxed max-w-lg transition-all duration-700 delay-200 ease-out transform" :class="mounted ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                Bukan sekadar sarung jok. Kami membangun ulang interior mobil Anda dengan material autentik dan standar manufaktur pabrik.
            </p>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-6 transition-all duration-700 delay-300 ease-out transform" :class="mounted ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                <a href="#kalkulator" class="touch-target px-8 py-4 rounded-none border-2 border-accent-500 text-base font-bold w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-accent-500 text-white hover:bg-accent-600 hover:border-accent-600 transition-all duration-300">
                    Mulai Estimasi
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
                <a href="#solusi" class="touch-target px-8 py-4 rounded-none text-base font-bold w-full sm:w-auto inline-flex items-center justify-center bg-transparent border-2 border-slate-900 dark:border-white text-slate-900 dark:text-white hover:bg-slate-900 hover:text-white dark:hover:bg-white dark:hover:text-slate-900 transition-all duration-300">
                    Cara Kerja Kami
                </a>
            </div>
        </div>
        
        <!-- Trust Indicators right side -->
        <div class="hidden md:block relative z-10" x-data="{ mounted: false }" x-init="setTimeout(() => mounted = true, 400)">
            <div class="grid grid-cols-1 gap-6 max-w-sm ml-auto transition-all duration-700 ease-out transform" :class="mounted ? 'translate-x-0 opacity-100' : 'translate-x-12 opacity-0'">
                <!-- Editorial brutalist card style -->
                <div class="bg-white dark:bg-slate-950 border-l-4 border-accent-500 p-6 shadow-2xl">
                    <h3 class="font-display font-black text-2xl text-slate-900 dark:text-white mb-2 uppercase tracking-wide">Material Asli</h3>
                    <p class="text-base text-slate-600 dark:text-slate-400">Garansi keaslian 100% pada setiap lembar material kulit yang kami gunakan.</p>
                </div>
                <div class="bg-slate-900 dark:bg-slate-800 border-l-4 border-white dark:border-slate-500 p-6 shadow-2xl transform translate-x-8">
                    <h3 class="font-display font-black text-2xl text-white mb-2 uppercase tracking-wide">Presisi Pabrik</h3>
                    <p class="text-base text-slate-300 dark:text-slate-400">Pola potongan dan jahitan *double-stitch* yang mengikuti standar manufaktur.</p>
                </div>
            </div>
        </div>
    </div>
</section>
