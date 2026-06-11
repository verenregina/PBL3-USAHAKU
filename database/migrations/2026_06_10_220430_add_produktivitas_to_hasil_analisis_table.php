<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_analisis', function (Blueprint $table) {

            $table->decimal('produktivitas', 15, 2)
                ->after('utilisasi_produksi');

            $table->string('produktivitas_label')
                ->after('utilisasi_label');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_analisis', function (Blueprint $table) {

            $table->dropColumn([
                'produktivitas',
                'produktivitas_label'
            ]);
        });
    }
};