<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_kriteria')->updateOrInsert(
            ['kode_kriteria' => 'K003'],
            [
                'nama_kriteria' => 'ROA',
                'bobot' => 0.30,
                'tipe' => 'benefit',
                'deskripsi' => 'Return on Assets'
            ]
        );

        DB::table('m_kriteria')->updateOrInsert(
            ['kode_kriteria' => 'K004'],
            [
                'nama_kriteria' => 'Margin Laba',
                'bobot' => 0.25,
                'tipe' => 'benefit',
                'deskripsi' => 'Persentase laba terhadap omset'
            ]
        );

        DB::table('m_kriteria')->updateOrInsert(
            ['kode_kriteria' => 'K007'],
            [
                'nama_kriteria' => 'Utilisasi Produksi',
                'bobot' => 0.25,
                'tipe' => 'benefit',
                'deskripsi' => 'Tingkat pemanfaatan kapasitas produksi'
            ]
        );

        DB::table('m_kriteria')->updateOrInsert(
            ['kode_kriteria' => 'K008'],
            [
                'nama_kriteria' => 'Produktivitas',
                'bobot' => 0.20,
                'tipe' => 'benefit',
                'deskripsi' => 'Pendapatan per jumlah karyawan'
            ]
        );
    }
}
