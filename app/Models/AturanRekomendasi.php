<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AturanRekomendasi extends Model
{
    protected $table = 'aturan_rekomendasi';

    protected $fillable = [
        'id_aturan',
        'id_kriteria',
        'operator',
        'nilai_min',
        'nilai_max',
        'label',
        'skor_aturan',
        'keterangan'
    ];

    public function kriteria()
    {
        return $this->belongsTo(
            Kriteria::class,
            'id_kriteria',
            'kode_kriteria'
        );
    }
}