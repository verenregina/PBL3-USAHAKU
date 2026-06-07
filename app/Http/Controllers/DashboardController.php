<?php

namespace App\Http\Controllers;

use App\Models\HasilAnalisis;
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

    public function history()
    {
        $histories = HasilAnalisis::with(['analisisUsaha.user'])
            ->latest()
            ->paginate(20);

        return view('admin.history', compact('histories'));
    }

    public function userHistory()
    {
        $users = User::withCount('analisisUsaha')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.user-history', compact('users'));
    }
}
