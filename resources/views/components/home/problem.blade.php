<section class="py-16 md:py-24 bg-white dark:bg-slate-950 relative border-b border-slate-200 dark:border-slate-800" id="problem">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 md:mb-20 gap-6" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
            <div class="max-w-2xl">
                <h2 class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3 transition-all duration-700 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'">MENGAPA MODIFIKASI JOK?</h2>
                <h3 class="text-3xl md:text-5xl font-display font-black text-slate-900 dark:text-white leading-tight transition-all duration-700 delay-100 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Jok Bawaan Pabrik <br/><span class="text-slate-400 dark:text-slate-600">Seringkali Mengecewakan.</span></h3>
            </div>
            <div class="max-w-md">
                <p class="text-base md:text-lg text-slate-600 dark:text-slate-400 font-medium transition-all duration-700 delay-200 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Kenyamanan kabin tidak seharusnya menjadi kompromi. Kami mengatasi masalah yang sering diabaikan oleh pabrikan.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8">
            <!-- Problem 1: Large Bento -->
            <div class="md:col-span-8 bg-slate-50 dark:bg-slate-900 p-8 md:p-12 rounded-none border-l-4 border-slate-900 dark:border-white" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
                <h4 class="text-2xl md:text-3xl font-display font-black text-slate-900 dark:text-white mb-4 uppercase tracking-tight">Panas & Tidak Nyaman</h4>
                <p class="text-base md:text-lg text-slate-600 dark:text-slate-400 leading-relaxed max-w-lg">Bahan fabrik (kain) bawaan mudah menyerap suhu, menyimpan debu, dan membuat perjalanan jauh terasa melelahkan. Kami menggantinya dengan material yang memiliki sirkulasi udara lebih baik.</p>
            </div>

            <!-- Problem 2: Small Bento -->
            <div class="md:col-span-4 bg-slate-100 dark:bg-slate-800 p-8 md:p-12 rounded-none" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
                <h4 class="text-xl md:text-2xl font-display font-black text-slate-900 dark:text-white mb-4 uppercase tracking-tight">Kusam & Noda</h4>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Tumpahan air atau makanan seringkali meninggalkan noda permanen. Material kulit memudahkan perawatan dan pembersihan harian.</p>
            </div>

            <!-- Problem 3: Full Width Banner -->
            <div class="md:col-span-12 bg-slate-900 dark:bg-black p-8 md:p-12 rounded-none flex flex-col md:flex-row items-start md:items-center justify-between gap-8" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
                <div class="max-w-2xl">
                    <h4 class="text-xl md:text-2xl font-display font-black text-white mb-2 uppercase tracking-tight">Desain Monoton</h4>
                    <p class="text-slate-400 leading-relaxed">Kehilangan kesan eksklusif dan personal. Mobil Anda seharusnya mencerminkan karakter dan gaya hidup Anda melalui sentuhan personalisasi.</p>
                </div>
                <div class="shrink-0 text-slate-700">
                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="0.5"><path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                </div>
            </div>
        </div>
    </div>
</section>
