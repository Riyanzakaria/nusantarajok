<?php

namespace App\Observers;

use App\Models\SettingsPricelist;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * PricelistObserver
 *
 * Otomatis menghancurkan cache harga setiap kali data pricelist berubah.
 * Terhubung ke model SettingsPricelist via #[ObservedBy] attribute.
 *
 * Flow:
 * 1. Halaman kalkulator memuat harga dari Cache::rememberForever('settings_pricelist')
 * 2. Admin mengubah harga di dashboard → observer memicu Cache::forget()
 * 3. Request berikutnya membangun cache baru dari database
 *
 * Efek: 0 database queries pada refresh berulang. 1 query hanya setelah update.
 */
class PricelistObserver
{
    /**
     * Handle the SettingsPricelist "saved" event (covers both create and update).
     */
    public function saved(SettingsPricelist $pricelist): void
    {
        $this->bustCache('saved', $pricelist);
    }

    /**
     * Handle the SettingsPricelist "deleted" event.
     */
    public function deleted(SettingsPricelist $pricelist): void
    {
        $this->bustCache('deleted', $pricelist);
    }

    /**
     * Invalidate the pricelist cache and log the event.
     */
    private function bustCache(string $event, SettingsPricelist $pricelist): void
    {
        Cache::forget('settings_pricelist');

        Log::info("[PricelistObserver] Cache invalidated on {$event}", [
            'item_id'   => $pricelist->id,
            'item_name' => $pricelist->item_name,
        ]);
    }
}
