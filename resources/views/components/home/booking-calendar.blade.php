@props(['calendar' => []])

<div class="mt-10"
     style="border-top: 1px solid oklch(0.22 0.02 55); padding-top: 2rem;">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <span class="font-display font-700 shrink-0" style="font-size: 1.25rem; color: oklch(0.67 0.13 66);">03</span>
            <div>
                <h3 class="font-sans font-700 text-sm uppercase tracking-wider" style="color: oklch(0.93 0.012 75);">Cek Ketersediaan Jadwal</h3>
                <p class="font-sans text-xs mt-0.5" style="color: oklch(0.50 0.020 62);">Maks. 2 mobil/hari. Hindari antrian panjang.</p>
            </div>
        </div>

        {{-- Legend --}}
        <div class="flex items-center gap-4 text-xs font-sans font-700" style="color: oklch(0.50 0.020 62);">
            <span class="flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 shrink-0" style="background: oklch(0.62 0.14 155);"></span>Tersedia
            </span>
            <span class="flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 shrink-0" style="background: oklch(0.72 0.14 80);"></span>Sisa 1
            </span>
            <span class="flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 shrink-0" style="background: oklch(0.60 0.20 25);"></span>Penuh
            </span>
        </div>
    </div>

    {{-- Calendar — horizontal scroll on mobile --}}
    <div class="flex overflow-x-auto gap-2.5 pb-3 snap-x snap-mandatory -mx-8 px-8"
         style="scroll-padding-left: 2rem; scrollbar-width: none; -ms-overflow-style: none;">

        @foreach($calendar as $day)
            @php
                if ($day['status'] === 'closed') {
                    $cardBg     = 'oklch(0.10 0.015 55)';
                    $cardBorder = 'oklch(0.22 0.02 55)';
                    $textPri    = 'oklch(0.35 0.015 60)';
                    $dotBg      = 'oklch(0.28 0.025 55)';
                    $statusTxt  = 'Tutup';
                    $isDisabled = true;
                } elseif ($day['status'] === 'full') {
                    $cardBg     = 'oklch(0.60 0.20 25 / 0.04)';
                    $cardBorder = 'oklch(0.60 0.20 25 / 0.35)';
                    $textPri    = 'oklch(0.70 0.22 25)';
                    $dotBg      = 'oklch(0.60 0.20 25)';
                    $statusTxt  = 'Penuh';
                    $isDisabled = true;
                } elseif ($day['status'] === 'limited') {
                    $cardBg     = 'oklch(0.72 0.14 80 / 0.05)';
                    $cardBorder = 'oklch(0.72 0.14 80 / 0.4)';
                    $textPri    = 'oklch(0.72 0.14 80)';
                    $dotBg      = 'oklch(0.72 0.14 80)';
                    $statusTxt  = 'Sisa 1';
                    $isDisabled = false;
                } else {
                    $cardBg     = 'oklch(0.62 0.14 155 / 0.05)';
                    $cardBorder = 'oklch(0.62 0.14 155 / 0.35)';
                    $textPri    = 'oklch(0.62 0.14 155)';
                    $dotBg      = 'oklch(0.62 0.14 155)';
                    $statusTxt  = 'Tersedia';
                    $isDisabled = false;
                }
                $opacity = ($day['isPast'] || $isDisabled) ? '0.55' : '1.0';
            @endphp

            <button
                type="button"
                @if(!$isDisabled && !$day['isPast'])
                    @click="customerDate = '{{ $day['date'] }}'; dateFormatted = '{{ $day['dayName'] }}'; selectedDate = '{{ $day['date'] }}'"
                @else
                    disabled
                @endif
                class="min-w-[100px] w-[100px] shrink-0 snap-start flex flex-col p-3 text-left transition-all duration-200"
                style="background: {{ $cardBg }}; border: 1px solid {{ $cardBorder }}; opacity: {{ $opacity }};"
                :style="selectedDate === '{{ $day['date'] }}' ? 'border-color: oklch(0.67 0.13 66); box-shadow: 0 0 0 1px oklch(0.67 0.13 66 / 0.3);' : ''"
                :class="selectedDate === '{{ $day['date'] }}' ? '' : ''"
            >
                <div class="flex items-center justify-between w-full mb-2">
                    <span class="font-sans text-[0.65rem] font-700 uppercase tracking-wider" style="color: {{ $textPri }};">
                        {{ explode(',', $day['dayName'])[0] }}
                    </span>
                    <span class="w-2 h-2 shrink-0" style="background: {{ $dotBg }};"></span>
                </div>
                <span class="font-display font-700 leading-none mb-3" style="font-size: 1.75rem; color: {{ $textPri }};">
                    {{ Carbon\Carbon::parse($day['date'])->format('d') }}
                </span>
                <span class="font-sans text-[0.6rem] font-700 uppercase tracking-widest mt-auto pt-2"
                      style="border-top: 1px solid {{ $cardBorder }}; color: {{ $textPri }};">
                    {{ $statusTxt }}
                </span>
            </button>
        @endforeach
    </div>

    {{-- Selected date feedback --}}
    <div class="mt-4 flex items-center justify-between p-4 transition-all duration-200"
         style="background: oklch(0.67 0.13 66 / 0.07); border: 1px solid oklch(0.67 0.13 66 / 0.25);"
         x-show="selectedDate"
         x-cloak>
        <div class="flex items-center gap-3">
            <div class="w-7 h-7 flex items-center justify-center shrink-0" style="background: oklch(0.67 0.13 66);">
                <svg class="w-3.5 h-3.5" fill="none" stroke="oklch(0.12 0.018 55)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <p class="font-sans text-[0.65rem] font-700 uppercase tracking-widest" style="color: oklch(0.67 0.13 66);">Tanggal Dipilih</p>
                <p class="font-sans font-700 text-sm" style="color: oklch(0.93 0.012 75);" x-text="dateFormatted"></p>
            </div>
        </div>
        <button type="button"
                @click="selectedDate = null; customerDate = ''; dateFormatted = ''"
                class="w-7 h-7 flex items-center justify-center transition-colors duration-200"
                style="color: oklch(0.50 0.020 62); border: 1px solid oklch(0.28 0.025 55);"
                onmouseover="this.style.color='oklch(0.93 0.012 75)'; this.style.borderColor='oklch(0.38 0.03 60)'"
                onmouseout="this.style.color='oklch(0.50 0.020 62)'; this.style.borderColor='oklch(0.28 0.025 55)'">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
</div>
