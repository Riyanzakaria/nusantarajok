<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id();
            $table->string('province_name');                    // e.g. "Jawa Timur"
            $table->string('province_code', 10)->unique();      // e.g. "JT"
            $table->unsignedBigInteger('cost_per_row');         // ongkir per baris jok (IDR)
            $table->string('estimated_days')->default('3-5 hari'); // e.g. "2-3 hari"
            $table->string('courier_name')->default('JNE Kargo'); // nama jasa kirim
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_rates');
    }
};
