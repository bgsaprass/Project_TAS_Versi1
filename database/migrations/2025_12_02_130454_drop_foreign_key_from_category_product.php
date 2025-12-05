<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ini seharusnya HANYA membuat tabel categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // JIKA ADA kode berikut, HAPUS:
        // Schema::create('category_product', ...)
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
        // JIKA ADA: Schema::dropIfExists('category_product');
    }
};
