<x-layout title="Lacak Kendaraan - Nusantara Jok">
    <div class="max-w-3xl mx-auto px-4 py-16 relative" x-data="trackerApp()">
        <div class="absolute -top-40 -left-40 w-[40rem] h-[40rem] bg-accent-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>
        <div class="text-center mb-16 relative z-10">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4 tracking-tight drop-shadow-md">Lacak Kendaraan Anda</h1>
            <p class="text-lg text-slate-500 dark:text-slate-400 font-light">Masukkan nomor plat kendaraan untuk melihat progres pengerjaan secara real-time.</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border border-slate-200 dark:border-white/10 p-8 rounded-3xl shadow-[0_0_30px_rgba(0,0,0,0.5)] mb-12 relative z-10">
            <form @submit.prevent="search" class="relative">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="relative flex-1">
                        <input
                            type="text"
                            x-model="platNomor"
                            placeholder="Contoh: B 8888 XZ"
                            required
                            maxlength="20"
                            class="w-full bg-slate-100/50 dark:bg-slate-900/50 border border-slate-300 dark:border-slate-600 rounded-xl px-6 py-4 text-slate-900 dark:text-white placeholder-slate-500 focus:ring-2 focus:ring-accent-500/50 focus:border-accent-500 transition-all touch-target text-xl uppercase tracking-widest font-mono shadow-inner"
                        >
                    </div>
                    <button
                        type="submit"
                        class="bg-accent-500 hover:bg-accent-400 text-slate-900 dark:text-white px-8 py-4 rounded-xl text-lg font-bold touch-target md:w-auto w-full flex items-center justify-center min-w-[140px] transition-all shadow-[0_0_15px_rgba(249,115,22,0.3)] hover:shadow-[0_0_25px_rgba(249,115,22,0.5)] active:scale-95 border border-accent-400/50"
                        :disabled="loading"
                    >
                        <span x-show="!loading">Lacak</span>
                        <svg x-show="loading" x-cloak class="animate-spin h-6 w-6 text-slate-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Error Message -->
                <div x-show="error" x-transition.opacity class="mt-4 p-4 bg-red-500/10 border border-red-500/50 rounded-xl text-red-400 flex items-center gap-3" x-cloak>
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span x-text="errorMsg"></span>
                </div>
            </form>
        </div>

        <!-- Skeleton Loader -->
        <div x-show="loading && !result" x-transition.opacity class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/10 rounded-3xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.5)] relative z-10" x-cloak>
            <div class="animate-pulse">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-10 border-b border-slate-300 dark:border-slate-700 pb-8">
                    <div class="w-full md:w-1/3">
                        <div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-24 mb-3"></div>
                        <div class="h-8 bg-slate-600 rounded w-48"></div>
                    </div>
                    <div class="w-full md:w-1/3 flex flex-col md:items-end">
                        <div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-32 mb-3"></div>
                        <div class="h-6 bg-slate-600 rounded w-24"></div>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="h-4 bg-slate-100 dark:bg-slate-700 rounded w-40 mb-6"></div>
                    <div class="w-64 h-64 rounded-full bg-slate-50 dark:bg-slate-900 border-4 border-slate-300 dark:border-slate-700 mb-8"></div>
                    <div class="h-12 bg-slate-600 rounded-full w-64"></div>
                </div>
            </div>
        </div>

        <!-- Result Card -->
        <div x-show="result" x-transition:enter="transition ease-elastic duration-700" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/10 rounded-3xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.5)] relative z-10" x-cloak>
            
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-10 border-b border-slate-300 dark:border-slate-700 pb-8">
                <div class="text-center md:text-left">
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wider mb-1 drop-shadow-sm">Kendaraan</p>
                    <h2 class="text-3xl font-display font-bold text-slate-900 dark:text-white drop-shadow-md" x-text="result?.vehicle_type"></h2>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wider mb-1 drop-shadow-sm">Estimasi Selesai</p>
                    <p class="text-xl text-slate-600 dark:text-slate-300 font-medium" x-text="result?.scheduled_at"></p>
                </div>
            </div>

            <div class="flex flex-col items-center">
                <p class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wider mb-6 drop-shadow-sm">Progres Pengerjaan</p>
                
                <!-- Liquid Gauge & Odometer Container -->
                <div class="relative w-64 h-64 rounded-full bg-slate-50 dark:bg-slate-900 border-4 border-slate-300 dark:border-slate-700 flex items-center justify-center overflow-hidden shadow-inner mb-8">
                    
                    <!-- Liquid Fill -->
                    <div class="absolute bottom-0 left-0 right-0 bg-accent-500/90 backdrop-blur-sm transition-all duration-1000 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
                         :style="`height: ${animatedPercent}%`">
                         <!-- SVG Wave for Liquid Effect -->
                         <div class="absolute top-0 left-0 right-0 -mt-2 opacity-30 text-slate-900 dark:text-white">
                             <svg class="animate-[wave_3s_linear_infinite] w-[200%] h-4" viewBox="0 0 100 10" preserveAspectRatio="none">
                                <path d="M0,0 Q25,10 50,0 T100,0 V10 H0 Z" fill="currentColor"></path>
                            </svg>
                         </div>
                    </div>

                    <!-- Odometer Text -->
                    <div class="relative z-10 flex items-baseline gap-1" :class="animatedPercent > 50 ? 'text-slate-900 dark:text-white drop-shadow-md' : 'text-slate-600 dark:text-slate-300 drop-shadow-sm'">
                        <span class="font-display font-bold text-7xl tracking-tighter" x-text="Math.round(animatedPercent)"></span>
                        <span class="text-3xl font-bold mb-2">%</span>
                    </div>
                </div>

                <!-- Status Text -->
                <div class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 shadow-[0_0_15px_rgba(0,0,0,0.3)]">
                    <div class="w-3 h-3 rounded-full animate-pulse" 
                        :class="{
                            'bg-red-500': result?.current_status === 'pending',
                            'bg-amber-500': result?.current_status === 'cutting' || result?.current_status === 'sewing',
                            'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]': result?.current_status === 'installation' || result?.current_status === 'qc' || result?.current_status === 'completed'
                        }">
                    </div>
                    <span class="text-lg font-bold text-slate-600 dark:text-slate-300 capitalize" x-text="formatStatus(result?.current_status)"></span>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('trackerApp', () => ({
                platNomor: '',
                loading: false,
                error: false,
                errorMsg: '',
                result: null,
                animatedPercent: 0,
                
                async search() {
                    if (!this.platNomor) return;
                    
                    this.loading = true;
                    this.error = false;
                    this.result = null;
                    this.animatedPercent = 0;
                    
                    try {
                        const response = await fetch('{{ route('tracker.search') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ plat_nomor: this.platNomor })
                        });
                        
                        const data = await response.json();
                        
                        if (!response.ok) {
                            throw new Error(data.message || 'Terjadi kesalahan.');
                        }
                        
                        // Fake delay for demo purposes so skeleton loader is visible
                        await new Promise(resolve => setTimeout(resolve, 800));
                        
                        this.result = data;
                        
                        // Animate the odometer and liquid gauge
                        setTimeout(() => {
                            this.animateValue(0, data.progress_percent, 1500);
                        }, 100);
                        
                    } catch (err) {
                        this.error = true;
                        this.errorMsg = err.message;
                    } finally {
                        this.loading = false;
                    }
                },
                
                animateValue(start, end, duration) {
                    let startTimestamp = null;
                    const step = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                        // Ease out cubic
                        const easeOut = 1 - Math.pow(1 - progress, 3);
                        this.animatedPercent = (easeOut * (end - start) + start);
                        
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            this.animatedPercent = end;
                        }
                    };
                    window.requestAnimationFrame(step);
                },
                
                formatStatus(status) {
                    const map = {
                        'pending': 'Menunggu Jadwal',
                        'cutting': 'Pemotongan Pola',
                        'sewing': 'Proses Penjahitan',
                        'installation': 'Pemasangan ke Kendaraan',
                        'qc': 'Quality Control',
                        'completed': 'Selesai & Siap Diambil'
                    };
                    return map[status] || status;
                }
            }));
        });
    </script>
    @endpush
</x-layout>
