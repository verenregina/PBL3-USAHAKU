<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AturanRekomendasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('aturan_rekomendasi')->insert([

            [
                'id_aturan' => 'AR001',
                'id_kriteria' => 'K003',
                'operator' => 'between',
                'nilai_min' => 0,
                'nilai_max' => 10,
                'label' => 'Rendah',
                'skor_aturan' => 1,
                'keterangan' => 'ROA rendah menunjukkan aset belum menghasilkan laba optimal',
            ],
            [
                'id_aturan' => 'AR002',
                'id_kriteria' => 'K003',
                'operator' => 'between',
                'nilai_min' => 10,
                'nilai_max' => 30,
                'label' => 'Sedang',
                'skor_aturan' => 2,
                'keterangan' => 'ROA sedang menunjukkan aset cukup produktif',
            ],
            [
                'id_aturan' => 'AR003',
                'id_kriteria' => 'K003',
                'operator' => '>=',
                'nilai_min' => 30,
                'nilai_max' => null,
                'label' => 'Tinggi',
                'skor_aturan' => 3,
                'keterangan' => 'ROA tinggi menunjukkan aset produktif',
            ],

            [
                'id_aturan' => 'AR004',
                'id_kriteria' => 'K004',
                'operator' => 'between',
                'nilai_min' => 0,
                'nilai_max' => 10,
                'label' => 'Rendah',
                'skor_aturan' => 1,
                'keterangan' => 'Margin laba rendah menunjukkan keuntungan masih kecil',
            ],
            [
                'id_aturan' => 'AR005',
                'id_kriteria' => 'K004',
                'operator' => 'between',
                'nilai_min' => 10,
                'nilai_max' => 25,
                'label' => 'Sedang',
                'skor_aturan' => 2,
                'keterangan' => 'Margin laba sedang menunjukkan keuntungan cukup baik',
            ],
            [
                'id_aturan' => 'AR006',
                'id_kriteria' => 'K004',
                'operator' => '>=',
                'nilai_min' => 25,
                'nilai_max' => null,
                'label' => 'Tinggi',
                'skor_aturan' => 3,
                'keterangan' => 'Margin laba tinggi menunjukkan keuntungan baik',
            ],

            [
                'id_aturan' => 'AR007',
                'id_kriteria' => 'K007',
                'operator' => 'between',
                'nilai_min' => 0,
                'nilai_max' => 60,
                'label' => 'Rendah',
                'skor_aturan' => 1,
                'keterangan' => 'Utilisasi produksi rendah menunjukkan kapasitas belum optimal',
            ],
            [
                'id_aturan' => 'AR008',
                'id_kriteria' => 'K007',
                'operator' => 'between',
                'nilai_min' => 60,
                'nilai_max' => 85,
                'label' => 'Sedang',
                'skor_aturan' => 2,
                'keterangan' => 'Utilisasi produksi sedang menunjukkan produksi cukup stabil',
            ],
            [
                'id_aturan' => 'AR009',
                'id_kriteria' => 'K007',
                'operator' => '>=',
                'nilai_min' => 85,
                'nilai_max' => null,
                'label' => 'Tinggi',
                'skor_aturan' => 3,
                'keterangan' => 'Utilisasi produksi tinggi menunjukkan produksi optimal',
            ],

        ]);
    }
}