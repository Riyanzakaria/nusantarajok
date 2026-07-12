<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookController;

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
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap.index');

// Checkout Flow
Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Payment Page
Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{order}/regenerate', [PaymentController::class, 'regenerate'])->name('payment.regenerate');

// Midtrans Webhook (Make sure to exclude this from CSRF in bootstrap/app.php in Laravel 11)
Route::post('/api/webhook/midtrans', [WebhookController::class, 'midtrans'])->name('webhook.midtrans');

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
    Route::resource('vehicle-categories', \App\Http\Controllers\Admin\VehicleCategoryController::class)->except(['show', 'create', 'edit', 'update']);
    Route::get('schedule', [\App\Http\Controllers\Admin\ScheduleController::class, 'index'])->name('schedule.index');
    
    Route::resource('pricelist', \App\Http\Controllers\Admin\PricelistController::class)
        ->except(['show', 'create', 'edit'])
        ->parameters(['pricelist' => 'pricelist']);
    
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryManagerController::class)->except(['show']);
    
    // ── E-Commerce Order Management ──────────────────────────
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');

    // --- E-Commerce Master Data ---
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except('show');
    Route::resource('car-variants', \App\Http\Controllers\Admin\CarVariantController::class)->except('show');
    Route::resource('shipping-rates', \App\Http\Controllers\Admin\ShippingRateController::class)->except('show');
});

// ── Technician + Admin Routes ──────────────────────────────────
Route::middleware(['auth', 'role:admin,technician'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');

    // History & Export
    Route::get('/history', [\App\Http\Controllers\DashboardController::class, 'history'])->name('work-orders.history');
    Route::get('/export-csv', [\App\Http\Controllers\DashboardController::class, 'exportCsv'])->name('work-orders.export');

    // Work order status update (technician action)
    Route::patch('/work-orders/{work_order}/status', [\App\Http\Controllers\DashboardController::class, 'updateStatus'])->name('work-orders.update-status');

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
