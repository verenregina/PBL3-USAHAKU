<?php

namespace App\Services;

use App\Models\Kriteria;

class SawService
{
    public function calculate($dataKriteria)
    {
        $kriteriaList = Kriteria::all();

        // 1. Siapkan nilai mentah
        $matrix = [];

        foreach ($kriteriaList as $kriteria) {
            $matrix[$kriteria->kode_kriteria] = $dataKriteria[$kriteria->kode_kriteria] ?? 0;
        }

        // 2. Hitung max & min tiap kriteria
        $max = [];
        $min = [];

        foreach ($kriteriaList as $kriteria) {
            $code = $kriteria->kode_kriteria;

            $max[$code] = $matrix[$code]; // karena 1 input (bisa dikembangkan multi data)
            $min[$code] = $matrix[$code];
        }

        // 3. Normalisasi
        $normalisasi = [];

        foreach ($kriteriaList as $kriteria) {

            $code = $kriteria->kode_kriteria;
            $nilai = $matrix[$code];

            if ($kriteria->tipe == 'benefit') {
                $normalisasi[$code] = $nilai / max($max[$code], 1);
            } else {
                $normalisasi[$code] = $min[$code] / max($nilai, 1);
            }
        }

        // 4. Hitung nilai akhir
        $total = 0;

        foreach ($kriteriaList as $kriteria) {
            $code = $kriteria->kode_kriteria;

            $total += $normalisasi[$code] * $kriteria->bobot;
        }

        return round($total * 100, 3);
    }
}