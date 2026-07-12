<x-layout title="Lacak Kendaraan — Bengkel Jok Nusantara Magetan">
<div
    class="min-h-screen flex flex-col items-center justify-start pt-32 pb-20 px-4"
    style="background: oklch(0.12 0.018 55);"
    x-data="trackerApp()"
>
    {{-- Page Header --}}
    <div class="w-full max-w-2xl mb-12 text-center">
        <h1
            style="font-family: 'Space Grotesk', sans-serif; font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 700; letter-spacing: -0.03em; color: oklch(0.93 0.012 75); line-height: 1.1;"
        >Lacak Progres Kendaraan</h1>
        <p class="mt-4 font-sans" style="font-size: 1rem; color: oklch(0.68 0.022 65); line-height: 1.7;">
            Masukkan nomor plat kendaraan kamu untuk cek status pengerjaan secara real-time.
        </p>
    </div>

    {{-- Search Panel --}}
    <div class="w-full max-w-2xl mb-8">
        <form @submit.prevent="search">
            <div class="flex flex-col sm:flex-row gap-0">
                <div class="relative flex-1">
                    <input
                        type="text"
                        x-model="platNomor"
                        placeholder="CONTOH: B 8888 XZ"
                        required
                        maxlength="20"
                        class="w-full font-mono font-700 uppercase tracking-widest text-lg px-6 py-4 outline-none transition-colors duration-200"
                        style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.28 0.025 55); border-right: none; color: oklch(0.93 0.012 75);"
                        onfocus="this.style.borderColor='oklch(0.67 0.13 66)'"
                        onblur="this.style.borderColor='oklch(0.28 0.025 55)'"
                    />
                </div>
                <button
                    type="submit"
                    class="px-8 py-4 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-200 active:scale-95"
                    style="background: oklch(0.67 0.13 66); color: oklch(0.12 0.018 55); border: 1px solid oklch(0.67 0.13 66); min-width: 120px; white-space: nowrap;"
                    :disabled="loading"
                    onmouseover="this.style.background='oklch(0.75 0.11 67)'"
                    onmouseout="this.style.background='oklch(0.67 0.13 66)'"
                >
                    <span x-show="!loading">Cari</span>
                    <svg x-show="loading" x-cloak class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                    </svg>
                </button>
            </div>

            {{-- Error --}}
            <div
                x-show="error"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-cloak
                class="mt-4 flex items-center gap-3 px-5 py-4 font-sans text-sm"
                style="background: oklch(0.60 0.20 25 / 0.08); border: 1px solid oklch(0.60 0.20 25 / 0.30); color: oklch(0.75 0.18 25);"
            >
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span x-text="errorMsg"></span>
            </div>
        </form>
    </div>

    {{-- Skeleton Loader --}}
    <div
        x-show="loading && !result"
        x-cloak
        class="w-full max-w-2xl animate-pulse"
        style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.22 0.02 55);"
    >
        <div class="p-8">
            <div class="flex justify-between mb-8" style="border-bottom: 1px solid oklch(0.22 0.02 55); padding-bottom: 2rem;">
                <div>
                    <div class="h-3 w-20 mb-3" style="background: oklch(0.22 0.02 55);"></div>
                    <div class="h-7 w-40" style="background: oklch(0.22 0.02 55);"></div>
                </div>
                <div class="text-right">
                    <div class="h-3 w-24 mb-3 ml-auto" style="background: oklch(0.22 0.02 55);"></div>
                    <div class="h-5 w-28 ml-auto" style="background: oklch(0.22 0.02 55);"></div>
                </div>
            </div>
            <div class="flex flex-col items-center gap-6">
                <div class="h-3 w-32" style="background: oklch(0.22 0.02 55);"></div>
                <div class="w-full h-8" style="background: oklch(0.22 0.02 55);"></div>
                <div class="h-16 w-24 mx-auto" style="background: oklch(0.22 0.02 55);"></div>
            </div>
        </div>
    </div>

    {{-- Result Panel --}}
    <div
        x-show="result"
        x-cloak
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="w-full max-w-2xl"
        style="background: oklch(0.155 0.022 55); border: 1px solid oklch(0.28 0.025 55);"
    >
        {{-- Top: vehicle + schedule --}}
        <div class="grid grid-cols-2 gap-px" style="background: oklch(0.22 0.02 55); border-bottom: 1px solid oklch(0.22 0.02 55);">
            <div class="p-6" style="background: oklch(0.12 0.018 55);">
                <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: oklch(0.50 0.020 62);">Kendaraan</p>
                <p class="font-sans font-700 text-lg" style="color: oklch(0.93 0.012 75); letter-spacing: -0.01em;" x-text="result?.vehicle_type"></p>
            </div>
            <div class="p-6" style="background: oklch(0.12 0.018 55);">
                <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: oklch(0.50 0.020 62);">Estimasi Selesai</p>
                <p class="font-sans font-700 text-lg" style="color: oklch(0.93 0.012 75); letter-spacing: -0.01em;" x-text="result?.scheduled_at"></p>
            </div>
        </div>

        {{-- Progress section --}}
        <div class="p-8">
            <p class="font-sans text-xs uppercase tracking-[0.14em] mb-6 text-center" style="color: oklch(0.50 0.020 62);">Progres Pengerjaan</p>

            {{-- Progress bar --}}
            <div class="mb-8">
                <div class="flex items-end justify-between mb-3">
                    <span
                        style="font-family: 'Space Grotesk', sans-serif; font-size: 3.5rem; font-weight: 700; letter-spacing: -0.04em; line-height: 1; color: oklch(0.93 0.012 75);"
                        x-text="Math.round(animatedPercent) + '%'"
                    ></span>
                    <span
                        class="font-sans text-sm font-700 px-3 py-1.5 uppercase tracking-wider"
                        :style="{
                            background: result?.current_status === 'selesai'
                                ? 'oklch(0.62 0.14 155 / 0.12)'
                                : result?.current_status === 'proses'
                                    ? 'oklch(0.67 0.13 66 / 0.12)'
                                    : 'oklch(0.60 0.04 250 / 0.12)',
                            color: result?.current_status === 'selesai'
                                ? 'oklch(0.62 0.14 155)'
                                : result?.current_status === 'proses'
                                    ? 'oklch(0.67 0.13 66)'
                                    : 'oklch(0.72 0.025 68)',
                            border: '1px solid ' + (result?.current_status === 'selesai'
                                ? 'oklch(0.62 0.14 155 / 0.30)'
                                : result?.current_status === 'proses'
                                    ? 'oklch(0.67 0.13 66 / 0.30)'
                                    : 'oklch(0.38 0.03 60 / 0.30)')
                        }"
                        x-text="formatStatus(result?.current_status)"
                    ></span>
                </div>

                {{-- Track --}}
                <div class="relative h-2 w-full" style="background: oklch(0.22 0.02 55);">
                    <div
                        class="absolute top-0 left-0 h-full transition-all duration-1000"
                        :style="`width: ${animatedPercent}%; background: ${
                            result?.current_status === 'selesai'
                                ? 'oklch(0.62 0.14 155)'
                                : result?.current_status === 'proses'
                                    ? 'oklch(0.67 0.13 66)'
                                    : 'oklch(0.60 0.04 250)'
                        };`"
                    ></div>
                </div>
            </div>

            {{-- Step indicators --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="flex flex-col items-center gap-2">
                    <div
                        class="w-2 h-2"
                        :style="result?.progress_percent >= 10 ? 'background: oklch(0.67 0.13 66)' : 'background: oklch(0.28 0.025 55)'"
                    ></div>
                    <p class="font-sans text-xs text-center uppercase tracking-wider" style="color: oklch(0.50 0.020 62);">Antrian</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <div
                        class="w-2 h-2"
                        :style="result?.progress_percent >= 50 ? 'background: oklch(0.67 0.13 66)' : 'background: oklch(0.28 0.025 55)'"
                    ></div>
                    <p class="font-sans text-xs text-center uppercase tracking-wider" style="color: oklch(0.50 0.020 62);">Proses</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <div
                        class="w-2 h-2"
                        :style="result?.progress_percent >= 100 ? 'background: oklch(0.62 0.14 155)' : 'background: oklch(0.28 0.025 55)'"
                    ></div>
                    <p class="font-sans text-xs text-center uppercase tracking-wider" style="color: oklch(0.50 0.020 62);">Selesai</p>
                </div>
            </div>
        </div>

        {{-- Footer CTA --}}
        <div class="px-8 py-6" style="border-top: 1px solid oklch(0.22 0.02 55); background: oklch(0.12 0.018 55);">
            <a
                href="https://wa.me/6281234567890"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-2 font-sans font-700 text-sm uppercase tracking-wider transition-all duration-200"
                style="color: oklch(0.67 0.13 66);"
                onmouseover="this.style.color='oklch(0.75 0.11 67)'"
                onmouseout="this.style.color='oklch(0.67 0.13 66)'"
            >
                Ada pertanyaan? Chat WhatsApp kami
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
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
                    if (!response.ok) throw new Error(data.message || 'Kendaraan tidak ditemukan.');
                    await new Promise(resolve => setTimeout(resolve, 600));
                    this.result = data;
                    setTimeout(() => { this.animateValue(0, data.progress_percent, 1200); }, 100);
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
                    const easeOut = 1 - Math.pow(1 - progress, 3);
                    this.animatedPercent = easeOut * (end - start) + start;
                    if (progress < 1) window.requestAnimationFrame(step);
                    else this.animatedPercent = end;
                };
                window.requestAnimationFrame(step);
            },

            formatStatus(status) {
                const map = {
                    'antrian': 'Menunggu',
                    'proses':  'Dikerjakan',
                    'selesai': 'Selesai ✓'
                };
                return map[status] || status;
            }
        }));
    });
</script>
@endpush
</x-layout>


