<?php

namespace App\Services;

use App\Models\SettingsPricelist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * PricelistService
 *
 * Provides cached access to the pricing matrix.
 * Uses Cache::rememberForever() — invalidated by PricelistObserver.
 *
 * Blueprint §3A: "Admin dapat mengubah harga material/jasa di dashboard tanpa koding."
 */
class PricelistService
{
    /**
     * Get all pricelist items, grouped by category.
     * Cached indefinitely — busted only when admin modifies data.
     *
     * @return Collection<int, SettingsPricelist>
     */
    public function getAll(): Collection
    {
        return Cache::rememberForever('settings_pricelist', function () {
            return SettingsPricelist::orderBy('category')
                ->orderBy('item_name')
                ->get();
        });
    }

    /**
     * Get items grouped by category for the calculator UI.
     *
     * @return \Illuminate\Support\Collection<string, Collection>
     */
    public function getGroupedByCategory(): \Illuminate\Support\Collection
    {
        return $this->getAll()->groupBy('category');
    }

    /**
     * Find a specific pricelist item by ID (from cache, not DB).
     */
    public function findById(int $id): ?SettingsPricelist
    {
        return $this->getAll()->firstWhere('id', $id);
    }
}
