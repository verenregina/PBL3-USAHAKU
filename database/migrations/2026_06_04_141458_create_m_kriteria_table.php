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
        Schema::create('m_kriteria', function (Blueprint $table) {
            $table->id();

            $table->string('kode_kriteria', 10)->unique();
            $table->string('nama_kriteria', 100);

            // Digunakan untuk SAW
            $table->decimal('bobot', 5, 2);

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kriteria');
    }
};