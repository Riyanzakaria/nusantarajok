<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\WorkOrder;
use Illuminate\Database\Seeder;

/**
 * Seeds realistic work order data for development.
 * Creates leads first (FK requirement), then work orders in various statuses.
 */
class WorkOrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            ['customer_name' => 'Budi Santoso',   'whatsapp_number' => '08123456001', 'raw_plat' => 'B 1234 XYZ', 'vehicle_type' => 'Toyota Avanza',    'status' => 'antrian',   'units' => 1],
            ['customer_name' => 'Siti Rahayu',    'whatsapp_number' => '08123456002', 'raw_plat' => 'D 5678 ABC', 'vehicle_type' => 'Honda CR-V',       'status' => 'bongkar',   'units' => 1],
            ['customer_name' => 'Ahmad Fauzi',    'whatsapp_number' => '08123456003', 'raw_plat' => 'AE 9012 KL', 'vehicle_type' => 'Bus Medium Hino',  'status' => 'potong',    'units' => 3],
            ['customer_name' => 'Dewi Lestari',   'whatsapp_number' => '08123456004', 'raw_plat' => 'AB 3456 MN', 'vehicle_type' => 'Mitsubishi Pajero','status' => 'jahit',     'units' => 1],
            ['customer_name' => 'Rina Wati',      'whatsapp_number' => '08123456005', 'raw_plat' => 'H 7890 PQ',  'vehicle_type' => 'Toyota Innova',    'status' => 'pasang',    'units' => 1],
            ['customer_name' => 'Joko Widodo',    'whatsapp_number' => '08123456006', 'raw_plat' => 'L 2345 RS',  'vehicle_type' => 'Bus Besar',        'status' => 'finishing', 'units' => 4],
            ['customer_name' => 'Mega Putri',     'whatsapp_number' => '08123456007', 'raw_plat' => 'F 6789 TU',  'vehicle_type' => 'Daihatsu Xenia',   'status' => 'antrian',   'units' => 1],
            ['customer_name' => 'Bambang S.',     'whatsapp_number' => '08123456008', 'raw_plat' => 'AG 1122 VW', 'vehicle_type' => 'Suzuki Ertiga',    'status' => 'jahit',     'units' => 1],
        ];

        foreach ($orders as $data) {
            $lead = Lead::updateOrCreate(
                ['whatsapp_number' => $data['whatsapp_number']],
                [
                    'customer_name' => $data['customer_name'],
                    'vehicle_type'  => $data['vehicle_type'],
                    'notes'         => 'Seeder data untuk demo Kanban board.',
                ]
            );

            WorkOrder::updateOrCreate(
                ['raw_plat' => $data['raw_plat']],
                [
                    'lead_id'             => $lead->id,
                    'raw_plat'            => $data['raw_plat'],
                    'normalized_plat'     => WorkOrder::normalizePlate($data['raw_plat']),
                    'vehicle_type'        => $data['vehicle_type'],
                    'work_units_required' => $data['units'],
                    'scheduled_at'        => now()->toDateString(),
                    'current_status'      => $data['status'],
                ]
            );
        }
    }
}
