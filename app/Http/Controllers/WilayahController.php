<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    public function kabupaten()
    {
        $response = Http::get(
            'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/35.json'
        );

        return response()->json(
            $response->json()
        );
    }

    // public function kecamatan($id)
    // {
    //     $response = Http::get(
    //         "https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$id}.json"
    //     );

    //     return response()->json(
    //         $response->json()
    //     );
    // }
}