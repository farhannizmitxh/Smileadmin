<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();       // contoh: "mandiri-4"
            $table->string('name');                // nama produk
            $table->integer('price');              // harga
            $table->string('image')->nullable();   // URL gambar

            // 3 level kategori
            $table->enum('main_category', ['mandiri', 'tefa']); // kategori utama
            $table->string('department')->nullable();           // jurusan
            $table->string('product_category')->nullable();     // kategori produk

            $table->integer('stock')->default(0);  // stok
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
