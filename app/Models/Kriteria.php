<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'm_kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
        'deskripsi'
    ];

    public function aturan()
    {
        return $this->hasMany(AturanRekomendasi::class, 'id_kriteria', 'kode_kriteria');
    }
}