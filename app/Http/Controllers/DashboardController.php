<?php

namespace App\Http\Controllers;

use App\Models\HasilAnalisis;
use App\Models\JenisUsaha;
use App\Models\User;
use App\Models\Umkm;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
class DashboardController extends Controller
{
    public function index()
    {
        $totalUsaha = Umkm::count();

        $totalKategori = JenisUsaha::count();

        $totalUser = User::count();

        $periodStart = Carbon::today()->subDays(6);
        $dateCounts = HasilAnalisis::selectRaw('DATE(created_at) as date, count(*) as total')
            ->where('created_at', '>=', $periodStart->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $chartLabels = [];
        $chartData = [];

        for ($day = $periodStart->copy(); $day->lte(Carbon::today()); $day->addDay()) {
            $chartLabels[] = $day->format('d M');
            $chartData[] = $dateCounts[$day->toDateString()] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalUsaha',
            'totalKategori',
            'totalUser',
            'chartLabels',
            'chartData'
        ));
    }

    public function history()
    {
        $histories = HasilAnalisis::with(['analisisUsaha.user'])
            ->latest()
            ->paginate(20);

        return view('admin.history', compact('histories'));
    }

    public function exportPdf($id)
{
    $history = HasilAnalisis::with(['analisisUsaha.user'])
        ->findOrFail($id);

    $pdf = Pdf::loadView('admin.history-pdf', compact('history'));

    return $pdf->download('laporan-'.$history->id.'.pdf');
}

    public function userHistory()
    {
        $users = User::withCount('analisisUsaha')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.user-history', compact('users'));
    }
}
