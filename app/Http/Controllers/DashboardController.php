<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\SettingsPricelist;
use App\Models\VehicleCategory;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

/**
 * DashboardController
 *
 * Handles the internal dashboard view for both admin and technician roles.
 * - Admin sees management links + active work orders overview.
 * - Technician sees only the Kanban board for status updates.
 */
class DashboardController extends Controller
{
    /**
     * Display the dashboard with active work orders grouped by status.
     */
    public function index()
    {
        // Active statuses for the Kanban board (exclude 'selesai')
        $activeStatuses = ['antrian', 'bongkar', 'potong', 'jahit', 'pasang', 'finishing'];

        $workOrders = WorkOrder::with('lead')
            ->whereIn('current_status', $activeStatuses)
            ->orderBy('scheduled_at')
            ->get()
            ->groupBy('current_status');

        // Ensure all columns exist even if empty
        $kanbanColumns = collect($activeStatuses)->mapWithKeys(function ($status) use ($workOrders) {
            return [$status => $workOrders->get($status, collect())];
        });

        $statusLabels = [
            'antrian'   => 'Antrian',
            'bongkar'   => 'Bongkar',
            'potong'    => 'Potong Pola',
            'jahit'     => 'Jahit',
            'pasang'    => 'Pasang',
            'finishing' => 'Finishing',
        ];

        $statusColors = [
            'antrian'   => 'slate',
            'bongkar'   => 'amber',
            'potong'    => 'blue',
            'jahit'     => 'violet',
            'pasang'    => 'emerald',
            'finishing' => 'orange',
        ];

        // Data for the "+ Tambah Pesanan Manual" modal
        $vehicleCategories = VehicleCategory::with('pricelists')->get();
        $rawLeadsCount = Lead::where('status', 'raw')->count();

        return view('dashboard.index', compact(
            'kanbanColumns', 'statusLabels', 'statusColors',
            'vehicleCategories', 'rawLeadsCount'
        ));
    }

    /**
     * Store a manually-entered work order (Offline POS / Admin entry).
     * Creates a Lead record first, then a linked WorkOrder.
     */
    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name'      => 'required|string|max:100',
            'whatsapp_number'    => 'required|string|max:20',
            'raw_plat'           => 'required|string|max:20',
            'vehicle_category_id'=> 'required|exists:vehicle_categories,id',
            'pricelist_id'       => 'required|exists:settings_pricelists,id',
            'scheduled_at'       => 'required|date',
        ]);

        $category  = VehicleCategory::findOrFail($validated['vehicle_category_id']);
        $pricelist = SettingsPricelist::findOrFail($validated['pricelist_id']);

        // 1. Create the lead record
        $lead = Lead::create([
            'customer_name'    => $validated['customer_name'],
            'whatsapp_number'  => $validated['whatsapp_number'],
            'vehicle_type'     => $category->name,
            'material_selected'=> $pricelist->item_name,
            'calculated_price' => $pricelist->price,
            'status'           => 'dealt',
        ]);

        // 2. Create work order linked to the lead
        WorkOrder::create([
            'lead_id'             => $lead->id,
            'raw_plat'            => $validated['raw_plat'],
            'vehicle_type'        => $category->name,
            'work_units_required' => 1,
            'scheduled_at'        => $validated['scheduled_at'],
            'current_status'      => 'antrian',
        ]);

        return redirect()->route('dashboard.index')
            ->with('success', "Pesanan untuk {$validated['customer_name']} ({$validated['raw_plat']}) berhasil masuk antrian!");
    }

    /**
     * Display the Leads Pipeline panel (admin only).
     */
    public function leads()
    {
        $leads = Lead::whereIn('status', ['raw', 'follow_up'])
            ->latest()
            ->get();

        $vehicleCategories = VehicleCategory::with('pricelists')->get();

        return view('dashboard.leads', compact('leads', 'vehicleCategories'));
    }

    /**
     * Convert a web lead into an active work order.
     */
    public function convertLead(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'raw_plat'            => 'required|string|max:20',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'pricelist_id'        => 'required|exists:settings_pricelists,id',
            'scheduled_at'        => 'required|date',
        ]);

        $category  = VehicleCategory::findOrFail($validated['vehicle_category_id']);
        $pricelist = SettingsPricelist::findOrFail($validated['pricelist_id']);

        // Update lead to 'dealt'
        $lead->update([
            'vehicle_type'      => $category->name,
            'material_selected' => $pricelist->item_name,
            'calculated_price'  => $pricelist->price,
            'status'            => 'dealt',
        ]);

        // Create the work order
        WorkOrder::create([
            'lead_id'             => $lead->id,
            'raw_plat'            => $validated['raw_plat'],
            'vehicle_type'        => $category->name,
            'work_units_required' => 1,
            'scheduled_at'        => $validated['scheduled_at'],
            'current_status'      => 'antrian',
        ]);

        return redirect()->route('dashboard.index')
            ->with('success', "Prospek {$lead->customer_name} berhasil dikonversi menjadi pesanan aktif!");
    }

    /**
     * Update the status of a work order (technician action).
     * This directly feeds the public Liquid Tracker.
     */
    public function updateStatus(Request $request, WorkOrder $workOrder)
    {
        $validated = $request->validate([
            'status' => 'required|in:antrian,bongkar,potong,jahit,pasang,finishing,selesai',
        ]);

        $workOrder->update(['current_status' => $validated['status']]);

        return redirect()->route('dashboard.index')
            ->with('success', "Status {$workOrder->raw_plat} diperbarui ke \"{$validated['status']}\".");
    }

    /**
     * Update a lead's status manually (admin action).
     */
    public function updateLeadStatus(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'status' => 'required|in:raw,follow_up,dealt,dropped',
        ]);

        $lead->update(['status' => $validated['status']]);

        return redirect()->route('dashboard.leads.index')
            ->with('success', "Status prospek {$lead->customer_name} diperbarui.");
    }

    /**
     * Hard-delete a lead record (admin action).
     */
    public function destroyLead(Lead $lead)
    {
        $name = $lead->customer_name;
        $lead->delete();

        return redirect()->route('dashboard.leads.index')
            ->with('success', "Prospek \"{$name}\" berhasil dihapus.");
    }
}
