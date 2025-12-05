<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->decimal('total', 12, 2);
                $table->string('payment_method')->nullable();
                $table->string('status')->default('pending'); // pending, paid, cancelled
                $table->string('shipping_status')->default('pending'); // pending, processing, shipped, delivered
                $table->unsignedBigInteger('address_id')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
