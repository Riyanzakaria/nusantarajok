@props(['featuredGalleries' => []])

<section class="py-24 bg-slate-50 dark:bg-slate-950 relative border-t border-slate-200 dark:border-slate-800" id="gallery">
    <div class="container mx-auto px-6 max-w-7xl">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6" x-data="{ shown: false }" x-intersect.once.margin.-10%.0px="shown = true">
            <div class="max-w-2xl">
                <h2 class="text-sm font-bold text-accent-500 uppercase tracking-widest mb-3 transition-all duration-700 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'">PORTFOLIO KAMI</h2>
                <h3 class="text-3xl md:text-5xl font-display font-black text-slate-900 dark:text-white tracking-tight transition-all duration-700 delay-100 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Galeri <span class="text-accent-500">Pekerjaan.</span></h3>
                <p class="mt-4 text-lg text-slate-500 dark:text-slate-400 font-medium transition-all duration-700 delay-200 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">Jelajahi hasil modifikasi interior kami dari berbagai kelas kendaraan. Bukti nyata dedikasi pada kualitas.</p>
            </div>
            <div class="transition-all duration-700 delay-300 transform" :class="shown ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                <a href="{{ route('gallery.index') }}" class="touch-target inline-flex items-center gap-2 px-6 py-3 rounded-lg text-sm font-bold bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white hover:bg-slate-50 dark:hover:bg-slate-700 transition-all duration-300">
                    Lihat Semua Galeri
                    <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($featuredGalleries as $index => $gallery)
                @php
                    // Bikin layout bento grid, item pertama lebih besar jika jumlah ganjil
                    $colSpan = ($index === 0 && count($featuredGalleries) % 2 !== 0) ? 'lg:col-span-2' : '';
                @endphp
                <div 
                    x-data="{ shown: false }" 
                    x-intersect.once.margin.-10%.0px="shown = true"
                    class="rounded-2xl overflow-hidden group {{ $colSpan }} bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-500 relative"
                >
                    <div 
                        class="relative h-72 md:h-80 w-full overflow-hidden opacity-0 translate-y-8 transition-all duration-[800ms] ease-out"
                        :class="shown ? '!opacity-100 !translate-y-0' : ''"
                        style="transition-delay: {{ $index * 100 }}ms;"
                    >
                        <img src="{{ asset($gallery->image_url) }}" alt="{{ $gallery->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                            <div class="p-6 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h4 class="text-xl font-bold text-white mb-1">{{ $gallery->title ?? 'Modifikasi Jok' }}</h4>
                                @if($gallery->category)
                                    <p class="text-accent-400 text-sm font-bold uppercase tracking-wider">{{ $gallery->category->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800">
                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada galeri yang ditampilkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
