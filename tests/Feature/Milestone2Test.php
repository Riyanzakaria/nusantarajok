<?php

namespace Tests\Feature;

use App\Exceptions\CapacityExceededException;
use App\Models\Lead;
use App\Models\SettingsPricelist;
use App\Models\WorkOrder;
use App\Services\PricelistService;
use App\Services\StitchFlowManager;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * Milestone 2 Checkpoint Tests
 *
 * Task 2.1: Schema & Index verification
 * Task 2.2: Plate normalization on model events
 * Task 2.3: StitchFlowManager capacity + pessimistic locking
 * Task 2.4: Pricelist caching + observer invalidation
 */
class Milestone2Test extends TestCase
{
    use RefreshDatabase;

    // ── Task 2.1: Schema Verification ────────────────────────────

    public function test_settings_pricelists_table_exists_with_correct_columns(): void
    {
        $this->assertTrue(
            \Schema::hasTable('settings_pricelists'),
            'Table settings_pricelists must exist'
        );

        $this->assertTrue(\Schema::hasColumns('settings_pricelists', [
            'id', 'category', 'item_name', 'base_price_per_meter', 'service_fee', 'created_at', 'updated_at',
        ]));
    }

    public function test_leads_table_exists_with_correct_columns(): void
    {
        $this->assertTrue(\Schema::hasTable('leads'));

        $this->assertTrue(\Schema::hasColumns('leads', [
            'id', 'customer_name', 'whatsapp_number', 'status', 'created_at', 'updated_at',
        ]));
    }

    public function test_work_orders_table_has_indexes(): void
    {
        $this->assertTrue(\Schema::hasTable('work_orders'));

        // Verify index existence via raw query
        $indexes = collect(DB::select("SHOW INDEX FROM work_orders"))
            ->pluck('Key_name')
            ->unique()
            ->toArray();

        $this->assertContains('idx_normalized_plat', $indexes, 'B-Tree index on normalized_plat must exist');
        $this->assertContains('idx_scheduled_at', $indexes, 'B-Tree index on scheduled_at must exist');
        $this->assertContains('idx_schedule_status', $indexes, 'Composite index on schedule+status must exist');
    }

    // ── Task 2.2: Plate Normalization on Model Events ────────────

    public function test_work_order_auto_normalizes_plate_on_create(): void
    {
        $lead = Lead::factory()->create();

        $order = WorkOrder::create([
            'lead_id'             => $lead->id,
            'raw_plat'            => 'b  8888  xZ',
            'vehicle_type'        => 'Avanza',
            'work_units_required' => 1,
            'scheduled_at'        => now()->toDateString(),
        ]);

        $this->assertSame('B8888XZ', $order->normalized_plat);
    }

    public function test_work_order_re_normalizes_on_update(): void
    {
        $order = WorkOrder::factory()->create(['raw_plat' => 'B 1234 XY']);

        $this->assertSame('B1234XY', $order->fresh()->normalized_plat);

        $order->update(['raw_plat' => 'ae-5678-cd']);

        $this->assertSame('AE5678CD', $order->fresh()->normalized_plat);
    }

    public function test_five_dirty_plate_formats_all_produce_identical_normalized_plat(): void
    {
        $lead = Lead::factory()->create();
        $formats = ['b  8888  xZ', 'B-8888-XZ', 'B 8888 XZ', 'b8888xz', '  B.8888.XZ  '];

        $results = [];
        foreach ($formats as $raw) {
            $order = WorkOrder::create([
                'lead_id'             => $lead->id,
                'raw_plat'            => $raw,
                'vehicle_type'        => 'Test',
                'work_units_required' => 1,
                'scheduled_at'        => now()->addDays(rand(1, 30))->toDateString(),
            ]);
            $results[] = $order->normalized_plat;
        }

        $this->assertCount(1, array_unique($results), 'All 5 variations must produce identical normalized_plat');
        $this->assertSame('B8888XZ', $results[0]);
    }

    // ── Task 2.3: StitchFlowManager — Capacity & Locking ────────

    public function test_schedule_order_within_capacity(): void
    {
        $manager = app(StitchFlowManager::class);
        $lead = Lead::factory()->create();
        $date = Carbon::tomorrow();

        $order = $manager->checkAndSchedule([
            'lead_id'             => $lead->id,
            'raw_plat'            => 'B 1234 XY',
            'vehicle_type'        => 'Avanza',
            'work_units_required' => 2,
            'scheduled_at'        => $date->toDateString(),
        ]);

        $this->assertInstanceOf(WorkOrder::class, $order);
        $this->assertSame(2, $order->work_units_required);
        $this->assertSame('B1234XY', $order->normalized_plat);
    }

    public function test_reject_order_when_capacity_exceeded(): void
    {
        $manager = app(StitchFlowManager::class);
        $lead = Lead::factory()->create();
        $date = Carbon::tomorrow();

        // Fill up capacity (MAX = 5 units)
        $manager->checkAndSchedule([
            'lead_id' => $lead->id, 'raw_plat' => 'A 1', 'vehicle_type' => 'Bus',
            'work_units_required' => 4, 'scheduled_at' => $date->toDateString(),
        ]);

        // This should fail: only 1 unit left, requesting 2
        $this->expectException(CapacityExceededException::class);

        $manager->checkAndSchedule([
            'lead_id' => $lead->id, 'raw_plat' => 'A 2', 'vehicle_type' => 'Bus',
            'work_units_required' => 2, 'scheduled_at' => $date->toDateString(),
        ]);
    }

    public function test_capacity_exception_contains_earliest_available_date(): void
    {
        $manager = app(StitchFlowManager::class);
        $lead = Lead::factory()->create();
        $date = Carbon::tomorrow();

        // Fill tomorrow completely
        $manager->checkAndSchedule([
            'lead_id' => $lead->id, 'raw_plat' => 'FULL 1', 'vehicle_type' => 'Bus Besar',
            'work_units_required' => 5, 'scheduled_at' => $date->toDateString(),
        ]);

        try {
            $manager->checkAndSchedule([
                'lead_id' => $lead->id, 'raw_plat' => 'OVERFLOW', 'vehicle_type' => 'Avanza',
                'work_units_required' => 1, 'scheduled_at' => $date->toDateString(),
            ]);
            $this->fail('Should have thrown CapacityExceededException');
        } catch (CapacityExceededException $e) {
            $this->assertTrue(
                $e->earliestAvailableDate->isAfter($date),
                'Earliest available date must be after the full date'
            );
        }
    }

    public function test_remaining_capacity_calculation(): void
    {
        $manager = app(StitchFlowManager::class);
        $lead = Lead::factory()->create();
        $date = Carbon::tomorrow();

        $this->assertSame(StitchFlowManager::MAX_DAILY_UNITS, $manager->getRemainingCapacity($date));

        $manager->checkAndSchedule([
            'lead_id' => $lead->id, 'raw_plat' => 'CAP 1', 'vehicle_type' => 'Innova',
            'work_units_required' => 3, 'scheduled_at' => $date->toDateString(),
        ]);

        $this->assertSame(StitchFlowManager::MAX_DAILY_UNITS - 3, $manager->getRemainingCapacity($date));
    }

    // ── Task 2.4: Pricelist Caching & Invalidation ──────────────

    public function test_pricelist_service_caches_data(): void
    {
        SettingsPricelist::factory()->count(3)->create();

        $service = app(PricelistService::class);

        // First call: hits DB, populates cache
        $result1 = $service->getAll();
        $this->assertCount(3, $result1);

        // Verify cache key exists
        $this->assertTrue(Cache::has('settings_pricelist'), 'Cache key must exist after first getAll()');

        // Second call: should come from cache (no DB query)
        $queryCount = 0;
        DB::listen(function () use (&$queryCount) {
            $queryCount++;
        });

        $result2 = $service->getAll();
        $this->assertCount(3, $result2);
        $this->assertSame(0, $queryCount, 'Second call must not hit the database (0 queries)');
    }

    public function test_pricelist_cache_invalidated_on_save(): void
    {
        $item = SettingsPricelist::factory()->create();

        $service = app(PricelistService::class);
        $service->getAll(); // Warm cache

        $this->assertTrue(Cache::has('settings_pricelist'));

        // Update triggers PricelistObserver -> Cache::forget()
        $item->update(['base_price_per_meter' => 999999.99]);

        $this->assertFalse(Cache::has('settings_pricelist'), 'Cache must be busted after update');
    }

    public function test_pricelist_cache_invalidated_on_delete(): void
    {
        $item = SettingsPricelist::factory()->create();

        $service = app(PricelistService::class);
        $service->getAll(); // Warm cache

        $this->assertTrue(Cache::has('settings_pricelist'));

        $item->delete();

        $this->assertFalse(Cache::has('settings_pricelist'), 'Cache must be busted after delete');
    }

    public function test_zero_queries_on_repeated_pricelist_loads(): void
    {
        SettingsPricelist::factory()->count(5)->create();

        $service = app(PricelistService::class);

        // First call: populates cache
        $service->getAll();

        // Now count queries over 10 repeated calls
        $queryCount = 0;
        DB::listen(function () use (&$queryCount) {
            $queryCount++;
        });

        for ($i = 0; $i < 10; $i++) {
            $service->getAll();
        }

        $this->assertSame(0, $queryCount, 'Must show 0 queries on 10 repeated pricelist loads');
    }
}
