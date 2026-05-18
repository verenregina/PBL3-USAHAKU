<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    protected $table = 'marketplace';

    protected $primaryKey = 'id_marketplace';

    protected $fillable = [
        'nama_marketplace'
    ];
}