<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('m_kriteria', function (Blueprint $table) {
            $table->enum('tipe', ['benefit', 'cost'])
                  ->default('benefit')
                  ->after('bobot');
        });
    }

    public function down(): void
    {
        Schema::table('m_kriteria', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }
};