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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price',10,2);
            $table->decimal('compare_price',10,2)->nullable();
            $table->string('condition');
            $table->string('grade')->nullable();
            $table->integer('stock')->default(0);
            $table->json('specifications')->nullable(); // RAM, Storage, Color, etc.
            $table->json('accessories_included')->nullable(); // Charger, Cable, etc.
            $table->string('battery_health')->nullable(); // 85%, 90%, etc.
            $table->boolean('is_published')->default(false);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->json('images')->nullable(); // JSON column for multiple images
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
