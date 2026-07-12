<x-layout title="Galeri Artisan | Nusantara Jok">
    <div class="bg-transparent min-h-screen pt-24 pb-16 relative" x-data="galleryFilter()">
        <div class="absolute top-20 right-0 w-96 h-96 bg-accent-500/10 rounded-full blur-[100px] pointer-events-none z-0"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Header Section -->
            <div class="text-center mb-12" x-intersect="animateFadeInUp($el)">
                <h1 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 tracking-tight drop-shadow-md">The Artisan's Showcase</h1>
                <p class="text-slate-500 dark:text-slate-400 text-lg max-w-2xl mx-auto">
                    Koleksi mahakarya restorasi interior kami. Dari bus premium hingga mobil mewah, dedikasi kami terlihat pada setiap jahitan.
                </p>
            </div>

            <!-- Filter Pills -->
            <div class="flex flex-wrap justify-center gap-3 mb-12" x-intersect="animateFadeInUp($el)" style="animation-delay: 100ms;">
                <button 
                    @click="activeCategory = 'all'"
                    :class="activeCategory === 'all' ? 'bg-accent-500 text-slate-900 dark:text-white shadow-[0_0_15px_rgba(249,115,22,0.4)] border-accent-400' : 'bg-slate-100 dark:bg-white/5 border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200 dark:hover:bg-white/10'"
                    class="px-6 py-2.5 rounded-full text-sm font-bold border transition-all duration-300 transform hover:scale-105 active:scale-95 backdrop-blur-sm"
                >
                    Semua
                </button>
                @foreach($categories as $category)
                    <button 
                        @click="activeCategory = '{{ $category->slug }}'"
                        :class="activeCategory === '{{ $category->slug }}' ? 'bg-accent-500 text-slate-900 dark:text-white shadow-[0_0_15px_rgba(249,115,22,0.4)] border-accent-400' : 'bg-slate-100 dark:bg-white/5 border-slate-200 dark:border-white/10 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200 dark:hover:bg-white/10'"
                        class="px-6 py-2.5 rounded-full text-sm font-bold border transition-all duration-300 transform hover:scale-105 active:scale-95 backdrop-blur-sm"
                    >
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galleries as $index => $gallery)
                    <div 
                        x-show="activeCategory === 'all' || activeCategory === '{{ $gallery->category->slug }}'"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform absolute w-full"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="group cursor-pointer {{ $index % 3 == 0 ? 'lg:col-span-2 lg:row-span-2' : '' }}"
                    >
                        <div class="relative overflow-hidden rounded-2xl bg-white dark:bg-slate-800 border border-white/5 h-64 {{ $index % 3 == 0 ? 'lg:h-[34rem]' : '' }} shadow-[0_0_15px_rgba(0,0,0,0.5)] hover:shadow-[0_0_30px_rgba(249,115,22,0.2)] transition-all duration-500">
                            <img 
                                src="{{ asset($gallery->image_url) }}" 
                                alt="{{ $gallery->title ?? 'Gallery image' }}"
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out"
                                loading="lazy"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-0 left-0 p-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 w-full">
                                    <div class="w-8 h-1 bg-accent-500 mb-3 rounded-full shadow-[0_0_8px_rgba(249,115,22,0.8)]"></div>
                                    <span class="inline-block px-3 py-1 mb-2 text-xs font-bold text-slate-900 dark:text-white bg-accent-500/90 rounded-full backdrop-blur-sm shadow-md">
                                        {{ $gallery->category->name }}
                                    </span>
                                    @if($gallery->title)
                                        <h3 class="text-xl font-bold text-slate-900 dark:text-white drop-shadow-md">{{ $gallery->title }}</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($galleries->isEmpty())
                <div class="text-center py-20 text-slate-500 dark:text-slate-400">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-600 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-lg">Koleksi galeri sedang dipersiapkan.</p>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('galleryFilter', () => ({
                activeCategory: 'all',
                animateFadeInUp(el) {
                    el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700', 'ease-out');
                    setTimeout(() => {
                        el.classList.remove('opacity-0', 'translate-y-8');
                        el.classList.add('opacity-100', 'translate-y-0');
                    }, 50);
                }
            }));
        });
    </script>
    @endpush
</x-layout>


