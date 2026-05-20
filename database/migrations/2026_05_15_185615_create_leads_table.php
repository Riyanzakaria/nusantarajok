<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel leads
     *
     * Menyimpan data prospek dari kalkulator harga.
     * Data disimpan sebelum user diarahkan ke WhatsApp (Lead-to-WA Pipeline).
     * Blueprint §3A: "Data kalkulasi disimpan ke tabel leads sebelum diarahkan ke WhatsApp"
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 100);
            $table->string('whatsapp_number', 20);
            $table->string('vehicle_type', 100)->nullable()->comment('Tipe kendaraan: Avanza, Bus Medium, dll');
            $table->string('material_selected', 100)->nullable()->comment('Material yang dipilih dari kalkulator');
            $table->decimal('calculated_price', 14, 2)->default(0)->comment('Harga estimasi dari kalkulator');
            $table->enum('status', ['raw', 'follow_up', 'dealt', 'dropped'])->default('raw');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Index for funnel analysis and admin filtering
            $table->index('status', 'idx_lead_status');
            $table->index('created_at', 'idx_lead_created');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
