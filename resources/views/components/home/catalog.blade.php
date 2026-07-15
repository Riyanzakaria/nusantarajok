@props(['products'])

<section id="katalog" class="py-24 bg-[var(--color-bg)]">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-display font-700 tracking-tight text-[var(--color-heading)] mb-4">
                Katalog <span class="text-[var(--color-primary)]">Jok Racing PNP</span>
            </h2>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Pilih model jok racing favorit Anda. Kami rakit secara custom sesuai dudukan baut mobil Anda sehingga bisa langsung dipasang tanpa modifikasi tambahan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($products as $product)
            <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-3xl overflow-hidden hover:border-[var(--color-primary)]/50 transition-colors duration-300 flex flex-col">
                <div class="aspect-[4/3] bg-gray-900 relative overflow-hidden group">
                    @if($product->primary_image)
                        <img src="{{ Storage::disk('public')->url($product->primary_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-500 font-mono text-sm">
                            [FOTO {{ strtoupper($product->name) }}]
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="text-2xl font-bold text-white">{{ $product->name }}</h3>
                        <p class="text-[var(--color-primary)] font-bold text-lg mt-1">{{ $product->base_price_formatted }} <span class="text-sm font-normal text-gray-300">/ set dasar</span></p>
                    </div>
                </div>
                
                <div class="p-6 sm:p-8 flex-1 flex flex-col">
                    <p class="text-gray-400 leading-relaxed mb-8 flex-1">
                        {{ $product->description }}
                    </p>
                    
                    <a href="{{ route('checkout.create', ['product' => $product->slug]) }}" class="w-full bg-white hover:bg-gray-100 text-black font-bold py-4 rounded-xl transition text-center flex items-center justify-center gap-2 group">
                        Beli & Sesuaikan Mobil
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
