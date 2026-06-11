<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(); // BLM-2024-XXXX
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('notes')->nullable();
            $table->json('items'); // cart items snapshot
            $table->integer('subtotal');
            $table->integer('tax');
            $table->integer('total');
            $table->string('payment_method')->default('QRIS');
            $table->string('status')->default('pending'); // pending, paid, processing
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};