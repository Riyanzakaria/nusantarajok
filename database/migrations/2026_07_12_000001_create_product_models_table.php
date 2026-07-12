<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // e.g. "Model Apex", "Model Titan"
            $table->string('slug')->unique();               // e.g. "model-apex"
            $table->text('description')->nullable();
            $table->unsignedBigInteger('base_price');       // in IDR (no decimals)
            $table->string('primary_image')->nullable();    // main product image path
            $table->json('gallery_images')->nullable();     // additional product images
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_models');
    }
};
