<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\VehicleCategory;
use App\Services\ScheduleService;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page/landing page.
     */
    public function index(ScheduleService $scheduleService): View
    {
        $featuredGalleries = Gallery::with('category')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();
            
        $products = \App\Models\ProductModel::active()->take(3)->get();
            
        $vehicleCategories = VehicleCategory::with('pricelists')->get();
        $calendar = $scheduleService->getAvailability(14); // Tampilkan 14 hari ke depan saja agar ringkas di kalender
            
        return view('welcome', compact('featuredGalleries', 'products', 'vehicleCategories', 'calendar'));
    }
}
