<?php

namespace App\Services;

class SawService
{
    public function calculate($data)
    {
        // ==========================
        // KONVERSI KE SKOR 1 - 5
        // ==========================

        $skorRoa = match (true) {
            $data['K003'] >= 30 => 5,
            $data['K003'] >= 20 => 4,
            $data['K003'] >= 10 => 3,
            $data['K003'] >= 5  => 2,
            default => 1
        };

        $skorMargin = match (true) {
            $data['K004'] >= 25 => 5,
            $data['K004'] >= 15 => 4,
            $data['K004'] >= 10 => 3,
            $data['K004'] >= 5  => 2,
            default => 1
        };

        $skorUtilisasi = match (true) {
            $data['K007'] >= 90 => 5,
            $data['K007'] >= 80 => 4,
            $data['K007'] >= 70 => 3,
            $data['K007'] >= 60 => 2,
            default => 1
        };

        $skorProduktivitas = match (true) {
            $data['K008'] >= 5000000 => 5,
            $data['K008'] >= 4000000 => 4,
            $data['K008'] >= 3000000 => 3,
            $data['K008'] >= 2000000 => 2,
            default => 1
        };

        // ==========================
        // NORMALISASI SAW
        // ==========================

        $normalisasi = [
            'K003' => $skorRoa / 5,
            'K004' => $skorMargin / 5,
            'K007' => $skorUtilisasi / 5,
            'K008' => $skorProduktivitas / 5,
        ];

        // ==========================
        // BOBOT
        // ==========================

        $bobot = [
            'K003' => 0.30, // ROA
            'K004' => 0.25, // Margin
            'K007' => 0.25, // Utilisasi
            'K008' => 0.20, // Produktivitas
        ];

        // ==========================
        // HITUNG SAW
        // ==========================

        $nilaiSaw =
            ($normalisasi['K003'] * $bobot['K003']) +
            ($normalisasi['K004'] * $bobot['K004']) +
            ($normalisasi['K007'] * $bobot['K007']) +
            ($normalisasi['K008'] * $bobot['K008']);

        return round($nilaiSaw * 100, 2);
    }
}
