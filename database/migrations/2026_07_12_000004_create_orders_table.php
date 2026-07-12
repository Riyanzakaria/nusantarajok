<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invoice_number', 30)->unique();     // e.g. "BJN-20260712-001"

            // Product
            $table->foreignId('product_model_id')->constrained('product_models')->restrictOnDelete();
            $table->foreignId('car_variant_id')->constrained('car_variants')->restrictOnDelete();
            $table->string('seat_row', 10);                     // baris jok yang dibeli (e.g., "1", "1,2", "1,2,3")
            $table->string('primary_color');                     // warna primer yang dipilih
            $table->string('secondary_color')->nullable();       // warna sekunder (accent)

            // Customer
            $table->string('customer_name');
            $table->string('customer_wa', 20);                  // nomor WhatsApp (format 62xxx)
            $table->string('customer_email')->nullable();

            // Shipping
            $table->string('shipping_province');
            $table->string('shipping_city');
            $table->text('shipping_address');
            $table->string('shipping_postal_code', 10)->nullable();
            $table->string('courier_name')->nullable();
            $table->unsignedBigInteger('shipping_cost')->default(0);
            $table->string('shipping_awb')->nullable();         // nomor resi

            // Pricing
            $table->unsignedBigInteger('product_price');        // harga produk saat order dibuat
            $table->unsignedBigInteger('grand_total');          // product_price + shipping_cost

            // Payment (Midtrans)
            $table->enum('payment_status', ['unpaid', 'paid', 'expired', 'failed'])->default('unpaid');
            $table->string('midtrans_snap_token')->nullable();
            $table->text('payment_url')->nullable();            // Snap URL dari Midtrans
            $table->timestamp('paid_at')->nullable();

            // Production & Fulfillment
            $table->enum('production_status', ['waiting', 'producing', 'shipped', 'delivered'])->default('waiting');

            // Notes
            $table->text('notes')->nullable();                  // catatan dari pelanggan / admin

            $table->timestamps();
            $table->index(['payment_status', 'production_status']);
            $table->index('customer_wa');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
