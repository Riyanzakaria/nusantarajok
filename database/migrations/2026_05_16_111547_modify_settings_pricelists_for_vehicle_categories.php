<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings_pricelists', function (Blueprint $table) {
            $table->dropIndex('idx_category_item');
            
            if (Schema::hasColumn('settings_pricelists', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
            $table->dropColumn(['category', 'base_price_per_meter', 'service_fee']);
            
            $table->foreignId('vehicle_category_id')->after('id')->nullable()->constrained('vehicle_categories')->cascadeOnDelete();
            $table->decimal('price', 12, 2)->after('item_name')->default(0)->comment('Harga mutlak material untuk kendaraan ini');
            
            $table->index(['vehicle_category_id', 'item_name'], 'idx_vehcat_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings_pricelists', function (Blueprint $table) {
            $table->dropForeign(['vehicle_category_id']);
            $table->dropIndex('idx_vehcat_item');
            $table->dropColumn(['vehicle_category_id', 'price']);
            
            $table->string('category', 50)->nullable();
            $table->decimal('base_price_per_meter', 12, 2)->default(0);
            $table->decimal('service_fee', 12, 2)->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->index(['category', 'item_name'], 'idx_category_item');
        });
    }
};
