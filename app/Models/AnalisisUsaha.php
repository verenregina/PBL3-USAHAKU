<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalisisUsaha extends Model
{
    protected $table = 'analisis_usaha';

    protected $fillable = [
        'user_id',

        'nama_usaha',
        'jenis_usaha',
        'kabupaten',
        'lama_usaha',

        'aset',
        'omset',
        'laba',

        'jumlah_karyawan',
        'kapasitas_produksi',
        'produksi_aktual',
    ];

    public function hasilAnalisis()
    {
        return $this->hasOne(HasilAnalisis::class, 'analisis_usaha_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}