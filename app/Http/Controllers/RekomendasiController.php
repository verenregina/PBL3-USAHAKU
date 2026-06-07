<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisUsaha;
use App\Services\RekomendasiService;

class RekomendasiController extends Controller
{
    protected $rekomendasiService;

    public function __construct(RekomendasiService $rekomendasiService)
    {
        $this->rekomendasiService = $rekomendasiService;
    }

    // FORM
    public function showForm()
    {
        $jenisUsaha = JenisUsaha::all();

        return view('pages.rekomendasi-form', compact('jenisUsaha'));
    }

    // PROSES
    public function processRecommendation(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string',
            'jenis_usaha' => 'required|string',
            'kabupaten' => 'required|string',
            'lama_usaha' => 'required|numeric',

            'aset' => 'required|numeric',
            'omset' => 'required|numeric',
            'laba' => 'required|numeric',

            'jumlah_karyawan' => 'required|numeric',
            'kapasitas_produksi' => 'required|numeric',
            'produksi_aktual' => 'required|numeric',
        ]);

        $hasil = $this->rekomendasiService->process($validated);

        return redirect()->route('rekomendasi.hasil', $hasil->id);
    }

    // HASIL
    public function hasil($id)
    {
        $hasil = \App\Models\HasilAnalisis::findOrFail($id);

        return view('pages.hasil-rekomendasi', compact('hasil'));
    }
}