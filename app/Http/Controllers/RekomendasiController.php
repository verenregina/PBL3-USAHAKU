<?php

namespace App\Http\Controllers;

use App\Models\JenisUsaha;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    // Tampilkan form input rekomendasi
public function showForm()
{
    $jenisUsaha = JenisUsaha::all();

    return view('pages.rekomendasi-form', compact('jenisUsaha'));
}

    // Proses rekomendasi dan tampilkan hasil
    public function processRecommendation(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'aset' => 'required|numeric|min:0',
            'omset' => 'required|numeric|min:0',
            'laba' => 'required|numeric|min:0',
            'jumlah_pelanggan' => 'required|numeric|min:0',
            'nama_usaha' => 'required|string|max:255',
            'daerah' => 'required|string|max:255',
        ]);

        // Baca dataset
        $csvFile = base_path('SBP UTS/dataset_umkm_bersih.csv');
        if (!file_exists($csvFile)) {
            return back()->with('error', 'Dataset tidak ditemukan');
        }

        $data = array_map('str_getcsv', file($csvFile));
        $headers = array_shift($data);
        
        // Hitung mean untuk kategori
        $asets = array_column($data, array_search('aset', $headers));
        $omsets = array_column($data, array_search('omset', $headers));
        $labas = array_column($data, array_search('laba', $headers));
        $pelanggan = array_column($data, array_search('jumlah_pelanggan', $headers));

        $meanAset = array_sum($asets) / count($asets);
        $meanOmset = array_sum($omsets) / count($omsets);
        $meanLaba = array_sum($labas) / count($labas);
        $meanPelanggan = array_sum($pelanggan) / count($pelanggan);

        // Kategorikan input user
        $asetKat = $validated['aset'] > $meanAset ? 'Tinggi' : 'Rendah';
        $omsetKat = $validated['omset'] > $meanOmset ? 'Tinggi' : 'Rendah';
        $labaKat = $validated['laba'] > $meanLaba ? 'Tinggi' : 'Rendah';
        $pelangganKat = $validated['jumlah_pelanggan'] > $meanPelanggan ? 'Banyak' : 'Sedikit';

        // Backward Chaining Logic
        $potensi = $this->backwardChaining(
            $asetKat, $omsetKat, $labaKat, $pelangganKat
        );

        // Hitung persentase risiko
        $riskPercentage = $this->calculateRisk($asetKat, $omsetKat, $labaKat);

        // Rekomendasi sistem
        $recommendation = $this->getRecommendation($potensi);

        return view('recommendation.result', [
            'input' => $validated,
            'potensi' => $potensi,
            'riskPercentage' => $riskPercentage,
            'recommendation' => $recommendation,
            'asetKat' => $asetKat,
            'omsetKat' => $omsetKat,
            'labaKat' => $labaKat,
            'pelangganKat' => $pelangganKat,
        ]);
    }

    // Backward Chaining
    private function backwardChaining($aset, $omset, $laba, $pelanggan)
    {
        // Potensi Tinggi
        if ($aset == 'Tinggi' && $omset == 'Tinggi' && $laba == 'Tinggi') {
            return 'Potensi Tinggi';
        }
        // Potensi Sedang
        elseif ($omset == 'Tinggi' || $pelanggan == 'Banyak') {
            return 'Potensi Sedang';
        }
        // Potensi Rendah
        else {
            return 'Potensi Rendah';
        }
    }

    // Hitung risiko
    private function calculateRisk($aset, $omset, $laba)
    {
        $risk = 0;
        if ($aset == 'Rendah') $risk += 40;
        if ($omset == 'Rendah') $risk += 35;
        if ($laba == 'Rendah') $risk += 25;
        return min($risk, 100);
    }

    // Rekomendasi sistem
    private function getRecommendation($potensi)
    {
        if ($potensi == 'Potensi Tinggi') {
            return 'Usaha Anda memiliki potensi tinggi. Disarankan untuk melakukan ekspansi dan diversifikasi produk/layanan.';
        } elseif ($potensi == 'Potensi Sedang') {
            return 'Usaha Anda memiliki potensi sedang. Fokus pada peningkatan efisiensi operasional dan customer retention.';
        } else {
            return 'Usaha Anda perlu perhatian khusus. Pertimbangkan untuk restructuring bisnis atau mencari strategi baru.';
        }
    }
}
