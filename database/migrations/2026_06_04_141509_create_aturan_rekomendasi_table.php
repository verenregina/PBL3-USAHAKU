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
        Schema::create('aturan_rekomendasi', function (Blueprint $table) {
            $table->id();

            $table->string('id_aturan')->unique();
            $table->string('id_kriteria');

            $table->string('operator');

            $table->decimal('nilai_min', 10, 2)->nullable();
            $table->decimal('nilai_max', 10, 2)->nullable();

            $table->string('label');
            $table->integer('skor_aturan');

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturan_rekomendasi');
    }
};
