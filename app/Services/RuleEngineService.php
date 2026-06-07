<?php

namespace App\Services;

use App\Models\AturanRekomendasi;

class RuleEngineService
{
    public function evaluate($roa, $margin, $utilisasi)
    {
        $rules = AturanRekomendasi::all();
        $skor = 0;

        foreach ($rules as $rule) {

            $nilai = match ($rule->id_kriteria) {
                'K003' => $roa,
                'K004' => $margin,
                'K007' => $utilisasi,
                default => null
            };

            if ($nilai === null) continue;

            if ($rule->operator == 'between') {
                if ($nilai >= $rule->nilai_min && $nilai <= $rule->nilai_max) {
                    $skor += $rule->skor_aturan;
                }
            }

            if ($rule->operator == '>=') {
                if ($nilai >= $rule->nilai_min) {
                    $skor += $rule->skor_aturan;
                }
            }
        }

        return match (true) {
            $skor >= 7 => 'Potensi Tinggi',
            $skor >= 4 => 'Potensi Sedang',
            default => 'Potensi Rendah'
        };
    }
}