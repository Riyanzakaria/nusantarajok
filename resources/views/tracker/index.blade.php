<x-layout title="Lacak Pesanan — Bengkel Jok Nusantara Magetan">
<div
    class="min-h-screen flex flex-col items-center justify-start pt-32 pb-20 px-4"
    style="background: oklch(0.12 0.018 55);"
    x-data="trackerApp()"
>
    {{-- Page Header --}}
    <div class="w-full max-w-2xl mb-12 text-center">
        <h1
            style="font-family: 'Space Grotesk', sans-serif; font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 700; letter-spacing: -0.03em; color: oklch(0.93 0.012 75); line-height: 1.1;"
        >Lacak Status Pesanan</h1>
        <p class="mt-4 font-sans" style="font-size: 1rem; color: oklch(0.68 0.022 65); line-height: 1.7;">
            Masukkan Nomor Invoice, Plat Nomor, atau No. WhatsApp Anda untuk mengecek status pesanan.
        </p>
    </div>

    {{-- Search Panel --}}
    <div class="w-full max-w-2xl mb-8">
        <form @submit.prevent="search">
            <div class="flex flex-col sm:flex-row gap-0">
                <div class="relative flex-1">
                    <input
                        type="text"
                        x-model="query"
                        placeholder="BJN-2026... / AE 1234 XX / 0812..."
                        required
                        maxlength="50"
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
                    <span x-show="!loading">Lacak</span>
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
        {{-- Top: Product + Date --}}
        <div class="grid grid-cols-2 gap-px" style="background: oklch(0.22 0.02 55); border-bottom: 1px solid oklch(0.22 0.02 55);">
            <div class="p-6" style="background: oklch(0.12 0.018 55);">
                <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: oklch(0.50 0.020 62);">Produk</p>
                <p class="font-sans font-700 text-lg" style="color: oklch(0.93 0.012 75); letter-spacing: -0.01em;" x-text="result?.product_name"></p>
            </div>
            <div class="p-6" style="background: oklch(0.12 0.018 55);">
                <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: oklch(0.50 0.020 62);">Tanggal Order</p>
                <p class="font-sans font-700 text-lg" style="color: oklch(0.93 0.012 75); letter-spacing: -0.01em;" x-text="result?.created_at"></p>
            </div>
        </div>

        {{-- Main Tracking Details --}}
        <div class="p-8">

            {{-- Payment Status Box --}}
            <div class="flex items-center justify-between mb-8 p-4 rounded-xl" style="background: oklch(0.22 0.02 55 / 0.3); border: 1px solid oklch(0.22 0.02 55);">
                <p class="font-sans font-700 text-sm uppercase tracking-wider" style="color: oklch(0.68 0.022 65);">Status Pembayaran</p>
                <span
                    class="font-sans text-xs font-700 px-3 py-1.5 uppercase tracking-wider rounded-full"
                    :style="{
                        background: result?.payment_status === 'paid' ? 'oklch(0.72 0.17 142 / 0.15)' : 'oklch(0.72 0.14 80 / 0.15)',
                        color: result?.payment_status === 'paid' ? 'oklch(0.85 0.12 142)' : 'oklch(0.85 0.10 80)'
                    }"
                    x-text="result?.payment_status_label"
                ></span>
            </div>

            <p class="font-sans text-xs uppercase tracking-[0.14em] mb-6 text-center" style="color: oklch(0.50 0.020 62);">Progres Produksi & Pengiriman</p>

            {{-- Progress bar --}}
            <div class="mb-8">
                <div class="flex justify-between items-center mb-3">
                    <span
                        style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; letter-spacing: -0.04em; line-height: 1; color: oklch(0.93 0.012 75);"
                        x-text="result?.production_status_label"
                    ></span>
                </div>

                {{-- Track --}}
                <div class="relative h-2 w-full mt-4" style="background: oklch(0.22 0.02 55);">
                    <div
                        class="absolute top-0 left-0 h-full transition-all duration-1000"
                        :style="`width: ${(result?.production_step / 4) * 100}%; background: ${
                            result?.production_step >= 3 ? 'oklch(0.67 0.13 66)' : 'oklch(0.72 0.14 80)'
                        };`"
                    ></div>
                </div>
            </div>

            {{-- Step indicators --}}
            <div class="grid grid-cols-4 gap-2">
                <template x-for="(label, idx) in (result?.type === 'offline' ? ['Antrian', 'Dikerjakan', 'Pemasangan', 'Selesai'] : ['Menunggu', 'Diproduksi', 'Dikirim', 'Diterima'])">
                    <div class="flex flex-col items-center gap-2">
                        <div
                            class="w-3 h-3 rounded-full"
                            :style="(result?.production_step >= idx + 1) ? 'background: oklch(0.67 0.13 66)' : 'background: oklch(0.28 0.025 55)'"
                        ></div>
                        <p class="font-sans text-[10px] text-center uppercase tracking-wider" style="color: oklch(0.50 0.020 62);" x-text="label"></p>
                    </div>
                </template>
            </div>

            {{-- Shipping Detail if available --}}
            <template x-if="result?.shipping_awb">
                <div class="mt-8 p-6 text-center" style="background: oklch(0.12 0.018 55); border: 1px dashed oklch(0.28 0.025 55);">
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: oklch(0.50 0.020 62);">Resi Pengiriman (<span x-text="result?.courier_name"></span>)</p>
                    <p class="font-mono font-700 text-2xl" style="color: oklch(0.67 0.13 66);" x-text="result?.shipping_awb"></p>
                </div>
            </template>
        </div>

        {{-- Footer CTA --}}
        <div class="px-8 py-6" style="border-top: 1px solid oklch(0.22 0.02 55); background: oklch(0.12 0.018 55);">
            <a
                href="https://wa.me/{{ env('WA_BUSINESS_NUMBER', '6281234567890') }}"
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
            query: '',
            loading: false,
            error: false,
            errorMsg: '',
            result: null,

            async search() {
                if (!this.query) return;
                this.loading = true;
                this.error = false;
                this.result = null;
                try {
                    const response = await fetch('{{ route('tracker.search') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ query: this.query })
                    });
                    const data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'Pesanan tidak ditemukan.');
                    await new Promise(resolve => setTimeout(resolve, 600)); // smooth UX delay
                    this.result = data;
                } catch (err) {
                    this.error = true;
                    this.errorMsg = err.message;
                } finally {
                    this.loading = false;
                }
            }
        }));
    });
</script>
@endpush
</x-layout>
