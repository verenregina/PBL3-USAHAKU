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
        Schema::table('hasil_analisis', function (Blueprint $table) {
            $table->string('jenis_usaha')->after('nama_usaha');
            $table->string('daerah')->after('jenis_usaha');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_analisis', function (Blueprint $table) {
            $table->dropColumn(['jenis_usaha', 'daerah']);
        });
    }
};
