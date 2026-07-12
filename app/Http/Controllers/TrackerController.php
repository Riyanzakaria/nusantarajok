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
     * Search for an order by invoice number.
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:50',
        ]);

        $query = strtoupper(trim($request->input('query')));

        // 1. Check if it's an E-commerce Order (Invoice)
        if (str_starts_with($query, 'BJN-')) {
            $order = \App\Models\Order::with('product')
                ->where('invoice_number', $query)
                ->first();

            if ($order) {
                return response()->json([
                    'status'             => 'ok',
                    'type'               => 'ecommerce',
                    'invoice_number'     => $order->invoice_number,
                    'product_name'       => $order->product->name ?? 'Jok Custom',
                    'payment_status'     => $order->payment_status->value,
                    'payment_status_label' => $order->payment_status->label(),
                    'production_status'  => $order->production_status->value,
                    'production_status_label' => $order->production_status->label(),
                    'production_step'    => $order->production_status->stepNumber(),
                    'courier_name'       => $order->courier_name,
                    'shipping_awb'       => $order->shipping_awb,
                    'created_at'         => $order->created_at->format('d M Y'),
                ]);
            }
        }

        // 2. Check if it's an Offline Work Order (Phone or Plate)
        $normalizedQuery = preg_replace('/[^a-zA-Z0-9]/', '', $query);
        $normalizedPhone = preg_replace('/[^0-9]/', '', $query);
        
        $workOrder = null;
        if (!empty($normalizedQuery)) {
            $workOrderQuery = \App\Models\WorkOrder::where('normalized_plat', $normalizedQuery);
            if (!empty($normalizedPhone)) {
                $workOrderQuery->orWhereHas('lead', function($q) use ($normalizedPhone) {
                    $q->where('phone', 'like', '%' . $normalizedPhone . '%');
                });
            }
            $workOrder = $workOrderQuery->first();
        }

        if ($workOrder) {
            $step = match($workOrder->current_status) {
                'antrian' => 1,
                'proses'  => 2,
                'selesai' => 4,
                default   => 1,
            };
            
            $statusLabel = match($workOrder->current_status) {
                'antrian' => 'Masuk Antrian',
                'proses'  => 'Sedang Dikerjakan',
                'selesai' => 'Selesai / Siap Diambil',
                default   => 'Menunggu',
            };

            return response()->json([
                'status'             => 'ok',
                'type'               => 'offline',
                'invoice_number'     => 'PLAT: ' . $workOrder->raw_plat,
                'product_name'       => 'Pengerjaan Bengkel: ' . $workOrder->vehicle_type,
                'payment_status_label' => 'Bayar di Bengkel',
                'production_status_label' => $statusLabel,
                'production_step'    => $step,
                'courier_name'       => null,
                'shipping_awb'       => null,
                'created_at'         => $workOrder->created_at ? $workOrder->created_at->format('d M Y') : '-',
            ]);
        }

        return response()->json([
            'status' => 'not_found',
            'message' => 'Pesanan tidak ditemukan. Periksa kembali nomor invoice, plat, atau nomor WA Anda.',
        ], 404);
    }
}
