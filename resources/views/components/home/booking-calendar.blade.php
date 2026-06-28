@props(['calendar' => []])

<div class="mt-12 bg-slate-50 dark:bg-slate-950 p-6 md:p-8 border-t lg:border-t-0 lg:border-l border-slate-200 dark:border-slate-800">
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h4 class="text-slate-900 dark:text-white font-black flex items-center gap-3 uppercase tracking-tight text-sm">
                <span class="w-8 h-8 rounded-none bg-slate-900 dark:bg-white text-white dark:text-slate-900 flex items-center justify-center text-sm font-bold">3</span>
                Cek Ketersediaan Jadwal
            </h4>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 font-medium">Kapasitas maksimal 2 mobil/hari. Hindari antrean panjang.</p>
        </div>
        
        <!-- Legend -->
        <div class="flex items-center gap-3 text-xs font-bold text-slate-600 dark:text-slate-400 bg-white dark:bg-slate-900 px-3 py-2 border border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-1.5"><div class="w-2.5 h-2.5 bg-green-500"></div>Tersedia</div>
            <div class="flex items-center gap-1.5"><div class="w-2.5 h-2.5 bg-orange-400"></div>Sisa 1</div>
            <div class="flex items-center gap-1.5"><div class="w-2.5 h-2.5 bg-red-500"></div>Penuh</div>
        </div>
    </div>

    <!-- Calendar Horizontal Scroll / Grid -->
    <div class="flex overflow-x-auto gap-3 pb-4 snap-x snap-mandatory hide-scrollbar -mx-6 px-6 md:mx-0 md:px-0" style="scroll-padding-left: 1.5rem;">
        @foreach($calendar as $day)
            @php
                $bgColor = 'bg-white dark:bg-slate-900';
                $borderColor = 'border-slate-200 dark:border-slate-700';
                $textColor = 'text-slate-900 dark:text-white';
                $indicatorColor = 'bg-slate-300';
                $statusText = '';
                $opacity = 'opacity-100';
                $isClickable = false;

                if ($day['status'] === 'closed') {
                    $bgColor = 'bg-slate-100 dark:bg-slate-800/50';
                    $textColor = 'text-slate-400 dark:text-slate-500';
                    $statusText = 'Tutup';
                    $indicatorColor = 'bg-slate-300 dark:bg-slate-600';
                    $opacity = 'opacity-60';
                } elseif ($day['status'] === 'full') {
                    $bgColor = 'bg-red-50 dark:bg-red-500/5';
                    $borderColor = 'border-red-200 dark:border-red-900/30';
                    $textColor = 'text-red-900 dark:text-red-400';
                    $statusText = 'Penuh';
                    $indicatorColor = 'bg-red-500';
                    $opacity = 'opacity-80';
                } elseif ($day['status'] === 'limited') {
                    $bgColor = 'bg-orange-50 dark:bg-orange-500/5';
                    $borderColor = 'border-orange-200 dark:border-orange-900/30';
                    $textColor = 'text-orange-900 dark:text-orange-400';
                    $statusText = 'Sisa 1 Slot';
                    $indicatorColor = 'bg-orange-400';
                    $isClickable = true;
                } else {
                    $borderColor = 'border-green-200 dark:border-green-900/30';
                    $statusText = 'Tersedia';
                    $indicatorColor = 'bg-green-500';
                    $isClickable = true;
                }
            @endphp

            <button 
                type="button"
                @if($isClickable)
                    @click="customerDate = '{{ $day['date'] }}'; dateFormatted = '{{ $day['dayName'] }}'; selectedDate = '{{ $day['date'] }}'"
                @else
                    disabled
                @endif
                class="min-w-[120px] w-[120px] flex-shrink-0 snap-start flex flex-col p-3 border-2 {{ $borderColor }} {{ $bgColor }} {{ $opacity }} transition-all duration-200 text-left"
                :class="selectedDate === '{{ $day['date'] }}' ? 'ring-2 ring-offset-2 ring-accent-500 dark:ring-offset-slate-950 border-accent-500' : ''"
            >
                <div class="flex items-center justify-between w-full mb-3">
                    <div class="text-xs font-bold {{ $textColor }} uppercase tracking-wider">
                        {{ explode(',', $day['dayName'])[0] }}
                    </div>
                    <div class="w-2.5 h-2.5 {{ $indicatorColor }}"></div>
                </div>
                
                <div class="text-2xl font-black font-display {{ $textColor }} leading-none mb-1">
                    {{ Carbon\Carbon::parse($day['date'])->format('d') }}
                </div>
                
                <div class="text-[0.65rem] font-bold uppercase tracking-widest {{ $textColor }} mt-auto pt-2 border-t {{ $borderColor }}">
                    {{ $statusText }}
                </div>
            </button>
        @endforeach
    </div>
    
    <!-- Info Section & Selection Feedback -->
    <div class="mt-4 flex items-center justify-between text-sm bg-accent-50 dark:bg-accent-500/10 p-4 border border-accent-100 dark:border-accent-500/20" x-show="selectedDate">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-accent-500 flex items-center justify-center text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <p class="text-accent-600 dark:text-accent-400 font-bold text-xs uppercase tracking-wider">TANGGAL DIPILIH</p>
                <p class="text-slate-900 dark:text-white font-black" x-text="dateFormatted"></p>
            </div>
        </div>
        <button type="button" @click="selectedDate = null; customerDate = ''; dateFormatted = ''" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
</div>
