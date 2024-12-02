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
        Schema::create('kategori_produk_dana', function (Blueprint $table) {
            $table->id('id_kategori_produk_dana'); // This will create an auto-incrementing unsigned integer primary key.
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('dokumentasi_db')->nullable();
            $table->timestamps(); // created_at and updated_at timestamps.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_produk_dana');
    }
};
