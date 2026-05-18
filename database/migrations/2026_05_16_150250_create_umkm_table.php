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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id('id_umkm');
        
            $table->string('nama_usaha');
        
            $table->foreignId('id_jenis_usaha')
                ->constrained('jenis_usaha', 'id_jenis_usaha');
        
            $table->foreignId('id_marketplace')
                ->constrained('marketplace', 'id_marketplace');
        
            $table->foreignId('id_daerah')
                ->constrained('daerah', 'id_daerah');
        
            $table->integer('tenaga_kerja_perempuan');
            $table->integer('tenaga_kerja_laki_laki');
            $table->integer('total_tenaga_kerja');
        
            $table->bigInteger('aset');
            $table->bigInteger('omset');
        
            $table->integer('kapasitas_produksi');
            $table->year('tahun_berdiri');
        
            $table->bigInteger('laba');
            $table->bigInteger('biaya_karyawan');
        
            $table->integer('jumlah_pelanggan');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
