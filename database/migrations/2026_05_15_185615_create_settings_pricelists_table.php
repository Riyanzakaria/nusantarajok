<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel settings_pricelists
     *
     * Menyimpan matriks harga material dan jasa bengkel.
     * Admin memiliki kontrol penuh untuk mengubah nilai secara dinamis.
     * Data ini di-cache via PricelistObserver (Task 2.4).
     */
    public function up(): void
    {
        Schema::create('settings_pricelists', function (Blueprint $table) {
            $table->id();
            $table->string('category', 50)->comment('Kategori: material, jasa, dll');
            $table->string('item_name', 150)->comment('Nama item: Kulit Sintetis, Kulit Asli, dll');
            $table->decimal('base_price_per_meter', 12, 2)->default(0)->comment('Harga dasar per meter');
            $table->decimal('service_fee', 12, 2)->default(0)->comment('Biaya jasa pengerjaan');
            $table->timestamps();

            // Composite index for category filtering + item lookup
            $table->index(['category', 'item_name'], 'idx_category_item');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings_pricelists');
    }
};
