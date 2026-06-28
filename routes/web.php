<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTO-STITCH OS — Web Routes
|--------------------------------------------------------------------------
|
| Public routes: landing page, tracker search
| Admin routes: pricelist management (role:admin only)
| Technician routes: work order status updates
|
*/

// ── Public Routes ──────────────────────────────────────────────
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/galeri', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');

// ── Tracker (Public, Rate-Limited) ─────────────────────────────
Route::prefix('tracker')->name('tracker.')->group(function () {
    Route::get('/', function () {
        return view('tracker.index');
    })->name('index');

    Route::post('/search', [\App\Http\Controllers\TrackerController::class, 'search'])
        ->middleware('throttle:tracker-search')
        ->name('search');
});

Route::post('/leads', [\App\Http\Controllers\LeadController::class, 'store'])
    ->middleware('throttle:lead-capture')
    ->name('leads.store');

// ── Auth Routes (Login) ────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
});

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── Admin Routes (RBAC Protected) ──────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('pricelist', \App\Http\Controllers\Admin\PricelistController::class)
        ->except(['show', 'create', 'edit'])
        ->parameters(['pricelist' => 'pricelist']);
    
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryManagerController::class)->except(['show']);
});

// ── Technician + Admin Routes ──────────────────────────────────
Route::middleware(['auth', 'role:admin,technician'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');

    // Work order status update (technician action)
    Route::patch('/work-orders/{workOrder}/status', [\App\Http\Controllers\DashboardController::class, 'updateStatus'])
        ->name('work-orders.update-status');

    // ── Admin: Manual Order Entry (Offline POS) ─────────────────
    Route::post('/work-orders', [\App\Http\Controllers\DashboardController::class, 'storeOrder'])
        ->middleware('role:admin')
        ->name('work-orders.store');

    // ── Admin: Leads Pipeline ───────────────────────────────────
    Route::get('/leads', [\App\Http\Controllers\DashboardController::class, 'leads'])
        ->middleware('role:admin')
        ->name('leads.index');

    Route::post('/leads/{lead}/convert', [\App\Http\Controllers\DashboardController::class, 'convertLead'])
        ->middleware('role:admin')
        ->name('leads.convert');

    // ── Admin: Lead status update & hard-delete ─────────────────
    Route::patch('/leads/{lead}/status', [\App\Http\Controllers\DashboardController::class, 'updateLeadStatus'])
        ->middleware('role:admin')
        ->name('leads.status');

    Route::delete('/leads/{lead}', [\App\Http\Controllers\DashboardController::class, 'destroyLead'])
        ->middleware('role:admin')
        ->name('leads.destroy');
});
