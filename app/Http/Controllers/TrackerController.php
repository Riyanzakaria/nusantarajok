<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;

/**
 * TrackerController
 *
 * Handles public vehicle tracking search.
 * Only returns: vehicle type + production status.
 * Isolates all PII (name, phone, price) from public layer.
 *
 * Blueprint §2: "Anonymized Public Tracker"
 * Blueprint §3B: "Hanya menampilkan jenis kendaraan dan status (Progress Bar), bukan data pribadi/harga."
 */
class TrackerController extends Controller
{
    /**
     * Search for a work order by plate number.
     * Normalizes the input before querying via the indexed normalized_plat column.
     */
    public function search(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:20',
        ]);

        // Normalize using the same regex as WorkOrder model
        $normalized = WorkOrder::normalizePlate($request->input('plat_nomor'));

        // Query via indexed column (B-Tree: idx_normalized_plat)
        $order = WorkOrder::where('normalized_plat', $normalized)
            ->latest()
            ->first();

        if (! $order) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Data kendaraan tidak ditemukan.',
            ], 404);
        }

        // Anonymized response: ONLY vehicle type + status. No PII.
        return response()->json([
            'status'           => 'ok',
            'vehicle_type'     => $order->vehicle_type,
            'current_status'   => $order->current_status,
            'progress_percent' => $order->progress_percent,
            'scheduled_at'     => $order->scheduled_at->format('d M Y'),
        ]);
    }
}
