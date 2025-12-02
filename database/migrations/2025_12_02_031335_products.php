<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->integer('harga')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();

            
        });
    }

    public function down() {
        Schema::dropIfExists('products');
    }
};
