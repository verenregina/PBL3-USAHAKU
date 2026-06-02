<?php

namespace App\Http\Controllers;

use App\Models\JenisUsaha;
use App\Models\User;
use App\Models\Umkm;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsaha = Umkm::count();

        $totalKategori = JenisUsaha::count();

        $totalUser = User::count();

        return view('admin.dashboard', compact(
            'totalUsaha',
            'totalKategori',
            'totalUser'
        ));
    }
}
