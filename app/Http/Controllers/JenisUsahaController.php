<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisUsaha;

class JenisUsahaController extends Controller
{
    /**
     * Menampilkan semua jenis usaha
     */
    public function index()
    {
        $data = JenisUsaha::all();

        return response()->json([
            'success' => true,
            'message' => 'Data jenis usaha berhasil diambil',
            'data' => $data
        ], 200);
    }

    /**
     * Menampilkan detail jenis usaha berdasarkan ID
     */
    public function show($id)
    {
        $data = JenisUsaha::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}