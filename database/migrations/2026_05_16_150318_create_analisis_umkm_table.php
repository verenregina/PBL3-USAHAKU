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
        Schema::create('analisis_umkm', function (Blueprint $table) {
            $table->id('id_analisis');
        
            $table->foreignId('id_umkm')
                ->constrained('umkm', 'id_umkm')
                ->onDelete('cascade');
        
            $table->double('margin_laba');
            $table->double('avg_belanja_pelanggan');
            $table->double('utilisasi_produksi');
            $table->double('roa');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_umkm');
    }
};
