<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_analisis', function (Blueprint $table) {

            $table->id();

            $table->foreignId('analisis_usaha_id')->constrained()->onDelete('cascade');

            $table->decimal('roa', 8, 2);
            $table->decimal('margin_laba', 8, 2);
            $table->decimal('utilisasi_produksi', 8, 2);

            $table->string('roa_label');
            $table->string('margin_label');
            $table->string('utilisasi_label');

            $table->decimal('nilai_saw', 8, 2);

            $table->string('kategori_potensi');

            $table->text('rekomendasi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_analisis');
    }
};
