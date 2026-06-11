<?php

namespace App\Services;

class RuleEngineService
{
    public function generateRecommendation(
        $roa,
        $margin,
        $utilisasi,
        $produktivitas
    ) {

        $rekomendasi = [];

        if ($roa < 10) {
            $rekomendasi[] =
                'Tingkatkan efisiensi penggunaan aset agar laba meningkat.';
        }

        if ($margin < 10) {
            $rekomendasi[] =
                'Kurangi biaya operasional untuk meningkatkan margin laba.';
        }

        if ($utilisasi < 60) {
            $rekomendasi[] =
                'Tingkatkan pemasaran agar kapasitas produksi lebih optimal.';
        }

        if ($produktivitas < 2000000) {
            $rekomendasi[] =
                'Tingkatkan produktivitas karyawan melalui pelatihan.';
        }

        if (empty($rekomendasi)) {
            $rekomendasi[] =
                'Kondisi usaha sudah baik, pertahankan dan tingkatkan skala usaha.';
        }

        return $rekomendasi;
    }
}
