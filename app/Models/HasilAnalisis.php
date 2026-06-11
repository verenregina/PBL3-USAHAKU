<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAnalisis extends Model
{
    protected $table = 'hasil_analisis';

    protected $fillable = [

        'analisis_usaha_id',

        'roa',
        'margin_laba',
        'utilisasi_produksi',
        'produktivitas',

        'roa_label',
        'margin_label',
        'utilisasi_label',
        'produktivitas_label',

        'nilai_saw',
        'kategori_potensi',

        'rekomendasi'
    ];

    public function analisisUsaha()
    {
        return $this->belongsTo(AnalisisUsaha::class);
    }
}