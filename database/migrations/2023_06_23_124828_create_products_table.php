<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('category_products')->onDelete('cascade');
            $table->string('title');
            $table->string('price');
            $table->string('price_retail')->nullable();
            $table->double('qty');
            $table->string('weight'); // Tipe data decimal dengan presisi 8 dan skala 2
            $table->double('promo')->nullable();
            $table->string('unit');
            $table->text('unit_variant');
            $table->text('description');
            $table->text('photo');
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