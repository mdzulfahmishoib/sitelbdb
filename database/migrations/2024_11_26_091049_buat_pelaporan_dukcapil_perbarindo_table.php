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
        Schema::create('pelaporan_dukcapil_perbarindo', function (Blueprint $table) {
            $table->id('id_pelaporan_dukcapil_perbarindo'); // This will create an auto-incrementing unsigned integer primary key.
            $table->date('tanggal_input_data');
            $table->string('periode_tahun')->nullable();
            $table->string('jenis_periode')->nullable();
            $table->string('nama_laporan')->nullable();
            $table->string('nama_laporan_isidentil')->nullable();
            $table->string('dokumen_pendukung')->nullable();
            $table->timestamps(); // created_at and updated_at timestamps.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporan_dukcapil_perbarindo');
    }
};
