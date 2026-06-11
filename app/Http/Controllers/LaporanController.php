<?php

namespace App\Http\Controllers;

use App\Models\HasilAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LaporanController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | CARD STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalAnalisis = HasilAnalisis::count();

        $rataRoa = round(HasilAnalisis::avg('roa'), 2);

        $rataMargin = round(HasilAnalisis::avg('margin_laba'), 2);

        $rataUtilisasi = round(HasilAnalisis::avg('utilisasi_produksi'), 2);


        /*
        |--------------------------------------------------------------------------
        | TOP 10 NILAI SAW
        |--------------------------------------------------------------------------
        */

        $top10Umkm = HasilAnalisis::with('analisisUsaha')
            ->orderByDesc('nilai_saw')
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | POTENSI UMKM PER KABUPATEN
        |--------------------------------------------------------------------------
        */

        $potensiPerDaerah = HasilAnalisis::join(
                'analisis_usaha',
                'hasil_analisis.analisis_usaha_id',
                '=',
                'analisis_usaha.id'
            )
            ->select(
                'analisis_usaha.kabupaten',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('analisis_usaha.kabupaten')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | POTENSI UMKM PER JENIS USAHA
        |--------------------------------------------------------------------------
        */

        $potensiPerJenisUsaha = HasilAnalisis::join(
                'analisis_usaha',
                'hasil_analisis.analisis_usaha_id',
                '=',
                'analisis_usaha.id'
            )
            ->select(
                'analisis_usaha.jenis_usaha',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('analisis_usaha.jenis_usaha')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KATEGORI POTENSI
        |--------------------------------------------------------------------------
        */

        $kategoriPotensi = HasilAnalisis::select(
                'kategori_potensi',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('kategori_potensi')
            ->get();


        return view('admin.laporan', compact(
            'totalAnalisis',
            'rataRoa',
            'rataMargin',
            'rataUtilisasi',
            'top10Umkm',
            'potensiPerDaerah',
            'potensiPerJenisUsaha',
            'kategoriPotensi'
        ));
    }
}