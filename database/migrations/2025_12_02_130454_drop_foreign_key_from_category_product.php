<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('category_product')) {
            Schema::table('category_product', function (Blueprint $table) {
                // dropForeign harus pakai nama constraint atau array kolom
                $table->dropForeign(['product_id']);
                $table->dropForeign(['category_id']);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('category_product')) {
            Schema::table('category_product', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            });
        }
    }
};
