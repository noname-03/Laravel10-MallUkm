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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('address_id')->constrained()->cascadeOnDelete();
            $table->text('order_id');
            $table->string('courier')->nullable();
            $table->string('cost_courier')->nullable();
            $table->string('receipt_number')->nullable();
            $table->double('total');
            $table->text('payment_url')->nullable();
            $table->enum('status', ['paid', 'unpaid', 'canceled', 'sending', 'delivered']);
            $table->enum('status_payment', ['online', 'offline']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};