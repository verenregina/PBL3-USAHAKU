<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analisis_usaha', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->nullable();

            $table->string('nama_usaha');
            $table->string('jenis_usaha');

            $table->string('kabupaten');

            $table->integer('lama_usaha');

            $table->decimal('aset', 15, 2);
            $table->decimal('omset', 15, 2);
            $table->decimal('laba', 15, 2);

            $table->integer('jumlah_karyawan');

            $table->decimal('kapasitas_produksi', 15, 2);
            $table->decimal('produksi_aktual', 15, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analisis_usaha');
    }
};
