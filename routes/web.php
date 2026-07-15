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
Route::get('/debug-path', function() {
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    
    $logFile = storage_path('logs/laravel.log');
    $logTail = 'Disabled';

    return response()->json([
        'log' => $logTail,
        'base_path' => base_path(),
        'public_path' => public_path(),
        'storage_path' => storage_path(),
        'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'unknown',
        'script_filename' => $_SERVER['SCRIPT_FILENAME'] ?? 'unknown',
        'storage_url_test' => \Illuminate\Support\Facades\Storage::disk('public')->url('test.jpg'),
        'disk_root' => config('filesystems.disks.public.root'),
        'directory_exists' => is_dir(public_path('uploads/galleries')),
        'files' => is_dir(public_path('uploads/galleries')) ? scandir(public_path('uploads/galleries')) : [],
        'fallback_dir_exists' => is_dir(base_path('public/uploads/galleries')),
        'fallback_files' => is_dir(base_path('public/uploads/galleries')) ? scandir(base_path('public/uploads/galleries')) : [],
        'db_galleries' => \App\Models\Gallery::latest()->take(3)->get(['id', 'image_url']),
        'disk_config' => config('filesystems.disks.public'),
        'db_products' => \App\Models\ProductModel::latest()->take(3)->get(['id', 'primary_image']),
        'products_dir_exists' => is_dir(public_path('uploads/products')),
        'product_files' => is_dir(public_path('uploads/products')) ? scandir(public_path('uploads/products')) : [],
        'test_url' => \Illuminate\Support\Facades\Storage::url('products/Cu4VyVomIOPDYubLEPIEoVPia2q3kAOLIJfYuzyP.jpg'),
    ]);
});

Route::get('/fix-db', function() {
    $galleries = \App\Models\Gallery::where('image_url', 'LIKE', '/storage/%')->get();
    foreach($galleries as $g) {
        $g->image_url = str_replace('/storage/', '/uploads/', $g->image_url);
        $g->save();
    }
    return "DB Fixed! " . $galleries->count() . " rows updated.";
});

Route::get('/rescue-files', function() {
    $results = [];
    foreach(['products', 'galleries'] as $folder) {
        $src = storage_path('app/public/' . $folder);
        $dest = public_path('uploads/' . $folder);
        if (!is_dir($dest)) @mkdir($dest, 0755, true);
        
        if (is_dir($src)) {
            $files = scandir($src);
            foreach($files as $f) {
                if ($f !== '.' && $f !== '..') {
                    $s = $src . '/' . $f;
                    $d = $dest . '/' . $f;
                    if (is_file($s) && !file_exists($d)) {
                        copy($s, $d);
                        $results[] = "Rescued: $folder/$f";
                    }
                }
            }
        }
    }
    return empty($results) ? "No files to rescue." : implode("<br>", $results);
});

Route::get('/find-file', function() {
    try {
        $fallback = base_path('public/uploads/products');
        $files = is_dir($fallback) ? scandir($fallback) : "Dir not found: $fallback";
        
        $old = storage_path('app/public/products');
        $old_files = is_dir($old) ? scandir($old) : "Dir not found: $old";

        return response()->json([
            'fallback' => $files,
            'old' => $old_files,
            'public_html' => is_dir(public_path('uploads/products')) ? scandir(public_path('uploads/products')) : [],
        ]);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/galeri', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap.index');

// Katalog Produk Publik
Route::get('/produk', [\App\Http\Controllers\ProductCatalogController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [\App\Http\Controllers\ProductCatalogController::class, 'show'])->name('products.show');

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
    Route::get('orders/{order}/print-label', [\App\Http\Controllers\Admin\OrderController::class, 'printLabel'])->name('orders.print-label');
    Route::patch('orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::delete('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');

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

    // ── Admin: Manual Order Entry & Delete ──────────────────────
    Route::post('/work-orders', [\App\Http\Controllers\DashboardController::class, 'storeOrder'])
        ->middleware('role:admin')
        ->name('work-orders.store');
    
    Route::delete('/work-orders/{workOrder}', [\App\Http\Controllers\DashboardController::class, 'destroyWorkOrder'])
        ->middleware('role:admin')
        ->name('work-orders.destroy');

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
