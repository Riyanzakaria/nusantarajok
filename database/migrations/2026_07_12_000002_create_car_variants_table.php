<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_variants', function (Blueprint $table) {
            $table->id();
            $table->string('brand');                            // e.g. "Toyota"
            $table->string('model_name');                      // e.g. "Avanza"
            $table->string('year_range')->nullable();           // e.g. "2012-2021"
            $table->tinyInteger('seat_rows')->default(2);       // 1 = baris depan saja, 2 = depan+belakang
            $table->boolean('has_row_1')->default(true);        // baris 1 (depan) tersedia
            $table->boolean('has_row_2')->default(true);        // baris 2 (belakang) tersedia
            $table->boolean('has_row_3')->default(false);       // baris 3 tersedia (mobil 7-seater)
            $table->unsignedInteger('weight_per_row_kg')->default(25); // berat per baris untuk ongkir
            $table->integer('price_adjustment')->default(0);    // harga tambahan/diskon dari base_price (bisa negatif)
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['brand', 'model_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_variants');
    }
};
