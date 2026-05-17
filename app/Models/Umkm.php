<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';

    protected $primaryKey = 'id_umkm';

    protected $fillable = [
        'nama_usaha',
        'id_jenis_usaha',
        'id_marketplace',
        'id_daerah',
        'tenaga_kerja_perempuan',
        'tenaga_kerja_laki_laki',
        'total_tenaga_kerja',
        'aset',
        'omset',
        'kapasitas_produksi',
        'tahun_berdiri',
        'jumlah_pelanggan',
        'laba',
        'biaya_karyawan'
    ];

    // =========================
    // RELASI JENIS USAHA
    // =========================
    public function jenisUsaha()
    {
        return $this->belongsTo(
            JenisUsaha::class,
            'id_jenis_usaha'
        );
    }

    // =========================
    // RELASI MARKETPLACE
    // =========================
    public function marketplace()
    {
        return $this->belongsTo(
            Marketplace::class,
            'id_marketplace'
        );
    }

    // =========================
    // RELASI DAERAH
    // =========================
    public function daerah()
    {
        return $this->belongsTo(
            Daerah::class,
            'id_daerah'
        );
    }

    // =========================
    // RELASI ANALISIS
    // =========================
    public function analisis()
    {
        return $this->hasOne(
            AnalisisUmkm::class,
            'id_umkm'
        );
    }
}