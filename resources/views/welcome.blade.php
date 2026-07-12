<x-layout>
    <x-home.hero />

    <x-home.catalog :products="$products" />

    <x-home.gallery :featuredGalleries="$featuredGalleries" />

    {{-- Layanan Custom & Booking Bengkel (Old Features) --}}
    <section class="py-24" style="background: oklch(0.12 0.018 55); border-top: 1px solid oklch(0.22 0.02 55);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-display font-700 text-3xl sm:text-4xl tracking-tight mb-4" style="color: oklch(0.93 0.012 75);">
                    Layanan Custom Bengkel
                </h2>
                <p class="font-sans text-lg max-w-2xl mx-auto" style="color: oklch(0.68 0.022 65);">
                    Punya ide desain jok sendiri atau sekadar ingin perbaikan? Datang langsung ke bengkel kami. Silakan hitung estimasi harga dan jadwalkan kedatangan Anda.
                </p>
            </div>
            
            <x-home.calculator :vehicleCategories="$vehicleCategories" :calendar="$calendar" />
        </div>
    </section>

    <x-home.testimonials />
</x-layout>
