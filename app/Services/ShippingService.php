<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ShippingRate;

class ShippingService
{
    /**
     * Get shipping rate by province name
     */
    public function getRate(string $province): ?ShippingRate
    {
        return ShippingRate::active()->byProvince($province)->first();
    }

    /**
     * Get fallback whatsapp message
     */
    public function getFallbackMessage(string $province): string
    {
        $adminWa = env('WA_BUSINESS_NUMBER', '6281259645665');
        $text = urlencode("Halo min, saya mau tanya ongkir untuk Jok Racing PNP ke provinsi {$province}. Kira-kira berapa ya?");
        return "https://wa.me/{$adminWa}?text={$text}";
    }
}
