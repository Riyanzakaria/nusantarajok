<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Store a new lead from the Smart Calculator (public endpoint).
     * Fields customer_name and whatsapp_number are optional.
     */
    public function store(Request $request)
    {
        $request->validate([
            'material'        => 'required|string',
            'capacity'        => 'required|string',
            'price'           => 'required|numeric',
            'customer_name'   => 'nullable|string|max:100',
            'whatsapp_number' => 'nullable|string|max:20',
        ]);

        $lead = Lead::create([
            'customer_name'    => $request->customer_name ?: 'Web Lead — ' . now()->format('d M Y H:i'),
            'whatsapp_number'  => $request->whatsapp_number ?: 'Pending',
            'vehicle_type'     => $request->capacity,
            'material_selected'=> $request->material,
            'calculated_price' => $request->price,
            'status'           => 'raw',
        ]);

        return response()->json([
            'status'  => 'success',
            'lead_id' => $lead->id,
            'message' => 'Lead captured successfully',
        ]);
    }
}
