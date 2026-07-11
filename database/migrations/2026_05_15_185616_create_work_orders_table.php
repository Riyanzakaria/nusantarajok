<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel work_orders
     *
     * Inti dari STITCH-FLOW Engine.
     * - raw_plat: input asli dari user
     * - normalized_plat: hasil sanitasi regex (INDEX untuk pencarian publik)
     * - scheduled_at: tanggal mulai pengerjaan (INDEX untuk kalkulasi kapasitas harian)
     * - current_status: status pengerjaan untuk Progress Bar publik
     *
     * Blueprint §3B: "Pelanggan melacak progres hanya menggunakan Nomor Plat"
     */
    public function up(): void
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->string('raw_plat', 20)->comment('Input asli dari pelanggan/admin');
            $table->string('normalized_plat', 20)->comment('Hasil normalisasi regex: alfanumerik, huruf kapital');
            $table->string('vehicle_type', 100);
            $table->unsignedSmallInteger('work_units_required')->default(1)->comment('Jumlah unit kerja yang dibutuhkan');
            $table->date('scheduled_at')->comment('Tanggal mulai pengerjaan');
            $table->enum('current_status', [
                'antrian',    // Menunggu giliran
                'proses',     // Sedang dikerjakan
                'selesai',    // Siap diambil
            ])->default('antrian');
            $table->timestamps();

            // B-Tree index: pencarian plat nomor publik (prevents Full Table Scan)
            $table->index('normalized_plat', 'idx_normalized_plat');

            // B-Tree index: kalkulasi kapasitas harian (SUM work_units WHERE scheduled_at = ?)
            $table->index('scheduled_at', 'idx_scheduled_at');

            // Composite index: status filtering per tanggal (dashboard admin)
            $table->index(['scheduled_at', 'current_status'], 'idx_schedule_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
