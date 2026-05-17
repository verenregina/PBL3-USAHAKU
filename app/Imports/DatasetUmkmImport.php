<?php

namespace App\Imports;

use App\Models\Umkm;
use App\Models\JenisUsaha;
use App\Models\Marketplace;
use App\Models\Daerah;
use App\Models\AnalisisUmkm;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DatasetUmkmImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // JENIS USAHA
        $jenisUsaha = JenisUsaha::firstOrCreate(
            [
                'kode_jenis_usaha' => $row['kode_jenis_usaha']
            ],
            [
                'nama_jenis_usaha' => $row['jenis_usaha']
            ]
        );

        // MARKETPLACE
        $marketplace = Marketplace::firstOrCreate([
            'nama_marketplace' => $row['marketplace']
        ]);

        // DAERAH
        $daerah = Daerah::firstOrCreate([
            'nama_daerah' => $row['daerah']
        ]);

        // SIMPAN UMKM
        $umkm = Umkm::create([
            // 'id_umkm' => $row['id_umkm'],
            'nama_usaha' => $row['nama_usaha'],

            'id_jenis_usaha' => $jenisUsaha->id_jenis_usaha,
            'id_marketplace' => $marketplace->id_marketplace,
            'id_daerah' => $daerah->id_daerah,

            'tenaga_kerja_perempuan' => $row['tenaga_kerja_perempuan'],
            'tenaga_kerja_laki_laki' => $row['tenaga_kerja_laki_laki'],
            'total_tenaga_kerja' => $row['total_tenaga_kerja'],

            'aset' => $row['aset'],
            'omset' => $row['omset'],
            'kapasitas_produksi' => $row['kapasitas_produksi'],
            'tahun_berdiri' => $row['tahun_berdiri'],
            'jumlah_pelanggan' => $row['jumlah_pelanggan'],
            'laba' => $row['laba'],
            'biaya_karyawan' => $row['biaya_karyawan']
        ]);

        // SIMPAN ANALISIS UMKM
        AnalisisUmkm::create([
            'id_umkm' => $umkm->id_umkm,

            'margin_laba' => $row['margin_laba'],
            'avg_belanja_pelanggan' => $row['avg_belanja_pelanggan'],
            'utilisasi_produksi' => $row['utilisasi_produksi'],
            'roa' => $row['roa']
        ]);

        return $umkm;
    }
}