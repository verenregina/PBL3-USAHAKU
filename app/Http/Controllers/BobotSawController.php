<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class BobotSawController extends Controller
{
    // Menampilkan data bobot
    public function index()
    {
        $kriteria = Kriteria::orderBy('kode_kriteria')->get();

        return view('admin.bobot-saw', compact('kriteria'));
    }

    // Update bobot
    public function update(Request $request)
    {
        $request->validate([
            'bobot.*' => 'required|numeric|min:0'
        ]);

        // Jumlah seluruh bobot
        $totalBobot = array_sum($request->bobot);

        if (round($totalBobot, 2) != 1) {
            return back()
                ->withInput()
                ->with('error', 'Total bobot harus sama dengan 1');
        }

        foreach ($request->bobot as $id => $nilai) {
            Kriteria::where('id', $id)
                ->update([
                    'bobot' => $nilai
                ]);
        }

        return back()->with('success', 'Bobot berhasil diperbarui');
    }
}