<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Milestone 1 Checkpoint Tests
 *
 * Task 1.2: RBAC — technician gets HTTP 403 on /admin/pricelist
 * Task 1.3: Throttle — 6th request in 1 minute gets HTTP 429
 */
class Milestone1Test extends TestCase
{
    use RefreshDatabase;

    // ── Task 1.2: RBAC Middleware ─────────────────────────────────

    public function test_admin_can_access_pricelist(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/pricelist');

        $response->assertStatus(200);
    }

    public function test_technician_gets_403_on_admin_pricelist(): void
    {
        $technician = User::factory()->create(['role' => 'technician']);

        $response = $this->actingAs($technician)->get('/admin/pricelist');

        $response->assertStatus(403);
    }

    public function test_guest_is_redirected_from_admin_pricelist(): void
    {
        $response = $this->get('/admin/pricelist');

        $response->assertRedirect('/login');
    }

    // ── Task 1.3: Rate Limiting ──────────────────────────────────

    public function test_tracker_search_allows_5_requests_per_minute(): void
    {
        // Seed a work order so the tracker returns 200 (not 404)
        $lead = Lead::factory()->create();
        WorkOrder::create([
            'lead_id'             => $lead->id,
            'raw_plat'            => 'B 8888 XZ',
            'vehicle_type'        => 'Avanza',
            'work_units_required' => 1,
            'scheduled_at'        => now()->toDateString(),
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $response = $this->post('/tracker/search', [
                '_token' => csrf_token(),
                'plat_nomor' => 'B 8888 XZ',
            ]);

            $response->assertStatus(200);
        }
    }

    public function test_tracker_search_blocks_6th_request_with_429(): void
    {
        // Exhaust the 5-request limit
        for ($i = 1; $i <= 5; $i++) {
            $this->post('/tracker/search', [
                '_token' => csrf_token(),
                'plat_nomor' => 'B 8888 XZ',
            ]);
        }

        // The 6th request must be blocked
        $response = $this->post('/tracker/search', [
            '_token' => csrf_token(),
            'plat_nomor' => 'B 8888 XZ',
        ]);

        $response->assertStatus(429);
    }

    // ── RBAC Edge Cases ──────────────────────────────────────────

    public function test_technician_can_access_dashboard(): void
    {
        $technician = User::factory()->create(['role' => 'technician']);

        $response = $this->actingAs($technician)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(200);
    }
}
