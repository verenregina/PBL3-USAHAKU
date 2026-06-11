<?php

namespace App\Services;

use App\Models\AnalisisUsaha;
use App\Models\HasilAnalisis;

class RekomendasiService
{
    protected $sawService;
    protected $ruleService;

    public function __construct(SawService $sawService, RuleEngineService $ruleService)
    {
        $this->sawService = $sawService;
        $this->ruleService = $ruleService;
    }

    public function process($data)
    {
        // 1. SIMPAN INPUT
        $input = AnalisisUsaha::create([
            'user_id' => auth()->id(),
            'nama_usaha' => $data['nama_usaha'],
            'jenis_usaha' => $data['jenis_usaha'],
            'kabupaten' => $data['kabupaten'],
            'lama_usaha' => $data['lama_usaha'],
            'aset' => $data['aset'],
            'omset' => $data['omset'],
            'laba' => $data['laba'],
            'jumlah_karyawan' => $data['jumlah_karyawan'],
            'kapasitas_produksi' => $data['kapasitas_produksi'],
            'produksi_aktual' => $data['produksi_aktual'],
        ]);

        // 2. HITUNG RASIO (NORMALISASI)
        $roa = ($input->laba / max($input->aset, 1)) * 100;
        $margin = ($input->laba / max($input->omset, 1)) * 100;
        $utilisasi = ($input->produksi_aktual / max($input->kapasitas_produksi, 1)) * 100;
        $produktivitas = $input->omset / max($input->jumlah_karyawan, 1);

        // 3. SAW
        $dataKriteria = [
            'K003' => $roa,
            'K004' => $margin,
            'K007' => $utilisasi,
            'K008' => $produktivitas,
        ];

        $nilaiSaw = $this->sawService->calculate($dataKriteria);

        // 4. Kategori Potensi
        $kategoriPotensi = match (true) {
            $nilaiSaw >= 80 => 'Potensi Tinggi',
            $nilaiSaw >= 60 => 'Potensi Sedang',
            default => 'Potensi Rendah'
        };

        // 5. Forward Chaining
        $rekomendasi = $this->ruleService->generateRecommendation(
            $roa,
            $margin,
            $utilisasi,
            $produktivitas
        );

        // 6. SIMPAN HASIL
        return HasilAnalisis::create([

            'analisis_usaha_id' => $input->id,

            'roa' => $roa,
            'margin_laba' => $margin,
            'utilisasi_produksi' => $utilisasi,
            'produktivitas' => $produktivitas,

            'roa_label' => $this->labelRoa($roa),
            'margin_label' => $this->labelMargin($margin),
            'utilisasi_label' => $this->labelUtilisasi($utilisasi),
            'produktivitas_label' => $this->labelProduktivitas($produktivitas),

            'nilai_saw' => $nilaiSaw,
            'kategori_potensi' => $kategoriPotensi,

            'rekomendasi' => json_encode($rekomendasi),
        ]);
    }

    private function labelRoa($roa)
    {
        return $roa >= 30 ? 'Tinggi' : ($roa >= 10 ? 'Sedang' : 'Rendah');
    }

    private function labelMargin($margin)
    {
        return $margin >= 25 ? 'Tinggi' : ($margin >= 10 ? 'Sedang' : 'Rendah');
    }

    private function labelUtilisasi($utilisasi)
    {
        return $utilisasi >= 85 ? 'Optimal' : ($utilisasi >= 60 ? 'Cukup' : 'Kurang');
    }

    private function labelProduktivitas($nilai)
    {
        return $nilai >= 5000000
            ? 'Tinggi'
            : ($nilai >= 2000000
                ? 'Sedang'
                : 'Rendah');
    }
}
