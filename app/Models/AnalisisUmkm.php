<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalisisUmkm extends Model
{
    protected $table = 'analisis_umkm';

    protected $primaryKey = 'id_analisis';

    protected $fillable = [
        'id_umkm',
        'margin_laba',
        'avg_belanja_pelanggan',
        'utilisasi_produksi',
        'roa'
    ];
}