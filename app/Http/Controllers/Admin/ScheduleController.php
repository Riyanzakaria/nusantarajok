<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ScheduleService;

class ScheduleController extends Controller
{
    public function index(ScheduleService $scheduleService)
    {
        // Tampilkan jadwal untuk 30 hari ke depan
        $calendar = $scheduleService->getAvailability(30);
        return view('admin.schedule.index', compact('calendar'));
    }
}
