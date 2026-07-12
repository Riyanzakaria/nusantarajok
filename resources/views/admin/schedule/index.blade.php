{{-- Admin shared design tokens via inline CSS variables --}}
@php
    $bg       = 'oklch(0.12 0.018 55)';
    $bgCard   = 'oklch(0.155 0.022 55)';
    $border   = 'oklch(0.22 0.02 55)';
    $inkPri   = 'oklch(0.93 0.012 75)';
    $inkSec   = 'oklch(0.68 0.022 65)';
    $inkMute  = 'oklch(0.50 0.020 62)';
    $gold     = 'oklch(0.67 0.13 66)';
    $goldHov  = 'oklch(0.75 0.11 67)';
@endphp
<x-layout title="Jadwal Pengerjaan — Admin BJN">
    <div class="min-h-screen" style="background: {{ $bg }}; padding: 8rem 0 8rem;">
        <div class="max-w-6xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-10 gap-4"
                 style="border-bottom: 1px solid {{ $border }}; padding-bottom: 1.5rem;">
                <div>
                    <p class="font-sans text-xs uppercase tracking-[0.14em] mb-2" style="color: {{ $inkMute }};">Admin</p>
                    <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 700; letter-spacing: -0.03em; color: {{ $inkPri }}; line-height: 1.1;">Jadwal Slot</h1>
                </div>
                <a href="{{ route('dashboard.index') }}"
                   class="inline-flex items-center gap-2 font-sans text-sm font-700 uppercase tracking-wider transition-colors duration-200"
                   style="color: {{ $inkMute }};"
                   onmouseover="this.style.color='{{ $goldHov }}'"
                   onmouseout="this.style.color='{{ $inkMute }}'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
            </div>

            <div class="mb-8" style="color: {{ $inkSec }}; max-width: 65ch;">
                <p class="font-sans text-sm leading-relaxed">
                    Menampilkan kalender jadwal untuk 30 hari ke depan. Hari Minggu secara otomatis ditutup (Libur). Kuota harian diset maksimal {{ \App\Services\ScheduleService::MAX_DAILY_CAPACITY }} kendaraan per hari.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
                @foreach($calendar as $day)
                    @php
                        if ($day['status'] === 'closed') {
                            $boxBg = 'oklch(0.12 0.018 55)';
                            $boxBorder = 'oklch(0.28 0.025 55)';
                            $textPri = 'oklch(0.38 0.03 60)';
                            $textSec = 'oklch(0.38 0.03 60)';
                            $label = 'LIBUR';
                            $labelColor = 'oklch(0.50 0.020 62)';
                        } elseif ($day['status'] === 'full') {
                            $boxBg = 'oklch(0.60 0.20 25 / 0.05)';
                            $boxBorder = 'oklch(0.60 0.20 25 / 0.4)';
                            $textPri = 'oklch(0.70 0.22 25)';
                            $textSec = 'oklch(0.70 0.22 25)';
                            $label = 'PENUH';
                            $labelColor = 'oklch(0.70 0.22 25)';
                        } elseif ($day['status'] === 'limited') {
                            $boxBg = 'oklch(0.72 0.14 80 / 0.05)';
                            $boxBorder = 'oklch(0.72 0.14 80 / 0.4)';
                            $textPri = 'oklch(0.93 0.012 75)';
                            $textSec = 'oklch(0.72 0.14 80)';
                            $label = 'SISA ' . (\App\Services\ScheduleService::MAX_DAILY_CAPACITY - $day['count']);
                            $labelColor = 'oklch(0.72 0.14 80)';
                        } else {
                            $boxBg = $bgCard;
                            $boxBorder = $border;
                            $textPri = $inkPri;
                            $textSec = $inkSec;
                            $label = 'KOSONG';
                            $labelColor = 'oklch(0.62 0.14 155)';
                        }

                        if ($day['isPast']) {
                            $boxBg = 'oklch(0.12 0.018 55)';
                            $boxBorder = 'oklch(0.22 0.02 55)';
                            $textPri = 'oklch(0.38 0.03 60)';
                            $textSec = 'oklch(0.38 0.03 60)';
                            $labelColor = 'oklch(0.38 0.03 60)';
                        }
                    @endphp

                    <div class="flex flex-col p-4" style="background: {{ $boxBg }}; border: 1px solid {{ $boxBorder }}; {{ $day['isPast'] ? 'opacity: 0.6;' : '' }}">
                        <p class="font-sans text-xs uppercase font-700 tracking-widest mb-1" style="color: {{ $textSec }};">
                            {{ explode(',', $day['dayName'])[0] }}
                        </p>
                        <p class="font-display font-700 mb-4" style="font-size: 1.5rem; color: {{ $textPri }};">
                            {{ date('d', strtotime($day['date'])) }}
                        </p>

                        <div class="mt-auto pt-4" style="border-top: 1px solid {{ $boxBorder }};">
                            <p class="font-sans text-xs font-700 uppercase tracking-widest" style="color: {{ $labelColor }};">
                                {{ $label }}
                            </p>
                            @if($day['status'] !== 'closed' && $day['count'] > 0)
                                <p class="font-sans text-[10px] uppercase tracking-widest mt-1" style="color: {{ $textPri }};">
                                    {{ $day['count'] }} Order
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-layout>
